

<?php $__env->startSection('content'); ?>
<div class="admin-container">
    <div class="admin-header">
        <h1>📅 Eventos institucionales</h1>
        <a href="<?php echo e(route('admin.events.create')); ?>" class="btn btn-primary">Crear evento</a>
    </div>
    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Fecha</th>
                    <th>Lugar</th>
                    <th>Estado</th>
                    <th>Imagen</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($event->title); ?></td>
                        <td><?php echo e($event->date->format('d/m/Y')); ?></td>
                        <td><?php echo e($event->place); ?></td>
                        <td>
                            <?php if($event->status === 'published'): ?>
                                <span class="badge bg-success">Publicado</span>
                            <?php else: ?>
                                <span class="badge bg-secondary">Borrador</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if($event->image_path): ?>
                                <img src="<?php echo e(asset('storage/' . $event->image_path)); ?>" alt="Imagen" style="max-width:60px;max-height:40px;">
                            <?php else: ?>
                                <span class="text-muted">Sin imagen</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="<?php echo e(route('admin.events.edit', $event)); ?>" class="btn btn-sm btn-warning">Editar</a>
                            <form action="<?php echo e(route('admin.events.destroy', $event)); ?>" method="POST" style="display:inline-block;">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar este evento?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="6">No hay eventos registrados.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <div class="pagination">
        <?php echo e($events->links()); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\workspace\ISTSSYSTEM\resources\views/admin/events/index.blade.php ENDPATH**/ ?>