<!doctype html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- AOS CSS (CDN) -->
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    @stack('css')
</head>
<body class="font-sans bg-gradient-to-b from-emerald-50 via-emerald-50/50 to-emerald-100/50 text-neutral-800 overflow-x-hidden">
    {{-- Background --}}
    <div class="fixed inset-0 -z-10 overflow-hidden">
        <div class="absolute -top-32 -left-24 w-72 h-72 bg-emerald-300/35 blur-3xl rounded-full"></div>
        <div class="absolute top-32 -right-20 w-80 h-80 bg-emerald-300/30 blur-3xl rounded-full"></div>
        <div class="absolute bottom-[-120px] left-1/3 w-96 h-96 bg-emerald-100/55 blur-3xl rounded-full"></div>
        <div class="absolute bottom-10 right-10 w-52 h-52 bg-teal-100/45 blur-3xl rounded-full"></div>
    </div>

    @include('frontend.partials.top-header')
    @include('frontend.partials.navbar')

    <main>
        @yield('content')
    </main>

    @include('frontend.partials.footer')

    <!-- AOS JS (CDN) -->
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    
    @stack('scripts')
</body>
</html>