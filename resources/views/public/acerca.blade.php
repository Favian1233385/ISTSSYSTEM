@extends('layouts.public')
@section('title', 'Sobre Nosotros')
@section('content')
<div class="container py-5">
    <div style="margin-top:2cm"></div>
    <h1 class="mb-4">Sobre Nosotros</h1>
    <p class="mb-4">Conoce la misión, visión, autoridades y planta docente del Instituto Superior Tecnológico Sucúa.</p>
    <div class="mb-5">
        <h2>Misión y Visión</h2>
        <ul>
            <li><strong>Misión:</strong> {{ App\Models\Setting::get('mision') ?? 'No definida.' }}</li>
            <li><strong>Visión:</strong> {{ App\Models\Setting::get('vision') ?? 'No definida.' }}</li>
        </ul>
    </div>
    <div class="mb-5">
        <h2>Autoridades</h2>
        <ul>
            @foreach(App\Models\Autoridad::all() as $autoridad)
                <li>{{ $autoridad->name }} - {{ $autoridad->role }}</li>
            @endforeach
        </ul>
    </div>
    <div class="mb-5">
        <h2>Planta Docente</h2>
        <ul>
            @foreach(App\Models\Teacher::all() as $teacher)
                <li>{{ $teacher->name }}</li>
            @endforeach
        </ul>
    </div>
</div>
@endsection
