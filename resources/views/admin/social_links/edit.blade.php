@extends('admin.layout')

@section('content')
    <h1>Editar enlace de {{ ucfirst($link->name) }}</h1>
    <form method="POST" action="{{ route('admin.social_links.update', $link->id) }}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="url">Enlace</label>
            <input type="url" name="url" id="url" class="form-control" value="{{ old('url', $link->url) }}" required>
            @error('url')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="bg_color">Color de fondo (hex o CSS)</label>
            <input type="text" name="bg_color" id="bg_color" class="form-control" value="{{ old('bg_color', $link->bg_color) }}" required>
        </div>
        <div class="form-group">
            <label for="icon_svg">SVG del ícono</label>
            <textarea name="icon_svg" id="icon_svg" class="form-control" rows="3" required>{{ old('icon_svg', $link->icon_svg) }}</textarea>
            <small>Pega aquí el código SVG (sin etiquetas &lt;script&gt;).</small>
        </div>
        <div class="form-check">
            <input type="checkbox" name="active" id="active" class="form-check-input" {{ $link->active ? 'checked' : '' }}>
            <label for="active" class="form-check-label">Activo</label>
        </div>
        <button type="submit" class="btn btn-success mt-2">Guardar</button>
        <a href="{{ route('admin.social_links.index') }}" class="btn btn-secondary mt-2">Cancelar</a>
    </form>
@endsection
