
@extends('admin.layout')

@section('content')
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

    <form method="POST" action="{{ route('admin.users.update', $item->id) }}" class="styled-form" style="max-width: 500px; margin: 0 auto;">
        @csrf
        @method('PUT')
        <div class="form-card" style="background: #f8fafc; border-radius: 12px; box-shadow: var(--admin-shadow); padding: 2rem;">
            <div class="form-group" style="margin-bottom: 1.5rem;">
                <label for="name" style="font-weight: 600;">Nombre</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $item->name ?? '') }}" required>
            </div>
            <div class="form-group" style="margin-bottom: 1.5rem;">
                <label for="email" style="font-weight: 600;">Email</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $item->email ?? '') }}" required>
            </div>
            <div class="form-group" style="margin-bottom: 1.5rem;">
                <label for="password" style="font-weight: 600;">Nueva Contraseña <span style="font-weight:400; color:var(--admin-gray);">(dejar en blanco para no cambiar)</span></label>
                <input type="password" id="password" name="password" class="form-control">
            </div>
            <div class="form-group" style="margin-bottom: 1.5rem;">
                <label for="role" style="font-weight: 600;">Rol</label>
                <select id="role" name="role" class="form-control">
                    <option value="user" {{ old('role', $item->role ?? '') === 'user' ? 'selected' : '' }}>Usuario</option>
                    <option value="editor" {{ old('role', $item->role ?? '') === 'editor' ? 'selected' : '' }}>Editor</option>
                    <option value="admin" {{ old('role', $item->role ?? '') === 'admin' ? 'selected' : '' }}>Administrador</option>
                </select>
            </div>
            <div class="form-group" style="margin-bottom: 2rem;">
                <label for="status" style="font-weight: 600;">Estado</label>
                <select id="status" name="status" class="form-control">
                    <option value="active" {{ old('status', $item->status ?? '') === 'active' ? 'selected' : '' }}>Activo</option>
                    <option value="inactive" {{ old('status', $item->status ?? '') === 'inactive' ? 'selected' : '' }}>Inactivo</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary" style="width: 100%; font-size: 1.1rem;">💾 Guardar Cambios</button>
        </div>
    </form>
</div>
@endsection
