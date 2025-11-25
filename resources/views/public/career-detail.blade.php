<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $career->description ?? $career->name }} - Instituto Superior Tecnológico Sucúa">
    <title>{{ $career->name }} - ISTS Sucúa</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/harvard-style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/harvard-exact.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body>

    @include('public.partials.header')

    <!-- Main Content -->
    <main id="main-content" class="main-content">
        <!-- Page Header Simple -->
        <section class="career-page-header">
            <div class="container text-center">
                <h1 class="career-page-title">{{ $career->name }}</h1>
            </div>
        </section>

        <!-- Sección 1: Objetivo de la Carrera (Texto Izquierda - Imagen Derecha) -->
        @if($career->full_description)
        <section class="career-section">
            <div class="container">
                <div class="career-box">
                    <div class="row g-0 align-items-stretch">
                        <div class="col-lg-6">
                            <div class="section-content">
                                <h2 class="section-title">{{ $career->name }}</h2>
                                <div class="section-text">
                                    {!! nl2br(e($career->full_description)) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="section-image">
                                @if($career->image_path)
                                    <img src="{{ asset('storage/' . $career->image_path) }}" 
                                         alt="{{ $career->name }}">
                                @else
                                    <img src="https://istsucua.edu.ec/wp-content/uploads/2025/05/CARRERA-DE-DESARROLLO-DE-SOFTWARE-300x300.jpg" 
                                         alt="{{ $career->name }}">
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @endif

        <!-- Sección 2: Perfil Profesional (Imagen Izquierda - Texto Derecha) -->
        <section class="career-section">
            <div class="container">
                <div class="career-box">
                    <div class="row g-0 align-items-stretch">
                        <div class="col-lg-6 order-lg-1 order-2">
                            <div class="section-image">
                                @if($career->image_path_2)
                                    <img src="{{ asset('storage/' . $career->image_path_2) }}" 
                                         alt="Perfil Profesional - {{ $career->name }}">
                                @else
                                    <img src="https://istsucua.edu.ec/wp-content/uploads/2024/09/desarrollador-software-programacion.jpg" 
                                         alt="Perfil Profesional">
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6 order-lg-2 order-1">
                            <div class="section-content">
                                <h2 class="section-title">Perfil Profesional</h2>
                                <div class="section-text">
                                    @if($career->professional_profile)
                                        <p>{{ $career->professional_profile }}</p>
                                    @else
                                        <p>Analizar los requerimientos del usuario mediante metodologías de desarrollo de software. Desarrollar sistemas informáticos de escritorio, web y aplicaciones móviles. Codificar sistemas informáticos utilizando lenguajes de programación de última generación. Implementar el software elaborado en un ambiente de trabajo.</p>
                                    @endif
                                    
                                    <div class="academic-info">
                                        <p><strong>Título a obtener:</strong> Tecnólogo Superior en {{ $career->name }}</p>
                                        <p><strong>Períodos académicos:</strong> 4</p>
                                        <p><strong>Modalidad:</strong> Presencial</p>
                                        <p><strong>Horario:</strong> 5 PM – 10 PM</p>
                                        
                                        @if($career->coordinator || $career->coordinator_email)
                                            <div class="coordinator-info mt-3">
                                                <p class="coordinator-title"><strong><i class="bi bi-person-circle"></i> Coordinación de Carrera</strong></p>
                                                @if($career->coordinator)
                                                    <p><strong>Coordinador:</strong> {{ $career->coordinator }}</p>
                                                @endif
                                                @if($career->coordinator_email)
                                                    <p><strong>Email:</strong> <a href="mailto:{{ $career->coordinator_email }}">{{ $career->coordinator_email }}</a></p>
                                                @endif
                                            </div>
                                        @endif

                                        @if($career->curriculum_pdf)
                                            <div class="curriculum-actions mt-4">
                                                <a href="{{ asset('storage/' . $career->curriculum_pdf) }}" 
                                                   class="btn-curriculum" 
                                                   target="_blank">
                                                    <i class="bi bi-file-earmark-pdf"></i>
                                                    Ver Malla Curricular
                                                </a>
                                                <a href="{{ asset('storage/' . $career->curriculum_pdf) }}" 
                                                   class="btn-curriculum btn-download" 
                                                   download>
                                                    <i class="bi bi-download"></i>
                                                    Descargar PDF
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    @include('public.partials.footer')

    <style>
        /* Career Page Header */
        .career-page-header {
            background: linear-gradient(135deg, var(--harvard-primary) 0%, var(--harvard-secondary) 100%);
            color: white;
            padding: 8rem 0 3rem;
            margin-top: 0;
            margin-bottom: 3rem;
        }

        .career-page-title {
            font-size: 2.5rem;
            font-weight: 800;
            margin: 0;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        }

        /* Career Sections */
        .career-section {
            padding: 2rem 0;
        }

        /* Career Box - Caja con estilo institucional */
        .career-box {
            background: linear-gradient(135deg, rgba(0, 168, 107, 0.08) 0%, rgba(14, 62, 73, 0.08) 100%);
            border-radius: 12px;
            margin-bottom: 2rem;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            border: 2px solid rgba(0, 168, 107, 0.15);
            display: flex;
        }

        .career-box .row {
            width: 100%;
            display: flex;
            flex-wrap: nowrap;
        }

        .career-box .col-lg-6 {
            flex: 0 0 50%;
            max-width: 50%;
        }

        /* Section Content Column */
        .section-content {
            padding: 3rem 2.5rem;
            background: rgba(255, 255, 255, 0.95);
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            min-height: 450px;
        }

        .section-title {
            color: var(--harvard-secondary);
            font-size: 1.75rem;
            font-weight: 700;
            margin-bottom: 1.25rem;
            line-height: 1.3;
            border-bottom: 3px solid var(--harvard-primary);
            padding-bottom: 0.5rem;
        }

        .section-text {
            font-size: 0.975rem;
            line-height: 1.7;
            color: #1e293b;
            text-align: justify;
        }

        .section-text p {
            margin-bottom: 1rem;
        }

        /* Academic Info */
        .academic-info {
            margin-top: 1.5rem;
            padding: 1.25rem;
            background: rgba(0, 168, 107, 0.05);
            border-radius: 8px;
            border-left: 4px solid var(--harvard-primary);
        }

        .academic-info p {
            margin-bottom: 0.5rem;
            font-size: 0.925rem;
            color: #1e293b;
        }

        .academic-info p:last-child {
            margin-bottom: 0;
        }

        .academic-info strong {
            font-weight: 700;
            color: var(--harvard-secondary);
        }

        /* Coordinator Info */
        .coordinator-info {
            padding-top: 1rem;
            border-top: 2px solid rgba(0, 168, 107, 0.2);
        }

        .coordinator-info .coordinator-title {
            margin-bottom: 0.75rem;
            color: var(--harvard-secondary);
        }

        .coordinator-info .coordinator-title i {
            color: var(--harvard-primary);
            margin-right: 0.25rem;
        }

        .coordinator-info a {
            color: var(--harvard-primary);
            text-decoration: none;
            font-weight: 600;
        }

        .coordinator-info a:hover {
            text-decoration: underline;
        }

        /* Curriculum Actions */
        .curriculum-actions {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .btn-curriculum {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            background: var(--harvard-primary);
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            border: 2px solid var(--harvard-primary);
        }

        .btn-curriculum:hover {
            background: #008c5a;
            border-color: #008c5a;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 168, 107, 0.3);
            color: white;
        }

        .btn-curriculum.btn-download {
            background: white;
            color: var(--harvard-primary);
            border: 2px solid var(--harvard-primary);
        }

        .btn-curriculum.btn-download:hover {
            background: var(--harvard-primary);
            color: white;
        }

        .btn-curriculum i {
            font-size: 1.1rem;
        }

        /* Section Image Column */
        .section-image {
            background: linear-gradient(135deg, rgba(0, 168, 107, 0.1) 0%, rgba(14, 62, 73, 0.1) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 450px;
            overflow: hidden;
            width: 100%;
            height: 100%;
        }

        .section-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform 0.3s ease;
        }

        .section-image:hover img {
            transform: scale(1.05);
        }

        /* Responsive */
        @media (max-width: 991px) {
            .career-box .row {
                flex-wrap: wrap;
            }

            .career-box .col-lg-6 {
                flex: 0 0 100%;
                max-width: 100%;
            }

            .career-section {
                padding: 1.5rem 0;
            }

            .section-content {
                padding: 2rem;
                min-height: auto;
            }

            .section-title {
                font-size: 1.5rem;
            }

            .career-page-title {
                font-size: 2rem;
            }

            .section-image {
                min-height: 300px;
            }
        }

        @media (max-width: 768px) {
            .career-page-header {
                padding: 6rem 0 2rem;
            }

            .career-page-title {
                font-size: 1.75rem;
            }

            .career-section {
                padding: 1rem 0;
            }

            .section-content {
                padding: 1.5rem;
            }

            .section-title {
                font-size: 1.35rem;
                text-align: center;
            }

            .section-text {
                font-size: 0.925rem;
            }

            .section-image {
                min-height: 250px;
            }

            .academic-info {
                padding: 1rem;
            }

            .academic-info p {
                font-size: 0.875rem;
            }
        }
    </style>
</body>
</html>
