@extends('layouts.app')

@section('content')
<div class="min-h-screen pt-6 md:pt-8 pb-16 md:pb-20">

    {{-- Container BESAR dibuat full width agar form rata kiri --}}
    <div class="w-full px-6 md:px-12">

        {{-- HEADER --}}
        <div class="flex items-center gap-3 mb-6">
            <div class="w-11 h-11 rounded-2xl bg-indigo-100 text-indigo-700 flex items-center justify-center shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                     class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.7">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M4 7.5 12 4l8 3.5M4 7.5V17l8 3 8-3V7.5M12 10.5 4 7.5m8 3 8-3" />
                </svg>
            </div>

            <div>
                <h1 class="text-2xl md:text-3xl font-extrabold text-slate-900 tracking-tight">
                    Tambah Barang Ditemukan
                </h1>
                <p class="text-sm md:text-base text-slate-500 mt-1">
                    Isi detail barang yang Anda temukan agar pemiliknya bisa mengajukan klaim.
                </p>
            </div>
        </div>

        {{-- FORM – dibuat full left, tanpa max-width --}}
        <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data"
              class="space-y-6">

            @csrf
            <input type="hidden" name="type" value="found" />

            {{-- =========================== --}}
            {{-- NAMA BARANG --}}
            {{-- =========================== --}}
            <div>
                <label class="block mb-1.5 text-sm font-semibold text-slate-800">
                    Nama Barang
                </label>

                <div class="flex items-center rounded-lg border border-slate-300 bg-white
                            focus-within:ring-2 focus-within:ring-indigo-500">
                    <span class="pl-3 pr-2 text-slate-400">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                             class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M4 7h16M4 12h10M4 17h6" />
                        </svg>
                    </span>

                    <input type="text" name="name" required
                           value="{{ old('name') }}"
                           class="flex-1 border-0 bg-transparent px-2 py-2.5 text-sm focus:outline-none" />
                </div>
            </div>

            {{-- DESKRIPSI --}}
            <div>
                <label class="block mb-1.5 text-sm font-semibold text-slate-800">
                    Deskripsi
                </label>

                <div class="flex items-start rounded-lg border border-slate-300 bg-white
                            focus-within:ring-2 focus-within:ring-indigo-500">
                    <span class="pl-3 pr-2 pt-2 text-slate-400">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                             class="w-4 h-4" stroke-width="1.8" fill="none" stroke="currentColor">
                            <path d="M5 7h14M5 12h11M5 17h7"/>
                        </svg>
                    </span>

                    <textarea name="description" rows="4" required
                              class="flex-1 border-0 bg-transparent px-2 py-2.5 text-sm resize-y focus:outline-none">{{ old('description') }}</textarea>
                </div>
            </div>

            {{-- KATEGORI + LOKASI --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <div>
                    <label class="block mb-1.5 text-sm font-semibold text-slate-800">
                        Kategori
                    </label>

                    <div class="flex items-center rounded-lg border border-slate-300 bg-white
                                focus-within:ring-2 focus-within:ring-indigo-500">
                        <span class="pl-3 pr-2 text-slate-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4"
                                 fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path d="M7 4h10l3 5-8 11-8-11z"/>
                            </svg>
                        </span>

                        <input type="text" name="category" required
                               value="{{ old('category') }}"
                               class="flex-1 border-0 bg-transparent px-2 py-2.5 text-sm focus:outline-none" />
                    </div>
                </div>

                <div>
                    <label class="block mb-1.5 text-sm font-semibold text-slate-800">
                        Lokasi Ditemukan
                    </label>

                    <div class="flex items-center rounded-lg border border-slate-300 bg-white
                                focus-within:ring-2 focus-within:ring-indigo-500">
                        <span class="pl-3 pr-2 text-slate-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4"
                                 fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path d="M12 21s6-5.373 6-10A6 6 0 0 0 6 11c0 4.627 6 10 6 10z"/>
                                <circle cx="12" cy="11" r="2.5"/>
                            </svg>
                        </span>

                        <input type="text" name="location" required
                               value="{{ old('location') }}"
                               class="flex-1 border-0 bg-transparent px-2 py-2.5 text-sm focus:outline-none" />
                    </div>
                </div>

            </div>

            {{-- CIRI-CIRI --}}
            <div>
                <label class="block mb-1.5 text-sm font-semibold text-slate-800">
                    Ciri-ciri Barang <span class="text-xs text-slate-500">(syarat klaim)</span>
                </label>

                <div class="flex items-start rounded-lg border border-slate-300 bg-white
                            focus-within:ring-2 focus-within:ring-indigo-500">
                    <span class="pl-3 pr-2 pt-2 text-slate-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4"
                             fill="none" stroke="currentColor" stroke-width="1.8">
                            <path d="M5 5h14M5 12h9M5 19h5"/>
                        </svg>
                    </span>

                    <textarea name="features" rows="3" required
                              class="flex-1 border-0 bg-transparent px-2 py-2.5 text-sm resize-y focus:outline-none">{{ old('features') }}</textarea>
                </div>

                <p class="text-[11px] text-slate-400 mt-1">
                    Contoh: warna, merek, stiker, kerusakan, goresan tertentu, dll.
                </p>
            </div>

            {{-- TANGGAL + FOTO --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <div>
                    <label class="block mb-1.5 text-sm font-semibold text-slate-800">
                        Tanggal Ditemukan
                    </label>

                    <input type="date" name="lost_date" required
                           value="{{ old('lost_date') }}"
                           class="w-full rounded-lg border border-slate-300 px-3 py-2.5 text-sm focus:ring-2 focus:ring-indigo-500" />
                </div>

                <div>
                    <label class="block mb-1.5 text-sm font-semibold text-slate-800">
                        Foto Barang (Opsional)
                    </label>

                    <input type="file" name="image" accept="image/*"
                           class="block w-full text-sm text-slate-600
                                  file:mr-3 file:py-2 file:px-4 file:rounded-lg 
                                  file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" />

                    <p class="text-[11px] text-slate-400 mt-1">Format JPG/PNG, max 2MB.</p>
                </div>

            </div>

            {{-- SUBMIT --}}
            <button type="submit"
                class="px-6 py-3 bg-indigo-600 text-white text-sm font-semibold rounded-xl shadow
                       hover:bg-indigo-700 transition inline-flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4"
                     fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path d="M12 5v14m-7-7h14"/>
                </svg>
                Tambah Barang
            </button>

        </form>

    </div>

</div>
@endsection
