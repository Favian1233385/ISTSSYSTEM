@extends('layouts.admin')

@section('content')
<div class="admin-content">
    <div class="dashboard-header">
        <h1>👥 Crear Usuario</h1>
        <p>Rellena el formulario para crear un nuevo usuario.</p>
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

    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
        </div>
        <div class="form-group">
            <label for="password">Contraseña</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password_confirmation">Confirmar Contraseña</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="role">Rol</label>
            <select name="role" id="role" class="form-control">
                <option value="user" @if(old('role') == 'user') selected @endif>Usuario</option>
                <option value="editor" @if(old('role') == 'editor') selected @endif>Editor</option>
                <option value="admin" @if(old('role') == 'admin') selected @endif>Administrador</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Crear Usuario</button>
    </form>
</div>
@endsection
