

<?php $__env->startSection('title', 'Secciones de Visitar'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="h3 mb-0">🏢 Secciones de Visitar</h1>
                <a href="<?php echo e(route('admin.visit-sections.create')); ?>" class="btn btn-primary">
                    ➕ Nueva Sección
                </a>
            </div>
        </div>
    </div>

    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Listado de Secciones</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
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
                        <tr>
                            <td><?php echo e($section->sort_order); ?></td>
                            <td>
                                <strong><?php echo e($section->title); ?></strong>
                            </td>
                            <td>
                                <code><?php echo e($section->slug); ?></code>
                            </td>
                            <td>
                                <small><?php echo e($section->email ?? 'N/A'); ?></small>
                            </td>
                            <td>
                                <small><?php echo e($section->phone ?? 'N/A'); ?></small>
                            </td>
                            <td>
                                <?php if($section->is_active): ?>
                                    <span class="badge bg-success">✓ Activo</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary">✗ Inactivo</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="<?php echo e(route('visitar.section', $section->slug)); ?>" 
                                       class="btn btn-info" 
                                       title="Ver en sitio público"
                                       target="_blank">
                                        👁️
                                    </a>
                                    <a href="<?php echo e(route('admin.visit-sections.edit', $section->id)); ?>" 
                                       class="btn btn-warning" 
                                       title="Editar">
                                        ✏️
                                    </a>
                                    <form action="<?php echo e(route('admin.visit-sections.destroy', $section->id)); ?>" 
                                          method="POST" 
                                          class="d-inline"
                                          onsubmit="return confirm('¿Está seguro de eliminar esta sección?')">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-danger" title="Eliminar">
                                            🗑️
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                <p class="text-muted mb-0">No hay secciones registradas</p>
                                <a href="<?php echo e(route('admin.visit-sections.create')); ?>" class="btn btn-sm btn-primary mt-2">
                                    Crear la primera sección
                                </a>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                <?php echo e($sections->links()); ?>

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\worspace\ISTSSYSTEM\resources\views/admin/visit-sections/index.blade.php ENDPATH**/ ?>