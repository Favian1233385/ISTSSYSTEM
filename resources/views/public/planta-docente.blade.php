<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Planta Docente - ISTS Sucúa' }}</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/harvard-style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/harvard-exact.css') }}">
</head>
<body>
    @include('public.partials.header')

    <main class="main-content">
        <!-- Page Header -->
        <section class="about-page-header">
            <div class="container text-center">
                <h1 class="about-page-title">Planta Docente</h1>
            </div>
        </section>

        <!-- Content Section -->
        <section class="about-content-area">
            <div class="container">
                <div class="team-grid">
                    @if(isset($teachers) && count($teachers) > 0)
                        @foreach($teachers as $teacher)
                            <div class="team-member-card">
                                @if($teacher->image_path)
                                    <img src="{{ asset('storage/' . $teacher->image_path) }}" alt="{{ $teacher->name }}" class="team-member-img">
                                @endif
                                <div class="team-member-info">
                                    <h3>{{ $teacher->name }}</h3>
                                    <p class="position">{{ $teacher->title }}</p>
                                    <p class="department">{{ $teacher->department }}</p>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p>No hay docentes para mostrar.</p>
                    @endif
                </div>
            </div>
        </section>
    </main>

    @include('public.partials.footer')

    @include('public.acerca.partials.about-styles')
</body>
</html>
