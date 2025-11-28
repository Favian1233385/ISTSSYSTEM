<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $autoridad->nombre }} - Autoridad ISTS</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- Puedes añadir estilos específicos si es necesario -->
</head>
<body>
    <!-- Header público -->
    @include('public.partials.header')

    <main class="main-content py-5">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('autoridades') }}">Autoridades</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $autoridad->nombre }}</li>
                </ol>
            </nav>

            <div class="row">
                <div class="col-md-4 text-center">
                    @if($autoridad->foto_path)
                        <img src="{{ asset('storage/' . $autoridad->foto_path) }}" class="img-fluid rounded-circle mb-3" alt="Foto de {{ $autoridad->nombre }}" style="max-width: 250px; height: auto; object-fit: cover;">
                    @else
                        <img src="{{ asset('images/default_avatar.png') }}" class="img-fluid rounded-circle mb-3" alt="Foto por defecto" style="max-width: 250px; height: auto; object-fit: cover;">
                    @endif
                    <h2 class="mt-3">{{ $autoridad->nombre }}</h2>
                    <h4 class="text-muted">{{ $autoridad->cargo }}</h4>
                    <p class="text-muted">Categoría: {{ $autoridad->categoria }}</p>
                    @if($autoridad->pdf_path)
                        <a href="{{ asset('storage/' . $autoridad->pdf_path) }}" target="_blank" class="btn btn-primary mt-3">
                            <i class="fas fa-download"></i> Descargar Currículum (PDF)
                        </a>
                    @endif
                </div>
                <div class="col-md-8">
                    <div class="card shadow-sm p-4">
                        <h3 class="mb-4">Biografía</h3>
                        @if($autoridad->biografia)
                            <div class="biography-content">
                                {!! $autoridad->biografia !!}
                            </div>
                        @else
                            <p>No hay biografía disponible para {{ $autoridad->nombre }}.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer público -->
    @include('public.partials.footer')

    <style>
        /* Estilos básicos para la página de detalle de autoridad */
        .main-content {
            padding-top: 100px; /* Ajusta según la altura de tu header fijo */
        }
        .rounded-circle {
            border-radius: 50% !important;
            border: 5px solid #eee; /* Borde suave */
            box-shadow: 0 0.5rem 1rem rgba(0,0,0,.15); /* Sombra para destacar */
        }
        .breadcrumb {
            background-color: transparent;
            padding: 0.75rem 0;
            margin-bottom: 2rem;
        }
        .breadcrumb-item a {
            color: #007bff;
            text-decoration: none;
        }
        .breadcrumb-item.active {
            color: #6c757d;
        }
        .card {
            border: 1px solid rgba(0,0,0,.125);
            border-radius: .5rem;
        }
        .card.shadow-sm {
            box-shadow: 0 .125rem .25rem rgba(0,0,0,.075)!important;
        }
        .biography-content {
            line-height: 1.7;
            font-size: 1.05rem;
        }
        .biography-content img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin-top: 1rem;
            margin-bottom: 1rem;
            display: block;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            color: #fff;
        }
        .btn-primary:hover {
            background-color: #0069d9;
            border-color: #0062cc;
        }
    </style>
</body>
</html>
