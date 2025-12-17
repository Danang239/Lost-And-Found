@extends('layouts.app')

@section('content')
<div class="py-6 md:py-8 pb-24">

    {{-- HEADER --}}
    <div class="flex items-center gap-3 mb-5">
        <div class="w-11 h-11 rounded-2xl bg-indigo-100 text-indigo-700 flex items-center justify-center shadow-sm">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                 class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.8">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M9 11.5 11 14l4-5M5 5h14v14H5z" />
            </svg>
        </div>

        <div>
            <h1 class="text-2xl md:text-3xl font-extrabold text-slate-900 tracking-tight">
                Daftar Barang yang DiKlaim
            </h1>
            <p class="text-sm md:text-base text-slate-500 mt-1">
                Berikut adalah daftar barang yang pernah Anda klaim sebagai pemilik.
            </p>
        </div>
    </div>

    @if($claims->count())

        {{-- LIST KARTU KLAIM --}}
        <div class="space-y-4">
            @foreach ($claims as $claim)
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 hover:shadow-md transition">
                    <div class="flex flex-col md:flex-row">

                        {{-- FOTO BARANG --}}
                        <div class="w-full md:w-64 h-48 md:h-40 overflow-hidden rounded-t-2xl md:rounded-l-2xl md:rounded-tr-none">
                            @if($claim->item && $claim->item->image)
                                <img
                                    src="{{ asset('storage/' . $claim->item->image) }}"
                                    alt="{{ $claim->item->name }}"
                                    class="w-full h-full object-cover"
                                />
                            @else
                                <div class="w-full h-full bg-slate-100 flex items-center justify-center text-slate-400 text-xs">
                                    No Image
                                </div>
                            @endif
                        </div>

                        {{-- DETAIL BARANG --}}
                        <div class="flex-1 p-4 md:p-5 flex flex-col justify-between">
                            <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-3">

                                {{-- NAMA, LOKASI, DESKRIPSI --}}
                                <div class="max-w-xl">
                                    <h2 class="text-lg md:text-xl font-semibold text-slate-900">
                                        {{ $claim->item->name ?? '-' }}
                                    </h2>

                                    <p class="mt-1 text-xs font-medium text-slate-500 flex items-center gap-1.5">
                                        {{-- Icon lokasi --}}
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                             class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" stroke-width="1.6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M12 21s6-5.373 6-10A6 6 0 0 0 6 11c0 4.627 6 10 6 10z" />
                                            <circle cx="12" cy="11" r="2.4" />
                                        </svg>
                                        <span>Lokasi ditemukan:</span>
                                        <span class="text-slate-700 font-semibold">
                                            {{ $claim->item->location ?? '-' }}
                                        </span>
                                    </p>

                                    <p class="mt-2 text-sm text-slate-600">
                                        {{ Str::limit($claim->item->description ?? '-', 110) }}
                                    </p>
                                </div>

                                {{-- TANGGAL KLAIM --}}
                                <div class="flex flex-col items-start md:items-end text-xs md:text-sm text-slate-500">
                                    <span class="flex items-center gap-1.5 font-medium text-slate-600 mb-1">
                                        {{-- Icon kalender --}}
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                             class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" stroke-width="1.6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M7 4v2M17 4v2M4 9h16M6 20h12a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2H6A2 2 0 0 0 4 8v10a2 2 0 0 0 2 2z" />
                                        </svg>
                                        Tanggal Klaim
                                    </span>

                                    @php
                                        // ambil claimed_at dari ITEM (di-set saat pemilik klik "Terima")
                                        $claimedAt = optional($claim->item)->claimed_at;
                                        $claimedAtText = $claimedAt
                                            ? \Carbon\Carbon::parse($claimedAt)->translatedFormat('d M Y')
                                            : '-';
                                    @endphp

                                    <span class="px-3 py-1 rounded-full border border-slate-200 bg-slate-50 text-[11px] md:text-xs font-medium">
                                        {{ $claimedAtText }}
                                    </span>
                                </div>
                            </div>

                            {{-- BADGE STATUS --}}
                            <div class="mt-3">
                                <span
                                    class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full
                                           bg-purple-50 text-purple-700 text-xs font-semibold">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                         class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M9.5 12.5 11 14l3.5-4.5M5 5h14v14H5z" />
                                    </svg>
                                    Barang yang Anda klaim
                                </span>
                            </div>
                        </div>

                    </div>
                </div>
            @endforeach
        </div>

        {{-- PAGINATION --}}
        <div class="mt-6">
            {{ $claims->links() }}
        </div>

    @else
        {{-- JIKA BELUM ADA KLAIM --}}
        <div class="mt-8 max-w-xl">
            <div class="flex items-start gap-3 px-4 py-4 rounded-2xl border border-dashed border-slate-300 bg-white shadow-sm">
                <div class="w-10 h-10 rounded-full bg-indigo-50 text-indigo-600 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                         class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M11 6h10M7 6h.01M11 12h10M7 12h.01M11 18h10M7 18h.01" />
                    </svg>
                </div>
                <div>
                    <p class="font-semibold text-slate-800">
                        Belum ada barang yang Anda klaim.
                    </p>
                    <p class="text-sm text-slate-500 mt-1">
                        Jika Anda menemukan barang milik Anda di daftar Lost &amp; Found,
                        ajukan klaim dari halaman detail barang tersebut.
                    </p>
                </div>
            </div>
        </div>
    @endif

</div>
@endsection
