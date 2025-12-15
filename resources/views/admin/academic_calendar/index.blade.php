@extends('layouts.admin')
@section('title', 'Calendario Académico')
@section('content')
<div class="container py-4">
    <h1 class="mb-4">Gestión de Calendario Académico</h1>
    <a href="{{ route('admin.academic-calendar.create') }}" class="btn btn-primary mb-3">Crear calendario</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Título</th>
                <th>Desde</th>
                <th>Hasta</th>
                <th>Color</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($events as $event)
            <tr>
                <td>{{ $event->title }}</td>
                <td>{{ $event->start_date->format('d/m/Y') }}</td>
                <td>{{ $event->end_date->format('d/m/Y') }}</td>
                <td><span style="background:{{ $event->color }};padding:0.3em 1em;border-radius:4px;">{{ $event->color }}</span></td>
                <td>
                    <a href="{{ route('admin.academic-calendar.edit', $event) }}" class="btn btn-sm btn-warning">Editar</a>
                    <form action="{{ route('admin.academic-calendar.destroy', $event) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar este calendario?')">Eliminar</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="5">No hay calendarios registrados.</td></tr>
            @endforelse
        </tbody>
    </table>
    {{ $events->links() }}
</div>
@endsection
