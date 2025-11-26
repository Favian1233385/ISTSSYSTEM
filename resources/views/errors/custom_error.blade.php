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
    </style>
</head>
<body>
    <div class="error-container">
        <div class="error-content">
            <div class="error-icon">&#9888;</div>
            <h1>{{ $title ?? 'Ha ocurrido un error' }}</h1>
            <p>{{ $message ?? 'Lo sentimos, algo salió mal. Por favor, inténtalo de nuevo más tarde.' }}</p>
            <a href="{{ url('/') }}" class="btn btn-primary">Volver al inicio</a>
        </div>
    </div>
</body>
</html>