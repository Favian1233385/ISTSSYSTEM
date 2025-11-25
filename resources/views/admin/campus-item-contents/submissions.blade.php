@extends('layouts.admin')

@section('content')
<div class="admin-content">
    <h2>Envíos de formulario para: {{ $content->title }}</h2>
    @if($submissions->count() === 0)
        <p>No hay envíos registrados.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Nombres</th>
                    <th>Cédula</th>
                    <th>Carrera</th>
                    <th>Ciclo</th>
                    <th>Nivel</th>
                    <th>Institución</th>
                    <th>PDF</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                @foreach($submissions as $submission)
                <tr>
                    <td>{{ $submission->nombres }}</td>
                    <td>{{ $submission->cedula }}</td>
                    <td>{{ $submission->carrera }}</td>
                    <td>{{ $submission->ciclo }}</td>
                    <td>{{ $submission->nivel }}</td>
                    <td>{{ $submission->institucion }}</td>
                    <td>
                        @if($submission->pdf_path)
                            <a href="{{ asset($submission->pdf_path) }}" target="_blank" class="btn btn-sm btn-outline-secondary">Descargar PDF</a>
                        @else
                            -
                        @endif
                    </td>
                    <td>{{ $submission->created_at->format('d/m/Y H:i') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
