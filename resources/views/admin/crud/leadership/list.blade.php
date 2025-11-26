<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Equipo Directivo</title>
    <link rel="stylesheet" href="{{ asset('public/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/admin.css') }}">
</head>
<body>
    @include('admin.header')

    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Gestión de Equipo Directivo</h1>
            <a href="{{ url('/admin/leadership/create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Añadir Miembro
            </a>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th>Orden</th>
                                <th>Imagen</th>
                                <th>Nombre</th>
                                <th>Cargo</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($team as $member)
                                <tr>
                                    <td>{{ $member->display_order }}</td>
                                    <td>
                                        <img src="{{ asset($member->image_path) }}" alt="{{ $member->name }}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%;">
                                    </td>
                                    <td>{{ $member->name }}</td>
                                    <td>{{ $member->position }}</td>
                                    <td>
                                        <a href="{{ url('/admin/leadership/edit/' . $member->id) }}" class="btn btn-sm btn-warning" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ url('/admin/leadership/delete/' . $member->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" title="Eliminar" onclick="return confirm('¿Estás seguro de eliminar este miembro?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">No hay miembros registrados.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @include('admin.footer')
</body>
</html>