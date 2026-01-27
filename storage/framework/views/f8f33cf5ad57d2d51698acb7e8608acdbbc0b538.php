

<?php $__env->startSection('title', 'Nueva Modalidad Académica'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">➕ Nueva Modalidad Académica</h1>
        <a href="<?php echo e(route('admin.academic_modalities.index')); ?>" class="btn btn-secondary">Volver</a>
    </div>
    <div class="card">
        <div class="card-body">
            <form action="<?php echo e(route('admin.academic_modalities.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="mb-3">
                    <label for="title" class="form-label">Título</label>
                    <input type="text" name="title" id="title" class="form-control" value="<?php echo e(old('title')); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Descripción</label>
                    <textarea name="description" id="description" class="form-control" rows="3"><?php echo e(old('description')); ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="icon" class="form-label">Icono (opcional, clase CSS)</label>
                    <input type="text" name="icon" id="icon" class="form-control" value="<?php echo e(old('icon')); ?>">
                </div>
                <div class="mb-3">
                    <label for="order" class="form-label">Orden</label>
                    <input type="number" name="order" id="order" class="form-control" value="<?php echo e(old('order', 0)); ?>">
                </div>
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" <?php echo e(old('is_active', true) ? 'checked' : ''); ?>>
                    <label class="form-check-label" for="is_active">Activo</label>
                </div>
                <button type="submit" class="btn btn-primary">Guardar Modalidad</button>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\workspace\ists\resources\views/admin/academic_modalities/create.blade.php ENDPATH**/ ?>