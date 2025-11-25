@extends('layouts.admin')

@section('title', 'Secciones de Visitar')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="h3 mb-0">🏢 Secciones de Visitar</h1>
                <a href="{{ route('admin.visit-sections.create') }}" class="btn btn-primary">
                    ➕ Nueva Sección
                </a>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Listado de Secciones</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Orden</th>
                            <th>Título</th>
                            <th>Slug</th>
                            <th>Email</th>
                            <th>Teléfono</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($sections as $section)
                        <tr>
                            <td>{{ $section->sort_order }}</td>
                            <td>
                                <strong>{{ $section->title }}</strong>
                            </td>
                            <td>
                                <code>{{ $section->slug }}</code>
                            </td>
                            <td>
                                <small>{{ $section->email ?? 'N/A' }}</small>
                            </td>
                            <td>
                                <small>{{ $section->phone ?? 'N/A' }}</small>
                            </td>
                            <td>
                                @if($section->is_active)
                                    <span class="badge bg-success">✓ Activo</span>
                                @else
                                    <span class="badge bg-secondary">✗ Inactivo</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('visitar.section', $section->slug) }}" 
                                       class="btn btn-info" 
                                       title="Ver en sitio público"
                                       target="_blank">
                                        👁️
                                    </a>
                                    <a href="{{ route('admin.visit-sections.edit', $section->id) }}" 
                                       class="btn btn-warning" 
                                       title="Editar">
                                        ✏️
                                    </a>
                                    <form action="{{ route('admin.visit-sections.destroy', $section->id) }}" 
                                          method="POST" 
                                          class="d-inline"
                                          onsubmit="return confirm('¿Está seguro de eliminar esta sección?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" title="Eliminar">
                                            🗑️
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                <p class="text-muted mb-0">No hay secciones registradas</p>
                                <a href="{{ route('admin.visit-sections.create') }}" class="btn btn-sm btn-primary mt-2">
                                    Crear la primera sección
                                </a>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $sections->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
