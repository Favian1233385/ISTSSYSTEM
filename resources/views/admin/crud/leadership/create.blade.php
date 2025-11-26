<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir Nuevo Miembro</title>
    <link rel="stylesheet" href="{{ asset('public/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/admin.css') }}">
</head>
<body>
    @include('admin.header')

    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Añadir Nuevo Miembro al Equipo</h1>
            <a href="{{ url('/admin/leadership') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Volver a la Lista
            </a>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="{{ url('/admin/leadership/store') }}" method="POST">
                    @csrf

                    <div class="form-group mb-3">
                        <label for="name" class="form-label">Nombre Completo</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="position" class="form-label">Cargo</label>
                        <input type="text" class="form-control" id="position" name="position" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="bio" class="form-label">Biografía</label>
                        <textarea class="form-control" id="bio" name="bio" rows="4"></textarea>
                    </div>

                    <div class="form-group mb-3">
                        <label for="image_path" class="form-label">Ruta de la Imagen</label>
                        <input type="text" class="form-control" id="image_path" name="image_path" placeholder="/assets/images/nombre-archivo.jpg">
                        <small class="form-text text-muted">Por ahora, ingrese la ruta manualmente. Ejemplo: /assets/images/director.jpg</small>
                    </div>

                    <div class="form-group mb-3">
                        <label for="display_order" class="form-label">Orden de Visualización</label>
                        <input type="number" class="form-control" id="display_order" name="display_order" value="0" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>
    </div>

    @include('admin.footer')
</body>
</html>