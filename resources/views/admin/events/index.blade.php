@extends('admin.layout')

@section('content')
<div class="admin-container">
    <div class="admin-header">
        <h1>📅 Eventos institucionales</h1>
        <a href="{{ route('admin.events.create') }}" class="btn btn-primary">Crear evento</a>
    </div>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Fecha</th>
                    <th>Lugar</th>
                    <th>Estado</th>
                    <th>Imagen</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($events as $event)
                    <tr>
                        <td>{{ $event->title }}</td>
                        <td>{{ $event->date->format('d/m/Y') }}</td>
                        <td>{{ $event->place }}</td>
                        <td>
                            @if($event->status === 'published')
                                <span class="badge bg-success">Publicado</span>
                            @else
                                <span class="badge bg-secondary">Borrador</span>
                            @endif
                        </td>
                        <td>
                            @if($event->image_path)
                                <img src="{{ asset('storage/' . $event->image_path) }}" alt="Imagen" style="max-width:60px;max-height:40px;">
                            @else
                                <span class="text-muted">Sin imagen</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.events.edit', $event) }}" class="btn btn-sm btn-warning">Editar</a>
                            <form action="{{ route('admin.events.destroy', $event) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar este evento?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6">No hay eventos registrados.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="pagination">
        {{ $events->links() }}
    </div>
</div>
@endsection
