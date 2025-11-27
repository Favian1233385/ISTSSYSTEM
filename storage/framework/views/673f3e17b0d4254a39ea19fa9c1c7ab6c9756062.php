
<?php $__env->startSection('content'); ?>
<div class="container">
    <h1>Gestión de Acerca</h1>
    <a href="<?php echo e(route('about.create')); ?>" class="btn btn-primary mb-3">Crear nuevo</a>
    <table class="table">
        <thead>
            <tr>
                <th>Título</th>
                <th>Descripción</th>
                <th>Imagen</th>
                <th>PDF</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($item->title); ?></td>
                <td><?php echo e(Str::limit($item->description, 50)); ?></td>
                <td><?php if($item->image): ?><img src="<?php echo e(asset('storage/'.$item->image)); ?>" width="60"><?php endif; ?></td>
                <td><?php if($item->pdf): ?><a href="<?php echo e(asset('storage/'.$item->pdf)); ?>" target="_blank">Ver PDF</a><?php endif; ?></td>
                <td>
                    <a href="<?php echo e(route('about.edit', $item->id)); ?>" class="btn btn-sm btn-warning">Editar</a>
                    <form action="<?php echo e(route('about.destroy', $item->id)); ?>" method="POST" style="display:inline;">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar?')">Eliminar</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\worspace\ISTSSYSTEM\resources\views/admin/about/index.blade.php ENDPATH**/ ?>