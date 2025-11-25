@extends('layouts.admin')

@section('content')
<div class="admin-content">
    <div class="dashboard-header">
        <h1>👥 Gestión de Usuarios</h1>
        <p>Administra los usuarios del sistema.</p>
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">Crear Usuario</a>
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
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Creado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->email }}</td>
                        <td><span class="badge status-{{ $item->role }}">{{ $item->role }}</span></td>
                        <td>{{ $item->created_at->format('d/m/Y') }}</td>
                        <td class="actions">
                            <a href="{{ route('admin.users.edit', $item) }}" class="btn btn-sm btn-secondary">Editar</a>
                            <form action="{{ route('admin.users.destroy', $item) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de que quieres eliminar este usuario?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" @if(Auth::id() == $item->id) disabled @endif>Eliminar</button>
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
