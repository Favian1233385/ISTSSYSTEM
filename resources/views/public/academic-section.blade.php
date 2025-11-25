<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $section->description ?? $section->title }} - Instituto Superior Tecnológico Sucúa">
    <title>{{ $section->title }} - ISTS Sucúa</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/harvard-style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/harvard-exact.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body>

    @include('public.partials.header')

    <!-- Main Content -->
    <main id="main-content" class="main-content">
        <!-- Page Header -->
        <section class="section-page-header">
            <div class="container text-center">
                <h1 class="section-page-title">{{ $section->title }}</h1>
                @if($section->description)
                    <p class="section-page-subtitle">{{ $section->description }}</p>
                @endif
            </div>
        </section>

        <!-- Section Content -->
        <section class="section-content-area">
            <div class="container">
                <div class="section-box">
                    <div class="row g-0 align-items-stretch">
                        <!-- Content Column -->
                        <div class="col-lg-{{ $section->image_path ? '7' : '12' }}">
                            <div class="section-text-content">
                                @if($section->content)
                                    <div class="content-body">
                                        {!! nl2br(e($section->content)) !!}
                                    </div>
                                @endif

                                <!-- CTA Buttons -->
                                <div class="section-actions mt-4">
                                    <a href="{{ url('/contacto') }}" class="btn btn-primary">
                                        <i class="bi bi-envelope-fill"></i>
                                        Solicitar Información
                                    </a>
                                    <a href="{{ url('/') }}" class="btn btn-secondary">
                                        <i class="bi bi-arrow-left"></i>
                                        Volver al Inicio
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Image Column -->
                        @if($section->image_path)
                            <div class="col-lg-5">
                                <div class="section-image-content">
                                    <img src="{{ asset('storage/' . $section->image_path) }}" 
                                         alt="{{ $section->title }}">
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </main>

    @include('public.partials.footer')

    <style>
        /* Page Header */
        .section-page-header {
            background: linear-gradient(135deg, var(--harvard-primary) 0%, var(--harvard-secondary) 100%);
            color: white;
            padding: 8rem 0 3rem;
            margin-top: 0;
            margin-bottom: 3rem;
        }

        .section-page-title {
            font-size: 2.5rem;
            font-weight: 800;
            margin: 0 0 1rem 0;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        }

        .section-page-subtitle {
            font-size: 1.2rem;
            opacity: 0.95;
            margin: 0;
        }

        /* Content Area */
        .section-content-area {
            padding: 2rem 0 4rem;
        }

        /* Section Box */
        .section-box {
            background: linear-gradient(135deg, rgba(0, 168, 107, 0.08) 0%, rgba(14, 62, 73, 0.08) 100%);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            border: 2px solid rgba(0, 168, 107, 0.15);
            display: flex;
        }

        .section-box .row {
            width: 100%;
            display: flex;
            flex-wrap: nowrap;
        }

        .section-box .col-lg-7,
        .section-box .col-lg-5,
        .section-box .col-lg-12 {
            flex: 0 0 auto;
        }

        .section-box .col-lg-7 {
            width: 58.333333%;
        }

        .section-box .col-lg-5 {
            width: 41.666667%;
        }

        .section-box .col-lg-12 {
            width: 100%;
        }

        /* Text Content */
        .section-text-content {
            padding: 3rem 2.5rem;
            background: rgba(255, 255, 255, 0.95);
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            min-height: 450px;
        }

        .content-body {
            font-size: 1.05rem;
            line-height: 1.8;
            color: #1e293b;
            text-align: justify;
            margin-bottom: 2rem;
        }

        .content-body p {
            margin-bottom: 1rem;
        }

        /* Image Content */
        .section-image-content {
            background: linear-gradient(135deg, rgba(0, 168, 107, 0.1) 0%, rgba(14, 62, 73, 0.1) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 450px;
            overflow: hidden;
            width: 100%;
            height: 100%;
        }

        .section-image-content img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform 0.3s ease;
        }

        .section-image-content:hover img {
            transform: scale(1.05);
        }

        /* Action Buttons */
        .section-actions {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.875rem 1.5rem;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .btn-primary {
            background: var(--harvard-primary);
            color: white;
            box-shadow: 0 4px 12px rgba(0, 168, 107, 0.2);
        }

        .btn-primary:hover {
            background: var(--harvard-secondary);
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(0, 168, 107, 0.3);
        }

        .btn-secondary {
            background: white;
            color: var(--harvard-secondary);
            border: 2px solid var(--harvard-secondary);
        }

        .btn-secondary:hover {
            background: var(--harvard-secondary);
            color: white;
            border-color: var(--harvard-secondary);
        }

        /* Responsive */
        @media (max-width: 991px) {
            .section-box .row {
                flex-wrap: wrap;
            }

            .section-box .col-lg-7,
            .section-box .col-lg-5,
            .section-box .col-lg-12 {
                width: 100% !important;
            }

            .section-text-content {
                padding: 2rem;
                min-height: auto;
            }

            .section-image-content {
                min-height: 300px;
            }

            .section-page-title {
                font-size: 2rem;
            }
        }

        @media (max-width: 768px) {
            .section-page-header {
                padding: 2rem 0 1.5rem;
            }

            .section-page-title {
                font-size: 1.75rem;
            }

            .section-page-subtitle {
                font-size: 1rem;
            }

            .section-text-content {
                padding: 1.5rem;
            }

            .content-body {
                font-size: 0.975rem;
            }

            .section-image-content {
                min-height: 250px;
            }

            .section-actions {
                flex-direction: column;
            }

            .btn {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</body>
</html>
