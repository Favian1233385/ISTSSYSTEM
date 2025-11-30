

<?php $__env->startSection('title', 'Secciones Académicas'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">📚 Secciones Académicas</h1>
        <a href="<?php echo e(route('admin.academic-sections.create')); ?>" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Nueva Sección
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
            <?php if($sections->count() > 0): ?>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Orden</th>
                                <th>Título</th>
                                <th>Slug</th>
                                <th>Imagen</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($section->sort_order); ?></td>
                                    <td>
                                        <strong><?php echo e($section->title); ?></strong>
                                        <?php if($section->description): ?>
                                            <br><small class="text-muted"><?php echo e(Str::limit($section->description, 50)); ?></small>
                                        <?php endif; ?>
                                    </td>
                                    <td><code><?php echo e($section->slug); ?></code></td>
                                    <td>
                                        <?php if($section->image_path): ?>
                                            <img src="<?php echo e(asset('storage/' . $section->image_path)); ?>" 
                                                 alt="<?php echo e($section->title); ?>" 
                                                 style="width: 60px; height: 60px; object-fit: cover;"
                                                 class="rounded">
                                        <?php else: ?>
                                            <span class="text-muted">Sin imagen</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if($section->is_active): ?>
                                            <span class="badge bg-success">Activo</span>
                                        <?php else: ?>
                                            <span class="badge bg-secondary">Inactivo</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="<?php echo e(route('admin.academic-sections.edit', $section)); ?>" 
                                               class="btn btn-sm btn-outline-primary">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="<?php echo e(route('admin.academic-sections.destroy', $section)); ?>" 
                                                  method="POST" 
                                                  onsubmit="return confirm('¿Está seguro de eliminar esta sección?');"
                                                  class="d-inline">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="text-center py-5">
                    <i class="bi bi-inbox" style="font-size: 3rem; color: #ccc;"></i>
                    <p class="text-muted mt-3">No hay secciones académicas creadas.</p>
                    <a href="<?php echo e(route('admin.academic-sections.create')); ?>" class="btn btn-primary">
                        <i class="bi bi-plus-lg"></i> Crear Primera Sección
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\worspace\ISTSSYSTEM\resources\views/admin/academic-sections/index.blade.php ENDPATH**/ ?>