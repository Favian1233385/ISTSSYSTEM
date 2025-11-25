

<?php $__env->startSection('title', 'Gestión de Carreras'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Gestión de Carreras / Coordinaciones</h1>
        <a href="<?php echo e(route('admin.careers.create')); ?>" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Nueva Carrera
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
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th style="width: 80px;">Imagen</th>
                            <th>Nombre</th>
                            <th>Coordinador</th>
                            <th style="width: 100px;">Orden</th>
                            <th style="width: 100px;">Estado</th>
                            <th style="width: 200px;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $careers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $career): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td>
                                    <?php if($career->image_path): ?>
                                        <img src="<?php echo e(asset('storage/' . $career->image_path)); ?>" 
                                             alt="<?php echo e($career->name); ?>" 
                                             class="img-thumbnail"
                                             style="width: 60px; height: 60px; object-fit: cover;">
                                    <?php else: ?>
                                        <div class="bg-secondary text-white d-flex align-items-center justify-content-center" 
                                             style="width: 60px; height: 60px; border-radius: 4px;">
                                            <i class="bi bi-book" style="font-size: 24px;"></i>
                                        </div>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <strong><?php echo e($career->name); ?></strong>
                                    <?php if($career->description): ?>
                                        <br><small class="text-muted"><?php echo e(Str::limit($career->description, 60)); ?></small>
                                    <?php endif; ?>
                                    <?php if(!$career->image_path || !$career->image_path_2): ?>
                                        <br><small class="badge" style="background: #ff6b6b; color: white; font-size: 10px;">
                                            ⚠️ Falta<?php echo e(!$career->image_path && !$career->image_path_2 ? 'n' : ''); ?> imagen<?php echo e(!$career->image_path && !$career->image_path_2 ? 'es' : ''); ?>

                                        </small>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php echo e($career->coordinator ?? '-'); ?>

                                    <?php if($career->coordinator_email): ?>
                                        <br><small class="text-muted"><?php echo e($career->coordinator_email); ?></small>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo e($career->sort_order); ?></td>
                                <td>
                                    <?php if($career->is_active): ?>
                                        <span class="badge bg-success">Activa</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary">Inactiva</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-1">
                                        <a href="<?php echo e(route('career.show', $career->slug)); ?>" 
                                           class="btn btn-sm btn-info" target="_blank">
                                            <i class="bi bi-eye"></i> Ver
                                        </a>
                                        <form action="<?php echo e(route('admin.careers.destroy', $career)); ?>" 
                                              method="POST" 
                                              class="d-inline"
                                              onsubmit="return confirm('¿Estás seguro de eliminar esta carrera?');">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="bi bi-trash"></i> Eliminar
                                            </button>
                                        </form>
                                        <a href="<?php echo e(route('admin.careers.edit', $career)); ?>" 
                                           class="btn btn-sm btn-primary">
                                            <i class="bi bi-pencil"></i> Editar
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="6" class="text-center py-4">
                                    <p class="text-muted mb-0">No hay carreras registradas.</p>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\worspace\ISTSSYSTEM\resources\views/admin/careers/index.blade.php ENDPATH**/ ?>