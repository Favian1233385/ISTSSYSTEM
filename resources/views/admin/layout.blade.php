<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'ISTS Admin' }}</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/harvard-style.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>
<body>
    @if (!session('user_id') || session('user_role') !== 'admin')
        <script>
            window.location.href = "{{ url('/admin/login') }}";
        </script>
    @endif

    <div class="admin-layout" style="padding: 2rem;">
        @include('admin.partials.header')

        <main>
            @yield('content')
        </main>

        @include('admin.partials.footer')
    </div>
</body>
</html>