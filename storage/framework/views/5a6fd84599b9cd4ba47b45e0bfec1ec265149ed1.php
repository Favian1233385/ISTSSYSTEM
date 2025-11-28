

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Gestión de Autoridades</h1>
    <p class="mb-4">Aquí puedes administrar las autoridades de la institución (Rector, Vicerrector, OCS, etc.).</p>

    <?php if(session('success')): ?>
        <div class="alert alert-success">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="<?php echo e(route('admin.autoridades.create')); ?>" class="btn btn-primary">
                <i class="fas fa-plus"></i> Crear Nueva Autoridad
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Orden</th>
                            <th>Nombre</th>
                            <th>Cargo</th>
                            <th>Categoría</th>
                            <th style="width: 150px;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $autoridades; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $autoridad): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($autoridad->orden); ?></td>
                            <td><?php echo e($autoridad->nombre); ?></td>
                            <td><?php echo e($autoridad->cargo); ?></td>
                            <td><?php echo e($autoridad->categoria); ?></td>
                            <td>
                                <a href="<?php echo e(route('admin.autoridades.edit', $autoridad->id)); ?>" class="btn btn-sm btn-warning" title="Editar">
                                    <i class="fas fa-edit"></i> Editar
                                </a>
                                <form action="<?php echo e(route('admin.autoridades.destroy', $autoridad->id)); ?>" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de que quieres eliminar esta autoridad?');">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-sm btn-danger" title="Eliminar">
                                        <i class="fas fa-trash"></i> Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="5" class="text-center">No hay autoridades creadas todavía.</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\worspace\ISTSSYSTEM\resources\views/admin/autoridades/index.blade.php ENDPATH**/ ?>