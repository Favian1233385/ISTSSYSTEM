<!DOCTYPE html>
<html lang="{{ str_replace('_','-',app()->getLocale()) }}" @if(app()->getLocale() === 'ar') dir="rtl" @endif>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? config('app.name', 'ISTS') }}</title>
    @php
        // Prefer the server base path (e.g. when deployed under a subfolder),
        // otherwise fall back to the APP_BASE env var or config('app.base_path').
        $reqBase = request()->getBasePath();
        $envBase = env('APP_BASE', config('app.base_path', ''));
        $computed = $reqBase ?: $envBase;
        // normalize: make empty string or leading-slash path (/ISTSSYSTEM)
        $base = $computed ? '/'.ltrim(rtrim($computed, '/'), '/') : '';
    @endphp
    {{-- Carga de estilos y scripts con Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ $base }}/css/admin.css">
    <link rel="stylesheet" href="{{ $base }}/css/style.css">
    @if(app()->getLocale() === 'ar')
        <link rel="stylesheet" href="{{ $base }}/css/app-rtl.css">
    @endif
    <link rel="icon" type="image/png" href="{{ asset('assets/images/logoists.png') }}" sizes="32x32">
</head>
<body>
    <div class="site-main">
        @include('public.partials.header')
        <main>
            @yield('content')
        </main>
        @include('public.partials.footer')
    </div>

    <script src="{{ $base }}/js/main.js"></script>
    <script src="{{ $base }}/js/dropdowns.js"></script>
</body>
</html>
