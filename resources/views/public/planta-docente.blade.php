<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Planta Docente - ISTS Sucúa' }}</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/harvard-style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/harvard-exact.css') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/images/logoists.png') }}" sizes="32x32">
    <style>
        .team-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 32px;
        }
        .team-member-card {
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: stretch;
            height: 100%;
            min-height: 420px;
            box-sizing: border-box;
        }
        .team-member-info {
            display: flex;
            flex-direction: column;
            flex: 1 1 auto;
            justify-content: flex-end;
            align-items: center;
            padding-bottom: 16px;
        }
        .team-member-info h3 {
            margin-bottom: 8px;
            text-align: center;
            width: 100%;
            min-height: 56px;
            display: flex;
            align-items: flex-end;
            justify-content: center;
        }
        .team-member-info p {
            margin-bottom: 8px;
            text-align: center;
            width: 100%;
        }
        .team-member-info .btn {
            margin-top: auto;
            align-self: center;
        }
    </style>
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
                                @else
                                    <img src="{{ asset('uploads/images/profe.jpg') }}" alt="Imagen por defecto docente" class="team-member-img">
                                @endif
                                <div class="team-member-info">
                                    <h3>{{ $teacher->name }}</h3>
                                    <p class="position">{{ $teacher->title }}</p>
                                    <p class="department">{{ $teacher->department }}</p>
                                    @if($teacher->pdf_path)
                                        <a href="{{ asset('storage/' . $teacher->pdf_path) }}" target="_blank" class="btn" style="margin-top:8px; background:#1976d2; color:#fff; border-radius:6px; padding:6px 18px; font-weight:500; text-decoration:none; display:inline-block; transition:background 0.2s;">Ver Currículum</a>
                                    @endif
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
