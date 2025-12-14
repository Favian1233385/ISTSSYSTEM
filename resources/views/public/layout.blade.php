<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Eventos - ISTS</title>
    <link rel="stylesheet" href="/css/style.css">
    <!-- Puedes agregar aquí otros estilos o scripts públicos -->
</head>
<body class="bg-gray-100 min-h-screen">
    <div class="min-h-screen bg-gray-50">
        @include('public.partials.header')
        <!-- Encabezado personalizado por sección -->
        @yield('header')
        <!-- Contenido principal -->
        <div class="max-w-7xl mx-auto px-4">
            @yield('content')
        </div>
    </div>
</body>
</html>
