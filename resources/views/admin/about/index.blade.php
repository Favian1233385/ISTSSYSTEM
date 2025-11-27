@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Gestión de Contenido "Acerca"</h1>
    <p class="mb-4">Aquí puedes crear, editar y eliminar las secciones de contenido que aparecen en la página "Acerca".</p>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="{{ route('about.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Crear Nueva Sección
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Título</th>
                            <th>Contenido</th>
                            <th style="width: 150px;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($abouts as $about)
                        <tr>
                            <td>{{ $about['title'] }}</td>
                            <td>{{ Str::limit(strip_tags($about['content']), 100) }}</td>
                            <td>
                                <a href="{{ route('about.edit', $about['id']) }}" class="btn btn-sm btn-warning" title="Editar">
                                    <i class="fas fa-edit"></i> Editar
                                </a>
                                <form action="{{ route('about.destroy', $about['id']) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de que quieres eliminar esta sección?');">
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
                            <td colspan="3" class="text-center">No hay secciones de "Acerca" creadas todavía.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
