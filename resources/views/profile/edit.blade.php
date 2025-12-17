@extends('layouts.app')

@section('content')
@php
    /** @var \App\Models\User $user */
    $user = auth()->user();
@endphp

<div class="py-10 md:py-8">
    <div class="max-w-3xl mx-auto space-y-8">

        {{-- HEADER --}}
        <div class="flex items-center justify-between mb-4">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-slate-900">
                    Edit Profil
                </h1>
                <p class="text-sm text-slate-500 mt-1">
                    Perbarui informasi akun dan keamanan password Anda.
                </p>
            </div>
        </div>

        {{-- FLASH MESSAGE LAMA (opsional, hampir tidak dipakai karena kita pakai SweetAlert) --}}
        @if (session('status'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm px-4 py-3 rounded-2xl">
                {{ session('status') }}
            </div>
        @endif

        {{-- ================== FORM DATA PROFIL ================== --}}
        <div class="bg-white rounded-3xl shadow-lg border border-slate-100 p-6 md:p-7 space-y-6">
            <h2 class="text-sm font-semibold text-slate-700 uppercase tracking-wide">
                Informasi Profil
            </h2>

            <form method="POST"
                  action="{{ route('profile.update') }}"
                  enctype="multipart/form-data"
                  class="space-y-5">
                @csrf
                @method('PATCH')

                {{-- Avatar --}}
                <div class="flex items-center gap-4">
                    <div class="w-20 h-20 rounded-full bg-slate-100 overflow-hidden flex items-center justify-center border border-slate-200">
                        @if($user->profile_photo_path)
                            <img src="{{ asset('storage/' . $user->profile_photo_path) }}"
                                 alt="Foto Profil"
                                 class="w-full h-full object-cover">
                        @else
                            <span class="text-2xl font-semibold text-slate-500">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </span>
                        @endif
                    </div>
                    <div class="text-sm text-slate-600 space-y-1">
                        <p class="font-medium text-slate-800">Foto Profil</p>
                        <p class="text-xs text-slate-500">
                            Upload foto baru untuk mengganti avatar Anda (JPG/PNG, maksimal 2MB).
                        </p>
                        <input type="file"
                               name="profile_photo"
                               class="mt-1 block w-full text-xs text-slate-600
                                      file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0
                                      file:text-xs file:font-semibold
                                      file:bg-slate-900 file:text-white
                                      hover:file:bg-slate-800">
                        @error('profile_photo')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Nama --}}
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">
                        Nama Lengkap
                    </label>
                    <input type="text"
                           name="name"
                           value="{{ old('name', $user->name) }}"
                           required
                           class="w-full rounded-xl border border-slate-300 px-3 py-2.5 text-sm
                                  focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    @error('name')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Email --}}
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">
                        Email
                    </label>
                    <input type="email"
                           name="email"
                           value="{{ old('email', $user->email) }}"
                           required
                           class="w-full rounded-xl border border-slate-300 px-3 py-2.5 text-sm
                                  focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    @error('email')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Nomor WhatsApp / Telepon --}}
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">
                        Nomor WhatsApp
                    </label>
                    <input type="text"
                           name="phone"
                           value="{{ old('phone', $user->phone) }}"
                           placeholder="Contoh: +628xxxxxxx"
                           class="w-full rounded-xl border border-slate-300 px-3 py-2.5 text-sm
                                  focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    @error('phone')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end pt-2">
                    <button type="submit"
                            class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-semibold
                                   bg-slate-900 text-white hover:bg-slate-800 transition shadow">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>

        {{-- ================== FORM PASSWORD ================== --}}
        <div class="bg-white rounded-3xl shadow-lg border border-slate-100 p-6 md:p-7 space-y-6">
            <h2 class="text-sm font-semibold text-slate-700 uppercase tracking-wide">
                Ubah Password
            </h2>

            <p class="text-xs text-slate-500 mb-1">
                Password minimal 8 karakter, wajib mengandung huruf besar, huruf kecil, dan angka.
            </p>

            <form method="POST"
                  action="{{ route('profile.password.update') }}"
                  class="space-y-5">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">
                        Password Saat Ini
                    </label>
                    <input type="password"
                           name="current_password"
                           required
                           class="w-full rounded-xl border border-slate-300 px-3 py-2.5 text-sm
                                  focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    @error('current_password')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">
                        Password Baru
                    </label>
                    <input type="password"
                           name="password"
                           required
                           class="w-full rounded-xl border border-slate-300 px-3 py-2.5 text-sm
                                  focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    @error('password')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">
                        Konfirmasi Password Baru
                    </label>
                    <input type="password"
                           name="password_confirmation"
                           required
                           class="w-full rounded-xl border border-slate-300 px-3 py-2.5 text-sm
                                  focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <div class="flex justify-end pt-2">
                    <button type="submit"
                            class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-semibold
                                   bg-indigo-600 text-white hover:bg-indigo-700 transition shadow">
                        Perbarui Password
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection
