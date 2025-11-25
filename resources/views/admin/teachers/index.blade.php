@extends('layouts.admin')

@section('content')
<div class="admin-content">
    <div class="dashboard-header">
        <h1>👩‍🏫 Gestión de Planta Docente</h1>
        <p>Administra la planta docente del instituto.</p>
        <a href="{{ route('admin.teachers.create') }}" class="btn btn-primary">Añadir Docente</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Orden</th>
                    <th>Imagen</th>
                    <th>Nombre</th>
                    <th>Título</th>
                    <th>Departamento</th>
                    <th>PDF</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                    <tr>
                        <td>{{ $item->order }}</td>
                        <td>
                            @if($item->image_path)
                                <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->name }}" style="max-width: 50px; border-radius: 50%;">
                            @endif
                        </td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->title }}</td>
                        <td>{{ $item->department }}</td>
                        <td>
                            @if($item->pdf_path)
                                <a href="{{ asset('storage/' . $item->pdf_path) }}" target="_blank">Ver PDF</a>
                            @endif
                        </td>
                        <td class="actions">
                            <a href="{{ route('admin.teachers.edit', $item) }}" class="btn btn-sm btn-secondary">Editar</a>
                            <form action="{{ route('admin.teachers.destroy', $item) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de que quieres eliminar a este docente?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Paginación -->
    {{ $items->links() }}
</div>
@endsection
