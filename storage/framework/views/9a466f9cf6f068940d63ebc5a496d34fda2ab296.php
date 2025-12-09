

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <?php if(session('success')): ?>
        <div class="alert alert-success">
            <span>✅</span> <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>
    <?php if(session('error')): ?>
        <div class="alert alert-danger">
            <span>❌</span> <?php echo e(session('error')); ?>

        </div>
    <?php endif; ?>
    <h1 class="h3 mb-2 text-gray-800">Gestión de Contenido "Acerca"</h1>
    <p class="mb-4">Aquí puedes crear, editar y eliminar las secciones de contenido que aparecen en la página "Acerca".</p>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="<?php echo e(route('about.create')); ?>" class="btn btn-primary">
                <i class="fas fa-plus"></i> Crear Nueva Sección
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Título</th>
                            <th>Contenido</th>
                            <th style="width: 150px;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $abouts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $about): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($about['title']); ?></td>
                            <td><?php echo e(Str::limit(strip_tags($about['content']), 100)); ?></td>
                            <td>
                                <a href="<?php echo e(route('about.edit', $about['id'])); ?>" class="btn btn-sm btn-warning" title="Editar">
                                    <i class="fas fa-edit"></i> Editar
                                </a>
                                <form action="<?php echo e(route('about.destroy', $about['id'])); ?>" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de que quieres eliminar esta sección?');">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-sm btn-danger" title="Eliminar">
                                        <i class="fas fa-trash"></i> Eliminar
                                    </button>
                                </form>
                                <?php if(strtolower($about['title']) === 'autoridades'): ?>
                                    <a href="<?php echo e(route('admin.autoridades.create')); ?>" class="btn btn-sm btn-success mt-1" title="Crear Autoridad">
                                        <i class="fas fa-user-plus"></i> Crear Autoridad
                                    </a>
                                <?php endif; ?>
                                <?php if(strtolower($about['title']) === 'planta docente'): ?>
                                    <a href="<?php echo e(route('admin.teachers.create')); ?>" class="btn btn-sm btn-success mt-1" title="Crear Docente">
                                        <i class="fas fa-user-plus"></i> Crear Docente
                                    </a>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="3" class="text-center">No hay secciones de "Acerca" creadas todavía.</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\workspace\ISTSSYSTEM\resources\views/admin/about/index.blade.php ENDPATH**/ ?>