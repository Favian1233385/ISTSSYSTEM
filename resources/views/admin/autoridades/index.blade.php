@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Gestión de Autoridades</h1>
    <p class="mb-4">Aquí puedes administrar las autoridades de la institución (Rector, Vicerrector, OCS, etc.).</p>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="{{ route('admin.autoridades.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Crear Nueva Autoridad
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Orden</th>
                            <th>Nombre</th>
                            <th>Cargo</th>
                            <th>Categoría</th>
                            <th style="width: 150px;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($autoridades as $autoridad)
                        <tr>
                            <td>{{ $autoridad->orden }}</td>
                            <td>{{ $autoridad->nombre }}</td>
                            <td>{{ $autoridad->cargo }}</td>
                            <td>{{ $autoridad->categoria }}</td>
                            <td>
                                <a href="{{ route('admin.autoridades.edit', $autoridad->id) }}" class="btn btn-sm btn-warning" title="Editar">
                                    <i class="fas fa-edit"></i> Editar
                                </a>
                                <form action="{{ route('admin.autoridades.destroy', $autoridad->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de que quieres eliminar esta autoridad?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Eliminar">
                                        <i class="fas fa-trash"></i> Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">No hay autoridades creadas todavía.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
