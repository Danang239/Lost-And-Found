@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-bold mb-6">Tambah Barang Hilang</h1>

    <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data" class="max-w-lg">
        @csrf

        <div class="mb-4">
            <label for="name" class="block mb-1 font-semibold">Nama Barang</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required
                   class="w-full border border-gray-300 rounded px-3 py-2 @error('name') border-red-500 @enderror" />
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="description" class="block mb-1 font-semibold">Deskripsi</label>
            <textarea name="description" id="description" rows="4" required
                      class="w-full border border-gray-300 rounded px-3 py-2 @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
            @error('description')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="category" class="block mb-1 font-semibold">Kategori</label>
            <input type="text" name="category" id="category" value="{{ old('category') }}" required
                   class="w-full border border-gray-300 rounded px-3 py-2 @error('category') border-red-500 @enderror" />
            @error('category')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="location" class="block mb-1 font-semibold">Lokasi Hilang</label>
            <input type="text" name="location" id="location" value="{{ old('location') }}" required
                   class="w-full border border-gray-300 rounded px-3 py-2 @error('location') border-red-500 @enderror" />
            @error('location')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="lost_date" class="block mb-1 font-semibold">Tanggal Hilang</label>
            <input type="date" name="lost_date" id="lost_date" value="{{ old('lost_date') }}" required
                   class="w-full border border-gray-300 rounded px-3 py-2 @error('lost_date') border-red-500 @enderror" />
            @error('lost_date')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="image" class="block mb-1 font-semibold">Foto Barang (Opsional)</label>
            <input type="file" name="image" id="image" accept="image/*"
                   class="w-full" />
            @error('image')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="bg-blue-700 text-white px-6 py-2 rounded hover:bg-blue-800">
            Tambah Barang
        </button>
    </form>
@endsection
