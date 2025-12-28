

<?php $__env->startSection('title', 'Calendario Académico'); ?>
<?php $__env->startSection('content'); ?>
<div class="card" style="border-radius: 18px; box-shadow: 0 2px 16px rgba(0,158,96,0.10); margin-top: 2.5rem;">
    <div class="card-body p-5">
        <div class="mb-4 d-flex flex-column flex-md-row align-items-center justify-content-between" style="gap:1.2rem;">
            <h1 class="fw-bold mb-0" style="font-size:2.1rem; color:#1a3c34; letter-spacing:-1px; display:flex;align-items:center;gap:0.5em;">
                <span style="font-size:2.2rem;">📅</span> Gestión de Calendario Académico
            </h1>
            <a href="<?php echo e(route('admin.academic-calendar.create')); ?>" class="btn" style="background: linear-gradient(90deg,#009e60,#f9d423 90%); color: #fff; font-weight:600; box-shadow:0 2px 8px rgba(0,158,96,0.15); border-radius: 8px; padding: 0.75rem 1.5rem; font-size:1.1rem; transition:box-shadow .2s;">Crear calendario</a>
        </div>
        <?php if(session('success')): ?>
            <div class="alert alert-success"><?php echo e(session('success')); ?></div>
        <?php endif; ?>
        <div class="table-responsive">
            <table class="table align-middle" style="border-radius: 12px; overflow: hidden;">
                <thead style="background: linear-gradient(90deg,#009e60,#0e3e49 90%); color: #fff;">
                    <tr>
                        <th>Título</th>
                        <th>Desde</th>
                        <th>Hasta</th>
                        <th>Color</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr style="background: #fff;">
                            <td style="font-weight:600;"><?php echo e($event->title); ?></td>
                            <td><?php echo e($event->start_date->format('d/m/Y')); ?></td>
                            <td><?php echo e($event->end_date->format('d/m/Y')); ?></td>
                            <td>
                                <span style="background:<?php echo e($event->color); ?>;color:#fff; font-weight:600; border-radius:6px; padding:0.4em 1em; font-size:0.98em; box-shadow:0 2px 8px rgba(0,158,96,0.10);">
                                    <?php echo e($event->color); ?>

                                </span>
                            </td>
                            <td style="display:flex; gap:0.5em;">
                                <a href="<?php echo e(route('admin.academic-calendar.edit', $event)); ?>" class="btn" style="background: #009e60; color: #fff; font-weight:600; border-radius:8px; padding:0.5em 1.2em; font-size:1em; box-shadow:0 2px 8px rgba(0,158,96,0.10);">Editar</a>
                                <form action="<?php echo e(route('admin.academic-calendar.destroy', $event)); ?>" method="POST" style="display:inline-block;">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn" style="background: #e74c3c; color: #fff; font-weight:600; border-radius:8px; padding:0.5em 1.2em; font-size:1em; box-shadow:0 2px 8px rgba(231,76,60,0.10);" onclick="return confirm('¿Eliminar este calendario?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr><td colspan="5" class="text-center text-muted">No hay calendarios registrados.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center mt-4">
            <?php echo e($events->links()); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\workspace\ISTSSYSTEM\resources\views/admin/academic_calendar/index.blade.php ENDPATH**/ ?>