<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trámites - ISTS Sucúa</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/harvard-style.css') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/images/logoists.png') }}" sizes="32x32">
</head>
<body>
    <header class="header">
        <nav class="main-navigation">
            <div class="container">
                <ul class="nav-menu">
                    <li class="nav-item"><a href="{{ route('home') }}" class="nav-link">Inicio</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <main id="main-content" class="main-content">
        <section class="focus-section">
            <div class="container">
                <div class="focus-header">
                    <h1>Trámites Disponibles</h1>
                    <p>Encuentra información y guías sobre los trámites institucionales.</p>
                </div>

                <div class="focus-grid">
                    @if (isset($tramites) && !empty($tramites))
                        @foreach ($tramites as $tramite)
                            <div class="focus-card">
                                @if (!empty($tramite['image_url']))
                                    <div class="focus-image">
                                        <img src="{{ asset(htmlspecialchars($tramite['image_url'])) }}" alt="{{ htmlspecialchars($tramite['title']) }}">
                                    </div>
                                @endif
                                <div class="focus-content">
                                    @php
                                        $url = $tramite['url'] ?? null;
                                        $file = $tramite['file_url'] ?? null;
                                        $isExternalUrl = $url && filter_var($url, FILTER_VALIDATE_URL);
                                        $isFile = $file && !$isExternalUrl;
                                    @endphp
                                    @if ($isExternalUrl)
                                        <h3>
                                            <a href="{{ $url }}" target="_blank" class="text-primary underline">{{ htmlspecialchars($tramite['title']) }}</a>
                                        </h3>
                                    @elseif ($isFile)
                                        <h3>
                                            <a href="{{ asset($file) }}" target="_blank" class="text-primary underline">{{ htmlspecialchars($tramite['title']) }}</a>
                                        </h3>
                                    @else
                                        <h3>{{ htmlspecialchars($tramite['title']) }}</h3>
                                    @endif
                                    <p>{{ htmlspecialchars($tramite['description'] ?? '') }}</p>
                                    <div class="focus-actions">
                                        @if ($isExternalUrl)
                                            <a href="{{ $url }}" target="_blank" class="btn btn-outline">Ir al trámite</a>
                                        @elseif ($isFile)
                                            <a href="{{ asset($file) }}" target="_blank" class="btn btn-outline">Ir al trámite</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p>No hay trámites disponibles en este momento.</p>
                    @endif
                </div>
            </div>
        </section>
    </main>
</body>
</html>
