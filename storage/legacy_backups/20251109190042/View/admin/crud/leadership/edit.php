<?php
// Cargar el layout del admin
include 'app/views/admin/layout.php';
?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Editar Miembro del Equipo</h1>
        <a href="<?= BASE_URL ?>/leadership/index" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Volver a la Lista
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <?php if (isset($data['member'])): ?>
            <form action="<?= BASE_URL ?>/leadership/update/<?= $data['member']['id'] ?>" method="POST">
                <div class="form-group mb-3">
                    <label for="name" class="form-label">Nombre Completo</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($data['member']['name']) ?>" required>
                </div>

                <div class="form-group mb-3">
                    <label for="position" class="form-label">Cargo</label>
                    <input type="text" class="form-control" id="position" name="position" value="<?= htmlspecialchars($data['member']['position']) ?>" required>
                </div>

                <div class="form-group mb-3">
                    <label for="bio" class="form-label">Biografía</label>
                    <textarea class="form-control" id="bio" name="bio" rows="4"><?= htmlspecialchars($data['member']['bio']) ?></textarea>
                </div>

                <div class="form-group mb-3">
                    <label for="image_path" class="form-label">Ruta de la Imagen</label>
                    <input type="text" class="form-control" id="image_path" name="image_path" value="<?= htmlspecialchars($data['member']['image_path']) ?>" placeholder="/assets/images/nombre-archivo.jpg">
                    <small class="form-text text-muted">Por ahora, ingrese la ruta manualmente. Ejemplo: /assets/images/director.jpg</small>
                </div>

                <div class="form-group mb-3">
                    <label for="display_order" class="form-label">Orden de Visualización</label>
                    <input type="number" class="form-control" id="display_order" name="display_order" value="<?= htmlspecialchars($data['member']['display_order']) ?>" required>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Actualizar Miembro
                </button>
            </form>
            <?php else: ?>
                <p class="alert alert-danger">No se encontró el miembro del equipo para editar.</p>
            <?php endif; ?>
        </div>
    </div>
</div>
