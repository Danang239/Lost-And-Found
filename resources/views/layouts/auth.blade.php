<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Lost & Found') }}</title>

    {{-- Tailwind + Vite (sesuai project kamu) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Scroll halus ke section About */
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-indigo-900 via-slate-900 to-purple-800 text-slate-100 antialiased">

    @yield('content')

</body>
</html>
