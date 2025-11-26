<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Gestión de Usuarios - ISTS Admin' }}</title>
    <link rel="stylesheet" href="{{ asset('public/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/harvard-style.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>
<body class="admin-body">
    @include('admin.header')

    <main class="admin-main">
        <div class="admin-container">
            <div class="admin-content">
                <div class="dashboard-header">
                    <h1>👥 Gestión de Usuarios</h1>
                    <p>Administra los usuarios del sistema.</p>
                    <a href="{{ url('/users/create') }}" class="btn btn-primary">Crear Usuario</a>
                </div>

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Rol</th>
                                <th>Estado</th>
                                <th>Último Login</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $item)
                                <tr>
                                    <td>{{ $item['id'] }}</td>
                                    <td>{{ $item['username'] }}</td>
                                    <td>{{ $item['email'] }}</td>
                                    <td><span class="badge role-{{ $item['role'] }}">{{ $item['role'] }}</span></td>
                                    <td><span class="badge status-{{ $item['status'] }}">{{ $item['status'] }}</span></td>
                                    <td>{{ $item['last_login'] ?? 'Nunca' }}</td>
                                    <td class="actions">
                                        <a href="{{ url('/users/edit/' . $item['id']) }}" class="btn btn-sm btn-secondary">Editar</a>
                                        <form action="{{ url('/users/delete/' . $item['id']) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de que quieres eliminar este usuario?');">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @if($totalPages > 1)
                    <nav class="pagination">
                        <ul>
                            @if($currentPage > 1)
                                <li><a href="?page={{ $currentPage - 1 }}">Anterior</a></li>
                            @endif

                            @for($i = 1; $i <= $totalPages; $i++)
                                <li>
                                    <a href="?page={{ $i }}" class="{{ $i == $currentPage ? 'active' : '' }}">
                                        {{ $i }}
                                    </a>
                                </li>
                            @endfor

                            @if($currentPage < $totalPages)
                                <li><a href="?page={{ $currentPage + 1 }}">Siguiente</a></li>
                            @endif
                        </ul>
                    </nav>
                @endif
            </div>
        </div>
    </main>
</body>
</html>
