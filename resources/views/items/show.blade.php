@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4">{{ $item->name }}</h1>

    @if ($item->image)
        <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}" class="mb-4 w-64">
    @endif

    <p><strong>Deskripsi:</strong> {{ $item->description }}</p>
    <p><strong>Kategori:</strong> {{ $item->category }}</p>
    <p><strong>Lokasi:</strong> {{ $item->location }}</p>
    <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($item->lost_date)->format('d M Y') }}</p>
    <p><strong>Pelapor:</strong> {{ $item->user->name }}</p>

    <div class="mt-6">
        @if($item->type === 'found')
            <form action="{{ route('items.claim', $item->id) }}" method="POST">
                @csrf
                <button class="bg-blue-600 text-white px-4 py-2 rounded">Klaim Barang</button>
            </form>
        @else
            <a href="https://wa.me/{{ $item->user->phone }}" target="_blank"
               class="bg-green-600 text-white px-4 py-2 rounded">Hubungi Pemilik</a>
        @endif
    </div>
@endsection
