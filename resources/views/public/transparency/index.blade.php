<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    @include('public.partials.header')

    <main class="container py-12">
        <h1 class="text-center text-3xl font-bold mb-8">{{ $title }}</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach(collect($items)->filter(function($i){ return empty($i['parent_id']); }) as $main)
                <div class="reglamento-box">
                    @if(!empty($main['image']))
                        <div class="reglamento-img">
                            <img src="{{ asset('storage/'.$main['image']) }}" alt="Imagen sección">
                        </div>
                    @endif
                    <div class="reglamento-content">
                        <h2 class="text-xl font-semibold mb-2">{{ $main['title'] }}</h2>
                        <p class="mb-3" style="font-size:1.08rem; color:#333;">{{ $main['description'] }}</p>
                        @if(isset($main['children']) && count($main['children']) > 0)
                            <h3 style="font-size:1.1rem; font-weight:700; margin-top:2.2rem; color:#1976d2;">Subreglamentos</h3>
                            <ul class="ml-2 mt-2">
                                @foreach($main['children'] as $child)
                                    <li class="mb-2" style="font-size:1.05rem; font-weight:600; color:#006400;">
                                        <span style="font-weight:700;">{{ $child['title'] }}</span>
                                        @if(!empty($child['pdf_url']))
                                            <a href="{{ asset('storage/'.$child['pdf_url']) }}" target="_blank" class="btn btn-primary btn-sm mx-2">Ver PDF</a>
                                            <a href="{{ asset('storage/'.$child['pdf_url']) }}" download class="btn btn-link btn-sm">Descargar PDF</a>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                        @if(!empty($main['link']))
                            <a href="{{ $main['link'] }}" class="text-blue-500 underline">Ver más</a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </main>

    @include('public.partials.footer')
</body>
</html>