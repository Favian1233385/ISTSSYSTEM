<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Slide - ISTS Admin</title>
    <link rel="stylesheet" href="{{ asset('public/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/admin.css') }}">
</head>
<body>
    @include('admin.header')

    <div class="container">
        <h2>Editar Slide</h2>

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="{{ url('/admin/heroslides/update/' . $slide['id']) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="title">Título</label>
                <input type="text" id="title" name="title" class="form-control" value="{{ old('title', $slide['title']) }}" required>
            </div>

            <div class="form-group">
                <label for="subtitle">Subtítulo</label>
                <textarea id="subtitle" name="subtitle" class="form-control">{{ old('subtitle', $slide['subtitle']) }}</textarea>
            </div>

            <div class="form-group">
                <label for="image">Imagen</label>
                <p>Imagen actual:</p>
                <img src="{{ asset($slide['image_path']) }}" alt="" width="200">
                <p class="mt-2">Subir nueva imagen (opcional):</p>
                <input type="file" id="image" name="image" class="form-control-file">
            </div>

            <div class="form-group">
                <label for="link">Enlace (URL)</label>
                <input type="url" id="link" name="link" class="form-control" value="{{ old('link', $slide['link']) }}" placeholder="https://ejemplo.com">
            </div>

            <div class="form-group">
                <label for="sort_order">Orden de Aparición</label>
                <input type="number" id="sort_order" name="sort_order" class="form-control" value="{{ old('sort_order', $slide['sort_order']) }}">
            </div>

            <div class="form-check">
                <input type="checkbox" id="is_active" name="is_active" class="form-check-input" value="1" {{ old('is_active', $slide['is_active']) ? 'checked' : '' }}>
                <label for="is_active" class="form-check-label">Activo</label>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Actualizar Slide</button>
            <a href="{{ url('/admin/heroslides') }}" class="btn btn-secondary mt-3">Cancelar</a>
        </form>
    </div>

    @include('admin.footer')
</body>
</html>