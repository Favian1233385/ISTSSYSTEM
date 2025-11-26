@extends('layouts.admin')

@section('content')
<div class="admin-container">
    <div class="admin-content">
        <div class="dashboard-header">
            <h1>👥 Crear Nuevo Usuario</h1>
            <p>Completa el formulario para agregar un nuevo usuario al sistema.</p>
        </div>

        <div class="form-container">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('users.create') }}" class="styled-form">
                @csrf

                <div class="form-card">
                    <div class="form-group">
                        <label for="username">Nombre de usuario</label>
                        <input type="text" id="username" name="username" class="form-control" value="{{ old('username') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input type="password" id="password" name="password" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="role">Rol</label>
                        <select id="role" name="role" class="form-control">
                            <option value="user" {{ old('role') === 'user' ? 'selected' : '' }}>Usuario</option>
                            <option value="editor" {{ old('role') === 'editor' ? 'selected' : '' }}>Editor</option>
                            <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Administrador</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="status">Estado</label>
                        <select id="status" name="status" class="form-control">
                            <option value="active" {{ old('status') === 'active' ? 'selected' : '' }}>Activo</option>
                            <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>Inactivo</option>
                            <option value="suspended" {{ old('status') === 'suspended' ? 'selected' : '' }}>Suspendido</option>
                        </select>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Crear Usuario</button>
                    <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection