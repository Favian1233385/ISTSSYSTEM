<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Coordinaciones de Carrera - Instituto Superior Tecnológico Sucúa">
    <title>Coordinaciones de Carrera - ISTS Sucúa</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/harvard-style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/harvard-exact.css') }}">
</head>
<body>

    @include('public.partials.header')

    <!-- Main Content -->
    <main id="main-content" class="main-content">
        <!-- Page Header -->
        <section class="page-header">
            <div class="container">
                <h1 class="page-title">Coordinaciones de Carrera</h1>
                <p class="page-subtitle">Conoce nuestras carreras tecnológicas y sus coordinadores</p>
            </div>
        </section>

        <!-- Careers Grid -->
        <section class="careers-section py-5">
            <div class="container">
                @if($careers->count() > 0)
                    <div class="row g-4">
                        @foreach($careers as $career)
                            <div class="col-md-6 col-lg-4">
                                <div class="career-card">
                                    @if($career->image_path)
                                        <div class="career-image">
                                            <img src="{{ asset('storage/' . $career->image_path) }}" 
                                                 alt="{{ $career->name }}"
                                                 loading="lazy">
                                        </div>
                                    @endif
                                    <div class="career-content">
                                        <h3 class="career-title">{{ $career->name }}</h3>
                                        
                                        @if($career->description)
                                            <p class="career-description">{{ $career->description }}</p>
                                        @endif

                                        @if($career->coordinator)
                                            <div class="career-coordinator">
                                                <strong>Coordinador:</strong> {{ $career->coordinator }}
                                                @if($career->coordinator_email)
                                                    <br>
                                                    <a href="mailto:{{ $career->coordinator_email }}" class="coordinator-email">
                                                        {{ $career->coordinator_email }}
                                                    </a>
                                                @endif
                                            </div>
                                        @endif

                                        @if($career->full_description)
                                            <a href="{{ route('careers.show', $career->slug) }}" class="btn-read-more">
                                                Más información →
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-5">
                        <p class="text-muted">No hay carreras disponibles en este momento.</p>
                    </div>
                @endif
            </div>
        </section>
    </main>

    @include('public.partials.footer')

    <style>
        .page-header {
            background: linear-gradient(135deg, var(--harvard-primary) 0%, var(--harvard-secondary) 100%);
            color: white;
            padding: 4rem 0 3rem;
            margin-bottom: 3rem;
        }

        .page-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .page-subtitle {
            font-size: 1.2rem;
            opacity: 0.9;
        }

        .careers-section {
            min-height: 50vh;
        }

        .career-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .career-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
        }

        .career-image {
            width: 100%;
            height: 200px;
            overflow: hidden;
            background: #f3f4f6;
        }

        .career-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .career-card:hover .career-image img {
            transform: scale(1.05);
        }

        .career-content {
            padding: 1.5rem;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .career-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--harvard-secondary);
            margin-bottom: 1rem;
        }

        .career-description {
            color: #64748b;
            line-height: 1.6;
            margin-bottom: 1rem;
            flex: 1;
        }

        .career-coordinator {
            background: #f8fafc;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            font-size: 0.9rem;
            color: #475569;
        }

        .coordinator-email {
            color: var(--harvard-primary);
            text-decoration: none;
            font-weight: 500;
        }

        .coordinator-email:hover {
            text-decoration: underline;
        }

        .btn-read-more {
            display: inline-block;
            color: var(--harvard-primary);
            font-weight: 600;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .btn-read-more:hover {
            color: var(--harvard-secondary);
        }

        @media (max-width: 768px) {
            .page-title {
                font-size: 2rem;
            }

            .page-subtitle {
                font-size: 1rem;
            }
        }
    </style>
</body>
</html>
