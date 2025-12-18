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

    <form action="<?php echo e(route('admin.teachers.update', $item)); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" name="name" id="name" class="form-control" value="<?php echo e(old('name', $item->name)); ?>" required>
        </div>
        <div class="form-group">
            <label for="title">Título</label>
            <input type="text" name="title" id="title" class="form-control" value="<?php echo e(old('title', $item->title)); ?>">
        </div>
        <div class="form-group">
            <label for="department">Departamento</label>
            <input type="text" name="department" id="department" class="form-control" value="<?php echo e(old('department', $item->department)); ?>">
        </div>
        <div class="form-group">
            <label for="bio">Biografía</label>
            <textarea name="bio" id="bio" class="form-control" rows="5"><?php echo e(old('bio', $item->bio)); ?></textarea>
        </div>
        <div class="form-group">
            <label for="image">Imagen</label>
            <input type="file" name="image" id="image" class="form-control">
            <?php if($item->image_path): ?>
                <img src="<?php echo e(asset('storage/' . $item->image_path)); ?>" alt="Imagen actual" style="max-width: 200px; margin-top: 10px;">
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label for="pdf">PDF (Currículum)</label>
            <input type="file" name="pdf" id="pdf" class="form-control">
            <?php if($item->pdf_path): ?>
                <p class="mt-2">
                    <a href="<?php echo e(asset('storage/' . $item->pdf_path)); ?>" target="_blank">Ver PDF actual</a>
                </p>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label for="order">Orden</label>
            <input type="number" name="order" id="order" class="form-control" value="<?php echo e(old('order', $item->order)); ?>">
        </div>
        <button type="submit" class="btn btn-primary">Actualizar Docente</button>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\workspace\ISTSSYSTEM\resources\views/admin/teachers/edit.blade.php ENDPATH**/ ?>