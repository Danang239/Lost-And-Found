@extends('layouts.app')

@section('content')

@php
    $user = auth()->user();

    // statistik (kalau controller tidak kirim, pakai default)
    $stats = $stats ?? [];

    $totalClaims    = $stats['total_claims']    ?? 0;
    $totalReports   = $stats['total_reports']   ?? 0;
    $approvedClaims = $stats['approved_claims'] ?? 0;
    $pendingClaims  = $stats['pending_claims']  ?? 0;

    // aktivitas terbaru
    $recentActivities = $recentActivities ?? collect();
@endphp

<div class="py-10 md:py-5 pb-24">
    <div class="max-w-5xl mx-auto">

        {{-- ================= HEADER ================= --}}
        <div class="text-center mb-10">
            <h1 class="text-3xl md:text-4xl font-extrabold text-slate-900">Profil Saya</h1>
            <p class="text-slate-500 mt-2 text-sm md:text-base">
                Kelola informasi akun Anda untuk memudahkan proses klaim dengan admin.
            </p>
        </div>

        {{-- ============ CARD PROFIL UTAMA ============ --}}
        <div class="bg-white rounded-3xl shadow-lg border border-slate-100 max-w-2xl mx-auto mb-10">
            <div class="px-10 pt-10 pb-8 flex flex-col items-center text-center">

                {{-- Avatar --}}
                <div class="w-28 h-28 rounded-full bg-indigo-100 overflow-hidden flex items-center justify-center shadow mb-5">
                    @if($user->profile_photo_path)
                        <img src="{{ asset('storage/' . $user->profile_photo_path) }}"
                             alt="Foto Profil"
                             class="w-full h-full object-cover">
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 text-indigo-600" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M12 12a4 4 0 1 0-4-4 4.003 4.003 0 0 0 4 4Zm0 2c-4 0-7 2-7 4v1h14v-1c0-2-3-4-7-4Z"/>
                        </svg>
                    @endif
                </div>

                {{-- Nama + email --}}
                <h2 class="text-2xl md:text-3xl font-semibold text-slate-900">
                    {{ $user->name }}
                </h2>
                <p class="mt-1 text-slate-600 flex items-center gap-2 text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-indigo-500" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M4 5h16v14H4z"/>
                        <path d="m4 5 8 7 8-7"/>
                    </svg>
                    {{ $user->email }}
                </p>

                {{-- Telepon (kalau ada) --}}
                @if($user->phone)
                    <div class="mt-4 w-full">
                        <div class="px-5 py-3 bg-emerald-50 border border-emerald-100 rounded-2xl flex items-center justify-between">
                            <div class="flex items-center gap-3 text-emerald-900">
                                <div class="w-9 h-9 bg-white border border-emerald-100 rounded-full flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                         viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M6.5 4h2l2 4-1.5 1a9 9 0 004 4l1-1.5 4 2v2a2 2 0 01-2.2 2 15 15 0 01-6.8-3.2A15 15 0 014.5 8.2 2 2 0 016.5 4z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-[11px] text-emerald-600 uppercase font-semibold">Nomor Telepon</p>
                                    <p class="font-medium">{{ $user->phone }}</p>
                                </div>
                            </div>
                            <div class="px-3 py-1 text-[11px] font-bold text-white bg-emerald-600 rounded-full">
                                Aktif
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Tip --}}
                <div class="mt-5 w-full">
                    <p class="px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs text-slate-500">
                        Pastikan informasi akun sesuai untuk mempercepat proses verifikasi klaim barang.
                    </p>
                </div>

                {{-- Tombol Edit -> ke halaman edit profil --}}
                <a
                    href="{{ route('profile.edit') }}"
                    class="mt-6 inline-flex items-center gap-2 px-6 py-2.5 bg-slate-900 text-white rounded-full text-sm font-semibold hover:bg-slate-800 transition shadow cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M15.232 5.232 18.768 8.768M5 19l3.5-.5L19 8l-3.5-3.5L5.5 15.5 5 19z"/>
                    </svg>
                    Edit Profil
                </a>
            </div>
        </div>

        {{-- ============ STATISTIK ============ --}}
        <div class="mb-10">
            <h2 class="text-sm font-semibold text-slate-600 uppercase tracking-wide mb-4">
                Ringkasan Aktivitas
            </h2>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="bg-white border border-slate-200 rounded-2xl p-4 shadow-sm">
                    <p class="text-xs text-slate-500 mb-1">Barang yang Anda klaim</p>
                    <p class="text-2xl font-bold">{{ $totalClaims }}</p>
                </div>
                <div class="bg-white border border-slate-200 rounded-2xl p-4 shadow-sm">
                    <p class="text-xs text-slate-500 mb-1">Barang yang Anda laporkan</p>
                    <p class="text-2xl font-bold">{{ $totalReports }}</p>
                </div>
                <div class="bg-white border border-slate-200 rounded-2xl p-4 shadow-sm">
                    <p class="text-xs text-slate-500 mb-1">Klaim disetujui</p>
                    <p class="text-2xl font-bold">{{ $approvedClaims }}</p>
                </div>
                <div class="bg-white border border-slate-200 rounded-2xl p-4 shadow-sm">
                    <p class="text-xs text-slate-500 mb-1">Menunggu verifikasi</p>
                    <p class="text-2xl font-bold">{{ $pendingClaims }}</p>
                </div>
            </div>
        </div>

        {{-- ============ AKTIVITAS TERBARU ============ --}}
        <div class="mb-10">
            <h2 class="text-sm font-semibold text-slate-600 uppercase tracking-wide mb-3">
                Aktivitas Terbaru
            </h2>

            @if($recentActivities->count() === 0)
                <p class="text-slate-500 text-sm">
                    Belum ada aktivitas. Klaim atau laporkan barang agar aktivitas muncul di sini.
                </p>
            @else
                <div class="space-y-3">
                    @foreach($recentActivities as $a)
                        <div class="flex items-center gap-4 bg-white border border-slate-200 rounded-xl p-4 shadow-sm">
                            <div class="w-10 h-10 bg-indigo-100 rounded-full flex items-center justify-center text-indigo-600">
                                @if(($a['icon'] ?? '') === 'claim')
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                         viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M5 13l4 4L19 7"/>
                                    </svg>
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                         viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M4 6h16M4 10h10M4 14h8M4 18h6"/>
                                    </svg>
                                @endif
                            </div>
                            <div class="flex-1">
                                <p class="font-semibold text-slate-800">
                                    {{ $a['label'] ?? '-' }}
                                </p>
                                <p class="text-xs text-slate-500">
                                    {{ $a['time'] ?? '' }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- ============ KEAMANAN AKUN ============ --}}
        <div class="mb-10">
            <h2 class="text-sm font-semibold text-slate-600 uppercase tracking-wide mb-3">
                Keamanan Akun
            </h2>

            <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm space-y-2 text-sm text-slate-700">
                <p>• Email terdaftar: <span class="font-medium">{{ $user->email }}</span></p>
                <p>• Gunakan password yang kuat dan jangan bagikan ke orang lain.</p>
                <p>• Logout jika menggunakan perangkat umum.</p>
            </div>
        </div>

        {{-- ============ PREFERENSI NOTIFIKASI ============ --}}
        <div class="mb-10">
            <h2 class="text-sm font-semibold text-slate-600 uppercase tracking-wide mb-3">
                Preferensi Notifikasi
            </h2>

            {{-- FORM PREFERENSI NOTIFIKASI --}}
            <form
                action="{{ route('profile.notifications.update') }}" {{-- pastikan route ini ada --}}
                method="POST"
                class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm space-y-4 text-sm text-slate-700"
            >
                @csrf
                @method('PUT')

                <p class="text-slate-600 text-sm">
                    Atur jenis notifikasi yang ingin Anda terima terkait klaim barang dan informasi kampus.
                </p>

                <label class="flex items-center gap-3">
                    <input
                        type="checkbox"
                        name="notify_claim_via_email"
                        value="1"
                        class="w-4 h-4 rounded border-slate-300"
                        {{ old('notify_claim_via_email', $user->notify_claim_via_email) ? 'checked' : '' }}
                    >
                    <span>Notifikasi klaim barang via email</span>
                </label>

                <label class="flex items-center gap-3">
                    <input
                        type="checkbox"
                        name="notify_claim_status"
                        value="1"
                        class="w-4 h-4 rounded border-slate-300"
                        {{ old('notify_claim_status', $user->notify_claim_status) ? 'checked' : '' }}
                    >
                    <span>Notifikasi ketika klaim Anda disetujui / ditolak</span>
                </label>

                <div class="pt-2">
                    <button
                        type="submit"
                        class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-slate-900 text-white text-xs font-semibold hover:bg-slate-800 transition"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M5 13l4 4L19 7"/>
                        </svg>
                        Simpan Preferensi
                    </button>
                </div>
            </form>
        </div>

        {{-- ============ INFO AKUN ============ --}}
        <div class="mb-4">
            <h2 class="text-sm font-semibold text-slate-600 uppercase tracking-wide mb-3">
                Informasi Akun
            </h2>

            <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm text-sm text-slate-700 space-y-2">
                <p>• ID Pengguna: <span class="font-medium">{{ $user->id }}</span></p>
                <p>• Terdaftar sejak: <span class="font-medium">{{ optional($user->created_at)->format('d M Y') }}</span></p>
                <p>• Total aktivitas (klaim + laporan): <span class="font-medium">{{ $totalClaims + $totalReports }}</span></p>
            </div>
        </div>

    </div>
</div>

@endsection
