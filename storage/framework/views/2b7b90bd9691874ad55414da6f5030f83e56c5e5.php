

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Gestión de Menú de Navegación</h3>
                    <a href="<?php echo e(route('admin.menu_items.create')); ?>" class="btn btn-primary float-right">Crear Nuevo Elemento</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Título</th>
                                <th>URL</th>
                                <th>Orden</th>
                                <th>Activo</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($item->title); ?></td>
                                    <td><?php echo e($item->url); ?></td>
                                    <td><?php echo e($item->order); ?></td>
                                    <td><?php echo e($item->is_active ? 'Sí' : 'No'); ?></td>
                                    <td>
                                        <a href="<?php echo e(route('admin.menu_items.edit', $item)); ?>" class="btn btn-sm btn-warning">Editar</a>
                                        <form action="<?php echo e(route('admin.menu_items.destroy', $item)); ?>" method="POST" style="display:inline;">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                                <?php $__currentLoopData = $item->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo e($child->title); ?></td>
                                        <td><?php echo e($child->url); ?></td>
                                        <td><?php echo e($child->order); ?></td>
                                        <td><?php echo e($child->is_active ? 'Sí' : 'No'); ?></td>
                                        <td>
                                            <a href="<?php echo e(route('admin.menu_items.edit', $child)); ?>" class="btn btn-sm btn-warning">Editar</a>
                                            <form action="<?php echo e(route('admin.menu_items.destroy', $child)); ?>" method="POST" style="display:inline;">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\worspace\ISTSSYSTEM\resources\views/admin/crud/menu_items/index.blade.php ENDPATH**/ ?>