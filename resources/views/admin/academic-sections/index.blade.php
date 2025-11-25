@extends('layouts.admin')

@section('title', 'Secciones Académicas')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">📚 Secciones Académicas</h1>
        <a href="{{ route('admin.academic-sections.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Nueva Sección
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            @if($sections->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Orden</th>
                                <th>Título</th>
                                <th>Slug</th>
                                <th>Imagen</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sections as $section)
                                <tr>
                                    <td>{{ $section->sort_order }}</td>
                                    <td>
                                        <strong>{{ $section->title }}</strong>
                                        @if($section->description)
                                            <br><small class="text-muted">{{ Str::limit($section->description, 50) }}</small>
                                        @endif
                                    </td>
                                    <td><code>{{ $section->slug }}</code></td>
                                    <td>
                                        @if($section->image_path)
                                            <img src="{{ asset('storage/' . $section->image_path) }}" 
                                                 alt="{{ $section->title }}" 
                                                 style="width: 60px; height: 60px; object-fit: cover;"
                                                 class="rounded">
                                        @else
                                            <span class="text-muted">Sin imagen</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($section->is_active)
                                            <span class="badge bg-success">Activo</span>
                                        @else
                                            <span class="badge bg-secondary">Inactivo</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.academic-sections.edit', $section) }}" 
                                               class="btn btn-sm btn-outline-primary">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('admin.academic-sections.destroy', $section) }}" 
                                                  method="POST" 
                                                  onsubmit="return confirm('¿Está seguro de eliminar esta sección?');"
                                                  class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-5">
                    <i class="bi bi-inbox" style="font-size: 3rem; color: #ccc;"></i>
                    <p class="text-muted mt-3">No hay secciones académicas creadas.</p>
                    <a href="{{ route('admin.academic-sections.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-lg"></i> Crear Primera Sección
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
