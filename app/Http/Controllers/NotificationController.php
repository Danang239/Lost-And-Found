<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    // Method untuk menandai notifikasi sudah dibaca (per notifikasi)
    public function markAsRead($id, Request $request)
    {
        // Ambil notifikasi berdasarkan id
        $notification = $request->user()->notifications()->find($id);

        // Jika notifikasi ditemukan
        if ($notification) {
            $notification->markAsRead(); // Tandai sebagai dibaca
            return back()->with('success', 'Notifikasi telah ditandai sudah dibaca.');
        }

        // Jika notifikasi tidak ditemukan
        return back()->with('error', 'Notifikasi tidak ditemukan.');
    }

    // Method untuk menandai semua notifikasi sebagai dibaca
    public function markAll(Request $request)
    {
        $request->user()->unreadNotifications->markAsRead();

        // Cek request apakah AJAX atau biasa
        if ($request->wantsJson()) {
            return response()->json(['success' => true]);
        }

        return back()->with('success', 'Semua notifikasi telah ditandai sudah dibaca.');
    }

    // Hapus notifikasi berdasarkan ID
    public function delete($id, Request $request)
    {
        $notification = $request->user()->notifications()->find($id);

        if ($notification) {
            $notification->delete(); // Hapus dari database
            return back()->with('success', 'Notifikasi berhasil dihapus.');
        }

        return back()->with('error', 'Notifikasi tidak ditemukan.');
    }

    // (Opsional) Hapus semua notifikasi user
    public function deleteAll(Request $request)
    {
        $request->user()->notifications()->delete(); // Hapus semua notifikasi
        return back()->with('success', 'Semua notifikasi dihapus.');
    }

    public function destroy($id)
    {
        $notification = auth()->user()->notifications()->find($id);
        if ($notification) {
            $notification->delete();
            return back()->with('success', 'Notifikasi berhasil dihapus.');
        }
        return back()->with('error', 'Notifikasi tidak ditemukan.');
    }

}
