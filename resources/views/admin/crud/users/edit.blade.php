<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Editar Usuario - ISTS Admin' }}</title>
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
                    <h1>👥 Editar Usuario</h1>
                    <p>Modifica la información del usuario.</p>
                </div>

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ url('/users/edit/' . $item['id']) }}" class="styled-form">
                    @csrf

                    <div class="form-card">
                        <div class="form-group">
                            <label for="username">Nombre de usuario</label>
                            <input type="text" id="username" name="username" class="form-control" value="{{ old('username', $item['username'] ?? '') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $item['email'] ?? '') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Nueva Contraseña (dejar en blanco para no cambiar)</label>
                            <input type="password" id="password" name="password" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="role">Rol</label>
                            <select id="role" name="role" class="form-control">
                                <option value="user" {{ old('role', $item['role'] ?? '') === 'user' ? 'selected' : '' }}>Usuario</option>
                                <option value="editor" {{ old('role', $item['role'] ?? '') === 'editor' ? 'selected' : '' }}>Editor</option>
                                <option value="admin" {{ old('role', $item['role'] ?? '') === 'admin' ? 'selected' : '' }}>Administrador</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="status">Estado</label>
                            <select id="status" name="status" class="form-control">
                                <option value="active" {{ old('status', $item['status'] ?? '') === 'active' ? 'selected' : '' }}>Activo</option>
                                <option value="inactive" {{ old('status', $item['status'] ?? '') === 'inactive' ? 'selected' : '' }}>Inactivo</option>
                            </select>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </form>
            </div>
        </div>
    </main>
</body>
</html>
