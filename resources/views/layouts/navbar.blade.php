{{-- NAVBAR --}}
<nav class="w-full bg-gradient-to-r from-[#0b1f26]/90 via-[#0f3440]/90 to-[#13525f]/90 text-white shadow-md border-b border-white/10 backdrop-blur-md relative z-30">
  <div class="w-full px-6 py-3 flex justify-between items-center">

    {{-- KIRI: LOGO + JUDUL --}}
    <div class="flex items-center space-x-3">
      <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-10 h-10 rounded-full object-cover" />
      <a href="{{ route('dashboard') }}" class="font-bold text-xl text-white tracking-wide">
        Lost &amp; Found
      </a>
    </div>

    {{-- KANAN: ICON & MENU --}}
    <div class="flex items-center gap-4 relative">
      @auth
        {{-- ICON PESAN (NOTIFIKASI DENGAN ANIMASI SWEETALERT SUDAH DIHANDLE DI layouts.app) --}}
        <div class="relative">
            {{-- TOMBOL ICON CHAT --}}
            <button
                id="messageBtn"
                onclick="toggleMessageModal()"
                class="relative flex items-center justify-center w-11 h-11 rounded-2xl 
                      bg-white/10 backdrop-blur-md shadow-lg border border-white/20 
                      hover:bg-white/20 hover:shadow-xl transition focus:outline-none"
                title="Notifikasi Pesan"
            >
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                    class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M7 8h6m-6 4h3m3 7.5L9.53 17H6a3 3 0 01-3-3V7a3 3 0 013-3h12a3 3 0 013 3v7a3 3 0 01-3 3h-3.5l-2.47 2.5z" />
                </svg>

                @if(isset($notifications) && $notifications->count())
                    <span class="absolute -top-1 -right-1 inline-block w-3 h-3 bg-pink-500 rounded-full ring-2 ring-purple-900"></span>
                @endif
            </button>

            {{-- MODAL PESAN --}}
            <div
                id="messageModal"
                class="hidden absolute right-0 mt-2 w-96 bg-white text-black rounded-2xl shadow-2xl max-h-[26rem] overflow-auto z-50"
            >
                {{-- HEADER --}}
                <div class="px-5 py-4 border-b bg-slate-50 rounded-t-2xl flex items-center justify-between">
                    <div>
                        <p class="font-semibold text-slate-900 text-base">
                            Pesan Baru ({{ $notifications->count() }})
                        </p>
                        <p class="text-xs text-slate-500 mt-0.5">
                            Notifikasi klaim dan aktivitas terbaru akun Anda
                        </p>
                    </div>
                    <div class="flex gap-1">
                        <span class="w-1.5 h-1.5 bg-slate-300 rounded-full"></span>
                        <span class="w-1.5 h-1.5 bg-slate-300 rounded-full"></span>
                        <span class="w-1.5 h-1.5 bg-slate-300 rounded-full"></span>
                    </div>
                </div>

                {{-- LIST PESAN --}}
                <div class="divide-y">
                    @forelse($notifications as $notification)
                        @php
                            $title   = $notification->data['title']   ?? 'Notifikasi';
                            $message = $notification->data['message'] ?? '';
                            $phone   = $notification->data['phone']   ?? null;
                        @endphp

                        <div class="px-5 py-4 hover:bg-slate-50/80 transition">
                            <div class="flex items-start gap-3">
                                {{-- ICON KECIL DI KIRI --}}
                                <div class="mt-1 flex items-center justify-center w-9 h-9 rounded-xl bg-indigo-100 text-indigo-600">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24"
                                        class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.7">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M7 8h6m-6 4h3m3 7.5L9.53 17H6a3 3 0 01-3-3V7a3 3 0 013-3h12a3 3 0 013 3v7a3 3 0 01-3 3h-3.5l-2.47 2.5z" />
                                    </svg>
                                </div>

                                <div class="flex-1">
                                    <p class="font-semibold text-sm text-slate-900">
                                        {{ $title }}
                                    </p>
                                    <p class="text-sm text-slate-700 mt-0.5 leading-snug">
                                        {{ Str::limit($message, 140) }}
                                    </p>

                                    <div class="flex items-center justify-between mt-2">
                                        <span class="text-xs text-slate-400">
                                            {{ $notification->created_at->diffForHumans() }}
                                        </span>

                                        <div class="flex items-center gap-2">
                                            <form action="{{ route('notifications.read', $notification->id) }}" method="POST">
                                                @csrf
                                                <button type="submit"
                                                        class="text-xs text-indigo-600 hover:text-indigo-700 hover:underline">
                                                    Tandai sebagai dibaca
                                                </button>
                                            </form>

                                            @if($phone)
                                                <a href="https://wa.me/{{ $phone }}" target="_blank"
                                                  class="text-xs px-2.5 py-1 rounded-full bg-emerald-500 text-white
                                                          hover:bg-emerald-600 shadow-sm">
                                                    Hubungi
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="px-5 py-6 text-center text-sm text-slate-500">
                            Tidak ada pesan baru.
                        </p>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- ICON LONCENG NOTIFIKASI KLAIM --}}
        <div class="relative">
          <button
            id="notifBtn"
            class="relative flex items-center justify-center w-10 h-10 rounded-full bg-white/10 hover:bg-white/20 text-white shadow-sm border border-white/10 transition focus:outline-none"
            title="Notifikasi Klaim Masuk"
            onclick="toggleNotifModal()"
          >
            {{-- icon bell --}}
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8">
              <path stroke-linecap="round" stroke-linejoin="round"
                    d="M15 17h5l-1.4-1.4A2 2 0 0118 14.2V11a6 6 0 00-4-5.7V5a2 2 0 10-4 0v.3A6 6 0 006 11v3.2c0 .5-.2 1-.6 1.4L4 17h5m6 0v1a3 3 0 11-6 0v-1" />
            </svg>

            @if(isset($pendingClaims) && $pendingClaims->count())
              <span class="absolute -top-0.5 -right-0.5 inline-block w-3 h-3 bg-red-500 rounded-full ring-2 ring-indigo-900"></span>
            @endif
          </button>

          {{-- MODAL NOTIFIKASI KLAIM --}}
          <div
              id="notifModal"
              class="hidden absolute right-0 mt-2 w-[26rem] bg-white text-black rounded-2xl shadow-2xl max-h-[26rem] overflow-auto z-50"
          >
              {{-- HEADER --}}
              <div class="px-5 py-4 border-b bg-slate-50 rounded-t-2xl flex items-center justify-between">
                  <div>
                      <p class="font-semibold text-slate-900 text-base">
                          Klaim Masuk ({{ $pendingClaims->count() }})
                      </p>
                      <p class="text-xs text-slate-500 mt-0.5">
                          Verifikasi klaim pemilik barang yang masuk ke sistem Anda.
                      </p>
                  </div>
                  <div class="flex gap-1">
                      <span class="w-1.5 h-1.5 bg-slate-300 rounded-full"></span>
                      <span class="w-1.5 h-1.5 bg-slate-300 rounded-full"></span>
                      <span class="w-1.5 h-1.5 bg-slate-300 rounded-full"></span>
                  </div>
              </div>

              {{-- DAFTAR KLAIM --}}
              <div class="divide-y">
                  @forelse($pendingClaims as $claim)
                      <div class="px-5 py-4 hover:bg-slate-50/70 transition">
                          <div class="flex items-start gap-3">
                              {{-- ICON DI KIRI --}}
                              <div class="mt-1 flex items-center justify-center w-9 h-9 rounded-xl
                                          bg-amber-100 text-amber-600">
                                  <svg xmlns="http://www.w3.org/2000/svg"
                                      viewBox="0 0 24 24"
                                      class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.7">
                                      <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 6v6m0 4h.01M5 20h14a2 2 0 001.73-3l-7-12a2 2 0 00-3.46 0l-7 12A2 2 0 005 20z" />
                                  </svg>
                              </div>

                              <div class="flex-1">
                                  {{-- NAMA BARANG + STATUS --}}
                                  <div class="flex items-start justify-between gap-2">
                                      <div>
                                          <p class="text-sm font-semibold text-slate-900">
                                              {{ $claim->item->name }}
                                          </p>
                                          <p class="text-xs text-slate-500">
                                              Pengklaim: <span class="font-medium">{{ $claim->user->name }}</span>
                                          </p>
                                      </div>

                                      {{-- BADGE STATUS --}}
                                      <span class="text-[11px] px-2 py-1 rounded-full
                                          @if($claim->verified === 0)
                                              bg-amber-100 text-amber-700
                                          @elseif($claim->verified === 2)
                                              bg-red-100 text-red-700
                                          @else
                                              bg-emerald-100 text-emerald-700
                                          @endif">
                                          @if($claim->verified === 0)
                                              Menunggu Verifikasi
                                          @elseif($claim->verified === 2)
                                              Klaim Ditolak
                                          @else
                                              Klaim Disetujui
                                          @endif
                                      </span>
                                  </div>

                                  {{-- DETAIL SINGKAT --}}
                                  <div class="mt-2 space-y-0.5 text-sm text-slate-700">
                                      <p>
                                          <span class="font-semibold">Pertanyaan:</span>
                                          {{ Str::limit($claim->item->features, 80) }}
                                      </p>
                                      <p>
                                          <span class="font-semibold">Jawaban:</span>
                                          {{ Str::limit($claim->message, 80) }}
                                      </p>
                                      <p class="text-xs text-slate-500 mt-1">
                                          <span class="font-semibold text-slate-700">Tanggal Klaim:</span>
                                          {{ $claim->claimed_at ? $claim->claimed_at->format('d M Y') : 'Belum diklaim' }}
                                      </p>
                                  </div>

                                  {{-- TOMBOL AKSI --}}
                                  <div class="mt-3 flex items-center justify-between gap-2">
                                      @if($claim->verified === 0)
                                          <div class="flex gap-2">
                                              <form action="{{ route('claims.verify', $claim) }}" method="POST" class="inline-block">
                                                  @csrf
                                                  <input type="hidden" name="verified" value="1" />
                                                  <button type="submit"
                                                          class="px-3.5 py-1.5 rounded-full bg-emerald-500 text-white text-xs
                                                                hover:bg-emerald-600 shadow-sm">
                                                      Terima
                                                  </button>
                                              </form>

                                              <form action="{{ route('claims.verify', $claim) }}" method="POST" class="inline-block">
                                                  @csrf
                                                  <input type="hidden" name="verified" value="0" />
                                                  <button type="submit"
                                                          class="px-3.5 py-1.5 rounded-full bg-red-500 text-white text-xs
                                                                hover:bg-red-600 shadow-sm">
                                                      Tolak
                                                  </button>
                                              </form>
                                          </div>
                                      @else
                                          <p class="text-xs text-slate-500 italic">
                                              Klaim sudah diverifikasi.
                                          </p>
                                      @endif

                                      {{-- TOMBOL HAPUS NOTIFIKASI --}}
                                      @if($claim->notification_id)
                                          <form action="{{ route('notifications.delete', $claim->notification_id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus notifikasi klaim ini?')">
                                              @csrf
                                              @method('DELETE')
                                              <button type="submit"
                                                      class="text-[11px] text-slate-400 hover:text-red-500 hover:underline">
                                                  Hapus
                                              </button>
                                          </form>
                                      @endif
                                  </div>
                              </div>
                          </div>
                      </div>
                  @empty
                      <p class="px-5 py-6 text-center text-sm text-slate-500">
                          Belum ada klaim baru yang perlu diverifikasi.
                      </p>
                  @endforelse
              </div>
          </div>
        </div>

        {{-- MENU HAMBURGER --}}
        <div class="relative">
            {{-- TOMBOL ICON HAMBURGER --}}
            <button
                id="hamburgerBtn"
                class="flex items-center justify-center w-11 h-11 rounded-2xl
                       bg-white/10 backdrop-blur-md shadow-lg border border-white/20
                       hover:bg-white/20 hover:shadow-xl transition focus:outline-none ml-2"
                title="Menu"
            >
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                     class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M4 7h16M4 12h16M4 17h10" />
                </svg>
            </button>

            {{-- MENU DROPDOWN --}}
            <div
                id="hamburgerMenu"
                class="hidden absolute right-0 mt-2 w-60 bg-white text-slate-900 rounded-2xl
                       shadow-2xl overflow-hidden z-50"
            >
                <div class="py-2 text-sm">
                    {{-- DAFTAR KLAIM --}}
                    <a href="{{ route('claims.index') }}"
                       class="flex items-center gap-3 px-4 py-2 hover:bg-slate-50 transition">
                        <span class="flex items-center justify-center w-7 h-7 rounded-full bg-indigo-50 text-indigo-600">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                 class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.7">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M5 7h14M5 12h9M5 17h5" />
                            </svg>
                        </span>
                        <span>Daftar Klaim</span>
                    </a>

                    {{-- TAMBAH BARANG --}}
                    <a href="{{ route('items.createFound') }}"
                       class="flex items-center gap-3 px-4 py-2 hover:bg-slate-50 transition">
                        <span class="flex items-center justify-center w-7 h-7 rounded-full bg-emerald-50 text-emerald-600">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                 class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.7">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M12 5v14m-7-7h14" />
                            </svg>
                        </span>
                        <span>Tambah Barang</span>
                    </a>

                    {{-- DAFTAR BARANG --}}
                    <a href="{{ route('items.index') }}"
                       class="flex items-center gap-3 px-4 py-2 hover:bg-slate-50 transition">
                        <span class="flex items-center justify-center w-7 h-7 rounded-full bg-sky-50 text-sky-600">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                 class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.7">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M4 6h7v7H4V6zm9 0h7v7h-7V6zM4 14h7v4H4v-4zm9 0h7v4h-7v-4z" />
                            </svg>
                        </span>
                        <span>Daftar Barang</span>
                    </a>
                </div>

                {{-- GARIS PEMISAH + LOGOUT --}}
                <div class="border-t border-slate-100">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button
                            type="submit"
                            class="w-full flex items-center gap-3 px-4 py-2 text-sm text-red-600
                                   hover:bg-red-50 hover:text-red-700 transition text-left"
                        >
                            <span class="flex items-center justify-center w-7 h-7 rounded-full bg-red-50 text-red-500">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                     class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.7">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M15 12H4m0 0l3-3m-3 3l3 3m4-9h6a2 2 0 012 2v8a2 2 0 01-2 2h-6" />
                                </svg>
                            </span>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        {{-- AVATAR --}}
        <a href="{{ route('profile') }}"
           class="w-11 h-11 ml-4 rounded-full overflow-hidden border border-white/30 
                  shadow-lg shadow-purple-500/20 hover:shadow-purple-500/40 
                  hover:scale-105 transition flex items-center justify-center bg-white/10 text-white">
          @if(Auth::user()->profile_photo_path)
            <img src="{{ asset('storage/' . Auth::user()->profile_photo_path) }}"
                 alt="Avatar"
                 class="w-full h-full object-cover" />
          @else
            <span class="text-white font-bold text-lg leading-none">
              {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </span>
          @endif
        </a>

      @else
        <a href="{{ route('login') }}" class="mr-4 hover:underline">Login</a>
        <a href="{{ route('register') }}" class="hover:underline">Register</a>
      @endauth
    </div>
  </div>
</nav>

{{-- TIDAK ADA LAGI FLASH MESSAGE DI SINI, SUDAH DIGANTI SWEETALERT DI layouts.app --}}

<script>
  function toggleNotifModal() {
    const modal = document.getElementById('notifModal');
    if (modal) modal.classList.toggle('hidden');
  }

  function toggleMessageModal() {
    const modal = document.getElementById('messageModal');
    if (modal) modal.classList.toggle('hidden');
  }

  window.addEventListener('click', function (e) {
    const notifModal = document.getElementById('notifModal');
    const notifBtn = document.getElementById('notifBtn');
    const messageModal = document.getElementById('messageModal');
    const messageBtn = document.getElementById('messageBtn');
    const hamburgerMenu = document.getElementById('hamburgerMenu');
    const hamburgerBtn = document.getElementById('hamburgerBtn');

    if (notifModal && notifBtn && !notifModal.contains(e.target) && !notifBtn.contains(e.target)) {
      notifModal.classList.add('hidden');
    }
    if (messageModal && messageBtn && !messageModal.contains(e.target) && !messageBtn.contains(e.target)) {
      messageModal.classList.add('hidden');
    }
    if (hamburgerMenu && hamburgerBtn && !hamburgerMenu.contains(e.target) && !hamburgerBtn.contains(e.target)) {
      hamburgerMenu.classList.add('hidden');
    }
  });

  const hbBtn = document.getElementById('hamburgerBtn');
  if (hbBtn) {
    hbBtn.addEventListener('click', function () {
      const menu = document.getElementById('hamburgerMenu');
      if (menu) menu.classList.toggle('hidden');
    });
  }
</script>
