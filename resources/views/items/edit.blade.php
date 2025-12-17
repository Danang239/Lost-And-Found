@extends('layouts.app')

@section('content')

{{-- TITLE --}}
<div class="mb-8">
    <h1 class="text-3xl font-extrabold text-slate-900 flex items-center gap-3">
        <span class="inline-flex items-center justify-center w-9 h-9 rounded-full bg-indigo-100 text-indigo-600">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15.232 5.232l3.536 3.536M4 20h4l9.536-9.536a1.5 1.5 0 000-2.121l-2.879-2.879a1.5 1.5 0 00-2.121 0L4 15.999V20z"/>
            </svg>
        </span>
        Edit Barang Ditemukan
    </h1>

    <p class="text-sm text-slate-500 mt-1">
        Perbarui informasi barang agar pemiliknya dapat mengenali dengan lebih mudah.
    </p>
</div>

{{-- FORM --}}
<form action="{{ route('items.update', $item) }}" method="POST" enctype="multipart/form-data" class="max-w-xl">
    @csrf
    @method('PUT')

    {{-- NAMA --}}
    <div class="mb-6">
        <label class="font-semibold text-sm text-slate-700 mb-1 block">Nama Barang</label>
        <div class="relative">
            <span class="absolute inset-y-0 left-3 flex items-center text-slate-400 pointer-events-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 7h18M3 17h18M7 7v10m10-10v10"/>
                </svg>
            </span>
            <input type="text" name="name" value="{{ old('name', $item->name) }}"
                class="w-full pl-9 pr-3 py-2.5 rounded-lg border border-slate-300 text-sm
                       focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" required />
        </div>
    </div>

    {{-- DESKRIPSI --}}
    <div class="mb-6">
        <label class="font-semibold text-sm text-slate-700 mb-1 block">Deskripsi</label>
        <textarea name="description" rows="4"
            class="w-full rounded-lg border border-slate-300 px-3 py-2.5 text-sm
                   focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">{{ old('description', $item->description) }}</textarea>
    </div>

    {{-- KATEGORI --}}
    <div class="mb-6">
        <label class="font-semibold text-sm text-slate-700 mb-1 block">Kategori</label>
        <div class="relative">
            <span class="absolute inset-y-0 left-3 flex items-center text-slate-400 pointer-events-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 10h10M4 14h8M4 18h6"/>
                </svg>
            </span>
            <input type="text" name="category" value="{{ old('category', $item->category) }}"
                class="w-full pl-9 pr-3 py-2.5 rounded-lg border border-slate-300 text-sm
                       focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" required />
        </div>
    </div>

    {{-- LOKASI --}}
    <div class="mb-6">
        <label class="font-semibold text-sm text-slate-700 mb-1 block">Lokasi Ditemukan</label>
        <div class="relative">
            <span class="absolute inset-y-0 left-3 flex items-center text-slate-400 pointer-events-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 2C8.134 2 5 5.134 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.866-3.134-7-7-7z"/>
                    <circle cx="12" cy="9" r="2.5"/>
                </svg>
            </span>
            <input type="text" name="location" value="{{ old('location', $item->location) }}"
                class="w-full pl-9 pr-3 py-2.5 rounded-lg border border-slate-300 text-sm
                       focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" required />
        </div>
    </div>

    {{-- TANGGAL --}}
    <div class="mb-6">
        <label class="font-semibold text-sm text-slate-700 mb-1 block">Tanggal Ditemukan</label>
        <div class="relative">
            <span class="absolute inset-y-0 left-3 flex items-center text-slate-400 pointer-events-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7V3m8 4V3M5 11h14M5 19h14M7 11v8m5-8v8m5-8v8"/>
                </svg>
            </span>
            <input type="date" name="lost_date"
                value="{{ old('lost_date', optional($item->lost_date)->format('Y-m-d')) }}"
                class="w-full pl-9 pr-3 py-2.5 rounded-lg border border-slate-300 text-sm
                       focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" required />
        </div>
    </div>

    {{-- FOTO BARANG (NOW UNDER TANGGAL) --}}
    <div class="mb-8">
        <label class="font-semibold text-sm text-slate-700 block">
            Foto Barang <span class="text-xs text-slate-400">(Opsional)</span>
        </label>

        @if($item->image)
            <img src="{{ asset('storage/' . $item->image) }}"
                class="w-48 rounded-lg shadow border border-slate-200 mb-3" />
        @endif

        <input type="file" name="image" accept="image/*"
            class="text-sm file:mr-3 file:py-1.5 file:px-3 file:rounded-full file:bg-indigo-100
                   file:text-indigo-700 hover:file:bg-indigo-200" />

        <p class="text-[11px] text-slate-400 mt-1">
            Format disarankan: JPG/PNG. Ukuran file &lt; 2MB.
        </p>
    </div>

    {{-- BUTTON --}}
    <button type="submit"
        class="inline-flex items-center gap-2 bg-indigo-600 px-6 py-2.5 text-white text-sm font-semibold rounded-lg shadow
               hover:bg-indigo-700 transition">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
            viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M5 13l4 4L19 7"/>
        </svg>
        Update Barang
    </button>

</form>

@endsection
