@extends('layouts.admin')

@section('title', 'Slides del Carrusel')

@section('content')
<div class="container mt-4">
    <h2>Listado de slides</h2>
    <a href="{{ route('admin.hero-slides.create') }}" class="btn btn-primary mb-3">Crear nuevo slide</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Subtítulo</th>
                <th>Imagen</th>
                <th>Enlace</th>
                <th>Orden</th>
                <th>Activo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($slides as $slide)
                <tr>
                    <td>{{ $slide->id }}</td>
                    <td>{{ $slide->title }}</td>
                    <td>{{ $slide->subtitle }}</td>
                    <td>
                        @if($slide->image_path)
                            <img src="{{ asset('uploads/images/' . $slide->image_path) }}" alt="{{ $slide->title }}" style="width: 100px;">
                        @endif
                    </td>
                    <td>{{ $slide->link }}</td>
                    <td>{{ $slide->sort_order }}</td>
                    <td>{{ $slide->is_active ? 'Sí' : 'No' }}</td>
                    <td>
                        <a href="{{ route('admin.hero-slides.edit', $slide->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('admin.hero-slides.destroy', $slide->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar este slide?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8">No hay slides registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
