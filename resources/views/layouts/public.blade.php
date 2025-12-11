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
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    @stack('styles')
</head>
<body>
    @include('public.partials.header')

    <main class="main-content">
        @yield('content')
    </main>

    @include('public.partials.footer')

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('js/chatbot.js') }}"></script>
    <script src="{{ asset('js/dropdowns.js') }}"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var myCarousel = document.querySelector('#heroCarousel');
        if (myCarousel) {
            var items = myCarousel.querySelectorAll('.carousel-item');
            console.log('Bootstrap Carousel: inicializando. Slides encontrados:', items.length);
            var carousel = new bootstrap.Carousel(myCarousel, {
                interval: 3000,
                ride: 'carousel',
                pause: false,
                wrap: true
            });
            // Mostrar el estado de los slides
            items.forEach(function(item, idx) {
                console.log('Slide', idx+1, 'clases:', item.className);
            });
        } else {
            console.log('Bootstrap Carousel: no encontrado en el DOM');
        }
    });
    </script>
    @stack('scripts')
</body>
</html>
