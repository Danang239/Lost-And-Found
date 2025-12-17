@extends('layouts.admin')

@section('content')

    {{-- HEADER DASHBOARD --}}
    <header class="mb-6">
        <div class="flex items-center justify-between gap-4 mb-2">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-slate-900">
                    Dashboard Admin
                </h1>
            </div>
        </div>

        {{-- KETERANGAN DINAMIS PER SECTION --}}
        <div class="mt-4 text-xs md:text-sm text-slate-500">
            <p x-show="section === 'lost'">
                Menampilkan semua <span class="font-semibold text-slate-700">laporan barang hilang</span> yang dibuat oleh pengguna.
            </p>
            <p x-show="section === 'found'">
                Menampilkan semua <span class="font-semibold text-slate-700">laporan barang ditemukan</span> yang diinput pengguna.
            </p>
            <p x-show="section === 'users'">
                Menampilkan daftar <span class="font-semibold text-slate-700">pengguna terdaftar</span> pada sistem Lost &amp; Found.
            </p>
            <p x-show="section === 'claims'">
                Menampilkan daftar <span class="font-semibold text-slate-700">klaim barang</span> beserta statusnya.
            </p>
        </div>
    </header>

    {{-- ====== BARANG HILANG ====== --}}
    @if(isset($lostItems))
        <section x-show="section === 'lost'" x-cloak class="space-y-4">
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                    <div>
                        <h2 class="text-lg font-semibold text-slate-900">
                            Laporan Barang Hilang
                        </h2>
                        <p class="text-xs md:text-sm text-slate-500">
                            Daftar barang yang dilaporkan hilang oleh civitas kampus.
                        </p>
                    </div>
                </div>
                <div class="p-4">
                    @include('admin.partials.lost-items', ['items' => $lostItems])
                </div>
            </div>
        </section>
    @endif

    {{-- ====== BARANG DITEMUKAN ====== --}}
    @if(isset($foundItems))
        <section x-show="section === 'found'" x-cloak class="space-y-4">
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                    <div>
                        <h2 class="text-lg font-semibold text-slate-900">
                            Laporan Barang Ditemukan
                        </h2>
                        <p class="text-xs md:text-sm text-slate-500">
                            Daftar barang yang ditemukan dan dilaporkan ke sistem.
                        </p>
                    </div>
                </div>
                <div class="p-4">
                    @include('admin.partials.found-items', ['items' => $foundItems])
                </div>
            </div>
        </section>
    @endif

    {{-- ====== PENGGUNA ====== --}}
    @if(isset($users))
        <section x-show="section === 'users'" x-cloak class="space-y-4">
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                    <div>
                        <h2 class="text-lg font-semibold text-slate-900">
                            Daftar Pengguna
                        </h2>
                        <p class="text-xs md:text-sm text-slate-500">
                            Informasi akun pengguna yang terdaftar di sistem Lost &amp; Found.
                        </p>
                    </div>
                </div>
                <div class="p-4">
                    @include('admin.partials.users', ['users' => $users])
                </div>
            </div>
        </section>
    @endif

    {{-- ====== KLAIM ====== --}}
    @if(isset($claims))
        <section x-show="section === 'claims'" x-cloak class="space-y-4">
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                    <div>
                        <h2 class="text-lg font-semibold text-slate-900">
                            Daftar Klaim Barang
                        </h2>
                        <p class="text-xs md:text-sm text-slate-500">
                            Klaim yang diajukan pengguna terhadap barang hilang / ditemukan.
                        </p>
                    </div>
                </div>
                <div class="p-4">
                    @include('admin.partials.claims', ['claims' => $claims])
                </div>
            </div>
        </section>
    @endif

@endsection
