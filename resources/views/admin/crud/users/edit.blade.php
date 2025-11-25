@extends('layouts.admin')

@section('content')
<div class="admin-content">
    <div class="dashboard-header">
        <h1>👥 Editar Usuario</h1>
        <p>Modifica el formulario para editar el usuario.</p>
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

    <form action="{{ route('admin.users.update', $item) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $item->name) }}" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $item->email) }}" required>
        </div>
        <div class="form-group">
            <label for="password">Contraseña (dejar en blanco para no cambiar)</label>
            <input type="password" name="password" id="password" class="form-control">
        </div>
        <div class="form-group">
            <label for="password_confirmation">Confirmar Contraseña</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
        </div>
        <div class="form-group">
            <label for="role">Rol</label>
            <select name="role" id="role" class="form-control" @if(Auth::id() == $item->id) disabled @endif>
                <option value="user" @if(old('role', $item->role) == 'user') selected @endif>Usuario</option>
                <option value="editor" @if(old('role', $item->role) == 'editor') selected @endif>Editor</option>
                <option value="admin" @if(old('role', $item->role) == 'admin') selected @endif>Administrador</option>
            </select>
             @if(Auth::id() == $item->id)
                <small class="form-text text-muted">No puedes cambiar tu propio rol.</small>
            @endif
        </div>
        <button type="submit" class="btn btn-primary">Actualizar Usuario</button>
    </form>
</div>
@endsection
