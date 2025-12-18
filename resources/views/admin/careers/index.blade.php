@extends('layouts.admin')

@section('title', 'Gestión de Carreras')

@section('content')
<div class="card" style="border-radius: 18px; box-shadow: 0 2px 16px rgba(0,158,96,0.10); margin-top: 2.5rem; max-width: 1100px; margin-left:auto; margin-right:auto;">
    <div class="card-body p-5">
        <div class="mb-4 d-flex flex-column flex-md-row align-items-center justify-content-between" style="gap:1.2rem;">
            <h1 class="fw-bold mb-0" style="font-size:2.1rem; color:#1a3c34; letter-spacing:-1px; display:flex;align-items:center;gap:0.5em;">
                <span style="font-size:2.2rem;">🎓</span> Gestión de Carreras / Coordinaciones
            </h1>
            <a href="{{ route('admin.careers.create') }}" class="btn" style="background: linear-gradient(90deg,#009e60,#f9d423 90%); color: #fff; font-weight:600; box-shadow:0 2px 8px rgba(0,158,96,0.15); border-radius: 8px; padding: 0.75rem 1.5rem; font-size:1.1rem; transition:box-shadow .2s;">+ Nueva Carrera</a>
        </div>
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">{{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
        @endif
        <div class="table-responsive">
            <table class="table align-middle" style="border-radius: 12px; overflow: hidden;">
                <thead style="background: linear-gradient(90deg,#009e60,#0e3e49 90%); color: #fff;">
                    <tr>
                        <th style="width: 80px;">Imagen</th>
                        <th>Nombre</th>
                        <th>Coordinador</th>
                        <th style="width: 100px;">Orden</th>
                        <th style="width: 100px;">Estado</th>
                        <th style="width: 220px;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($careers as $career)
                        <tr>
                            <td>
                                @if($career->image_path)
                                    <img src="{{ asset('storage/' . $career->image_path) }}" alt="{{ $career->name }}" style="width: 60px; height: 60px; object-fit: cover; border-radius: 6px; box-shadow:0 2px 8px rgba(0,158,96,0.10);">
                                @else
                                    <div class="bg-secondary text-white d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; border-radius: 6px;">
                                        <i class="bi bi-book" style="font-size: 24px;"></i>
                                    </div>
                                @endif
                            </td>
                            <td style="font-weight:600;">
                                {{ $career->name }}
                                @if($career->description)
                                    <br><small class="text-muted">{{ Str::limit($career->description, 60) }}</small>
                                @endif
                                @if(!$career->image_path || !$career->image_path_2)
                                    <br><small class="badge" style="background: #ff6b6b; color: white; font-size: 10px;">⚠️ Falta{{ !$career->image_path && !$career->image_path_2 ? 'n' : '' }} imagen{{ !$career->image_path && !$career->image_path_2 ? 'es' : '' }}</small>
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
                                <span class="badge" style="background:{{ $career->is_active ? '#009e60' : '#f9d423' }};color:#fff; font-weight:600; border-radius:6px; padding:0.4em 1em; font-size:0.98em;">
                                    {{ $career->is_active ? 'Activa' : 'Inactiva' }}
                                </span>
                            </td>
                            <td style="display:flex; gap:0.5em;">
                                <a href="{{ route('career.show', $career->slug) }}" class="btn" style="background: #009e60; color: #fff; font-weight:600; border-radius:8px; padding:0.5em 1.2em; font-size:1em; min-width:90px; text-align:center;" target="_blank">Ver</a>
                                <form action="{{ route('admin.careers.destroy', $career) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn" style="background: #e74c3c; color: #fff; font-weight:600; border-radius:8px; padding:0.5em 1.2em; font-size:1em; min-width:90px; text-align:center;" onclick="return confirm('¿Estás seguro de eliminar esta carrera?');">Eliminar</button>
                                </form>
                                <a href="{{ route('admin.careers.edit', $career) }}" class="btn" style="background: linear-gradient(90deg,#253b7d,#f9d423 90%); color: #fff; font-weight:600; border-radius:8px; padding:0.5em 1.2em; font-size:1em; min-width:90px; text-align:center;">Editar</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">No hay carreras registradas.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
