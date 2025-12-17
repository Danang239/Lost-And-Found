<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ $title ?? 'Lost and Found' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gradient-to-br from-blue-500 to-blue-800 text-black justify-center items-center flex flex-col">

    {{-- Navbar --}}

    <main class="w-full max-w-md p-4">
        @yield('content')
    </main>

</body>
</html>
