<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $content->description ?? '' }}">
    <title>{{ $content->title ?? 'Contenido - ISTS' }}</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <!-- Header -->
    @include('public.partials.header')

    <!-- Hero Section -->
    <section class="about-hero">
        <div class="container">
            <h1>{{ $content->title ?? 'Contenido' }}</h1>
        </div>
    </section>

    <!-- Content -->
    <section class="about-content">
        <div class="container">
            @if (!empty($content))
                {{-- Determine if a two-column layout should be applied --}}
                @php
                    $isMisionVision = ($content->slug === 'mision-y-vision' || $content->slug === 'mision-y-vision-2');
                @endphp

                <div class="content-wrapper {{ $isMisionVision ? 'content-layout-two-column' : '' }}">
                    {{-- Display Image if it exists --}}
                    @if (!empty($content->image_url))
                        <div class="content-image">
                            <img src="{{ asset('storage/' . $content->image_url) }}" alt="{{ $content->title }}">
                        </div>
                    @endif

                    {{-- Display Rich Text Content --}}
                    <div class="content-body">
                        {!! $content->content !!}
                    </div>

                    {{-- Display PDF Link if it exists --}}
                    @if (!empty($content->file_url))
                        <div class="content-file-download">
                            <a href="{{ asset('storage/' . $content->file_url) }}" target="_blank" class="btn btn-primary">
                                Descargar PDF
                            </a>
                        </div>
                    @endif
                </div>
            @else
                <p>El contenido no está disponible.</p>
            @endif
        </div>
    </section>

    <!-- Footer -->
    @include('public.partials.footer')

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
            max-width: 90%; /* Ocupa más ancho de la pantalla */
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
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .content-body {
            font-size: 1.1rem;
            line-height: 1.8;
            margin-bottom: 2.5rem; /* Add space between content and PDF button */
        }

        /* Ensure images inside the rich text content are responsive */
        .content-body img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
        }

        .content-file-download {
            text-align: center;
            margin-top: 2rem;
        }

        /* Basic button styling if not provided by main CSS */
        .btn {
            display: inline-block;
            font-weight: 400;
            color: #212529;
            text-align: center;
            vertical-align: middle;
            user-select: none;
            background-color: transparent;
            border: 1px solid transparent;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            border-radius: 0.25rem;
            text-decoration: none;
            transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
        }

        .btn-primary {
            color: #fff;
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            color: #fff;
            background-color: #0069d9;
            border-color: #0062cc;
        }

        /* --- NEW STYLES FOR TWO-COLUMN LAYOUT --- */
        .content-layout-two-column {
            display: flex;
            flex-wrap: wrap; /* Allows items to wrap on smaller screens */
            gap: 2rem; /* Space between image and text */
            align-items: stretch; /* Align items to stretch to the same height */
        }

        .content-layout-two-column .content-image {
            flex: 0 0 40%; /* Imagen toma 40% del ancho */
            max-width: 40%;
            margin-bottom: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .content-layout-two-column .content-image img {
            width: 100%; /* Make image fill its column */
            height: 100%; /* Make image fill the height of its container */
            object-fit: contain; /* Ensure entire image is visible, potentially with whitespace */
        }

        .content-layout-two-column .content-body {
            flex: 0 0 55%; /* Texto toma 55% del ancho */
            max-width: 55%;
            margin-bottom: 0;
        }

        .content-layout-two-column .content-file-download {
            flex-basis: 100%; /* PDF button takes full width below both columns */
            margin-top: 2rem;
            text-align: left; /* Align to the left under two columns */
        }

        /* Responsive adjustments for smaller screens */
        @media (max-width: 768px) {
            .content-layout-two-column {
                flex-direction: column; /* Stack items vertically */
                gap: 1.5rem;
            }

            .content-layout-two-column .content-image,
            .content-layout-two-column .content-body {
                flex: 0 0 100%; /* Both take full width */
                max-width: 100%;
                margin-bottom: 1rem; /* Add some space back between stacked elements */
            }

            .content-layout-two-column .content-image {
                text-align: center; /* Center image when stacked */
            }

            .content-layout-two-column .content-file-download {
                text-align: center; /* Center PDF button when stacked */
            }
        }
    </style>
</body>
</html>
