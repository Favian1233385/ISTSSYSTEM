@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <h2>Línea de Tiempo - Administración</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.timeline.create') }}" class="btn btn-primary mb-3">Nuevo Evento</a>

    <table class="table">
        <thead>
            <tr>
                <th>Año</th>
                <th>Título</th>
                <th>Visible</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($events as $e)
            <tr>
                <td>{{ $e->year }}</td>
                <td>{{ $e->title }}</td>
                <td>{{ $e->is_public ? 'Sí' : 'No' }}</td>
                <td>
                    <a href="{{ route('admin.timeline.edit', $e) }}" class="btn btn-sm btn-secondary">Editar</a>
                    <form action="{{ route('admin.timeline.destroy', $e) }}" method="post" style="display:inline" onsubmit="return confirm('Eliminar evento?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
