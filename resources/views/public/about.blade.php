<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Conoce más sobre el Instituto Superior Tecnológico Sudamericano - Nuestra historia, misión y visión">
    <title>{{ $title ?? 'Sobre Nosotros - ISTS' }}</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <!-- Header -->
    @include('public.header')

    <!-- Hero Section -->
    <section class="about-hero">
        <div class="container">
            <h1>Instituto Superior Tecnológico Sucúa</h1>
            <p>Formando profesionales de excelencia desde 1995</p>
        </div>
    </section>

    <!-- About Content -->
    <section class="about-content">
        <div class="container">
            @if (!empty($content))
                <div class="content-wrapper">
                    <h2>{{ $content['title'] }}</h2>
                    <div class="content-body">
                        {!! $content['content'] !!}
                    </div>
                </div>
            @else
                <div class="content-wrapper">
                    <h2>Nuestra Historia</h2>
                    <p>El Instituto Superior Tecnológico Sucúa (ISTS) fue fundado en 1995 con la visión de formar profesionales altamente capacitados en el campo de la tecnología y la innovación. Desde nuestros inicios, hemos mantenido un compromiso inquebrantable con la excelencia académica y la formación integral de nuestros estudiantes.</p>

                    <h3>Misión</h3>
                    <p>Formar profesionales de excelencia en el campo tecnológico, capaces de contribuir al desarrollo sostenible de la sociedad, mediante una educación de calidad, innovadora y comprometida con los valores éticos y la responsabilidad social.</p>

                    <h3>Visión</h3>
                    <p>Ser un instituto líder en educación tecnológica, reconocido por su innovación, calidad académica y compromiso con el desarrollo integral de sus estudiantes y la sociedad.</p>
                </div>
            @endif
        </div>
    </section>

    <!-- Footer -->
    @include('public.footer')
</body>
</html>
