

<?php $__env->startSection('title', 'Slides del Carrusel'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <h2>Listado de slides</h2>
    <a href="<?php echo e(route('admin.hero-slides.create')); ?>" class="btn btn-primary mb-3">Crear nuevo slide</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Subtítulo</th>
                <th>Imagen</th>
                <th>Enlace</th>
                <th>Orden</th>
                <th>Activo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $slides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($slide->id); ?></td>
                    <td><?php echo e($slide->title); ?></td>
                    <td><?php echo e($slide->subtitle); ?></td>
                    <td>
                        <?php if($slide->image_path): ?>
                            <img src="<?php echo e(asset('uploads/images/' . $slide->image_path)); ?>" alt="<?php echo e($slide->title); ?>" style="width: 100px;">
                        <?php endif; ?>
                    </td>
                    <td><?php echo e($slide->link); ?></td>
                    <td><?php echo e($slide->sort_order); ?></td>
                    <td><?php echo e($slide->is_active ? 'Sí' : 'No'); ?></td>
                    <td>
                        <a href="<?php echo e(route('admin.hero-slides.edit', $slide->id)); ?>" class="btn btn-warning btn-sm">Editar</a>
                        <form action="<?php echo e(route('admin.hero-slides.destroy', $slide->id)); ?>" method="POST" style="display:inline;">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar este slide?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="8">No hay slides registrados.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\workspace\ISTSSYSTEM\resources\views/admin/hero-slides/index.blade.php ENDPATH**/ ?>