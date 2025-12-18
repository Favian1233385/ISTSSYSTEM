@extends('layouts.admin')

@section('content')
<div class="card" style="border-radius: 18px; box-shadow: 0 2px 16px rgba(0,158,96,0.10); margin-top: 2.5rem; max-width: 1100px; margin-left:auto; margin-right:auto;">
    <div class="card-body p-5">
        <div class="mb-4 d-flex flex-column flex-md-row align-items-center justify-content-between" style="gap:1.2rem;">
            <h1 class="fw-bold mb-0" style="font-size:2.1rem; color:#1a3c34; letter-spacing:-1px; display:flex;align-items:center;gap:0.5em;">
                <span style="font-size:2.2rem;">📋</span> Items del Menú Campus
            </h1>
            <a href="{{ route('admin.campus-items.create') }}" class="btn" style="background: linear-gradient(90deg,#009e60,#f9d423 90%); color: #fff; font-weight:600; box-shadow:0 2px 8px rgba(0,158,96,0.15); border-radius: 8px; padding: 0.75rem 1.5rem; font-size:1.1rem; transition:box-shadow .2s;">+ Nuevo Item</a>
        </div>
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">{{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
        @endif
        <div class="table-responsive">
            <table class="table align-middle" style="border-radius: 12px; overflow: hidden;">
                <thead style="background: linear-gradient(90deg,#009e60,#0e3e49 90%); color: #fff;">
                    <tr>
                        <th>Orden</th>
                        <th>Título</th>
                        <th>Categoría</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($campusItems as $item)
                        <tr>
                            <td>{{ $item->order }}</td>
                            <td>{{ $item->title }}</td>
                            <td>
                                <span class="badge" style="background:{{ $item->category === 'coordinaciones' ? '#253b7d' : '#009e60' }};color:#fff; font-weight:600; border-radius:6px; padding:0.4em 1em; font-size:0.98em;">
                                    {{ ucfirst($item->category) }}
                                </span>
                            </td>
                            <td>
                                <span class="badge" style="background:{{ $item->is_active ? '#009e60' : '#f9d423' }};color:#fff; font-weight:600; border-radius:6px; padding:0.4em 1em; font-size:0.98em;">
                                    {{ $item->is_active ? 'Activo' : 'Inactivo' }}
                                </span>
                            </td>
                            <td style="display:flex; gap:0.5em;">
                                <a href="{{ route('admin.campus-items.edit', $item) }}" class="btn" style="background: linear-gradient(90deg,#f9d423,#ffb347 90%); color: #222; font-weight:600; border-radius:8px; padding:0.5em 1.2em; font-size:1em; min-width:110px; text-align:center; display:flex; align-items:center; gap:0.5em;">
                                    <i class="bi bi-pencil"></i> Editar
                                </a>
                                <a href="{{ route('admin.campus-items.contents.index', $item) }}" class="btn" style="background: #0d6efd; color: #fff; font-weight:600; border-radius:8px; padding:0.5em 1.2em; font-size:1em; min-width:110px; text-align:center; display:flex; align-items:center; gap:0.5em;">
                                    <i class="bi bi-file-earmark-text"></i> Contenidos
                                </a>
                                <form action="{{ route('admin.campus-items.destroy', $item) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn" style="background: #e74c3c; color: #fff; font-weight:600; border-radius:8px; padding:0.5em 1.2em; font-size:1em; min-width:110px; text-align:center; display:flex; align-items:center; gap:0.5em;" onclick="return confirm('¿Estás seguro de eliminar este item?');">
                                        <i class="bi bi-trash"></i> Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">No hay items registrados</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
