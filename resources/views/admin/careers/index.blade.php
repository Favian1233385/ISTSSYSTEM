@extends('layouts.admin')

@section('title', 'Gestión de Carreras')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Gestión de Carreras / Coordinaciones</h1>
        <a href="{{ route('admin.careers.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Nueva Carrera
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
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th style="width: 80px;">Imagen</th>
                            <th>Nombre</th>
                            <th>Coordinador</th>
                            <th style="width: 100px;">Orden</th>
                            <th style="width: 100px;">Estado</th>
                            <th style="width: 150px;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($careers as $career)
                            <tr>
                                <td>
                                    @if($career->image_path)
                                        <img src="{{ asset('storage/' . $career->image_path) }}" 
                                             alt="{{ $career->name }}" 
                                             class="img-thumbnail"
                                             style="width: 60px; height: 60px; object-fit: cover;">
                                    @else
                                        <div class="bg-secondary text-white d-flex align-items-center justify-content-center" 
                                             style="width: 60px; height: 60px; border-radius: 4px;">
                                            <i class="bi bi-book" style="font-size: 24px;"></i>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <strong>{{ $career->name }}</strong>
                                    @if($career->description)
                                        <br><small class="text-muted">{{ Str::limit($career->description, 60) }}</small>
                                    @endif
                                    @if(!$career->image_path || !$career->image_path_2)
                                        <br><small class="badge" style="background: #ff6b6b; color: white; font-size: 10px;">
                                            ⚠️ Falta{{ !$career->image_path && !$career->image_path_2 ? 'n' : '' }} imagen{{ !$career->image_path && !$career->image_path_2 ? 'es' : '' }}
                                        </small>
                                    @endif
                                </td>
                                <td>
                                    {{ $career->coordinator ?? '-' }}
                                    @if($career->coordinator_email)
                                        <br><small class="text-muted">{{ $career->coordinator_email }}</small>
                                    @endif
                                </td>
                                <td>{{ $career->sort_order }}</td>
                                <td>
                                    @if($career->is_active)
                                        <span class="badge bg-success">Activa</span>
                                    @else
                                        <span class="badge bg-secondary">Inactiva</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.careers.edit', $career) }}" 
                                       class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.careers.destroy', $career) }}" 
                                          method="POST" 
                                          class="d-inline"
                                          onsubmit="return confirm('¿Estás seguro de eliminar esta carrera?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">
                                    <p class="text-muted mb-0">No hay carreras registradas.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
