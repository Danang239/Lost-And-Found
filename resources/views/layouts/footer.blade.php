{{-- FOOTER MODERN PUTIH PADAT (TANPA ROUTE items.create) --}}
<footer class="bg-white text-slate-700 py-10 mt-16 border-t border-slate-200">

    <div class="max-w-7xl mx-auto px-6 md:px-10 grid grid-cols-1 md:grid-cols-3 gap-10">

        {{-- Column 1 — Branding --}}
        <div>
            <div class="flex items-center gap-3 mb-3">
                <span class="w-10 h-10 rounded-xl bg-indigo-100 text-indigo-600 flex items-center justify-center shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M4 7.5 12 4l8 3.5M4 7.5V17l8 3 8-3V7.5M12 10.5 4 7.5m8 3 8-3"/>
                    </svg>
                </span>
                <h3 class="text-xl font-bold">Lost & Found</h3>
            </div>

            <p class="text-sm text-slate-500 leading-relaxed">
                Sistem pelaporan barang hilang & ditemukan untuk membantu civitas kampus
                menemukan kembali barang berharga mereka.
            </p>

            <p class="mt-3 text-sm text-slate-400">
                © {{ date('Y') }} Lost & Found — All Rights Reserved.
            </p>
        </div>

        {{-- Column 2 — Navigasi (semua route sudah ada di project kamu) --}}
        <div>
            <h4 class="text-sm font-semibold text-slate-800 mb-3">Navigasi</h4>

            <ul class="space-y-2 text-sm">
                <li>
                    <a href="{{ route('dashboard') }}" class="hover:text-indigo-600 transition">
                        Beranda
                    </a>
                </li>
                <li>
                    <a href="{{ route('items.index') }}" class="hover:text-indigo-600 transition">
                        Daftar Barang Ditemukan
                    </a>
                </li>
                <li>
                    <a href="{{ route('claims.index') }}" class="hover:text-indigo-600 transition">
                        Barang yang Saya Klaim
                    </a>
                </li>
                <li>
                    <a href="{{ route('items.createFound') }}" class="hover:text-indigo-600 transition">
                        Laporkan Penemuan
                    </a>
                </li>
            </ul>
        </div>

        {{-- Column 3 — Kontak / Social --}}
        <div>
            <h4 class="text-sm font-semibold text-slate-800 mb-3">Hubungi Admin</h4>

            <p class="text-sm text-slate-500 mb-4">
                Jika Anda menemukan barang atau butuh bantuan, silakan hubungi admin kampus melalui:
            </p>

            <div class="flex flex-wrap items-center gap-3">

                {{-- WhatsApp --}}
                <a href="https://api.whatsapp.com/send/?phone=%2B6281386642281&text=Halo%2C+saya+melihat+laporan+barang+%27jaket%27.+Apakah+ini+masih+hilang%3F&type=phone_number&app_absent=0"
                   class="flex items-center gap-2 px-4 py-2 rounded-lg border border-slate-300
                          hover:border-green-500 hover:bg-green-50 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                         stroke-width="1.8" stroke="currentColor" class="w-5 h-5 text-green-600">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M3.5 20.5l1.2-4A8 8 0 113.5 12c0 1.6.5 3.1 1.2 4.3l-1.2 4.2z"/>
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M10.5 9.5c.5-1 1.5-.5 2.2.2.7.7 1.1 1.3.5 2-0.8 1-2 1.8-2.4 2-0.4.2-0.9.2-1.3 0-0.5-0.3-2.2-1.1-3.2-3.2-0.1-0.3-0.1-0.8.2-1.1.2-0.3.5-0.5.8-0.6.3-0.1.5 0 .7.1l1.2.8z"/>
                    </svg>
                    <span class="text-sm font-medium">WhatsApp Admin</span>
                </a>

                {{-- Instagram --}}
                <a href="https://www.instagram.com/danangtri13/"
                   class="flex items-center gap-2 px-4 py-2 rounded-lg border border-slate-300
                          hover:border-pink-500 hover:bg-pink-50 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"
                         class="w-5 h-5 text-pink-500">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M7 3h10a4 4 0 014 4v10a4 4 0 01-4 4H7a4 4 0 01-4-4V7a4 4 0 014-4zm5 5a4 4 0 100 8 4 4 0 000-8zm4.5-1.5h.01"/>
                    </svg>
                    <span class="text-sm font-medium">Instagram</span>
                </a>

            </div>
        </div>

    </div>

</footer>
