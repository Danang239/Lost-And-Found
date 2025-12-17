@extends('layouts.auth')

@section('content')

{{-- ===================== SECTION REGISTER (FULL SCREEN DENGAN BACKGROUND GAMBAR) ===================== --}}
<section class="min-h-screen flex items-center justify-center px-4 py-10 relative overflow-hidden">

    {{-- Background Gambar (SAMA SEPERTI LOGIN) --}}
    <div class="absolute inset-0">
        <img src="/images/bg.jpg"
             class="w-full h-full object-cover object-center" />
    </div>

    {{-- Overlay agar teks tetap terbaca --}}
    <div class="absolute inset-0 bg-black/40 backdrop-blur-[2px]"></div>

    {{-- WRAPPER REGISTER --}}
    <div class="relative w-full max-w-md bg-white/20 backdrop-blur-xl rounded-3xl shadow-2xl border border-white/30 p-8 text-white">

        {{-- LOGO --}}
        <div class="flex justify-center mb-5">
            <img src="/images/logo.png" alt="Logo"
                 class="w-20 h-20 rounded-full shadow-xl object-cover border border-white/40">
        </div>

        {{-- HEADING --}}
        <h2 class="text-center text-2xl font-semibold">Register</h2>
        <p class="text-center text-sm text-white/80 mb-6">
            Buat akun baru untuk menggunakan sistem Lost &amp; Found
        </p>

        {{-- ERROR GLOBAL (OPSIONAL) --}}
        @if ($errors->any())
            <div class="mb-4 text-xs text-red-100 bg-red-500/80 border border-red-300 rounded-xl px-3 py-2">
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- FORM REGISTER --}}
        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            {{-- NAMA --}}
            <div>
                <label class="block text-sm text-white mb-1">Nama</label>
                <input
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    required
                    placeholder="Masukkan nama lengkap"
                    class="w-full rounded-xl bg-white/20 text-white px-3 py-2.5
                           placeholder-white/60 border-0 focus:ring-2 focus:ring-blue-400"
                >
            </div>

            {{-- EMAIL --}}
            <div>
                <label class="block text-sm text-white mb-1">Email</label>
                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    placeholder="Masukkan email"
                    class="w-full rounded-xl bg-white/20 text-white px-3 py-2.5
                           placeholder-white/60 border-0 focus:ring-2 focus:ring-blue-400"
                >
            </div>

            {{-- NOMOR WHATSAPP --}}
            <div>
                <label class="block text-sm text-white mb-1">Nomor WhatsApp</label>
                <input
                    type="text"
                    name="phone"
                    value="{{ old('phone') }}"
                    required
                    placeholder="Contoh: +628xxxxxxx"
                    class="w-full rounded-xl bg-white/20 text-white px-3 py-2.5
                           placeholder-white/60 border-0 focus:ring-2 focus:ring-blue-400"
                >
            </div>

            {{-- PASSWORD --}}
            <div>
                <label class="block text-sm text-white mb-1">Password</label>
                <input
                    id="password"
                    type="password"
                    name="password"
                    required
                    placeholder="Masukkan password"
                    class="w-full rounded-xl bg-white/20 text-white px-3 py-2.5
                           placeholder-white/60 border-0 focus:ring-2 focus:ring-blue-400"
                >

                {{-- BOX CEK SYARAT PASSWORD --}}
                <div
                    id="password-rules"
                    class="mt-2 rounded-2xl bg-black/25 border border-white/20 px-3 py-2 text-[11px] text-white/80 space-y-1"
                >
                    <p class="font-semibold text-white/90">Password harus mengandung:</p>

                    <div id="rule-length" class="flex items-center gap-2 text-red-200">
                        <span class="w-3 h-3 rounded-full border border-red-300 flex items-center justify-center text-[9px]">
                            ✕
                        </span>
                        <span>Minimal 8 karakter</span>
                    </div>

                    <div id="rule-uppercase" class="flex items-center gap-2 text-red-200">
                        <span class="w-3 h-3 rounded-full border border-red-300 flex items-center justify-center text-[9px]">
                            ✕
                        </span>
                        <span>Memiliki huruf kapital (A–Z)</span>
                    </div>

                    <div id="rule-number" class="flex items-center gap-2 text-red-200">
                        <span class="w-3 h-3 rounded-full border border-red-300 flex items-center justify-center text-[9px]">
                            ✕
                        </span>
                        <span>Memiliki angka (0–9)</span>
                    </div>
                </div>
            </div>

            {{-- KONFIRMASI PASSWORD --}}
            <div>
                <label class="block text-sm text-white mb-1">Konfirmasi Password</label>
                <input
                    type="password"
                    name="password_confirmation"
                    required
                    placeholder="Ulangi password"
                    class="w-full rounded-xl bg-white/20 text-white px-3 py-2.5
                           placeholder-white/60 border-0 focus:ring-2 focus:ring-blue-400"
                >
            </div>

            {{-- BUTTON REGISTER --}}
            <button
                type="submit"
                class="w-full bg-white text-indigo-900 font-semibold py-2.5 rounded-xl
                       shadow-lg hover:bg-gray-100 transition">
                Daftar
            </button>
        </form>

        {{-- LINK KE LOGIN --}}
        <p class="mt-5 text-center text-sm text-white/80">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="font-semibold underline">Login di sini</a>
        </p>

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

{{-- SCRIPT CEK SYARAT PASSWORD --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const inputPassword = document.getElementById('password');
        if (!inputPassword) return;

        const ruleLength    = document.getElementById('rule-length');
        const ruleUppercase = document.getElementById('rule-uppercase');
        const ruleNumber    = document.getElementById('rule-number');

        function updateRule(element, isValid) {
            const icon = element.querySelector('span');

            if (isValid) {
                element.classList.remove('text-red-200');
                element.classList.add('text-emerald-200');
                icon.textContent = '✓';
                icon.classList.remove('border-red-300');
                icon.classList.add('border-emerald-300');
            } else {
                element.classList.add('text-red-200');
                element.classList.remove('text-emerald-200');
                icon.textContent = '✕';
                icon.classList.add('border-red-300');
                icon.classList.remove('border-emerald-300');
            }
        }

        inputPassword.addEventListener('input', function (e) {
            const value = e.target.value;

            const isLengthValid = value.length >= 8;
            const hasUppercase  = /[A-Z]/.test(value);
            const hasNumber     = /[0-9]/.test(value);

            updateRule(ruleLength,    isLengthValid);
            updateRule(ruleUppercase, hasUppercase);
            updateRule(ruleNumber,    hasNumber);
        });
    });
</script>

@endsection
