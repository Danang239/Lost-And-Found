<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;

use App\Models\Item;
use App\Models\Claim;

class ProfileController extends Controller
{
    // ==============================
    // HALAMAN PROFIL
    // ==============================
    public function index()
    {
        $user = auth()->user();

        $stats = [
            'total_claims'    => Claim::where('user_id', $user->id)->count(),
            'total_reports'   => Item::where('user_id', $user->id)->count(),
            'approved_claims' => Claim::where('user_id', $user->id)->where('status', 'approved')->count(),
            'pending_claims'  => Claim::where('user_id', $user->id)->where('status', 'pending')->count(),
        ];

        $recentActivities = Claim::with('item')
            ->where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($claim) {
                return [
                    'icon'  => 'claim',
                    'label' => 'Mengklaim barang ' . ($claim->item->name ?? 'tanpa nama'),
                    'time'  => ($claim->claimed_at ?? $claim->created_at)->format('d M Y'),
                ];
            });

        return view('profile', compact('user', 'stats', 'recentActivities'));
    }

    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    // ==============================
    // UPDATE PROFIL (NAMA, EMAIL, NO HP, FOTO)
    // ==============================
    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name'  => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
            'phone'         => ['nullable', 'string', 'max:20'],
            'profile_photo' => ['nullable', 'image', 'max:2048'],
        ]);

        $user->name  = $validated['name'];
        $user->email = $validated['email'];
        $user->phone = $validated['phone'] ?? null;

        // Foto profil
        if ($request->hasFile('profile_photo')) {
            if ($user->profile_photo_path) {
                Storage::disk('public')->delete($user->profile_photo_path);
            }

            $path = $request->file('profile_photo')->store('profile_photos', 'public');
            $user->profile_photo_path = $path;
        }

        $user->save();

        return redirect()->route('profile')->with('success', 'Profil berhasil diperbarui!');
    }

    // ==============================
    // UPDATE PASSWORD
    // ==============================
    public function updatePassword(Request $request): RedirectResponse
    {
        $user = $request->user();

        // Validasi password
        $request->validate(
            [
                'current_password'      => ['required'],
                'password'              => [
                    'required',
                    'confirmed',
                    'min:8',
                    // wajib ada huruf kapital & angka
                    'regex:/^(?=.*[A-Z])(?=.*\d).+$/',
                ],
            ],
            [
                'current_password.required' => 'Password saat ini wajib diisi.',
                'password.required'        => 'Password baru wajib diisi.',
                'password.confirmed'       => 'Konfirmasi password baru tidak sama.',
                'password.min'             => 'Password baru minimal 8 karakter.',
                'password.regex'           => 'Password baru harus mengandung huruf kapital dan angka.',
            ]
        );

        // Cek password lama
        if (!Hash::check($request->current_password, $user->password)) {
            return back()
                ->withErrors(['current_password' => 'Password saat ini tidak sesuai.'])
                ->withInput();
        }

        // Simpan password baru
        $user->password = Hash::make($request->password);
        $user->save();

        return Redirect::route('profile')->with('success', 'Password berhasil diperbarui!');
    }

    // ==============================
    // PREFERENSI NOTIFIKASI
    // ==============================
    public function updateNotifications(Request $request): RedirectResponse
    {
        $user = $request->user();

        $request->validate([
            'notify_claim_via_email' => ['nullable', 'boolean'],
            'notify_claim_status'    => ['nullable', 'boolean'],
            'notify_campus_info'     => ['nullable', 'boolean'],
        ]);

        $user->notify_claim_via_email = $request->boolean('notify_claim_via_email');
        $user->notify_claim_status    = $request->boolean('notify_claim_status');
        $user->notify_campus_info     = $request->boolean('notify_campus_info');

        $user->save();

        return Redirect::route('profile')->with('success', 'Preferensi notifikasi berhasil diperbarui!');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
