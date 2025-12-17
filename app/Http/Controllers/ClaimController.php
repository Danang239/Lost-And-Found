<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Claim;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;

// Notifikasi in-app (database)
use App\Notifications\NewClaimNotification;
use App\Notifications\ClaimVerifiedNotification;
use App\Notifications\ClaimRejectedNotification;

// EMAIL
use App\Mail\NewClaimMail;
use App\Mail\ClaimStatusMail;
use Illuminate\Support\Facades\Mail;

class ClaimController extends Controller
{
    public function submitClaim(Request $request, Item $item)
    {
        $request->validate([
            'answer' => 'required|string|max:500',
        ]);

        // Cek apakah user sudah punya klaim yang statusnya pending (0) atau approved (1) untuk item ini
        $alreadyClaimed = Claim::where('item_id', $item->id)
            ->where('user_id', auth()->id())
            ->whereIn('verified', [0, 1]) // 0 = pending, 1 = approved
            ->exists();

        if ($alreadyClaimed) {
            return redirect()->back()->with('error', 'Anda sudah mengklaim barang ini dan sedang menunggu/verifikasi.');
        }

        // Simpan klaim baru dengan status pending (0)
        $claim = Claim::create([
            'item_id'  => $item->id,
            'user_id'  => auth()->id(),
            'message'  => $request->answer,
            'verified' => 0,  // pending
        ]);

        // ===========================
        // NOTIFIKASI ke PEMILIK BARANG
        // ===========================

        // Notifikasi in-app
        $item->user->notify(new NewClaimNotification($claim));

        // Notifikasi via EMAIL -> cek preferensi pemilik barang
        $owner = $item->user;

        if ($owner && $owner->notify_claim_via_email) {
            try {
                Mail::to($owner->email)->send(new NewClaimMail($claim));
            } catch (\Throwable $e) {
                // Jangan bikin aplikasi error kalau Mailtrap / SMTP limit
                \Log::warning('Gagal kirim email klaim baru: ' . $e->getMessage());
            }
        }

        return redirect()->back()->with('success', 'Klaim berhasil dikirim, silahkan tunggu verifikasi.');
    }

    public function listPendingClaims()
    {
        $userItems = Item::where('user_id', auth()->id())
            ->where('type', 'found')
            ->pluck('id');

        $pendingClaims = Claim::whereIn('item_id', $userItems)
            ->where('verified', 0) // klaim yang belum diverifikasi (pending)
            ->with(['item', 'user'])
            ->get();

        return view('claims.verify', compact('pendingClaims'));
    }

    public function verify(Request $request, Claim $claim)
    {
        $request->validate([
            'verified' => 'required|boolean',
        ]);

        // Cek pemilik barang
        if ($claim->item->user_id !== auth()->id()) {
            abort(403);
        }

        // user yang mengajukan klaim
        $claimer = $claim->user;

        if ($request->verified) {
            // =====================
            //  APPROVE KLAIM
            // =====================
            $now = now(); // gunakan waktu yang sama untuk claim & item

            $claim->verified   = 1;
            $claim->claimed_at = $now;          // <-- TANGGAL KLAIM DISIMPAN DI TABEL claims

            // kalau kamu punya kolom claimed_at di tabel items, boleh tetap diisi
            $claim->item->claimed_at = $now;    // <-- tanggal klaim di tabel items (opsional)
            $claim->item->save();

            // Notifikasi in-app
            $claim->user->notify(new ClaimVerifiedNotification($claim, true));

            $claim->save();

            // Notifikasi EMAIL ke pengklaim -> cek preferensi
            if ($claimer && $claimer->notify_claim_status) {
                try {
                    Mail::to($claimer->email)->send(new ClaimStatusMail($claim));
                } catch (\Throwable $e) {
                    \Log::warning('Gagal kirim email status klaim (approved): ' . $e->getMessage());
                }
            }

            // Set session flash untuk pop-up di pemilik
            return redirect()->back()->with([
                'success'      => 'Verifikasi klaim telah disimpan.',
                'claim_status' => 'approved',
            ]);
        } else {
            // =====================
            //  REJECT KLAIM
            // =====================
            $claim->verified = 2;
            // Klaim ditolak, claimed_at dibiarkan null (tidak di-set)

            // Notifikasi in-app
            $claim->user->notify(new ClaimRejectedNotification($claim));

            $claim->save();

            // Notifikasi EMAIL ke pengklaim -> cek preferensi
            if ($claimer && $claimer->notify_claim_status) {
                try {
                    Mail::to($claimer->email)->send(new ClaimStatusMail($claim));
                } catch (\Throwable $e) {
                    \Log::warning('Gagal kirim email status klaim (rejected): ' . $e->getMessage());
                }
            }

            // Set session flash untuk pop-up di pemilik
            return redirect()->back()->with([
                'success'      => 'Verifikasi klaim telah disimpan.',
                'claim_status' => 'rejected',
            ]);
        }
    }

    public function index()
    {
        // Pastikan di model Claim ada:
        // protected $casts = ['claimed_at' => 'datetime'];
        $claims = auth()->user()
            ->claims()
            ->with('item')
            ->orderByDesc('claimed_at')   // biar yang terbaru muncul di atas
            ->paginate(10);

        return view('claims.index', compact('claims'));
    }
}
