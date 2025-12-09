<?php $__env->startSection('content'); ?>
<div class="admin-content">
    <div class="dashboard-header">
        <h1>👩‍🏫 Añadir Docente</h1>
        <p>Rellena el formulario para añadir un nuevo docente.</p>
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

    <form action="<?php echo e(route('admin.teachers.store')); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" name="name" id="name" class="form-control" value="<?php echo e(old('name')); ?>" required>
        </div>
        <div class="form-group">
            <label for="title">Título</label>
            <input type="text" name="title" id="title" class="form-control" value="<?php echo e(old('title')); ?>">
        </div>
        <div class="form-group">
            <label for="department">Departamento</label>
            <input type="text" name="department" id="department" class="form-control" value="<?php echo e(old('department')); ?>">
        </div>
        <div class="form-group">
            <label for="bio">Biografía</label>
            <textarea name="bio" id="bio" class="form-control" rows="5"><?php echo e(old('bio')); ?></textarea>
        </div>
        <div class="form-group">
            <label for="image">Imagen</label>
            <input type="file" name="image" id="image" class="form-control">
        </div>
        <div class="form-group">
            <label for="pdf">PDF (Currículum)</label>
            <input type="file" name="pdf" id="pdf" class="form-control">
        </div>
        <div class="form-group">
            <label for="order">Orden</label>
            <input type="number" name="order" id="order" class="form-control" value="<?php echo e(old('order', 0)); ?>">
        </div>
        <button type="submit" class="btn btn-primary">Añadir Docente</button>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\workspace\ISTSSYSTEM\resources\views/admin/teachers/create.blade.php ENDPATH**/ ?>