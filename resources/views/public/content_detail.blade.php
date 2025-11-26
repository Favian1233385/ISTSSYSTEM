<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $content['description'] ?? '' }}">
    <title>{{ $title ?? 'Contenido - ISTS' }}</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <!-- Header -->
    @include('public.header')

    <!-- Hero Section -->
    <section class="about-hero">
        <div class="container">
            <h1>{{ $content['title'] ?? 'Contenido' }}</h1>
        </div>
    </section>

    <!-- Content -->
    <section class="about-content">
        <div class="container">
            @if (!empty($content))
                <div class="content-wrapper">
                    @if (!empty($content['image_url']))
                        <div class="content-image">
                            <img src="{{ asset($content['image_url']) }}" alt="{{ $content['title'] }}">
                        </div>
                    @endif
                    <div class="content-body">
                        {!! $content['content'] !!}
                    </div>
                </div>
            @else
                <p>El contenido no está disponible.</p>
            @endif
        </div>
    </section>

    <!-- Footer -->
    @include('public.footer')

    <style>
        .about-hero {
            background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-secondary) 100%);
            color: var(--color-white);
            padding: 4rem 0;
            text-align: center;
        }

        .about-hero h1 {
            font-size: 3rem;
            margin-bottom: 1rem;
            font-family: var(--font-primary);
        }

        .about-content {
            padding: 4rem 0;
        }

        .content-wrapper {
            max-width: 800px;
            margin: 0 auto;
        }

        .content-image {
            margin-bottom: 2rem;
            text-align: center;
        }

        .content-image img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
        }

        .content-body {
            font-size: 1.1rem;
            line-height: 1.8;
        }
    </style>
</body>
</html>
