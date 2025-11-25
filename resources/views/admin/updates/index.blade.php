@extends('layouts.admin')

@section('content')
<div class="content-header">
    <div class="header-left">
        <h1>📢 Actualizaciones y Novedades</h1>
        <p>Gestiona las últimas noticias y actualizaciones que se mostrarán en la página principal</p>
    </div>
    <div class="header-actions">
        <a href="{{ route('admin.updates.create') }}" class="btn btn-primary">
            + Nueva Actualización
        </a>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
            <polyline points="22 4 12 14.01 9 11.01"></polyline>
        </svg>
        {{ session('success') }}
    </div>
@endif

<div class="card">
    <div class="card-body">
        @if($updates->isEmpty())
            <div class="empty-state">
                <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                </svg>
                <h3>No hay actualizaciones</h3>
                <p>Comienza creando la primera actualización para mostrar en la página principal</p>
                <a href="{{ route('admin.updates.create') }}" class="btn btn-primary">Crear Primera Actualización</a>
            </div>
        @else
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th style="width: 100px;">Imagen</th>
                            <th>Título</th>
                            <th style="width: 120px;">Fecha</th>
                            <th style="width: 80px;">Orden</th>
                            <th style="width: 100px;">Estado</th>
                            <th style="width: 150px;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($updates as $update)
                            <tr>
                                <td>
                                    @if($update->image_path)
                                        <img src="{{ asset('storage/' . $update->image_path) }}" 
                                             alt="{{ $update->title }}" 
                                             class="img-thumbnail"
                                             style="width: 80px; height: 60px; object-fit: cover;">
                                    @elseif($update->video_path)
                                        <div class="bg-success text-white d-flex align-items-center justify-content-center" 
                                             style="width: 80px; height: 60px; border-radius: 4px;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="currentColor">
                                                <polygon points="5 3 19 12 5 21 5 3"></polygon>
                                            </svg>
                                            <small style="position: absolute; bottom: 2px; font-size: 9px;">Local</small>
                                        </div>
                                    @elseif($update->video_url)
                                        <div class="bg-primary text-white d-flex align-items-center justify-content-center" 
                                             style="width: 80px; height: 60px; border-radius: 4px;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="currentColor">
                                                <polygon points="5 3 19 12 5 21 5 3"></polygon>
                                            </svg>
                                            <small style="position: absolute; bottom: 2px; font-size: 9px;">URL</small>
                                        </div>
                                    @else
                                        <div class="bg-secondary text-white d-flex align-items-center justify-content-center" 
                                             style="width: 80px; height: 60px; border-radius: 4px;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                                            </svg>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <strong>{{ $update->title }}</strong>
                                    <br><small class="text-muted">{{ Str::limit($update->description, 80) }}</small>
                                </td>
                                <td>
                                    <small>{{ $update->date->format('d/m/Y') }}</small>
                                </td>
                                <td>
                                    <span class="badge badge-secondary">{{ $update->sort_order }}</span>
                                </td>
                                <td>
                                    @if($update->is_active)
                                        <span class="badge badge-success">Activa</span>
                                    @else
                                        <span class="badge badge-secondary">Inactiva</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.updates.edit', $update->id) }}" class="btn btn-sm btn-primary" title="Editar">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                            </svg>
                                        </a>
                                        <form action="{{ route('admin.updates.destroy', $update->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('¿Estás seguro de eliminar esta actualización?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" title="Eliminar">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <polyline points="3 6 5 6 21 6"></polyline>
                                                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="pagination-wrapper">
                {{ $updates->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
