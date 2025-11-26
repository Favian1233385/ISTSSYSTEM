<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Slides - ISTS Admin</title>
    <link rel="stylesheet" href="{{ asset('public/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/admin.css') }}">
</head>
<body>
    @include('admin.header')

    <div class="container">
        <h2>Gestionar Slides del Carrusel</h2>
        <a href="{{ url('/admin/heroslides/create') }}" class="btn btn-primary mb-3">Crear Nuevo Slide</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Imagen</th>
                    <th>Título</th>
                    <th>Orden</th>
                    <th>Activo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($slides as $slide)
                <tr>
                    <td>{{ $slide['id'] }}</td>
                    <td><img src="{{ asset($slide['image_path']) }}" alt="" width="150"></td>
                    <td>{{ $slide['title'] }}</td>
                    <td>{{ $slide['sort_order'] }}</td>
                    <td>{{ $slide['is_active'] ? 'Sí' : 'No' }}</td>
                    <td>
                        <a href="{{ url('/admin/heroslides/edit/' . $slide['id']) }}" class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ url('/admin/heroslides/delete/' . $slide['id']) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('¿Estás seguro de que quieres eliminar este slide?');">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @include('admin.footer')
</body>
</html>