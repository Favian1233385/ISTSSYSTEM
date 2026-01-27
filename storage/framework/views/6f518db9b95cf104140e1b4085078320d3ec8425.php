<?php $__env->startSection('content'); ?>
<div class="admin-content">
    <div class="dashboard-header">
        <h1>👩‍🏫 Editar Docente</h1>
        <p>Modifica el formulario para editar un docente.</p>
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

    <form class="card p-4 shadow-sm mx-auto" style="max-width:900px; min-width:340px;" method="POST" action="<?php echo e(route('admin.teachers.update', $item->id)); ?>" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        <div class="mb-3">
            <label for="name" class="form-label fw-bold text-primary">Nombre</label>
            <input type="text" name="name" id="name" class="form-control" value="<?php echo e(old('name', $item->name)); ?>" required>
        </div>
        <div class="mb-3">
            <label for="title" class="form-label fw-bold text-primary">Título</label>
            <input type="text" name="title" id="title" class="form-control" value="<?php echo e(old('title', $item->title)); ?>">
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="department" class="form-label fw-bold text-primary">Departamento</label>
                <input type="text" name="department" id="department" class="form-control" value="<?php echo e(old('department', $item->department)); ?>">
            </div>
            <div class="col">
                <label for="order" class="form-label fw-bold text-primary">Orden</label>
                <input type="number" name="order" id="order" value="<?php echo e(old('order', $item->order)); ?>" class="form-control">
            </div>
        </div>
        <div class="mb-3">
            <label for="bio" class="form-label fw-bold text-primary">Biografía</label>
            <textarea name="bio" id="bio" class="form-control tinymce-editor"><?php echo e(old('bio', $item->bio)); ?></textarea>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="image" class="form-label fw-bold text-primary">Imagen</label>
                <input type="file" name="image" id="image" accept="image/*" class="form-control">
            </div>
            <div class="col">
                <label for="pdf" class="form-label fw-bold text-primary">PDF (Currículum)</label>
                <input type="file" name="pdf" id="pdf" accept="application/pdf" class="form-control">
            </div>
        </div>
        <div class="admin-action-buttons">
            <a href="<?php echo e(route('admin.teachers.index')); ?>" class="btn btn-secondary shadow-sm fw-semibold border-0 d-flex align-items-center justify-content-center">
                <i class="bi bi-x-circle me-2"></i> Cancelar
            </a>
            <button type="submit" class="btn btn-primary shadow-sm fw-semibold border-0 d-flex align-items-center justify-content-center">
                <i class="bi bi-save me-2"></i> Actualizar Docente
            </button>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\workspace\ists\resources\views/admin/teachers/edit.blade.php ENDPATH**/ ?>