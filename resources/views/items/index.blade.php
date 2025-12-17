@extends('layouts.app')

@section('content')
<div class="pb-24"> {{-- tambahin padding bawah biar footer turun & harus scroll --}}

    {{-- HEADER + SUBTITLE --}}
    <div class="mb-6">
        <h1 class="text-3xl font-extrabold text-slate-900 flex items-center gap-3">
            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-indigo-100 text-indigo-600">
                {{-- Icon box search --}}
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M21 21l-4.35-4.35M11 5a6 6 0 100 12 6 6 0 000-12z"/>
                </svg>
            </span>
            Daftar Barang Ditemukan
        </h1>
        <p class="mt-1 text-sm text-slate-500">
            Lihat dan kelola barang yang dilaporkan ditemukan di area kampus.
        </p>
    </div>

    @if(session('error'))
        <div class="bg-red-500 text-white px-4 py-3 rounded-xl mb-4 shadow-sm flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                      d="M18 10A8 8 0 11 2 10a8 8 0 0116 0zm-7-4a1 1 0 10-2 0v4a1 1 0 102 0V6zm-1 8a1.25 1.25 0 100-2.5A1.25 1.25 0 0010 14z"
                      clip-rule="evenodd"/>
            </svg>
            <span>{{ session('error') }}</span>
        </div>
    @endif

    {{-- SEARCH BAR --}}
    <form method="GET" action="{{ route('items.index') }}" class="mb-6">
        <div class="flex flex-wrap items-center gap-3">
            <div class="relative w-full md:w-1/3">
                <span class="absolute inset-y-0 left-3 flex items-center pointer-events-none text-slate-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M21 21l-4.35-4.35M11 5a6 6 0 100 12 6 6 0 000-12z"/>
                    </svg>
                </span>
                <input
                    type="text"
                    name="search"
                    placeholder="Cari barang berdasarkan nama atau lokasi..."
                    value="{{ request('search') }}"
                    class="pl-10 pr-3 py-2 w-full rounded-xl border border-slate-300 bg-white/80 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm"
                />
            </div>
            <button
                type="submit"
                class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-indigo-600 text-white text-sm font-semibold shadow hover:bg-indigo-700 transition"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M21 21l-4.35-4.35M11 5a6 6 0 100 12 6 6 0 000-12z"/>
                </svg>
                Search
            </button>
        </div>
    </form>

    {{-- GRID CARD BARANG --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($items as $item)
            <div
                class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden flex flex-col hover:shadow-md hover:-translate-y-1 transition">

                {{-- IMAGE --}}
                <div class="relative">
                    @if ($item->image)
                        <img
                            src="{{ asset('storage/' . $item->image) }}"
                            alt="{{ $item->name }}"
                            class="h-52 w-full object-cover"
                        />
                    @else
                        <div
                            class="h-52 w-full bg-slate-100 flex flex-col items-center justify-center text-slate-400 text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 mb-2" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M3 5h18M3 19h18M5 5v14m14-14v14M9 9h6v6H9z"/>
                            </svg>
                            No Image
                        </div>
                    @endif

                    {{-- BADGE KATEGORI --}}
                    <span
                        class="absolute top-3 left-3 inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-white/90 text-indigo-700 shadow-sm">
                        {{ $item->category ?? 'Tanpa kategori' }}
                    </span>
                </div>

                {{-- CONTENT --}}
                <div class="p-4 flex flex-col flex-1">
                    <h2 class="font-semibold text-lg text-slate-900 mb-1">
                        {{ $item->name }}
                    </h2>
                    <p class="text-slate-600 text-sm mb-3">
                        {{ Str::limit($item->description, 100) }}
                    </p>

                    {{-- META INFO --}}
                    <div class="flex flex-wrap gap-3 text-xs text-slate-500 mb-4">
                        <div class="inline-flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 2C8.134 2 5 5.134 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.866-3.134-7-7-7z"/>
                                <circle cx="12" cy="9" r="2.5"/>
                            </svg>
                            <span>{{ $item->location ?? 'Lokasi tidak diketahui' }}</span>
                        </div>

                        <div class="inline-flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M8 7V3m8 4V3M5 11h14M5 19h14M7 11v8m5-8v8m5-8v8"/>
                            </svg>
                            <span>
                                {{ $item->lost_date ? \Carbon\Carbon::parse($item->lost_date)->format('d M Y') : 'Tanggal tidak diketahui' }}
                            </span>
                        </div>
                    </div>

                    {{-- ACTION BUTTONS (layout seperti semula) --}}
                    <div class="mt-auto flex flex-wrap items-center gap-2">
                        @auth
                            @if ($item->user_id === auth()->id())
                                {{-- PEMILIK BARANG: Edit + Hapus --}}
                                <a
                                    href="{{ route('items.edit', $item) }}"
                                    class="inline-flex items-center gap-1 bg-amber-500 text-white px-3 py-1.5 rounded-xl text-xs font-semibold hover:bg-amber-600 transition"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                         viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M15.232 5.232l3.536 3.536M4 20h4l9.536-9.536a1.5 1.5 0 000-2.121l-2.879-2.879a1.5 1.5 0 00-2.121 0L4 15.999V20z"/>
                                    </svg>
                                    Edit
                                </a>

                                <form
                                    action="{{ route('items.destroy', $item) }}"
                                    method="POST"
                                    class="inline-flex delete-item-form"
                                    data-item-name="{{ $item->name }}"
                                >
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        type="submit"
                                        class="inline-flex items-center gap-1 bg-red-600 text-white px-3 py-1.5 rounded-xl text-xs font-semibold hover:bg-red-700 transition"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                             viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M6 7h12M10 11v6m4-6v6M9 7l1-3h4l1 3M5 7l1 13h12l1-13"/>
                                        </svg>
                                        Hapus
                                    </button>
                                </form>
                            @endif
                        @endauth

                        {{-- DETAIL: selalu ada --}}
                        <button
                            onclick="openModal({{ $item->id }})"
                            class="inline-flex items-center gap-1 bg-sky-600 text-white px-3 py-1.5 rounded-xl text-xs font-semibold hover:bg-sky-700 transition"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            Detail
                        </button>

                        {{-- KLAIM: hanya untuk user yang BUKAN pembuat laporan --}}
                        @auth
                            @if ($item->user_id !== auth()->id())
                                <button
                                    class="claimBtn ml-auto inline-flex items-center gap-1 bg-emerald-600 text-white px-3 py-1.5 rounded-xl text-xs font-semibold hover:bg-emerald-700 transition"
                                    data-item-id="{{ $item->id }}"
                                    data-features="{{ $item->features }}"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                         viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Klaim Barang
                                </button>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>

            {{-- MODAL DETAIL --}}
            <div
                id="modal-{{ $item->id }}"
                class="fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center hidden z-40"
            >
                <div class="relative w-full max-w-2xl mx-4 rounded-3xl shadow-2xl bg-white overflow-hidden">
                    <div class="h-1 bg-slate-200/60"></div>

                    <button
                        onclick="closeModal({{ $item->id }})"
                        class="absolute top-3 right-3 text-slate-400 hover:text-slate-700 rounded-full p-1 bg-white/80 shadow-sm"
                        title="Tutup"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>

                    <div class="p-5 md:p-6">
                        <div class="flex items-start justify-between gap-4 mb-4">
                            <div class="flex items-center gap-3">
                                <span
                                    class="inline-flex w-9 h-9 rounded-full bg-indigo-50 text-indigo-600 items-center justify-center border border-indigo-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                         viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M3 7h18M3 17h18M7 7v10m10-10v10"/>
                                    </svg>
                                </span>
                                <div>
                                    <h3 class="text-xl font-semibold text-slate-900">
                                        {{ $item->name }}
                                    </h3>
                                    <p class="text-xs text-slate-500">
                                        Detail barang yang ditemukan di lingkungan kampus.
                                    </p>
                                </div>
                            </div>

                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-indigo-50 text-indigo-700 border border-indigo-100">
                                {{ $item->category ?? 'Tanpa kategori' }}
                            </span>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-6 items-start">
                            @if ($item->image)
                                <div class="order-1 md:order-none">
                                    <div class="relative rounded-2xl overflow-hidden shadow-md border border-slate-100">
                                        <img
                                            src="{{ asset('storage/' . $item->image) }}"
                                            alt="{{ $item->name }}"
                                            class="w-full h-56 md:h-64 object-cover"
                                        />
                                        <div class="absolute bottom-0 inset-x-0 bg-gradient-to-t from-black/60 to-transparent px-3 py-2">
                                            <p class="text-[11px] text-white/80">
                                                Foto barang yang dilaporkan oleh penemu.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="order-1 md:order-none">
                                    <div class="h-56 md:h-64 rounded-2xl border border-dashed border-slate-200 flex flex-col items-center justify-center text-slate-400 text-sm bg-slate-50">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 mb-2" fill="none"
                                             viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M3 5h18M3 19h18M5 5v14m14-14v14M9 9h6v6H9z"/>
                                        </svg>
                                        Foto belum tersedia
                                    </div>
                                </div>
                            @endif

                            <div class="space-y-3 text-sm">
                                <div class="flex items-start gap-2">
                                    <span class="mt-0.5 text-indigo-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                             viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M5 7h14M5 12h11M5 17h7"/>
                                        </svg>
                                    </span>
                                    <div>
                                        <p class="font-semibold text-slate-800">Deskripsi</p>
                                        <p class="text-slate-600">
                                            {{ $item->description }}
                                        </p>
                                    </div>
                                </div>

                                <div class="flex items-start gap-2">
                                    <span class="mt-0.5 text-amber-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                             viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M4 6h16M4 10h10M4 14h8M4 18h6"/>
                                        </svg>
                                    </span>
                                    <div>
                                        <p class="font-semibold text-slate-800">Kategori</p>
                                        <p class="text-slate-600">
                                            {{ $item->category ?? '-' }}
                                        </p>
                                    </div>
                                </div>

                                <div class="flex items-start gap-2">
                                    <span class="mt-0.5 text-emerald-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                             viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M12 2C8.134 2 5 5.134 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.866-3.134-7-7-7z"/>
                                            <circle cx="12" cy="9" r="2.5"/>
                                        </svg>
                                    </span>
                                    <div>
                                        <p class="font-semibold text-slate-800">Lokasi Ditemukan</p>
                                        <p class="text-slate-600">
                                            {{ $item->location ?? '-' }}
                                        </p>
                                    </div>
                                </div>

                                <div class="flex items-start gap-2">
                                    <span class="mt-0.5 text-sky-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                             viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M8 7V3m8 4V3M5 11h14M5 19h14M7 11v8m5-8v8m5-8v8"/>
                                        </svg>
                                    </span>
                                    <div>
                                        <p class="font-semibold text-slate-800">Tanggal Ditemukan</p>
                                        <p class="text-slate-600">
                                            {{ \Carbon\Carbon::parse($item->lost_date)->format('d M Y') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-5 flex justify-end">
                            <button
                                onclick="closeModal({{ $item->id }})"
                                class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-semibold text-slate-600 bg-slate-100 hover:bg-slate-200 transition"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                                Tutup
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-slate-500">Tidak ada barang ditemukan yang tersedia.</p>
        @endforelse
    </div>

    {{-- PAGINATION --}}
    <div class="mt-6">
        {{ $items->withQueryString()->links() }}
    </div>

    {{-- MODAL KLAIM --}}
    <div
        id="claimModal"
        class="fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center hidden z-50"
    >
        <div class="relative w-full max-w-lg mx-4 rounded-3xl bg-white shadow-2xl overflow-hidden">
            <div class="h-px bg-slate-200"></div>

            <button
                id="closeClaimModal"
                class="absolute top-3 right-3 text-slate-400 hover:text-slate-700 rounded-full p-1 bg-white/80 shadow-sm"
                title="Tutup"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

            <div class="p-5 md:p-6">
                <div class="flex items-center gap-3 mb-4">
                    <span
                        class="inline-flex w-9 h-9 rounded-full bg-emerald-50 text-emerald-600 items-center justify-center border border-emerald-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M5 13l4 4L19 7"/>
                        </svg>
                    </span>
                    <div>
                        <h3 class="text-xl font-semibold text-slate-900">Klaim Barang</h3>
                        <p class="text-xs text-slate-500">
                            Jawab pertanyaan ciri-ciri barang dengan detail agar admin dapat memverifikasi klaim Anda.
                        </p>
                    </div>
                </div>

                <div class="mb-4 rounded-xl bg-emerald-50 border border-emerald-100 px-3 py-2.5 text-xs text-emerald-800 flex items-start gap-2">
                    <span class="mt-0.5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M13 16h-1v-4h-1m1-4h.01M12 2a10 10 0 1010 10A10.011 10.011 0 0012 2z"/>
                        </svg>
                    </span>
                    <p id="claimQuestion" class="font-semibold leading-snug">
                        {{-- diisi via JS --}}
                    </p>
                </div>

                <form id="claimForm" method="POST" action="">
                    @csrf
                    <div class="mb-4">
                        <label for="answer" class="block font-semibold mb-1 text-sm text-slate-800">Jawaban Anda</label>
                        <textarea
                            name="answer"
                            id="answer"
                            rows="4"
                            required
                            class="w-full border border-slate-300 rounded-xl px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
                            placeholder="Tuliskan ciri-ciri barang yang hanya Anda dan pemilik tahu (warna detail, merk, stiker khusus, kerusakan, dll)..."
                        ></textarea>
                    </div>

                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3">
                        <p class="text-[11px] text-slate-400">
                            Dengan mengirim klaim, Anda menyatakan bahwa informasi yang diberikan adalah benar.
                        </p>
                        <button
                            type="submit"
                            class="inline-flex items-center gap-2 bg-emerald-600 text-white px-6 py-2 rounded-xl text-sm font-semibold shadow hover:bg-emerald-700 transition"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M5 13l4 4L19 7"/>
                            </svg>
                            Kirim Klaim
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

{{-- SCRIPT MODAL + SWEETALERT DELETE --}}
<script>
    /* -----------------------------
       OPEN & CLOSE MODAL DETAIL
    ----------------------------- */
    function openModal(id) {
        document.getElementById('modal-' + id).classList.remove('hidden');
    }

    function closeModal(id) {
        document.getElementById('modal-' + id).classList.add('hidden');
    }

    /* -----------------------------
       MODAL KLAIM BARANG
    ----------------------------- */
    const claimModal = document.getElementById('claimModal');
    const closeClaimModalBtn = document.getElementById('closeClaimModal');
    const claimForm = document.getElementById('claimForm');
    const claimQuestion = document.getElementById('claimQuestion');

    document.querySelectorAll('.claimBtn').forEach(button => {
        button.addEventListener('click', () => {
            const itemId = button.getAttribute('data-item-id');
            const features = button.getAttribute('data-features') || 'Tidak ada ciri-ciri tersedia.';

            claimQuestion.textContent = "Ciri-ciri barang: " + features;
            claimForm.action = `/items/${itemId}/claim`;

            claimModal.classList.remove('hidden');
        });
    });

    closeClaimModalBtn.addEventListener('click', () => {
        claimModal.classList.add('hidden');
    });

    window.addEventListener('click', (e) => {
        if (e.target === claimModal) {
            claimModal.classList.add('hidden');
        }
    });

    /* -----------------------------
       KONFIRMASI HAPUS (SWEETALERT)
    ----------------------------- */
    document.querySelectorAll('.delete-item-form').forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();

            const itemName = this.dataset.itemName || 'barang ini';

            Swal.fire({
                icon: 'warning',
                title: 'Hapus barang?',
                html: `
                    <p class="mt-1 text-[13px] leading-relaxed text-slate-200">
                        Barang <span class="font-semibold">${itemName}</span> akan dihapus
                        secara permanen dari daftar. Tindakan ini tidak bisa dibatalkan.
                    </p>
                `,
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus',
                cancelButtonText: 'Batal',
                reverseButtons: true,

                background: 'transparent',
                padding: 0,
                backdrop: `
                    rgba(15,23,42,0.78)
                    center top
                    no-repeat
                `,
                customClass: {
                    popup: 'rounded-3xl bg-gradient-to-br from-slate-950/95 via-slate-900/95 to-slate-800/95 border border-white/10 shadow-2xl shadow-red-900/40 px-6 py-5 max-w-sm',
                    title: 'text-base md:text-lg font-semibold text-white tracking-wide',
                    htmlContainer: 'mt-2 text-slate-200',
                    confirmButton: 'swal2-confirm !bg-red-500 !text-white !text-xs !font-semibold !px-4 !py-2.5 !rounded-xl !shadow hover:!bg-red-600',
                    cancelButton: 'swal2-cancel !bg-slate-700 !text-white !text-xs !font-semibold !px-4 !py-2.5 !rounded-xl hover:!bg-slate-600',
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            });
        });
    });
</script>

</div> {{-- /pb-24 --}}
@endsection
