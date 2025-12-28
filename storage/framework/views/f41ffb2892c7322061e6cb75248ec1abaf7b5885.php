

<?php $__env->startSection('title', 'Secciones de Visitar'); ?>

<?php $__env->startSection('content'); ?>
<div class="card" style="border-radius: 18px; box-shadow: 0 2px 16px rgba(0,158,96,0.10); margin-top: 2.5rem;">
    <div class="card-body p-5">
        <div class="mb-4 d-flex flex-column flex-md-row align-items-center justify-content-between" style="gap:1.2rem;">
            <h1 class="fw-bold mb-0" style="font-size:2.1rem; color:#1a3c34; letter-spacing:-1px; display:flex;align-items:center;gap:0.5em;">
                <span style="font-size:2.2rem;">🏢</span> Secciones de Visitar
            </h1>
            <a href="<?php echo e(route('admin.visit-sections.create')); ?>" class="btn" style="background: linear-gradient(90deg,#009e60,#f9d423 90%); color: #fff; font-weight:600; box-shadow:0 2px 8px rgba(0,158,96,0.15); border-radius: 8px; padding: 0.75rem 1.5rem; font-size:1.1rem; transition:box-shadow .2s;">+ Nueva Sección</a>
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
                        <th>Slug</th>
                        <th>Email</th>
                        <th>Teléfono</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr style="background: #fff;">
                            <td><?php echo e($section->sort_order); ?></td>
                            <td style="font-weight:600;"><?php echo e($section->title); ?></td>
                            <td><code><?php echo e($section->slug); ?></code></td>
                            <td><small><?php echo e($section->email ?? 'N/A'); ?></small></td>
                            <td><small><?php echo e($section->phone ?? 'N/A'); ?></small></td>
                            <td>
                                <span class="badge" style="background:<?php echo e($section->is_active ? '#009e60' : '#f9d423'); ?>;color:#fff; font-weight:600; border-radius:6px; padding:0.4em 1em; font-size:0.98em;">
                                    <?php echo e($section->is_active ? '✓ Activo' : '✗ Inactivo'); ?>

                                </span>
                            </td>
                            <td style="display:flex; gap:0.5em;">
                                <a href="<?php echo e(route('visitar.section', $section->slug)); ?>" class="btn" style="background: #253b7d; color: #fff; font-weight:600; border-radius:8px; padding:0.5em 1.2em; font-size:1em; box-shadow:0 2px 8px rgba(37,59,125,0.10);" title="Ver en sitio público" target="_blank">👁️</a>
                                <a href="<?php echo e(route('admin.visit-sections.edit', $section->id)); ?>" class="btn" style="background: #009e60; color: #fff; font-weight:600; border-radius:8px; padding:0.5em 1.2em; font-size:1em; box-shadow:0 2px 8px rgba(0,158,96,0.10);" title="Editar">✏️</a>
                                <form action="<?php echo e(route('admin.visit-sections.destroy', $section->id)); ?>" method="POST" style="display:inline-block;">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn" style="background: #e74c3c; color: #fff; font-weight:600; border-radius:8px; padding:0.5em 1.2em; font-size:1em; box-shadow:0 2px 8px rgba(231,76,60,0.10);" title="Eliminar" onclick="return confirm('¿Está seguro de eliminar esta sección?')">🗑️</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                <p class="text-muted mb-0">No hay secciones registradas</p>
                                <a href="<?php echo e(route('admin.visit-sections.create')); ?>" class="btn btn-sm btn-primary mt-2">Crear la primera sección</a>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center mt-4">
            <?php echo e($sections->links()); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\workspace\ISTSSYSTEM\resources\views/admin/visit-sections/index.blade.php ENDPATH**/ ?>