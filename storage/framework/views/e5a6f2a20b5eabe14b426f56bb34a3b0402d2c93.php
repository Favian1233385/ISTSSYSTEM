

<?php $__env->startSection('content'); ?>
<div class="admin-content">
    <h2>Contenidos de <?php echo e($campusItem->title); ?></h2>
    <a href="<?php echo e(route('admin.campus-item-contents.create', $campusItem)); ?>" class="btn btn-primary mb-3">Crear nuevo contenido</a>
    <?php if($contents->count() === 0): ?>
        <p>No hay contenidos asociados.</p>
    <?php else: ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Fecha</th>
                    <th>Imagen</th>
                    <th>Video</th>
                    <th>Contacto</th>
                    <th>Activo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $contents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($content->title); ?></td>
                    <td><?php echo e($content->date); ?></td>
                    <td>
                        <?php if($content->image_path): ?>
                            <img src="<?php echo e(asset($content->image_path)); ?>" alt="img" style="max-width:80px;max-height:60px;">
                        <?php elseif($content->image_url): ?>
                            <img src="<?php echo e($content->image_url); ?>" alt="img" style="max-width:80px;max-height:60px;">
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if($content->video_path): ?>
                            <video src="<?php echo e(asset($content->video_path)); ?>" style="max-width:80px;max-height:60px;" controls></video>
                        <?php elseif($content->video_url): ?>
                            <video src="<?php echo e($content->video_url); ?>" style="max-width:80px;max-height:60px;" controls></video>
                        <?php endif; ?>
                    </td>
                    <td><?php echo e($content->contact_name); ?></td>
                    <td><?php echo e($content->is_active ? 'Sí' : 'No'); ?></td>
                    <td>
                        <!-- Aquí irían los enlaces de editar/eliminar si se implementan -->
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\worspace\ISTSSYSTEM\resources\views/admin/campus-item-contents/list.blade.php ENDPATH**/ ?>