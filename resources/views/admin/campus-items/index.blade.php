@extends('layouts.admin')

@section('content')
<div class="admin-content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Items del Menú Campus</h1>
        <a href="{{ route('admin.campus-items.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Nuevo Item
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
                                    <span class="badge bg-{{ $item->category === 'coordinaciones' ? 'primary' : 'info' }}">
                                        {{ ucfirst($item->category) }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-{{ $item->is_active ? 'success' : 'secondary' }}">
                                        {{ $item->is_active ? 'Activo' : 'Inactivo' }}
                                    </span>
                                </td>
                                <td>
                                    <div style="display: flex; gap: 0.5rem;">
                                        <a href="{{ route('admin.campus-items.edit', $item) }}" 
                                           style="padding: 0.375rem 0.75rem; background-color: #ffc107; color: #000; text-decoration: none; border-radius: 4px; display: inline-block;">
                                            ✏️ Editar
                                        </a>
                                        <a href="{{ route('admin.campus-item-contents.index', $item) }}" 
                                           style="padding: 0.375rem 0.75rem; background-color: #0d6efd; color: #fff; text-decoration: none; border-radius: 4px; display: inline-block;">
                                            📄 Contenidos
                                        </a>
                                        <form action="{{ route('admin.campus-items.destroy', $item) }}" 
                                              method="POST" 
                                              style="display: inline-block; margin: 0;"
                                              onsubmit="return confirm('¿Estás seguro de eliminar este item?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    style="padding: 0.375rem 0.75rem; background-color: #dc3545; color: white; border: none; border-radius: 4px; cursor: pointer;">
                                                🗑️ Eliminar
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                       
                            <tr>
                                <td colspan="6" class="text-center">No hay items registrados</td>
                            </tr>
                        @endforelse
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
