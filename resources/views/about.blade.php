@extends('layouts.app')

@section('content')
<div class="max-w-6xl mt-6 mx-auto py-16 px-6 bg-gradient-to-r from-indigo-50 via-purple-50 to-pink-50 rounded-lg shadow-lg">
    <div class="flex flex-col md:flex-row items-center md:items-start gap-12">
        <!-- Gambar Vertikal dengan animasi fade-in -->
        <div class="w-full md:w-1/2 overflow-hidden rounded-lg shadow-xl animate-fadeIn">
            <img src="{{ asset('images/about2.webp') }}" alt="Tentang Lost & Found"
                 class="w-full h-auto object-cover transform hover:scale-105 transition duration-500 ease-in-out" />
        </div>

        <!-- Teks Deskripsi dengan animasi fade-in -->
        <div class="w-full md:w-1/2 animate-fadeIn">
            <h1 class="text-4xl font-extrabold mb-6 text-gray-900">Tentangs Aplikasi Lost & Found</h1>
            <p class="text-gray-700 leading-relaxed mb-6 text-lg">
                Aplikasi ini dibuat untuk membantu pengguna melaporkan barang yang hilang maupun ditemukan.
                Setiap pengguna bisa membuat laporan, melihat daftar barang, serta menghubungi pemilik jika menemukan barang yang sesuai.
            </p>
            <p class="text-gray-700 leading-relaxed mb-8 text-lg">
                Tujuan kami adalah menciptakan lingkungan yang aman dan terpercaya bagi pengguna untuk saling membantu menemukan barang-barang berharga yang hilang.
            </p>
            <a href="{{ route('dashboard') }}"
               class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-3 rounded shadow-lg transition duration-300">
                Mulai Cari Barangmu
            </a>
        </div>
    </div>
</div>

{{-- Tambah animasi fade-in --}}
<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fadeIn {
        animation: fadeIn 0.8s ease forwards;
    }
</style>
@endsection
