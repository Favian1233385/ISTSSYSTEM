
<?php $__env->startSection('title', 'Calendario Académico'); ?>
<?php $__env->startSection('content'); ?>
<div class="container py-4">
    <h1 class="mb-4">Gestión de Calendario Académico</h1>
    <a href="<?php echo e(route('admin.academic-calendar.create')); ?>" class="btn btn-primary mb-3">Crear calendario</a>
    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>
    <table class="table table-bordered">
        <thead>
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
            <tr>
                <td><?php echo e($event->title); ?></td>
                <td><?php echo e($event->start_date->format('d/m/Y')); ?></td>
                <td><?php echo e($event->end_date->format('d/m/Y')); ?></td>
                <td><span style="background:<?php echo e($event->color); ?>;padding:0.3em 1em;border-radius:4px;"><?php echo e($event->color); ?></span></td>
                <td>
                    <a href="<?php echo e(route('admin.academic-calendar.edit', $event)); ?>" class="btn btn-sm btn-warning">Editar</a>
                    <form action="<?php echo e(route('admin.academic-calendar.destroy', $event)); ?>" method="POST" style="display:inline-block;">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar este calendario?')">Eliminar</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr><td colspan="5">No hay calendarios registrados.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
    <?php echo e($events->links()); ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\workspace\ISTSSYSTEM\resources\views/admin/academic_calendar/index.blade.php ENDPATH**/ ?>