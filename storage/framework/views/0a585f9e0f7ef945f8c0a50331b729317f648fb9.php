

<?php $__env->startSection('content'); ?>
<div class="card" style="border-radius: 18px; box-shadow: 0 2px 16px rgba(0,158,96,0.10); margin-top: 2.5rem; max-width: 1100px; margin-left:auto; margin-right:auto;">
    <div class="card-body p-5">
        <div class="mb-4 d-flex flex-column flex-md-row align-items-center justify-content-between" style="gap:1.2rem;">
            <h1 class="fw-bold mb-0" style="font-size:2.1rem; color:#1a3c34; letter-spacing:-1px; display:flex;align-items:center;gap:0.5em;">
                <span style="font-size:2.2rem;">📋</span> Items del Menú Servicios
            </h1>
            <a href="<?php echo e(route('admin.campus-items.create')); ?>" class="btn" style="background: linear-gradient(90deg,#009e60,#f9d423 90%); color: #fff; font-weight:600; box-shadow:0 2px 8px rgba(0,158,96,0.15); border-radius: 8px; padding: 0.75rem 1.5rem; font-size:1.1rem; transition:box-shadow .2s;">+ Nuevo Item</a>
        </div>
        <?php if(session('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert"><?php echo e(session('success')); ?><button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
        <?php endif; ?>
        <div class="table-responsive">
            <table class="table align-middle" style="border-radius: 12px; overflow: hidden;">
                <thead style="background: linear-gradient(90deg,#009e60,#0e3e49 90%); color: #fff;">
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
                                <span class="badge" style="background:<?php echo e($item->category === 'coordinaciones' ? '#253b7d' : '#009e60'); ?>;color:#fff; font-weight:600; border-radius:6px; padding:0.4em 1em; font-size:0.98em;">
                                    <?php echo e(ucfirst($item->category)); ?>

                                </span>
                            </td>
                            <td>
                                <span class="badge" style="background:<?php echo e($item->is_active ? '#009e60' : '#f9d423'); ?>;color:#fff; font-weight:600; border-radius:6px; padding:0.4em 1em; font-size:0.98em;">
                                    <?php echo e($item->is_active ? 'Activo' : 'Inactivo'); ?>

                                </span>
                            </td>
                            <td style="display:flex; gap:0.5em;">
                                <a href="<?php echo e(route('admin.campus-items.edit', $item)); ?>" class="btn" style="background: linear-gradient(90deg,#f9d423,#ffb347 90%); color: #222; font-weight:600; border-radius:8px; padding:0.5em 1.2em; font-size:1em; min-width:110px; text-align:center; display:flex; align-items:center; gap:0.5em;">
                                    <i class="bi bi-pencil"></i> Editar
                                </a>
                                <a href="<?php echo e(route('admin.campus-items.contents.index', $item)); ?>" class="btn" style="background: #0d6efd; color: #fff; font-weight:600; border-radius:8px; padding:0.5em 1.2em; font-size:1em; min-width:110px; text-align:center; display:flex; align-items:center; gap:0.5em;">
                                    <i class="bi bi-file-earmark-text"></i> Contenidos
                                </a>
                                <form action="<?php echo e(route('admin.campus-items.destroy', $item)); ?>" method="POST" style="display:inline;">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn" style="background: #e74c3c; color: #fff; font-weight:600; border-radius:8px; padding:0.5em 1.2em; font-size:1em; min-width:110px; text-align:center; display:flex; align-items:center; gap:0.5em;" onclick="return confirm('¿Estás seguro de eliminar este item?');">
                                        <i class="bi bi-trash"></i> Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">No hay items registrados</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\workspace\ists\resources\views/admin/campus-items/index.blade.php ENDPATH**/ ?>