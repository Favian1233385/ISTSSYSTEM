@extends('layouts.admin')

@section('title', 'Programas de ' . $modality->title)

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">📚 Programas de {{ $modality->title }}</h1>
        <a href="{{ route('admin.academic_modalities.programs.create', $modality->id) }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Nuevo Programa
        </a>
        <a href="{{ route('admin.academic_modalities.index') }}" class="btn btn-secondary">Volver a Modalidades</a>
    </div>
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            @if($programs->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Orden</th>
                                <th>Título</th>
                                <th>Descripción</th>
                                <th>Enlace</th>
                                <th>Documento</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                                <th>Inscritos</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($programs as $program)
                                <tr>
                                    <td>{{ $program->order }}</td>
                                    <td><strong>{{ $program->title }}</strong></td>
                                    <td>{{ Str::limit($program->description, 50) }}</td>
                                    <td>@if($program->url)<a href="{{ $program->url }}" target="_blank">Ver</a>@else <span class="text-muted">-</span> @endif</td>
                                    <td>@if($program->document)<a href="{{ asset('storage/' . $program->document) }}" target="_blank">Descargar</a>@else <span class="text-muted">-</span> @endif</td>
                                    <td>
                                        @if($program->is_active)
                                            <span class="badge bg-success">Activo</span>
                                        @else
                                            <span class="badge bg-secondary">Inactivo</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.academic_modalities.programs.edit', [$modality->id, $program->id]) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                                            <form action="{{ route('admin.academic_modalities.programs.destroy', [$modality->id, $program->id]) }}" method="POST" onsubmit="return confirm('¿Está seguro de eliminar este programa?');" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.inscripciones.index', ['programa_id' => $program->id]) }}" class="btn btn-sm btn-info">
                                            <i class="bi bi-people"></i> Ver Inscritos
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-5">
                    <i class="bi bi-inbox" style="font-size: 3rem; color: #ccc;"></i>
                    <p class="text-muted mt-3">No hay programas creados para esta modalidad.</p>
                    <a href="{{ route('admin.academic_modalities.programs.create', $modality->id) }}" class="btn btn-primary">
                        <i class="bi bi-plus-lg"></i> Crear Primer Programa
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
