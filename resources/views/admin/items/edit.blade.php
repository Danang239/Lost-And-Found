@extends('layouts.admin')

@section('content')
    {{-- HEADER --}}
    <div class="mb-8 flex items-center gap-3">
        <div class="w-10 h-10 rounded-xl bg-amber-100 text-amber-600 flex items-center justify-center shadow-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M3 7h18M3 17h18M7 7v10m10-10v10"/>
            </svg>
        </div>

        <div>
            <h2 class="text-3xl font-bold text-slate-900">
                Edit Barang Hilang
            </h2>
            <p class="text-sm text-slate-500 mt-1">
                Perbarui detail laporan barang hilang agar memudahkan pencarian dan pencocokan.
            </p>
        </div>
    </div>

    {{-- FORM TANPA BOX --}}
    <form
        action="{{ route('admin.items.update', $item->id) }}"
        method="POST"
        enctype="multipart/form-data"
        class="space-y-6"
    >
        @csrf
        @method('PUT')

        {{-- NAMA BARANG --}}
        <div class="space-y-1">
            <label for="name" class="block text-sm font-semibold text-slate-800">
                Nama Barang
            </label>
            <input
                type="text"
                name="name"
                id="name"
                value="{{ old('name', $item->name) }}"
                required
                class="w-full bg-white border border-slate-300 rounded-lg px-3 py-2.5 text-sm
                       focus:ring-indigo-500 focus:border-indigo-500"
            />
            @error('name')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- DESKRIPSI --}}
        <div class="space-y-1">
            <label for="description" class="block text-sm font-semibold text-slate-800">
                Deskripsi Barang
            </label>
            <textarea
                name="description"
                id="description"
                rows="3"
                class="w-full bg-white border border-slate-300 rounded-lg px-3 py-2.5 text-sm
                       focus:ring-indigo-500 focus:border-indigo-500"
            >{{ old('description', $item->description) }}</textarea>
            @error('description')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- KATEGORI & LOKASI --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-1">
                <label for="category" class="block text-sm font-semibold text-slate-800">
                    Kategori Barang
                </label>
                <input
                    type="text"
                    name="category"
                    id="category"
                    value="{{ old('category', $item->category) }}"
                    class="w-full bg-white border border-slate-300 rounded-lg px-3 py-2.5 text-sm
                           focus:ring-indigo-500 focus:border-indigo-500"
                />
                @error('category')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-1">
                <label for="location" class="block text-sm font-semibold text-slate-800">
                    Lokasi Barang
                </label>
                <input
                    type="text"
                    name="location"
                    id="location"
                    value="{{ old('location', $item->location) }}"
                    class="w-full bg-white border border-slate-300 rounded-lg px-3 py-2.5 text-sm
                           focus:ring-indigo-500 focus:border-indigo-500"
                />
                @error('location')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- TANGGAL & TIPE BARANG --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-1">
                <label for="lost_date" class="block text-sm font-semibold text-slate-800">
                    Tanggal Barang Hilang
                </label>
                <input
                    type="date"
                    name="lost_date"
                    id="lost_date"
                    value="{{ old('lost_date', $item->lost_date ? \Carbon\Carbon::parse($item->lost_date)->format('Y-m-d') : '') }}"
                    class="w-full bg-white border border-slate-300 rounded-lg px-3 py-2.5 text-sm
                           focus:ring-indigo-500 focus:border-indigo-500"
                />
                @error('lost_date')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-1">
                <label for="type" class="block text-sm font-semibold text-slate-800">
                    Tipe Barang
                </label>
                <select
                    name="type"
                    id="type"
                    required
                    class="w-full bg-white border border-slate-300 rounded-lg px-3 py-2.5 text-sm
                           focus:ring-indigo-500 focus:border-indigo-500"
                >
                    <option value="lost"  {{ old('type', $item->type) == 'lost' ? 'selected' : '' }}>Barang Hilang</option>
                    <option value="found" {{ old('type', $item->type) == 'found' ? 'selected' : '' }}>Barang Ditemukan</option>
                </select>
                @error('type')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- FOTO BARANG --}}
        <div class="space-y-1">
            <label for="image" class="block text-sm font-semibold text-slate-800">
                Foto Barang
            </label>

            <input
                type="file"
                name="image"
                id="image"
                class="w-full bg-white border border-slate-300 rounded-lg px-3 py-2 text-sm
                       focus:ring-indigo-500 focus:border-indigo-500"
            />

            @if($item->image)
                <div class="mt-3">
                    <p class="text-xs font-medium text-slate-600 mb-1">Foto saat ini:</p>
                    <img
                        src="{{ asset('storage/' . $item->image) }}"
                        alt="Current Image"
                        class="w-40 h-40 object-cover rounded-lg border border-slate-200"
                    />
                </div>
            @endif

            <p class="text-[11px] text-slate-400">
                Format JPG/PNG, ukuran disarankan &lt; 2MB.
            </p>

            @error('image')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- BUTTON --}}
        <div class="flex justify-end pt-4 gap-3 mb-6">
            <a
                href="{{ route('admin.homepage', ['section' => 'lost']) }}"
                class="px-4 py-2 rounded-lg border border-slate-300 text-sm text-slate-600 bg-white hover:bg-slate-100"
            >
                Batal
            </a>

            <button
                type="submit"
                class="px-5 py-2.5 rounded-lg text-sm font-semibold text-white
                       bg-indigo-600 hover:bg-indigo-700 transition"
            >
                Update Barang
            </button>
        </div>
    </form>
@endsection
