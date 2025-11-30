<?php $__env->startSection('content'); ?>
<div class="admin-content">
    <div class="dashboard-header">
        <h1>👩‍🏫 Gestión de Planta Docente</h1>
        <p>Administra la planta docente del instituto.</p>
        <a href="<?php echo e(route('admin.teachers.create')); ?>" class="btn btn-primary">Añadir Docente</a>
    </div>

    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>
    <?php if($errors->any()): ?>
        <div class="alert alert-danger">
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Orden</th>
                    <th>Imagen</th>
                    <th>Nombre</th>
                    <th>Título</th>
                    <th>Departamento</th>
                    <th>PDF</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($item->order); ?></td>
                        <td>
                            <?php if($item->image_path): ?>
                                <img src="<?php echo e(asset('storage/' . $item->image_path)); ?>" alt="<?php echo e($item->name); ?>" style="max-width: 50px; border-radius: 50%;">
                            <?php endif; ?>
                        </td>
                        <td><?php echo e($item->name); ?></td>
                        <td><?php echo e($item->title); ?></td>
                        <td><?php echo e($item->department); ?></td>
                        <td>
                            <?php if($item->pdf_path): ?>
                                <a href="<?php echo e(asset('storage/' . $item->pdf_path)); ?>" target="_blank">Ver PDF</a>
                            <?php endif; ?>
                        </td>
                        <td class="actions">
                            <a href="<?php echo e(route('admin.teachers.edit', $item)); ?>" class="btn btn-sm btn-secondary">Editar</a>
                            <form action="<?php echo e(route('admin.teachers.destroy', $item)); ?>" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de que quieres eliminar a este docente?');">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>

    <!-- Paginación -->
    <?php echo e($items->links()); ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\worspace\ISTSSYSTEM\resources\views/admin/teachers/index.blade.php ENDPATH**/ ?>