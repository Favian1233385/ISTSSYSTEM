<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Error - ISTS Sucúa' }}</title>
    <link rel="stylesheet" href="{{ asset('public/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/harvard-style.css') }}">
    <style>
        .error-container {
            min-height: 60vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 2rem;
        }

        .error-content {
            max-width: 600px;
            background: white;
            padding: 3rem;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }

        .error-icon {
            font-size: 4rem;
            color: #d32f2f;
            margin-bottom: 1rem;
        }

        .error-title {
            font-size: 2rem;
            color: #333;
            margin-bottom: 1rem;
            font-weight: 600;
        }

        .error-message {
            font-size: 1.1rem;
            color: #666;
            margin-bottom: 2rem;
            line-height: 1.6;
        }

        .error-actions {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn {
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .btn-primary {
            background: #0066cc;
            color: white;
        }

        .btn-primary:hover {
            background: #0052a3;
            transform: translateY(-2px);
        }

        .btn-secondary {
            background: #f8f9fa;
            color: #333;
            border: 1px solid #dee2e6;
        }

        .btn-secondary:hover {
            background: #e9ecef;
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
    @include('public.header')

    <main class="error-container">
        <div class="error-content">
            <div class="error-icon">⚠️</div>
            <h1 class="error-title">Oops! Algo salió mal</h1>
            <p class="error-message">
                {{ $error ?? 'Ha ocurrido un error inesperado. Nuestro equipo técnico ha sido notificado y está trabajando para solucionarlo.' }}
            </p>
            <div class="error-actions">
                <a href="/" class="btn btn-primary">Volver al inicio</a>
                <a href="/contacto" class="btn btn-secondary">Reportar problema</a>
            </div>
        </div>
    </main>

    @include('public.footer')
</body>
</html>
