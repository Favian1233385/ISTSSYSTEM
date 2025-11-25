@extends('layouts.public')

@section('content')
<div class="container py-5">
    <h1 class="mb-4 linea-title">Línea de Tiempo Institucional</h1>

    @php
        $currentYear = \Carbon\Carbon::now()->year;
        $viewYear = (int) request()->get('year', $currentYear);

        // Si no vienen eventos desde el controlador, usar fallback estático
        if (!isset($events)) {
            $events = [
                ['year' => 2000, 'text' => 'Fundación del ISTS.'],
                ['year' => 2005, 'text' => 'Apertura de nuevas carreras tecnológicas.'],
                ['year' => 2015, 'text' => 'Reconocimiento nacional por excelencia académica.'],
                ['year' => 2022, 'text' => 'Inicio de programas de educación continua.'],
                ['year' => 2025, 'text' => 'Actualización de planes de estudio y alianzas estratégicas.'],
                ['year' => 2030, 'text' => 'Inauguración del nuevo campus y modernización curricular orientada a inteligencia artificial y sostenibilidad.'],
            ];
        }

        // calcular rango de años para el selector (desde el primer evento hasta +5 años)
        $firstYear = min(array_column($events, 'year'));
        $lastEventYear = max(array_column($events, 'year'));
        $years = range($firstYear, max($lastEventYear, $currentYear + 5));
    @endphp

    <form method="get" class="mb-4" id="timeline-filter-form">
        <label for="year">Ver historia hasta el año:</label>
        <select name="year" id="year" onchange="document.getElementById('timeline-filter-form').submit()">
            @foreach($years as $y)
                <option value="{{ $y }}" {{ $y == $viewYear ? 'selected' : '' }}>{{ $y }}</option>
            @endforeach
        </select>
        <small class="ms-2">(actual: {{ $currentYear }})</small>
    </form>

    <div class="timeline">
        @foreach($events as $event)
            @if($event['year'] <= $viewYear)
                <div class="timeline-event">
                    <div class="timeline-date">{{ $event['year'] }}</div>
                    <div class="timeline-content">{{ $event['text'] }}</div>
                </div>
            @endif
        @endforeach
    </div>
</div>
<style>
.timeline { border-left: 3px solid #0d6efd; margin-left: 2rem; padding-left: 2rem; }
.timeline-event { margin-bottom: 2rem; }
.timeline-date { font-weight: bold; color: #0d6efd; margin-bottom: 0.5rem; }
.timeline-content { background: #f8f9fa; padding: 1rem; border-radius: 8px; }
</style>
<style>
/* Estilos locales para título de Línea de Tiempo */
.linea-title {
    text-align: center;
    color: var(--color-primary);
    font-weight: 700;
    margin-bottom: 1.25rem;
}
</style>
@endsection
