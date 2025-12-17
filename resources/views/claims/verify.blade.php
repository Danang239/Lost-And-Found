@extends('layouts.app')

@section('content')
    <h1>Klaim Menunggu Verifikasi</h1>

    @if(session('success'))
        <div>{{ session('success') }}</div>
    @endif

    @forelse ($pendingClaims as $claim)
        <div style="border:1px solid #ccc; margin-bottom:15px; padding:10px;">
            <p><strong>Barang:</strong> {{ $claim->item->name ?? 'Nama barang tidak tersedia' }}</p>
            <p><strong>Pengklaim:</strong> {{ $claim->user->name ?? 'User tidak diketahui' }}</p>
            <p><strong>Jawaban klaim:</strong> {{ $claim->message }}</p>

            <form method="POST" action="{{ route('claims.verify', $claim->id) }}">
                @csrf
                <button type="submit" name="action" value="approve">Setujui</button>
                <button type="submit" name="action" value="reject">Tolak</button>
            </form>
        </div>
    @empty
        <p>Tidak ada klaim yang menunggu verifikasi.</p>
    @endforelse
@endsection
