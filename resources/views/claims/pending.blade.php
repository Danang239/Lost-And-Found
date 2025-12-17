<!-- resources/views/claims/pending.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>Daftar Klaim Pending</h1>

    @foreach($claims as $claim)
        <div>
            <p>Item: {{ $claim->item->name ?? 'Tidak diketahui' }}</p>
            <p>Pesan: {{ $claim->message }}</p>
            <p>Dibuat oleh: {{ $claim->user->name ?? 'Tidak diketahui' }}</p>
            <p>Status Verifikasi: {{ $claim->verified ? 'Terverifikasi' : 'Belum diverifikasi' }}</p>
        </div>
        <hr>
    @endforeach

    {{ $claims->links() }}
@endsection
