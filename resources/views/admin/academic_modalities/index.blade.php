@extends('layouts.admin')

@section('title', 'Modalidades Académicas')

@section('content')
<div class="card" style="border-radius: 18px; box-shadow: 0 2px 16px rgba(0,158,96,0.10); margin-top: 2.5rem; max-width: 1100px; margin-left:auto; margin-right:auto;">
    <div class="card-body p-5">
        <div class="mb-4 d-flex flex-column flex-md-row align-items-center justify-content-between" style="gap:1.2rem;">
            <h1 class="fw-bold mb-0" style="font-size:2.1rem; color:#1a3c34; letter-spacing:-1px; display:flex;align-items:center;gap:0.5em;">
                <span style="font-size:2.2rem;">📚</span> Modalidades Académicas
            </h1>
            <a href="{{ route('admin.academic_modalities.create') }}" class="btn" style="background: linear-gradient(90deg,#009e60,#f9d423 90%); color: #fff; font-weight:600; box-shadow:0 2px 8px rgba(0,158,96,0.15); border-radius: 8px; padding: 0.75rem 1.5rem; font-size:1.1rem; transition:box-shadow .2s;">+ Nueva Modalidad</a>
        </div>
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">{{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
        @endif
        @if($modalities->count() > 0)
            <div class="table-responsive">
                <table class="table align-middle" style="border-radius: 12px; overflow: hidden;">
                    <thead style="background: linear-gradient(90deg,#009e60,#0e3e49 90%); color: #fff;">
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
                                <td style="font-weight:600;">{{ $modality->title }}</td>
                                <td>{{ Str::limit($modality->description, 50) }}</td>
                                <td>@if($modality->icon)<i class="{{ $modality->icon }}"></i>@else <span class="text-muted">-</span> @endif</td>
                                <td>
                                    <span class="badge" style="background:{{ $modality->is_active ? '#009e60' : '#f9d423' }};color:#fff; font-weight:600; border-radius:6px; padding:0.4em 1em; font-size:0.98em;">
                                        {{ $modality->is_active ? 'Activo' : 'Inactivo' }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.academic_modalities.programs.index', $modality->id) }}" style="color:#009e60; font-weight:600; text-decoration:underline;">Ver Programas</a>
                                </td>
                                <td style="display:flex; gap:0.5em;">
                                    <a href="{{ route('admin.academic_modalities.edit', $modality) }}" class="btn" style="background: linear-gradient(90deg,#253b7d,#f9d423 90%); color: #fff; font-weight:600; border-radius:8px; padding:0.5em 1.2em; font-size:1em; min-width:110px; text-align:center; display:flex; align-items:center; gap:0.5em;" title="Editar">
                                        <i class="bi bi-pencil"></i> Editar
                                    </a>
                                    <form action="{{ route('admin.academic_modalities.destroy', $modality) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn" style="background: #e74c3c; color: #fff; font-weight:600; border-radius:8px; padding:0.5em 1.2em; font-size:1em; min-width:110px; text-align:center; display:flex; align-items:center; gap:0.5em;" title="Eliminar" onclick="return confirm('¿Está seguro de eliminar esta modalidad?');">
                                            <i class="bi bi-trash"></i> Eliminar
                                        </button>
                                    </form>
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
                <a href="{{ route('admin.academic_modalities.create') }}" class="btn" style="background: linear-gradient(90deg,#009e60,#f9d423 90%); color: #fff; font-weight:600; box-shadow:0 2px 8px rgba(0,158,96,0.15); border-radius: 8px; padding: 0.75rem 1.5rem; font-size:1.1rem;">+ Crear Primera Modalidad</a>
            </div>
        @endif
    </div>
</div>
@endsection
