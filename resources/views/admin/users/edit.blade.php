@extends('layouts.admin')

@section('content')

    {{-- HEADER --}}
    <div class="mb-8 flex items-center gap-3">
        <div class="w-10 h-10 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center shadow-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M5.121 17.804A4 4 0 0 1 4 15V9a5 5 0 1 1 10 0v6a4 4 0 0 1-1.121 2.804M9 21h6"/>
            </svg>
        </div>

        <div>
            <h2 class="text-3xl font-bold text-slate-900">
                Edit Pengguna
            </h2>
            <p class="text-sm text-slate-500 mt-1">
                Perbarui informasi pengguna yang terdaftar dalam sistem.
            </p>
        </div>
    </div>

    {{-- FORM TANPA BOX --}}
    <form
        action="{{ route('admin.users.update', $user->id) }}"
        method="POST"
        enctype="multipart/form-data"
        class="space-y-6"
    >
        @csrf
        @method('PUT')

        {{-- NAMA --}}
        <div class="space-y-1">
            <label for="name" class="block text-sm font-semibold text-slate-800">
                Nama Pengguna
            </label>
            <input
                type="text"
                id="name"
                name="name"
                value="{{ old('name', $user->name) }}"
                required
                class="w-full bg-white border border-slate-300 rounded-lg px-3 py-2.5 text-sm
                       focus:ring-blue-500 focus:border-blue-500"
            />
        </div>

        {{-- EMAIL --}}
        <div class="space-y-1">
            <label for="email" class="block text-sm font-semibold text-slate-800">
                Email Pengguna
            </label>
            <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email', $user->email) }}"
                required
                class="w-full bg-white border border-slate-300 rounded-lg px-3 py-2.5 text-sm
                       focus:ring-blue-500 focus:border-blue-500"
            />
        </div>

        {{-- NOMOR TELEPON --}}
        <div class="space-y-1">
            <label for="phone" class="block text-sm font-semibold text-slate-800">
                Nomor Telepon
            </label>
            <input
                type="text"
                id="phone"
                name="phone"
                value="{{ old('phone', $user->phone) }}"
                class="w-full bg-white border border-slate-300 rounded-lg px-3 py-2.5 text-sm
                       focus:ring-blue-500 focus:border-blue-500"
            />
        </div>

        {{-- FOTO PROFIL --}}
        <div class="space-y-1">
            <label for="profile_photo" class="block text-sm font-semibold text-slate-800">
                Foto Profil
            </label>
            <input
                type="file"
                id="profile_photo"
                name="profile_photo"
                class="w-full bg-white border border-slate-300 rounded-lg px-3 py-2 text-sm
                       focus:ring-blue-500 focus:border-blue-500"
            />

            @if($user->profile_photo_path)
                <div class="mt-3">
                    <p class="text-xs font-medium text-slate-600 mb-1">Foto saat ini:</p>
                    <img
                        src="{{ asset('storage/' . $user->profile_photo_path) }}"
                        class="w-40 h-40 object-cover rounded-lg border border-slate-200"
                    />
                </div>
            @endif

            <p class="text-[11px] text-slate-400">Disarankan JPG/PNG — Maks 2MB.</p>
        </div>

        {{-- BUTTON --}}
        <div class="flex justify-end pt-4 gap-3 mb-6">
            <a
                href="{{ route('admin.homepage', ['section' => 'users']) }}"
                class="px-4 py-2 rounded-lg border border-slate-300 text-sm text-slate-600 bg-white hover:bg-slate-100"
            >
                Batal
            </a>

            <button
                type="submit"
                class="px-5 py-2.5 rounded-lg text-sm font-semibold text-white
                       bg-blue-600 hover:bg-blue-700 transition"
            >
                Update Pengguna
            </button>
        </div>
    </form>

@endsection
