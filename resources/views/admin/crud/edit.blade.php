@extends('layouts.admin')

@section('content')
<div class="admin-content">
    <div class="dashboard-section">
        <div class="section-header">
            <h2>{{ $title ?? 'Editar' }}</h2>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ $action_link . ($item['id'] ?? '') }}" method="POST" enctype="multipart/form-data">
            @csrf

            @if ($type === 'users')
                <div class="form-group">
                    <label for="username">Nombre de usuario</label>
                    <input type="text" id="username" name="username" class="form-control" value="{{ $item['username'] ?? '' }}" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" class="form-control" value="{{ $item['email'] ?? '' }}" required>
                </div>

                <div class="form-group">
                    <label for="password">Nueva Contraseña (dejar en blanco para no cambiar)</label>
                    <input type="password" id="password" name="password" class="form-control">
                </div>

                <div class="form-group">
                    <label for="role">Rol</label>
                    <select id="role" name="role" class="form-control">
                        <option value="user" {{ ($item['role'] ?? '') === 'user' ? 'selected' : '' }}>Usuario</option>
                        <option value="editor" {{ ($item['role'] ?? '') === 'editor' ? 'selected' : '' }}>Editor</option>
                        <option value="admin" {{ ($item['role'] ?? '') === 'admin' ? 'selected' : '' }}>Administrador</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="status">Estado</label>
                    <select id="status" name="status" class="form-control">
                        <option value="active" {{ ($item['status'] ?? '') === 'active' ? 'selected' : '' }}>Activo</option>
                        <option value="inactive" {{ ($item['status'] ?? '') === 'inactive' ? 'selected' : '' }}>Inactivo</option>
                        <option value="suspended" {{ ($item['status'] ?? '') === 'suspended' ? 'selected' : '' }}>Suspendido</option>
                    </select>
                </div>
            @elseif ($type === 'contents')
                <div class="form-group">
                    <label for="title">Título</label>
                    <input type="text" id="title" name="title" class="form-control" value="{{ $item['title'] ?? '' }}" required>
                </div>

                <div class="form-group">
                    <label for="description">Descripción</label>
                    <textarea id="description" name="description" class="form-control" rows="3" required>{{ $item['description'] ?? '' }}</textarea>
                </div>

                <div class="form-group">
                    <label for="content">Contenido</label>
                    <textarea id="content" name="content" class="form-control" rows="10" required>{{ $item['content'] ?? '' }}</textarea>
                </div>

                <div class="form-group">
                    <label for="category">Categoría</label>
                    <input type="text" id="category" name="category" class="form-control" value="{{ $item['category'] ?? '' }}">
                </div>

                <div class="form-group">
                    <label for="status">Estado</label>
                    <select id="status" name="status" class="form-control">
                        <option value="draft" {{ ($item['status'] ?? '') === 'draft' ? 'selected' : '' }}>Borrador</option>
                        <option value="published" {{ ($item['status'] ?? '') === 'published' ? 'selected' : '' }}>Publicado</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="image_file">Subir Nueva Imagen (dejar en blanco para no cambiar)</label>
                    <input type="file" id="image_file" name="image_file" class="form-control">

                    @if (!empty($item['image_url']))
                        <div class="current-image">
                            <p>Imagen actual:</p>
                            <img src="{{ $item['image_url'] }}" alt="Imagen actual" style="max-width: 200px; margin-top: 10px;">
                        </div>
                    @endif
                </div>
            @elseif ($type === 'news')
                <div class="form-group">
                    <label for="title">Título</label>
                    <input type="text" id="title" name="title" class="form-control" value="{{ $item['title'] ?? '' }}" required>
                </div>

                <div class="form-group">
                    <label for="summary">Resumen</label>
                    <textarea id="summary" name="summary" class="form-control" rows="3" required>{{ $item['summary'] ?? '' }}</textarea>
                </div>

                <div class="form-group">
                    <label for="content">Contenido</label>
                    <textarea id="content" name="content" class="form-control" rows="10" required>{{ $item['content'] ?? '' }}</textarea>
                </div>

                <div class="form-group">
                    <label for="image_file">Subir Nueva Imagen (dejar en blanco para no cambiar)</label>
                    <input type="file" id="image_file" name="image_file" class="form-control">

                    @if (!empty($item['image_url']))
                        <div class="current-image">
                            <p>Imagen actual:</p>
                            <img src="{{ $item['image_url'] }}" alt="Imagen actual" style="max-width: 200px; margin-top: 10px;">
                        </div>
                    @endif
                </div>
            @endif

            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a href="{{ $cancel_link }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>
@endsection