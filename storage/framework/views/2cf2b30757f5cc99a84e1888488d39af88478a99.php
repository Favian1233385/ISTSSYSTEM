

<?php $__env->startSection('content'); ?>
<div class="admin-container">
    <div class="admin-header">
        <h1>Editar PopUp Destacado</h1>
        <a href="<?php echo e(route('admin.popups.index')); ?>" class="btn btn-secondary">← Volver a PopUps</a>
    </div>
    <?php if($errors->any()): ?>
        <div class="alert alert-danger">
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>
    <form action="<?php echo e(route('admin.popups.update', $popup)); ?>" method="POST" enctype="multipart/form-data" class="admin-form">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        <div class="form-group">
            <label for="image_path">Imagen del PopUp (GIF/JPG/PNG)</label>
            <?php if($popup->image_path): ?>
                <div class="mb-2">
                    <img src="<?php echo e(asset('storage/' . $popup->image_path)); ?>" alt="Banner actual" style="max-width:320px; border-radius:8px; box-shadow:0 2px 8px rgba(0,0,0,0.10);">
                    <p class="text-muted small mt-1">Banner actual</p>
                </div>
            <?php endif; ?>
            <input type="file" name="image_path" id="image_path" class="form-control-file" accept="image/*">
            <small class="form-text text-muted">Ideal: 900x300px, puede ser animado (GIF).</small>
        </div>
        <div class="form-group">
            <label for="message">Mensaje del PopUp</label>
            <input type="text" name="message" id="message" class="form-control" maxlength="255" value="<?php echo e(old('message', $popup->message)); ?>">
        </div>
        <div class="form-group">
            <label for="link">Enlace del PopUp</label>
            <input type="url" name="link" id="link" class="form-control" maxlength="255" placeholder="https://..." value="<?php echo e(old('link', $popup->link)); ?>">
        </div>
        <div class="form-group">
            <label for="is_active">¿Activo?</label>
            <select name="is_active" id="is_active" class="form-control">
                <option value="1" <?php echo e($popup->is_active ? 'selected' : ''); ?>>Sí</option>
                <option value="0" <?php echo e(!$popup->is_active ? 'selected' : ''); ?>>No</option>
            </select>
        </div>
        <div class="form-group">
            <label for="fecha_inicio">Fecha de inicio</label>
            <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" value="<?php echo e(old('fecha_inicio', $popup->fecha_inicio)); ?>" required>
        </div>
        <div class="form-group">
            <label for="fecha_fin">Fecha de fin</label>
            <input type="date" name="fecha_fin" id="fecha_fin" class="form-control" value="<?php echo e(old('fecha_fin', $popup->fecha_fin)); ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar PopUp</button>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\workspace\ists\resources\views/admin/popups/edit.blade.php ENDPATH**/ ?>