

<?php $__env->startSection('content'); ?>
<div class="container py-4">
    <h2 class="mb-4">Inscripciones a Cursos de Educación Continua</h2>
    <form method="GET" class="row g-3 mb-3">
        <div class="col-md-6">
            <select name="programa_id" class="form-select" onchange="this.form.submit()">
                <option value="">-- Filtrar por curso --</option>
                <?php $__currentLoopData = $programas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($prog->id); ?>" <?php if($programa_id == $prog->id): ?> selected <?php endif; ?>><?php echo e($prog->title); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
    </form>
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Fecha</th>
                    <th>Curso</th>
                    <th>Modalidad</th>
                    <th>Nombre</th>
                    <th>Cédula</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th>Especialidad</th>
                    <th>Observaciones</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $inscripciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $insc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($insc->id); ?></td>
                        <td><?php echo e($insc->created_at->format('d/m/Y H:i')); ?></td>
                        <td><?php echo e($insc->programa->title ?? '-'); ?></td>
                        <td><?php echo e($insc->modalidad->title ?? '-'); ?></td>
                        <td><?php echo e($insc->nombre); ?></td>
                        <td><?php echo e($insc->cedula); ?></td>
                        <td><?php echo e($insc->email); ?></td>
                        <td><?php echo e($insc->telefono); ?></td>
                        <td><?php echo e($insc->especialidad); ?></td>
                        <td><?php echo e($insc->observaciones); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="10" class="text-center">No hay inscripciones registradas.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <div class="mt-3">
        <?php echo e($inscripciones->withQueryString()->links()); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\worspace\ISTSSYSTEM\resources\views/admin/inscripciones/index.blade.php ENDPATH**/ ?>