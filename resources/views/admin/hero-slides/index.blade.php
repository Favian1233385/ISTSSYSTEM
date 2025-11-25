@extends('layouts.admin')

@section('title', 'Gestionar Slides del Hero')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Slides del Hero</h1>
        <a href="{{ route('admin.hero-slides.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Nuevo Slide
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
            @if($slides->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th style="width: 100px;">Imagen</th>
                                <th>Título</th>
                                <th>Subtítulo</th>
                                <th style="width: 100px;">Orden</th>
                                <th style="width: 100px;">Estado</th>
                                <th style="width: 150px;">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($slides as $slide)
                                <tr>
                                    <td>
                                        @if($slide->image_path)
                                            <img src="{{ asset('storage/' . $slide->image_path) }}" 
                                                 alt="{{ $slide->title }}" 
                                                 class="img-thumbnail" 
                                                 style="max-width: 80px; height: auto;">
                                        @else
                                            <span class="text-muted">Sin imagen</span>
                                        @endif
                                    </td>
                                    <td>{{ $slide->title ?? 'Sin título' }}</td>
                                    <td>{{ Str::limit($slide->subtitle, 50) }}</td>
                                    <td>
                                        <span class="badge bg-secondary">{{ $slide->sort_order }}</span>
                                    </td>
                                    <td>
                                        @if($slide->is_active)
                                            <span class="badge bg-success">Activo</span>
                                        @else
                                            <span class="badge bg-secondary">Inactivo</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group">
                                            <a href="{{ route('admin.hero-slides.edit', $slide) }}" 
                                               class="btn btn-outline-primary" 
                                               title="Editar">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('admin.hero-slides.destroy', $slide) }}" 
                                                  method="POST" 
                                                  class="d-inline"
                                                  onsubmit="return confirm('¿Estás seguro de eliminar este slide?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger" title="Eliminar">
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
                    <i class="bi bi-images" style="font-size: 3rem; color: #ccc;"></i>
                    <p class="text-muted mt-3">No hay slides registrados.</p>
                    <a href="{{ route('admin.hero-slides.create') }}" class="btn btn-primary">
                        Crear primer slide
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
