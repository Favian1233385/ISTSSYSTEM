<?php
// Vistas/admin/crud/slides/list.php
include __DIR__ . '../../../admin/header.php';
?>

<div class="container">
    <h2>Gestionar Slides del Carrusel</h2>
    <a href="/admin/heroslides/create" class="btn btn-primary mb-3">Crear Nuevo Slide</a>

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
            <?php foreach ($data['slides'] as $slide): ?>
            <tr>
                <td><?php echo htmlspecialchars($slide['id']); ?></td>
                <td><img src="/<?php echo htmlspecialchars($slide['image_path']); ?>" alt="" width="150"></td>
                <td><?php echo htmlspecialchars($slide['title']); ?></td>
                <td><?php echo htmlspecialchars($slide['sort_order']); ?></td>
                <td><?php echo $slide['is_active'] ? 'Sí' : 'No'; ?></td>
                <td>
                    <a href="/admin/heroslides/edit/<?php echo $slide['id']; ?>" class="btn btn-sm btn-warning">Editar</a>
                    <form action="/admin/heroslides/delete/<?php echo $slide['id']; ?>" method="POST" style="display: inline-block;" onsubmit="return confirm('¿Estás seguro de que quieres eliminar este slide?');">
                        <button type-="submit" class="btn btn-sm btn-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include __DIR__ . '../../../admin/footer.php'; ?>
