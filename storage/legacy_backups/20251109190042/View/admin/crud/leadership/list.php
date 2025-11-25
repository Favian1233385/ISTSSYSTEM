<?php
// Cargar el layout del admin
include 'app/views/admin/layout.php';
?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Gestión de Equipo Directivo</h1>
        <a href="<?= BASE_URL ?>/leadership/create" class="btn btn-primary">
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
                        <?php if (isset($data['team']) && !empty($data['team'])): ?>
                            <?php foreach ($data['team'] as $member): ?>
                                <tr>
                                    <td><?= htmlspecialchars($member['display_order']) ?></td>
                                    <td>
                                        <img src="<?= BASE_URL . htmlspecialchars($member['image_path']) ?>" alt="<?= htmlspecialchars($member['name']) ?>" style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%;">
                                    </td>
                                    <td><?= htmlspecialchars($member['name']) ?></td>
                                    <td><?= htmlspecialchars($member['position']) ?></td>
                                    <td>
                                        <a href="<?= BASE_URL ?>/leadership/edit/<?= $member['id'] ?>" class="btn btn-sm btn-warning" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="<?= BASE_URL ?>/leadership/destroy/<?= $member['id'] ?>" class="btn btn-sm btn-danger" title="Eliminar" onclick="return confirm('¿Estás seguro de que quieres eliminar a este miembro?');">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center">No hay miembros del equipo registrados.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
