
@extends('admin.layout')

@section('content')
<div class="admin-content">
    <div class="dashboard-header">
        <h1>👥 Gestión de Usuarios</h1>
        <p>Administra los usuarios del sistema.</p>
        <a href="{{ url('/users/create') }}" class="btn btn-primary">➕ Crear Usuario</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table" style="min-width: 900px;">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Estado</th>
                    <th>Último Login</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($items as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name ?? $item->username }}</td>
                        <td>{{ $item->email }}</td>
                        <td>
                            <span class="badge" style="background: 
                                @if($item->role === 'admin') var(--admin-primary)
                                @elseif($item->role === 'editor') var(--admin-secondary)
                                @else var(--admin-gray) @endif;
                                color: white;">
                                {{ ucfirst($item->role) }}
                            </span>
                        </td>
                        <td>
                            <span class="badge" style="background: {{ $item->status === 'active' ? 'var(--admin-primary)' : '#EF4444' }}; color: white;">
                                {{ $item->status === 'active' ? 'Activo' : 'Inactivo' }}
                            </span>
                        </td>
                        <td>
                            @if($item->last_login)
                                {{ \Carbon\Carbon::parse($item->last_login)->format('d/m/Y H:i') }}
                            @else
                                Nunca
                            @endif
                        </td>
                        <td class="actions">
                            <a href="{{ route('admin.users.edit', $item->id) }}" class="btn btn-sm btn-edit">Editar</a>
                            <form action="{{ route('admin.users.destroy', $item->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de que quieres eliminar este usuario?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="no-items">No hay usuarios registrados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($items->lastPage() > 1)
        <nav class="pagination">
            <ul>
                @if($items->currentPage() > 1)
                    <li><a href="?page={{ $items->currentPage() - 1 }}">Anterior</a></li>
                @endif
                @for($i = 1; $i <= $items->lastPage(); $i++)
                    <li>
                        <a href="?page={{ $i }}" class="{{ $i == $items->currentPage() ? 'active' : '' }}">
                            {{ $i }}
                        </a>
                    </li>
                @endfor
                @if($items->currentPage() < $items->lastPage())
                    <li><a href="?page={{ $items->currentPage() + 1 }}">Siguiente</a></li>
                @endif
            </ul>
        </nav>
    @endif
</div>
@endsection
