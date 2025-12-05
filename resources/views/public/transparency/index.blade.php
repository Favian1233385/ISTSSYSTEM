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
            @foreach($items as $item)
                <div class="p-4 border rounded shadow">
                    <h2 class="text-xl font-semibold">{{ $item->title }}</h2>
                    <p>{{ $item->description }}</p>
                    @if($item->link)
                        <a href="{{ $item->link }}" class="text-blue-500 underline">Ver más</a>
                    @endif
                </div>
            @endforeach
        </div>
    </main>

    @include('public.partials.footer')
</body>
</html>