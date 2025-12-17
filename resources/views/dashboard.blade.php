@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-slate-100">

    {{-- ====================== HERO / BANNER ATAS ====================== --}}
    <div class="relative w-full h-72 md:h-96 mb-6">

        {{-- Gambar Banner --}}
        <img
            src="{{ asset('images/banner.jpg') }}"
            alt="Banner"
            class="w-full h-full object-cover"
        />

        {{-- Overlay Gelap --}}
        <div class="absolute inset-0 bg-black/40"></div>

        {{-- TEKS DI TENGAH --}}
        <div class="absolute inset-0 flex flex-col items-center justify-center text-center px-4">
            <h1 class="text-4xl md:text-5xl font-extrabold text-white drop-shadow-xl">
                Manajemen Barang Hilang
            </h1>

            <p class="mt-3 text-base md:text-lg text-white/90 max-w-3xl drop-shadow">
                Laporkan, lacak, dan temukan kembali barang berharga Anda melalui sistem Lost &amp; Found kampus.
            </p>
        </div>
    </div>


    {{-- ====================== KONTEN UTAMA ====================== --}}
    @php
        $totalLost = method_exists($lostItems, 'total') ? $lostItems->total() : $lostItems->count();
    @endphp

    {{-- BAR INFO + TOMBOL --}}
    <div class="w-full bg-white border-y border-slate-200 px-6 md:px-10 py-4 mb-4">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

            {{-- Kiri --}}
            <div>
                <h3 class="text-lg font-semibold text-slate-800 flex items-center gap-2">
                    <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-blue-50 text-blue-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M4 6h16M4 12h8m-8 6h6" />
                        </svg>
                    </span>
                    Barang Hilang yang Dilaporkan
                </h3>
                <p class="text-sm text-slate-500 mt-1">
                    Daftar barang hilang dari seluruh pengguna. Silakan hubungi pelapor jika Anda menemukan barang yang cocok.
                </p>
            </div>

            {{-- Kanan --}}
            <div class="flex items-center gap-3">
                <div class="px-4 py-2 rounded-xl bg-blue-50 border border-blue-100 text-blue-700 font-semibold text-sm flex items-center gap-2">
                    <span class="inline-flex w-2 h-2 rounded-full bg-blue-500 animate-pulse"></span>
                    {{ $totalLost }} laporan aktif
                </div>

                <button
                    id="openModalBtn"
                    class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2
                           rounded-xl shadow text-sm transition"
                >
                    <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-white/15">
                        +
                    </span>
                    <span>Buat Laporan</span>
                </button>
            </div>

        </div>
    </div>


    {{-- ====================== DAFTAR BARANG HILANG ====================== --}}
    <div class="w-full mb-10">
        @if($lostItems->count())
            <div class="flex flex-col gap-5 px-4 md:px-10">
                @foreach ($lostItems as $item)
                    <div
                        class="w-full bg-white rounded-xl shadow-md hover:shadow-lg transition
                               p-4 md:p-5 flex flex-col md:flex-row gap-4 border border-slate-200"
                    >
                        {{-- FOTO --}}
                        <div class="w-full md:w-64 h-56 md:h-48 rounded-lg overflow-hidden">
                            @if ($item->image)
                                <img
                                    src="{{ asset('storage/' . $item->image) }}"
                                    alt="{{ $item->name }}"
                                    class="w-full h-full object-cover"
                                />
                            @else
                                <div class="w-full h-full bg-slate-200 flex items-center justify-center text-slate-400 text-sm">
                                    No Image
                                </div>
                            @endif
                        </div>

                        {{-- DETAIL --}}
                        <div class="flex-1 flex flex-col justify-between">
                            <div>
                                <h3 class="font-bold text-xl text-slate-800 mb-1">
                                    {{ $item->name }}
                                </h3>

                                <p class="text-sm text-slate-600 mb-3 leading-relaxed">
                                    {{ Str::limit($item->description, 150) }}
                                </p>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-y-1 text-sm text-slate-600">
                                    <p>
                                        <span class="font-semibold">Tanggal Hilang:</span>
                                        {{ \Carbon\Carbon::parse($item->lost_date)->format('d M Y') }}
                                    </p>

                                    <p>
                                        <span class="font-semibold">Lokasi:</span>
                                        {{ $item->location }}
                                    </p>

                                    <p class="md:col-span-2">
                                        <span class="font-semibold">Dilaporkan oleh:</span>
                                        {{ $item->user->name }}
                                    </p>
                                </div>
                            </div>

                            {{-- WhatsApp --}}
                            @if($item->user->phone)
                                <div class="mt-4 text-right">
                                    <a
                                        href="https://wa.me/{{ $item->user->phone }}?text=Halo, saya melihat laporan barang '{{ $item->name }}'. Apakah ini masih hilang?"
                                        target="_blank"
                                        class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700
                                               text-white text-sm font-medium px-5 py-2 rounded-lg shadow-md transition"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                             viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M7 10.5l2.5 2.5L17 8M12 21A9 9 0 1 1 21 12 9 9 0 0 1 12 21z" />
                                        </svg>
                                        Hubungi via WhatsApp
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- PAGINATION --}}
            <div class="mt-6 px-4 md:px-10">
                {{ $lostItems->links() }}
            </div>
        @else
            <p class="text-slate-600 px-4 md:px-10 mt-4">
                Tidak ada barang hilang yang ditemukan.
            </p>
        @endif
    </div>


    {{-- ====================== MODAL FORM LAPORAN ====================== --}}
    <div id="modal" class="fixed inset-0 bg-black/50 flex items-center justify-center hidden z-50">
        <div class="bg-white rounded-2xl w-full max-w-lg shadow-2xl overflow-hidden relative">

            {{-- HEADER MODAL --}}
            <div class="flex items-center justify-between px-5 py-4 border-b border-slate-200 bg-gradient-to-r from-indigo-600 to-blue-600">
                <div class="flex items-center gap-2">
                    <div class="w-9 h-9 rounded-full bg-white/15 flex items-center justify-center text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M12 6v12m-6-6h12" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-white font-semibold">
                            Buat Laporan Barang Hilang
                        </h2>
                        <p class="text-xs text-white/80">
                            Isi data secara lengkap agar orang lain mudah mengenali barang Anda.
                        </p>
                    </div>
                </div>

                <button
                    id="closeModalBtn"
                    class="text-white/80 hover:text-white text-2xl font-bold leading-none px-1"
                >
                    &times;
                </button>
            </div>

            {{-- BODY MODAL --}}
            <div class="p-5">
                <form action="{{ route('dashboard.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <input type="hidden" name="type" value="lost">

                    {{-- NAMA BARANG --}}
                    <div>
                        <label class="font-semibold text-sm text-slate-700 mb-1 block">Nama Barang</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-3 flex items-center text-slate-400 pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M3 7h18M3 17h18M7 7v10m10-10v10"/>
                                </svg>
                            </span>
                            <input
                                type="text"
                                name="name"
                                required
                                class="w-full pl-9 pr-3 py-2.5 rounded-lg border border-slate-300 text-sm
                                       focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                            >
                        </div>
                    </div>

                    {{-- DESKRIPSI --}}
                    <div>
                        <label class="font-semibold text-sm text-slate-700 mb-1 block">Deskripsi</label>
                        <textarea
                            name="description"
                            rows="4"
                            required
                            class="w-full rounded-lg border border-slate-300 px-3 py-2.5 text-sm
                                   focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                            placeholder="Warna, merek, ciri khusus, dll."
                        ></textarea>
                    </div>

                    {{-- KATEGORI / LOKASI / TANGGAL --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="font-semibold text-sm text-slate-700 mb-1 block">Kategori</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-3 flex items-center text-slate-400 pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                         viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M4 6h16M4 10h10M4 14h8M4 18h6"/>
                                    </svg>
                                </span>
                                <input
                                    type="text"
                                    name="category"
                                    required
                                    class="w-full pl-9 pr-3 py-2.5 rounded-lg border border-slate-300 text-sm
                                           focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                >
                            </div>
                        </div>

                        <div>
                            <label class="font-semibold text-sm text-slate-700 mb-1 block">Lokasi Hilang</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-3 flex items-center text-slate-400 pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                         viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M12 2C8.134 2 5 5.134 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.866-3.134-7-7-7z"/>
                                        <circle cx="12" cy="9" r="2.5"/>
                                    </svg>
                                </span>
                                <input
                                    type="text"
                                    name="location"
                                    required
                                    class="w-full pl-9 pr-3 py-2.5 rounded-lg border border-slate-300 text-sm
                                           focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                >
                            </div>
                        </div>

                        <div>
                            <label class="font-semibold text-sm text-slate-700 mb-1 block">Tanggal Hilang</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-3 flex items-center text-slate-400 pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                         viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M8 7V3m8 4V3M5 11h14M5 19h14M7 11v8m5-8v8m5-8v8"/>
                                    </svg>
                                </span>
                                <input
                                    type="date"
                                    name="lost_date"
                                    required
                                    class="w-full pl-9 pr-3 py-2.5 rounded-lg border border-slate-300 text-sm
                                           focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                >
                            </div>
                        </div>
                    </div>

                    {{-- FOTO --}}
                    <div>
                        <label class="font-semibold text-sm text-slate-700 mb-1 block">
                            Foto Barang <span class="text-xs text-slate-400">(Opsional)</span>
                        </label>
                        <input
                            type="file"
                            name="image"
                            accept="image/*"
                            class="w-full text-sm
                                   file:mr-3 file:py-1.5 file:px-3
                                   file:rounded-full file:border-0
                                   file:bg-indigo-50 file:text-indigo-700
                                   hover:file:bg-indigo-100"
                        >
                        <p class="text-[11px] text-slate-400 mt-1">
                            Format JPG/PNG, ukuran disarankan &lt; 2MB.
                        </p>
                    </div>

                    {{-- BUTTONS --}}
                    <div class="flex justify-end gap-2 pt-2">
                        <button
                            type="button"
                            id="closeModalBtn2"
                            class="px-4 py-2 text-sm border border-slate-300 rounded-lg text-slate-600 hover:bg-slate-50"
                        >
                            Batal
                        </button>

                        <button
                            type="submit"
                            class="px-5 py-2 text-sm bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700
                                   inline-flex items-center gap-2"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M5 13l4 4L19 7"/>
                            </svg>
                            Kirim Laporan
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>

</div>

{{-- MODAL SCRIPT --}}
<script>
    const modal = document.getElementById('modal');
    const openBtn = document.getElementById('openModalBtn');
    const closeBtn = document.getElementById('closeModalBtn');
    const closeBtn2 = document.getElementById('closeModalBtn2');

    openBtn.addEventListener('click', () => modal.classList.remove('hidden'));
    closeBtn.addEventListener('click', () => modal.classList.add('hidden'));
    closeBtn2.addEventListener('click', () => modal.classList.add('hidden'));

    window.addEventListener('click', e => {
        if (e.target === modal) modal.classList.add('hidden');
    });
</script>

@endsection
