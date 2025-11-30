@extends('layouts.admin')

@section('title', 'Modalidades Académicas')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">📚 Modalidades Académicas</h1>
        <a href="{{ route('admin.academic_modalities.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Nueva Modalidad
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
            @if($modalities->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Orden</th>
                                <th>Título</th>
                                <th>Descripción</th>
                                <th>Icono</th>
                                <th>Estado</th>
                                <th>Programas</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($modalities as $modality)
                                <tr>
                                    <td>{{ $modality->order }}</td>
                                    <td><strong>{{ $modality->title }}</strong></td>
                                    <td>{{ Str::limit($modality->description, 50) }}</td>
                                    <td>@if($modality->icon)<i class="{{ $modality->icon }}"></i>@else <span class="text-muted">-</span> @endif</td>
                                    <td>
                                        @if($modality->is_active)
                                            <span class="badge bg-success">Activo</span>
                                        @else
                                            <span class="badge bg-secondary">Inactivo</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.academic_modalities.programs.index', $modality->id) }}" class="btn btn-sm btn-outline-info">Ver Programas</a>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.academic_modalities.edit', $modality) }}" class="btn btn-sm btn-outline-primary" title="Editar"><i class="bi bi-pencil"></i></a>
                                            <form action="{{ route('admin.academic_modalities.destroy', $modality) }}" method="POST" onsubmit="return confirm('¿Está seguro de eliminar esta modalidad?');" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Eliminar"><i class="bi bi-trash"></i></button>
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
                    <p class="text-muted mt-3">No hay modalidades académicas creadas.</p>
                    <a href="{{ route('admin.academic_modalities.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-lg"></i> Crear Primera Modalidad
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
