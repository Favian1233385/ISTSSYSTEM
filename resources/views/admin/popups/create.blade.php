@extends('admin.layout')

@section('content')
<div class="admin-container">
    <div class="admin-header">
        <h1>Crear PopUp Destacado</h1>
        <a href="{{ route('admin.popups.index') }}" class="btn btn-secondary">← Volver a PopUps</a>
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
    <form action="{{ route('admin.popups.store') }}" method="POST" enctype="multipart/form-data" class="admin-form">
        @csrf
        <div class="form-group">
            <label for="image_path">Imagen del PopUp (GIF/JPG/PNG)</label>
            <input type="file" name="image_path" id="image_path" class="form-control-file" accept="image/*">
            <small class="form-text text-muted">Ideal: 900x300px, puede ser animado (GIF).</small>
        </div>
        <div class="form-group">
            <label for="message">Mensaje del PopUp</label>
            <input type="text" name="message" id="message" class="form-control" maxlength="255">
        </div>
        <div class="form-group">
            <label for="link">Enlace del PopUp</label>
            <input type="url" name="link" id="link" class="form-control" maxlength="255" placeholder="https://...">
        </div>
        <div class="form-group">
            <label for="is_active">¿Activo?</label>
            <select name="is_active" id="is_active" class="form-control">
                <option value="1">Sí</option>
                <option value="0">No</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Guardar PopUp</button>
    </form>
</div>
@endsection
