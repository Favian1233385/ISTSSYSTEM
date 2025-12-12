

<?php $__env->startSection('content'); ?>
<div class="content-header">
    <div class="header-left">
        <h1>📢 Actualizaciones y Novedades</h1>
        <p>Gestiona las últimas noticias y actualizaciones que se mostrarán en la página principal</p>
    </div>
    <div class="header-actions">
        <a href="<?php echo e(route('admin.updates.create')); ?>" class="btn btn-primary">
            + Nueva Actualización
        </a>
    </div>
</div>

<?php if(session('success')): ?>
    <div class="alert alert-success">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
            <polyline points="22 4 12 14.01 9 11.01"></polyline>
        </svg>
        <?php echo e(session('success')); ?>

    </div>
<?php endif; ?>

<div class="card">
    <div class="card-body">
        <?php if($updates->isEmpty()): ?>
            <div class="empty-state">
                <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                </svg>
                <h3>No hay actualizaciones</h3>
                <p>Comienza creando la primera actualización para mostrar en la página principal</p>
                <a href="<?php echo e(route('admin.updates.create')); ?>" class="btn btn-primary">Crear Primera Actualización</a>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th style="width: 100px;">Imagen</th>
                            <th>Título</th>
                            <th style="width: 120px;">Fecha</th>
                            <th style="width: 80px;">Orden</th>
                            <th style="width: 100px;">Estado</th>
                            <th style="width: 150px;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $updates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $update): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td>
                                    <?php if($update->image_path): ?>
                                        <img src="<?php echo e(asset('storage/' . $update->image_path)); ?>" 
                                             alt="<?php echo e($update->title); ?>" 
                                             class="img-thumbnail"
                                             style="width: 80px; height: 60px; object-fit: cover;">
                                    <?php elseif($update->video_path): ?>
                                        <div class="bg-success text-white d-flex align-items-center justify-content-center" 
                                             style="width: 80px; height: 60px; border-radius: 4px;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="currentColor">
                                                <polygon points="5 3 19 12 5 21 5 3"></polygon>
                                            </svg>
                                            <small style="position: absolute; bottom: 2px; font-size: 9px;">Local</small>
                                        </div>
                                    <?php elseif($update->video_url): ?>
                                        <div class="bg-primary text-white d-flex align-items-center justify-content-center" 
                                             style="width: 80px; height: 60px; border-radius: 4px;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="currentColor">
                                                <polygon points="5 3 19 12 5 21 5 3"></polygon>
                                            </svg>
                                            <small style="position: absolute; bottom: 2px; font-size: 9px;">URL</small>
                                        </div>
                                    <?php else: ?>
                                        <div class="bg-secondary text-white d-flex align-items-center justify-content-center" 
                                             style="width: 80px; height: 60px; border-radius: 4px;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                                            </svg>
                                        </div>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <strong><?php echo e($update->title); ?></strong>
                                    <br><small class="text-muted"><?php echo e(Str::limit($update->description, 80)); ?></small>
                                </td>
                                <td>
                                    <small><?php echo e($update->date->format('d/m/Y')); ?></small>
                                </td>
                                <td>
                                    <span class="badge badge-secondary"><?php echo e($update->sort_order); ?></span>
                                </td>
                                <td>
                                    <?php if($update->is_active): ?>
                                        <span class="badge badge-success">Activa</span>
                                    <?php else: ?>
                                        <span class="badge badge-secondary">Inactiva</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="<?php echo e(route('admin.updates.edit', $update->id)); ?>" class="btn btn-sm btn-primary" title="Editar">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                            </svg>
                                        </a>
                                        <form action="<?php echo e(route('admin.updates.destroy', $update->id)); ?>" method="POST" style="display: inline;" onsubmit="return confirm('¿Estás seguro de eliminar esta actualización?');">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn btn-sm btn-danger" title="Eliminar">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <polyline points="3 6 5 6 21 6"></polyline>
                                                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>

            <div class="pagination-wrapper">
                <?php echo e($updates->links()); ?>

            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\workspace\ISTSSYSTEM\resources\views/admin/updates/index.blade.php ENDPATH**/ ?>