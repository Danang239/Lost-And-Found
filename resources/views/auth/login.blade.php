@extends('layouts.auth')

@section('content')

{{-- ===================== SECTION LOGIN (FULL SCREEN DENGAN BACKGROUND GAMBAR) ===================== --}}
<section class="min-h-screen flex items-center justify-center px-4 py-10 relative overflow-hidden">

    {{-- Background Gambar --}}
    <div class="absolute inset-0">
        <img src="/images/bg.jpg"
             class="w-full h-full object-cover object-center" />
    </div>

    {{-- Overlay agar teks tetap terbaca --}}
    <div class="absolute inset-0 bg-black/40 backdrop-blur-[2px]"></div>

    {{-- WRAPPER LOGIN --}}
    <div class="relative w-full max-w-md bg-white/20 backdrop-blur-xl rounded-3xl shadow-2xl border border-white/30 p-8">

        {{-- LOGO --}}
        <div class="flex justify-center mb-5">
            <img src="/images/logo.png" alt="Logo" class="w-20 h-20 rounded-full shadow-xl object-cover border border-white/40">
        </div>

        {{-- HEADING --}}
        <h2 class="text-center text-2xl font-semibold text-white">Welcome Back</h2>
        <p class="text-center text-sm text-white/80 mb-6">
            Silakan masuk untuk melanjutkan
        </p>

        {{-- FORM LOGIN --}}
        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            {{-- EMAIL --}}
            <div>
                <label class="block text-sm text-white mb-1">Email</label>
                <input type="email" name="email" required placeholder="Masukkan email"
                       class="w-full rounded-xl bg-white/20 text-white px-3 py-2.5 placeholder-white/60 border-0
                              focus:ring-2 focus:ring-blue-400">
            </div>

            {{-- PASSWORD --}}
            <div>
                <label class="block text-sm text-white mb-1">Password</label>
                <input type="password" name="password" required placeholder="Masukkan password"
                       class="w-full rounded-xl bg-white/20 text-white px-3 py-2.5 placeholder-white/60 border-0
                              focus:ring-2 focus:ring-blue-400">
            </div>

            {{-- REMEMBER ME --}}
            <div class="flex items-center justify-between text-xs text-white/80">
                <label class="inline-flex items-center gap-2">
                    <input type="checkbox" class="rounded border-white/40 bg-transparent"> Ingat saya
                </label>
            </div>

            {{-- LOGIN BUTTON --}}
            <button
                class="w-full bg-white text-indigo-900 font-semibold py-2.5 rounded-xl shadow-lg hover:bg-gray-100 transition">
                Login
            </button>
        </form>

        {{-- LINK REGISTER --}}
        <p class="mt-5 text-center text-sm text-white/80">
            Belum punya akun?
            <a href="{{ route('register') }}" class="font-semibold underline">Daftar akun</a>
        </p>

        {{-- SCROLL INDICATOR --}}
        <div class="mt-8 text-center text-xs text-white/70">
            <p>Scroll ke bawah untuk melihat About</p>
            <a href="#about" class="mt-1 inline-block animate-bounce">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                     fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                </svg>
            </a>
        </div>

    </div>
</section>





{{-- ===================== SECTION ABOUT (VERSI GAMBAR AESTHETIC) ===================== --}}
<section id="about"
         class="relative py-24 px-6 overflow-hidden">

    {{-- Background Gambar --}}
    <div class="absolute inset-0">
        <img src="/images/bg_about.png"
             class="w-full h-full object-cover object-center" />
    </div>

    {{-- Overlay supaya teks tetap terbaca --}}
    <div class="absolute inset-0 bg-black/50 backdrop-blur-[2px]"></div>

    <div class="relative max-w-7xl mx-auto space-y-16 text-white">

        {{-- ========== ROW 1 (Foto + Deskripsi) ========== --}}
        <div class="grid lg:grid-cols-2 gap-14 items-center">

            <div>
                <img src="/images/about2.webp"
                     class="rounded-3xl shadow-2xl w-full h-[430px] object-cover border border-white/20">
            </div>

            <div class="space-y-6">

                <h2 class="text-4xl font-bold leading-snug">
                    Tentang Aplikasi Lost & Found
                </h2>

                <p class="text-white/80 text-lg leading-relaxed">
                    Lost & Found adalah sistem pelaporan barang hilang dan ditemukan
                    yang dibuat untuk membantu civitas kampus menemukan kembali barang berharga
                    dengan cepat dan mudah.
                </p>

                <p class="text-white/80 text-lg leading-relaxed">
                    Setiap laporan diverifikasi, memastikan keamanan dan keakuratan proses klaim,
                    sehingga meminimalkan kesalahan penyerahan barang.
                </p>

                <p class="text-white/80 text-lg leading-relaxed">
                    Dengan aplikasi ini, lingkungan kampus menjadi lebih tertib,
                    aman, dan membantu mahasiswa serta staf menemukan barangnya lagi.
                </p>

                <a href="/items"
                   class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-xl shadow-lg">
                    Mulai Cari Barangmu
                </a>

            </div>

        </div>


        {{-- ========== ROW 2 (Fitur Utama) ========== --}}
        <div class="grid md:grid-cols-3 gap-8">

            <div class="bg-white/10 p-6 rounded-2xl border border-white/20 shadow-xl backdrop-blur-md">
                <h3 class="text-xl font-semibold text-white mb-3">Pelaporan Mudah</h3>
                <p class="text-white/70">
                    Laporkan barang hilang atau ditemukan dalam hitungan detik.
                </p>
            </div>

            <div class="bg-white/10 p-6 rounded-2xl border border-white/20 shadow-xl backdrop-blur-md">
                <h3 class="text-xl font-semibold text-white mb-3">Klaim Terverifikasi</h3>
                <p class="text-white/70">
                    Proses verifikasi memastikan barang dikembalikan ke pemilik yang benar.
                </p>
            </div>

            <div class="bg-white/10 p-6 rounded-2xl border border-white/20 shadow-xl backdrop-blur-md">
                <h3 class="text-xl font-semibold text-white mb-3">Tracking Status</h3>
                <p class="text-white/70">
                    Pantau status laporan Anda secara real-time.
                </p>
            </div>

        </div>


        {{-- ========== ROW 3 (Statistik) ========== --}}
        <div class="grid md:grid-cols-3 gap-10 text-center mt-10">

            <div>
                <p class="text-4xl font-bold">450+</p>
                <p class="text-white/70 mt-2">Barang Dilaporkan</p>
            </div>

            <div>
                <p class="text-4xl font-bold">320+</p>
                <p class="text-white/70 mt-2">Barang Ditemukan</p>
            </div>

            <div>
                <p class="text-4xl font-bold">98%</p>
                <p class="text-white/70 mt-2">Klaim Berhasil</p>
            </div>

        </div>

    </div>

</section>
@endsection
