


<?php $__env->startSection('content'); ?>

<div class="container main-content" style="max-width: 600px; margin: 0 auto;">
    <div class="inscripcion-form-box" style="margin-top: 5rem; margin-bottom: 3rem; background: var(--color-light); border-radius: 16px; box-shadow: var(--shadow-lg); padding: 2.5rem 2rem;">
        <div class="text-center mb-4">
            <h1 class="section-title" style="font-family: var(--font-heading); color: var(--color-secondary); font-size: 2.2rem; font-weight: 700; margin-bottom: 1.2rem; letter-spacing: 1px;">Inscripción al curso</h1>
            <div class="mb-3" style="font-size:1.1rem; color:var(--color-gray);">
                <span class="badge" style="background: var(--color-primary); color: #fff; font-size:1rem; padding: 0.5em 1.2em; border-radius: 8px;">Modalidad: <?php echo e($modalidad->title ?? ''); ?></span>
                <span class="badge" style="background: var(--color-secondary); color: #fff; font-size:1rem; padding: 0.5em 1.2em; border-radius: 8px; margin-left: 0.5em;">Curso: <?php echo e($programa->title); ?></span>
            </div>
        </div>
        <?php if(session('success')): ?>
            <div class="alert alert-success"><?php echo e(session('success')); ?></div>
        <?php endif; ?>
        <?php if(session('error')): ?>
            <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
        <?php endif; ?>
        <?php if($errors->any()): ?>
            <div class="alert alert-danger">
                <ul class="mb-0">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>
        <form method="POST" action="<?php echo e(route('inscripcion.store')); ?>">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="modalidad_id" value="<?php echo e($modalidad->id ?? ''); ?>">
            <input type="hidden" name="programa_id" value="<?php echo e($programa->id); ?>">
            <div class="row g-3">
                <div class="col-12">
                    <label class="form-label">Nombre completo <span class="text-danger">*</span></label>
                    <input type="text" name="nombre" class="form-control" required value="<?php echo e(old('nombre')); ?>">
                    <?php $__errorArgs = ['nombre'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger small"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Cédula</label>
                    <input type="text" name="cedula" class="form-control" value="<?php echo e(old('cedula')); ?>">
                    <?php $__errorArgs = ['cedula'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger small"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Email <span class="text-danger">*</span></label>
                    <input type="email" name="email" class="form-control" required value="<?php echo e(old('email')); ?>">
                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger small"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Teléfono</label>
                    <input type="text" name="telefono" class="form-control" value="<?php echo e(old('telefono')); ?>">
                    <?php $__errorArgs = ['telefono'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger small"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Especialidad</label>
                    <input type="text" name="especialidad" class="form-control" value="<?php echo e(old('especialidad')); ?>">
                    <?php $__errorArgs = ['especialidad'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger small"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="col-12">
                    <label class="form-label">Observaciones</label>
                    <textarea name="observaciones" class="form-control"><?php echo e(old('observaciones')); ?></textarea>
                    <?php $__errorArgs = ['observaciones'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger small"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-12 d-flex justify-content-center align-items-center gap-3">
                    <button type="submit" class="btn btn-primary px-4">Inscribirse</button>
                    <a href="<?php echo e(url()->previous()); ?>" class="btn btn-secondary px-4">Regresar</a>
                </div>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.public', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\worspace\ISTSSYSTEM\resources\views/public/inscripcion.blade.php ENDPATH**/ ?>