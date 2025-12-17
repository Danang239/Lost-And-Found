<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ $title ?? 'Lost and Found' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 flex flex-col min-h-screen">

    {{-- Navbar --}}
    @include('layouts.navbar')

    {{-- Konten utama --}}
    <main class="flex-grow w-full">
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('layouts.footer')

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const showFancyAlert = (type, message, timer = 4500) => {
            const isSuccess = type === 'success';

            Swal.fire({
                icon: isSuccess ? 'success' : 'error',
                title: isSuccess ? 'Berhasil 🎉' : 'Terjadi Kesalahan',
                html: `
                    <p class="mt-1 text-[13px] leading-relaxed text-slate-200">
                        ${message}
                    </p>
                `,
                timer: timer,
                timerProgressBar: true,
                showConfirmButton: false,

                // POSISI TENGAH
                position: 'center',

                // Glass + Glow
                background: 'transparent',
                padding: 0,
                backdrop: `
                    rgba(15,23,42,0.65)
                    center center
                    no-repeat
                `,

                customClass: {
                    popup: 'rounded-3xl bg-gradient-to-br from-slate-950/95 via-slate-900/95 to-sky-900/90 border border-white/10 shadow-2xl shadow-sky-900/40 px-6 py-5 max-w-sm',
                    title: 'text-base md:text-lg font-semibold text-white tracking-wide',
                    htmlContainer: 'mt-2 text-slate-200',
                    icon: isSuccess
                        ? 'border-emerald-400 text-emerald-400 bg-emerald-500/10'
                        : 'border-rose-400 text-rose-400 bg-rose-500/10',
                    timerProgressBar: 'bg-emerald-400'
                }
            });
        };

        // SUCCESS
        @if(session('success'))
            showFancyAlert('success', {!! json_encode(session('success')) !!}, 4500);
        @endif

        // STATUS (Laravel default)
        @if(session('status'))
            showFancyAlert('success', {!! json_encode(session('status')) !!}, 4500);
        @endif

        // ERROR
        @if(session('error'))
            showFancyAlert('error', {!! json_encode(session('error')) !!}, 5000);
        @endif

        // VALIDATION ERROR
        @if($errors->any())
            const firstError = {!! json_encode($errors->first()) !!};
            showFancyAlert('error', firstError, 6000);
        @endif
    });
    </script>


</body>
</html>
