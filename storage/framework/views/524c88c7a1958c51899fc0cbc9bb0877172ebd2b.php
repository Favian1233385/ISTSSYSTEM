

<?php $__env->startSection('title', 'Programas de ' . $modality->title); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">📚 Programas de <?php echo e($modality->title); ?></h1>
        <a href="<?php echo e(route('admin.academic_modalities.programs.create', $modality->id)); ?>" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Nuevo Programa
        </a>
        <a href="<?php echo e(route('admin.academic_modalities.index')); ?>" class="btn btn-secondary">Volver a Modalidades</a>
    </div>
    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>
    <div class="card">
        <div class="card-body">
            <?php if($programs->count() > 0): ?>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Orden</th>
                                <th>Título</th>
                                <th>Descripción</th>
                                <th>Enlace</th>
                                <th>Documento</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                                <th>Inscritos</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $programs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $program): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($program->order); ?></td>
                                    <td><strong><?php echo e($program->title); ?></strong></td>
                                    <td><?php echo e(Str::limit($program->description, 50)); ?></td>
                                    <td><?php if($program->url): ?><a href="<?php echo e($program->url); ?>" target="_blank">Ver</a><?php else: ?> <span class="text-muted">-</span> <?php endif; ?></td>
                                    <td><?php if($program->document): ?><a href="<?php echo e(asset('storage/' . $program->document)); ?>" target="_blank">Descargar</a><?php else: ?> <span class="text-muted">-</span> <?php endif; ?></td>
                                    <td>
                                        <?php if($program->is_active): ?>
                                            <span class="badge bg-success">Activo</span>
                                        <?php else: ?>
                                            <span class="badge bg-secondary">Inactivo</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="<?php echo e(route('admin.academic_modalities.programs.edit', [$modality->id, $program->id])); ?>" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                                            <form action="<?php echo e(route('admin.academic_modalities.programs.destroy', [$modality->id, $program->id])); ?>" method="POST" onsubmit="return confirm('¿Está seguro de eliminar este programa?');" class="d-inline">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="<?php echo e(route('admin.inscripciones.index', ['programa_id' => $program->id])); ?>" class="btn btn-sm btn-info">
                                            <i class="bi bi-people"></i> Ver Inscritos
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="text-center py-5">
                    <i class="bi bi-inbox" style="font-size: 3rem; color: #ccc;"></i>
                    <p class="text-muted mt-3">No hay programas creados para esta modalidad.</p>
                    <a href="<?php echo e(route('admin.academic_modalities.programs.create', $modality->id)); ?>" class="btn btn-primary">
                        <i class="bi bi-plus-lg"></i> Crear Primer Programa
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\workspace\ISTSSYSTEM\resources\views/admin/academic_programs/index.blade.php ENDPATH**/ ?>