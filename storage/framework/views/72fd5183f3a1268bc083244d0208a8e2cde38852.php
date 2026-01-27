

<?php $__env->startSection('content'); ?>
<div class="container my-4">
    <div class="text-start mb-2">
        <span style="font-size:2.5rem; color:#7c3aed; background:#f3f4f6; border-radius:12px; padding:0.5rem 0.8rem; display:inline-block; margin-bottom:0.3rem;">
            💬
        </span>
        <h1 class="fw-bold" style="font-size:2.3rem; letter-spacing:0.5px; margin-bottom:0.7rem;">Crear PopUp Destacado</h1>
        <a href="<?php echo e(route('admin.popups.index')); ?>" class="btn" style="background: linear-gradient(90deg,#009e60,#1e3a8a 90%); color:#fff; font-weight:600; border-radius:8px; padding:0.6rem 1.6rem; font-size:1.08rem; box-shadow:0 2px 8px rgba(30,58,138,0.10);">← Volver a PopUps</a>
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
    <form action="<?php echo e(route('admin.popups.store')); ?>" method="POST" enctype="multipart/form-data" class="admin-form">
        <?php echo csrf_field(); ?>
        <div class="form-group">
            <label for="image_path">Imagen del PopUp (GIF/JPG/PNG)</label>
            <input type="file" name="image_path" id="image_path" class="form-control-file" accept="image/*">
            <small class="form-text text-muted">Ideal: 900x300px, puede ser animado (GIF).</small>
        </div>
        <div class="form-group">
            <label for="message">Mensaje del PopUp</label>
            <input type="text" name="message" id="message" class="form-control" maxlength="255">
        </div>
        <div class="form-group">
            <label for="link">Enlace del PopUp</label>
            <input type="url" name="link" id="link" class="form-control" maxlength="255" placeholder="https://...">
        </div>
        <div class="form-group">
            <label for="is_active">¿Activo?</label>
            <select name="is_active" id="is_active" class="form-control">
                <option value="1">Sí</option>
                <option value="0">No</option>
            </select>
        </div>
        <div class="form-group">
            <label for="fecha_inicio">Fecha de inicio</label>
            <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="fecha_fin">Fecha de fin</label>
            <input type="date" name="fecha_fin" id="fecha_fin" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar PopUp</button>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\workspace\ists\resources\views/admin/popups/create.blade.php ENDPATH**/ ?>