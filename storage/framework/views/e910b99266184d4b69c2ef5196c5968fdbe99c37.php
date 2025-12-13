

<?php $__env->startSection('title', 'Modalidades Académicas'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">📚 Modalidades Académicas</h1>
        <a href="<?php echo e(route('admin.academic_modalities.create')); ?>" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Nueva Modalidad
        </a>
    </div>

    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="card">
        <div class="card-body">
            <?php if($modalities->count() > 0): ?>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Orden</th>
                                <th>Título</th>
                                <th>Descripción</th>
                                <th>Icono</th>
                                <th>Estado</th>
                                <th>Programas</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $modalities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $modality): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($modality->order); ?></td>
                                    <td><strong><?php echo e($modality->title); ?></strong></td>
                                    <td><?php echo e(Str::limit($modality->description, 50)); ?></td>
                                    <td><?php if($modality->icon): ?><i class="<?php echo e($modality->icon); ?>"></i><?php else: ?> <span class="text-muted">-</span> <?php endif; ?></td>
                                    <td>
                                        <?php if($modality->is_active): ?>
                                            <span class="badge bg-success">Activo</span>
                                        <?php else: ?>
                                            <span class="badge bg-secondary">Inactivo</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="<?php echo e(route('admin.academic_modalities.programs.index', $modality->id)); ?>" class="btn btn-sm btn-outline-info">Ver Programas</a>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="<?php echo e(route('admin.academic_modalities.edit', $modality)); ?>" class="btn btn-sm btn-outline-primary" title="Editar"><i class="bi bi-pencil"></i></a>
                                            <form action="<?php echo e(route('admin.academic_modalities.destroy', $modality)); ?>" method="POST" onsubmit="return confirm('¿Está seguro de eliminar esta modalidad?');" class="d-inline">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Eliminar"><i class="bi bi-trash"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="text-center py-5">
                    <i class="bi bi-inbox" style="font-size: 3rem; color: #ccc;"></i>
                    <p class="text-muted mt-3">No hay modalidades académicas creadas.</p>
                    <a href="<?php echo e(route('admin.academic_modalities.create')); ?>" class="btn btn-primary">
                        <i class="bi bi-plus-lg"></i> Crear Primera Modalidad
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\workspace\ISTSSYSTEM\resources\views/admin/academic_modalities/index.blade.php ENDPATH**/ ?>