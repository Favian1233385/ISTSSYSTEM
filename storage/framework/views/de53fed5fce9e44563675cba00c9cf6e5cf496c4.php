

<?php $__env->startSection('content'); ?>
<div class="admin-content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Items del Menú Campus</h1>
        <a href="<?php echo e(route('admin.campus-items.create')); ?>" class="btn btn-primary">
            <i class="fas fa-plus"></i> Nuevo Item
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
                            <th>Orden</th>
                            <th>Título</th>
                            <th>Categoría</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $campusItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e($item->order); ?></td>
                                <td><?php echo e($item->title); ?></td>
                                <td>
                                    <span class="badge bg-<?php echo e($item->category === 'coordinaciones' ? 'primary' : 'info'); ?>">
                                        <?php echo e(ucfirst($item->category)); ?>

                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-<?php echo e($item->is_active ? 'success' : 'secondary'); ?>">
                                        <?php echo e($item->is_active ? 'Activo' : 'Inactivo'); ?>

                                    </span>
                                </td>
                                <td>
                                    <div style="display: flex; gap: 0.5rem;">
                                        <a href="<?php echo e(route('admin.campus-items.edit', $item)); ?>" 
                                           style="padding: 0.375rem 0.75rem; background-color: #ffc107; color: #000; text-decoration: none; border-radius: 4px; display: inline-block;">
                                            ✏️ Editar
                                        </a>
                                        <a href="<?php echo e(route('admin.campus-items.contents.index', $item)); ?>" 
                                           style="padding: 0.375rem 0.75rem; background-color: #0d6efd; color: #fff; text-decoration: none; border-radius: 4px; display: inline-block;">
                                            📄 Contenidos
                                        </a>
                                        <form action="<?php echo e(route('admin.campus-items.destroy', $item)); ?>" 
                                              method="POST" 
                                              style="display: inline-block; margin: 0;"
                                              onsubmit="return confirm('¿Estás seguro de eliminar este item?');">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" 
                                                    style="padding: 0.375rem 0.75rem; background-color: #dc3545; color: white; border: none; border-radius: 4px; cursor: pointer;">
                                                🗑️ Eliminar
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                       
                            <tr>
                                <td colspan="6" class="text-center">No hay items registrados</td>
                            </tr>
                        <?php endif; ?>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\workspace\ISTSSYSTEM\resources\views/admin/campus-items/index.blade.php ENDPATH**/ ?>