@extends('admin.layout')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Gestión de Menú de Navegación</h3>
                    <a href="{{ route('admin.menu_items.create') }}" class="btn btn-primary float-right">Crear Nuevo Elemento</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Título</th>
                                <th>URL</th>
                                <th>Orden</th>
                                <th>Activo</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $item)
                                <tr>
                                    <td>{{ $item->title }}</td>
                                    <td>{{ $item->url }}</td>
                                    <td>{{ $item->order }}</td>
                                    <td>{{ $item->is_active ? 'Sí' : 'No' }}</td>
                                    <td>
                                        <a href="{{ route('admin.menu_items.edit', $item) }}" class="btn btn-sm btn-warning">Editar</a>
                                        <form action="{{ route('admin.menu_items.destroy', $item) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                                @foreach($item->children as $child)
                                    <tr>
                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;{{ $child->title }}</td>
                                        <td>{{ $child->url }}</td>
                                        <td>{{ $child->order }}</td>
                                        <td>{{ $child->is_active ? 'Sí' : 'No' }}</td>
                                        <td>
                                            <a href="{{ route('admin.menu_items.edit', $child) }}" class="btn btn-sm btn-warning">Editar</a>
                                            <form action="{{ route('admin.menu_items.destroy', $child) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection