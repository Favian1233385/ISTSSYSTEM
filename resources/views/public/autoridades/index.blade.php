<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autoridades - ISTS</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- Si usas algún framework CSS como Bootstrap, asegúrate de incluirlo aquí -->
</head>
<body>
    <!-- Header público -->
    @include('public.partials.header')

    <main class="main-content py-5">
        <div class="container">
            <h1 class="autoridades-title">Nuestras Autoridades</h1>
            <div class="autoridades-grid">
                @forelse($autoridades as $autoridad)
                    <div class="autoridad-card">
                        <div class="autoridad-img-wrap">
                            @if($autoridad->foto_path)
                                <img src="{{ asset('uploads/images/' . $autoridad->foto_path) }}" alt="Foto de {{ $autoridad->nombre }}" class="autoridad-img">
                            @else
                                <div class="autoridad-img autoridad-img-placeholder">Sin foto</div>
                            @endif
                        </div>
                        <div class="autoridad-info">
                            <h3 class="autoridad-nombre">{{ $autoridad->nombre }}</h3>
                            <div class="autoridad-cargo">{{ $autoridad->cargo }}</div>
                            <div class="autoridad-categoria">{{ $autoridad->categoria }}</div>
                            @if($autoridad->biografia)
                                <div class="autoridad-bio">{!! $autoridad->biografia !!}</div>
                            @endif
                            @if($autoridad->pdf_path)
                                <a href="{{ asset('storage/' . $autoridad->pdf_path) }}" target="_blank" class="autoridad-cv-btn">Descargar Currículum (PDF)</a>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="alert alert-info text-center" role="alert">
                        No hay autoridades registradas en este momento.
                    </div>
                @endforelse
            </div>
        </div>
    </main>

    <!-- Footer público -->
    @include('public.partials.footer')

    <style>
        /* Estilos básicos para la página de autoridades */
        .main-content {
            padding-top: 100px; /* Ajusta según la altura de tu header fijo */
        }
        .text-center { text-align: center; }
        .mb-5 { margin-bottom: 3rem; }
        .mb-4 { margin-bottom: 1.5rem; }
        .shadow-sm { box-shadow: 0 .125rem .25rem rgba(0,0,0,.075)!important; }
        .card { border: 1px solid rgba(0,0,0,.125); border-radius: .25rem; }
        .row.g-0 { display: flex; flex-wrap: wrap; margin-right: 0; margin-left: 0; }
        .col-md-4, .col-md-8, .col-md-12 { flex: 0 0 auto; width: 100%; }
        @media (min-width: 768px) {
            .col-md-4 { width: 33.333333%; }
            .col-md-8 { width: 66.666667%; }
        }
        .d-flex { display: flex!important; }
        .align-items-center { align-items: center!important; }
        .justify-content-center { justify-content: center!important; }
        .img-fluid { max-width: 100%; height: auto; }
        .rounded-start { border-top-left-radius: .25rem; border-bottom-left-radius: .25rem; }
        .p-3 { padding: 1rem!important; }
        .card-body { flex: 1 1 auto; padding: 1.25rem; }
        .card-title { font-size: 1.75rem; margin-bottom: .75rem; }
        .card-subtitle { font-size: 1rem; color: #6c757d; }
        .card-text { margin-top: 1rem; }
        <style>
            .main-content {
                padding-top: 100px;
            }
            .autoridades-title {
                text-align: center;
                font-size: 2.5rem;
                font-weight: 800;
                margin-bottom: 2.5rem;
                color: var(--color-primary, #0056b3);
                letter-spacing: 1px;
            }
            .autoridades-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
                gap: 2rem;
            }
            .autoridad-card {
                background: #fff;
                border-radius: 1.2rem;
                box-shadow: 0 4px 24px rgba(0,0,0,0.08), 0 1.5px 4px rgba(0,0,0,0.04);
                display: flex;
                flex-direction: column;
                align-items: center;
                padding: 2rem 1.5rem 1.5rem 1.5rem;
                transition: box-shadow 0.2s, transform 0.2s;
                min-height: 420px;
            }
            .autoridad-card:hover {
                box-shadow: 0 8px 32px rgba(0,0,0,0.14), 0 2px 8px rgba(0,0,0,0.08);
                transform: translateY(-4px) scale(1.02);
            }
            .autoridad-img-wrap {
                width: 140px;
                height: 140px;
                margin-bottom: 1.2rem;
                display: flex;
                align-items: center;
                justify-content: center;
                background: linear-gradient(135deg, #e3f0ff 0%, #f7faff 100%);
                border-radius: 50%;
                overflow: hidden;
                box-shadow: 0 2px 8px rgba(0,0,0,0.07);
            }
            .autoridad-img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                border-radius: 50%;
            }
            .autoridad-img-placeholder {
                color: #aaa;
                font-size: 1.1rem;
                display: flex;
                align-items: center;
                justify-content: center;
                width: 100%;
                height: 100%;
                background: #f0f0f0;
                border-radius: 50%;
            }
            .autoridad-info {
                text-align: center;
            }
            .autoridad-nombre {
                font-size: 1.35rem;
                font-weight: 700;
                margin-bottom: 0.3rem;
                color: var(--color-dark, #222);
            }
            .autoridad-cargo {
                font-size: 1.1rem;
                font-weight: 500;
                color: #007bff;
                margin-bottom: 0.2rem;
            }
            .autoridad-categoria {
                font-size: 1rem;
                color: #888;
                margin-bottom: 0.7rem;
            }
            .autoridad-bio {
                font-size: 1rem;
                color: #444;
                margin-bottom: 0.7rem;
                text-align: justify;
            }
            .autoridad-cv-btn {
                display: inline-block;
                background: var(--color-primary, #007bff);
                color: #fff;
                border: none;
                padding: 0.5rem 1.2rem;
                border-radius: 4px;
                text-decoration: none;
                font-weight: 600;
                margin-top: 0.5rem;
                transition: background 0.2s;
            }
            .autoridad-cv-btn:hover {
                background: #0056b3;
            }
            @media (max-width: 600px) {
                .main-content {
                    padding-top: 70px;
                }
                .autoridades-title {
                    font-size: 1.5rem;
                }
                .autoridades-grid {
                    gap: 1rem;
                }
                .autoridad-card {
                    padding: 1.2rem 0.5rem 1rem 0.5rem;
                    min-height: 340px;
                }
                .autoridad-img-wrap {
                    width: 90px;
                    height: 90px;
                }
                .autoridad-nombre {
                    font-size: 1.1rem;
                }
            }
        </style>
            border-color: #007bff;
        }
        .btn-primary:hover {
            color: #fff;
            background-color: #0069d9;
            border-color: #0062cc;
        }
        .mt-3 { margin-top: 1rem!important; }
        .alert {
            position: relative;
            padding: .75rem 1.25rem;
            margin-bottom: 1rem;
            border: 1px solid transparent;
            border-radius: .25rem;
        }
        .alert-info {
            color: #0c5460;
            background-color: #d1ecf1;
            border-color: #bee5eb;
        }
    </style>
</body>
</html>
