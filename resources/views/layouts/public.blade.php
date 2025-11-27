<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'ISTS Sucúa' }}</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/harvard-style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/harvard-exact.css') }}">
    @stack('styles')
</head>
<body>
    @include('public.partials.header')

    <main class="main-content">
        @yield('content')
    </main>

    @include('public.partials.footer')

    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('js/chatbot.js') }}"></script>
    <script src="{{ asset('js/dropdowns.js') }}"></script>
    @stack('scripts')
</body>
</html>
