<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin • Lost &amp; Found</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 text-slate-900 font-sans antialiased">

{{-- ========================= --}}
{{--  SET SECTION BY URL      --}}
{{-- ========================= --}}
<div x-data="{ section: '{{ request('section', 'lost') }}' }" class="flex min-h-screen">

    {{-- ========================= --}}
    {{--         SIDEBAR           --}}
    {{-- ========================= --}}
    <aside class="w-64 bg-white/95 backdrop-blur border-r border-slate-200 shadow-xl shadow-slate-900/5 flex flex-col">

        {{-- Brand --}}
        <div class="flex items-center gap-3 px-6 pt-6 pb-4 border-b border-slate-100">
            <div class="w-10 h-10 rounded-2xl bg-gradient-to-tr from-indigo-600 to-purple-500 text-white flex items-center justify-center shadow-md">
                <span class="text-lg font-bold">LF</span>
            </div>
            <div>
                <h1 class="text-lg font-semibold text-slate-900 leading-tight">Lost &amp; Found</h1>
                <p class="text-xs text-slate-500">Dashboard Admin</p>
            </div>
        </div>

        {{-- ========================= --}}
        {{-- Navigation (ROUTE-BASED) --}}
        {{-- ========================= --}}
        <nav class="flex-1 px-4 py-4 space-y-1 text-sm">
            <p class="px-2 text-[11px] font-semibold tracking-wide text-slate-400 uppercase mb-2">
                Navigasi
            </p>

            {{-- Barang Hilang --}}
            <a href="{{ route('admin.homepage', ['section' => 'lost']) }}"
               class="w-full flex items-center gap-2 px-3 py-2 rounded-xl transition
               {{ request('section','lost') === 'lost' ? 'bg-indigo-600 text-white shadow-sm' : 'hover:bg-indigo-50 hover:text-indigo-700' }}">
                <span class="text-lg">📦</span>
                <span class="font-medium">Barang Hilang</span>
            </a>

            {{-- Barang Ditemukan --}}
            <a href="{{ route('admin.homepage', ['section' => 'found']) }}"
               class="w-full flex items-center gap-2 px-3 py-2 rounded-xl transition
               {{ request('section') === 'found' ? 'bg-indigo-600 text-white shadow-sm' : 'hover:bg-indigo-50 hover:text-indigo-700' }}">
                <span class="text-lg">🎒</span>
                <span class="font-medium">Barang Ditemukan</span>
            </a>

            {{-- Pengguna --}}
            <a href="{{ route('admin.homepage', ['section' => 'users']) }}"
               class="w-full flex items-center gap-2 px-3 py-2 rounded-xl transition
               {{ request('section') === 'users' ? 'bg-indigo-600 text-white shadow-sm' : 'hover:bg-indigo-50 hover:text-indigo-700' }}">
                <span class="text-lg">👤</span>
                <span class="font-medium">Pengguna</span>
            </a>

            {{-- Klaim --}}
            <a href="{{ route('admin.homepage', ['section' => 'claims']) }}"
               class="w-full flex items-center gap-2 px-3 py-2 rounded-xl transition
               {{ request('section') === 'claims' ? 'bg-indigo-600 text-white shadow-sm' : 'hover:bg-indigo-50 hover:text-indigo-700' }}">
                <span class="text-lg">📄</span>
                <span class="font-medium">Klaim</span>
            </a>
        </nav>

        {{-- ========================= --}}
        {{-- Logout --}}
        {{-- ========================= --}}
        <div class="px-4 pb-6 border-t border-slate-100 mt-2 pt-4">
            <p class="text-[11px] text-slate-400 mb-2">
                Masuk sebagai <span class="font-semibold text-slate-600">{{ auth()->user()->name ?? 'Admin' }}</span>
            </p>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit"
                        class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl
                        bg-red-600 text-white text-sm font-semibold shadow-sm
                        hover:bg-red-700 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M15 12H3m12 0-3-3m3 3-3 3m3-9h3a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2h-3"/>
                    </svg>
                    Logout
                </button>
            </form>
        </div>
    </aside>

    {{-- ========================= --}}
    {{--      MAIN CONTENT         --}}
    {{-- ========================= --}}
    <main class="flex-1 p-6 md:p-8 overflow-y-auto">
        <div class="max-w-6xl mx-auto space-y-6">
            @yield('content')
        </div>
    </main>

</div>

</body>
</html>
