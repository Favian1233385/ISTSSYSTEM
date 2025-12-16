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
            @php
                // Solo mostrar la sección principal 'Reglamentos Internos' (o la que corresponda)
                $main = collect($items)->first(function($i) {
                    return empty($i['parent_id']);
                });
            @endphp
            @if($main)
                <div class="p-4 border rounded shadow">
                    <h2 class="text-xl font-semibold">{{ $main['title'] }}</h2>
                    <p>{{ $main['description'] }}</p>
                    @if(isset($main['children']) && count($main['children']) > 0)
                        <ul class="ml-4 mt-2">
                            @foreach($main['children'] as $child)
                                <li class="mb-2">
                                    <a href="{{ url('/transparency/'.$child['slug']) }}" class="text-blue-500 underline">{{ $child['title'] }}</a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                    @if(!empty($main['link']))
                        <a href="{{ $main['link'] }}" class="text-blue-500 underline">Ver más</a>
                    @endif
                </div>
            @endif
        </div>
    </main>

    @include('public.partials.footer')
</body>
</html>