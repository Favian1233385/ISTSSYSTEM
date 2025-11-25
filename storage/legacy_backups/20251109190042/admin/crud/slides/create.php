<?php
// Vistas/admin/crud/slides/create.php
include __DIR__ . '../../../admin/header.php';
?>

<div class="container">
    <h2>Crear Nuevo Slide</h2>

    <?php if (isset($data['error'])): ?>
        <div class="alert alert-danger"><?php echo $data['error']; ?></div>
    <?php endif; ?>

    <form action="/admin/heroslides/store" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="title">Título</label>
            <input type="text" id="title" name="title" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="subtitle">Subtítulo</label>
            <textarea id="subtitle" name="subtitle" class="form-control"></textarea>
        </div>

        <div class="form-group">
            <label for="image">Imagen</label>
            <input type="file" id="image" name="image" class="form-control-file" required>
        </div>

        <div class="form-group">
            <label for="link">Enlace (URL)</label>
            <input type="url" id="link" name="link" class="form-control" placeholder="https://ejemplo.com">
        </div>

        <div class="form-group">
            <label for="sort_order">Orden de Aparición</label>
            <input type="number" id="sort_order" name="sort_order" class="form-control" value="0">
        </div>

        <div class="form-check">
            <input type="checkbox" id="is_active" name="is_active" class="form-check-input" value="1" checked>
            <label for="is_active" class="form-check-label">Activo</label>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Guardar Slide</button>
        <a href="/admin/heroslides" class="btn btn-secondary mt-3">Cancelar</a>
    </form>
</div>

<?php include __DIR__ . '../../../admin/footer.php'; ?>
