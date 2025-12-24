@extends('admin.layout')

@section('content')
<div class="admin-container">
    <div class="admin-header">
        <h1>Editar PopUp Destacado</h1>
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
    <form action="{{ route('admin.popups.update', $popup) }}" method="POST" enctype="multipart/form-data" class="admin-form">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="image_path">Imagen del PopUp (GIF/JPG/PNG)</label>
            @if($popup->image_path)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $popup->image_path) }}" alt="Banner actual" style="max-width:320px; border-radius:8px; box-shadow:0 2px 8px rgba(0,0,0,0.10);">
                    <p class="text-muted small mt-1">Banner actual</p>
                </div>
            @endif
            <input type="file" name="image_path" id="image_path" class="form-control-file" accept="image/*">
            <small class="form-text text-muted">Ideal: 900x300px, puede ser animado (GIF).</small>
        </div>
        <div class="form-group">
            <label for="message">Mensaje del PopUp</label>
            <input type="text" name="message" id="message" class="form-control" maxlength="255" value="{{ old('message', $popup->message) }}">
        </div>
        <div class="form-group">
            <label for="link">Enlace del PopUp</label>
            <input type="url" name="link" id="link" class="form-control" maxlength="255" placeholder="https://..." value="{{ old('link', $popup->link) }}">
        </div>
        <div class="form-group">
            <label for="is_active">¿Activo?</label>
            <select name="is_active" id="is_active" class="form-control">
                <option value="1" {{ $popup->is_active ? 'selected' : '' }}>Sí</option>
                <option value="0" {{ !$popup->is_active ? 'selected' : '' }}>No</option>
            </select>
        </div>
        <div class="form-group">
            <label for="fecha_inicio">Fecha de inicio</label>
            <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" value="{{ old('fecha_inicio', $popup->fecha_inicio) }}" required>
        </div>
        <div class="form-group">
            <label for="fecha_fin">Fecha de fin</label>
            <input type="date" name="fecha_fin" id="fecha_fin" class="form-control" value="{{ old('fecha_fin', $popup->fecha_fin) }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar PopUp</button>
    </form>
</div>
@endsection
