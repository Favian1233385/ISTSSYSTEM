<?php $__env->startSection('content'); ?>

<div class="container my-4">
    <div class="card shadow-sm mx-auto" style="max-width:900px;">
        <div class="card-body pb-0">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <div class="d-flex align-items-center gap-3">
                    <span style="font-size:2.2rem; color:#2563eb;">🤖</span>
                    <div>
                        <h2 class="fw-bold mb-0" style="font-size:1.7rem; letter-spacing:0.5px;">Añadir Q&amp;A</h2>
                        <p class="mb-0 text-muted" style="font-size:1.08rem;">Rellena el formulario para añadir una nueva pregunta y respuesta al chatbot.</p>
                    </div>
                </div>
                <a href="<?php echo e(route('admin.qas.index')); ?>" class="btn btn-outline-primary fw-bold">← Volver</a>
            </div>
        </div>
    </div>

    <?php if($errors->any()): ?>
        <div class="alert alert-danger">
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="<?php echo e(route('admin.qas.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <div class="form-group mb-4">
            <label for="question" class="fw-semibold mb-2" style="font-size:1.08rem;">Pregunta o Palabras Clave</label>
            <input type="text" name="question" id="question" class="admin-input w-100" value="<?php echo e(old('question')); ?>" required style="margin-bottom:0.5rem;">
            <small class="form-text text-muted">Puedes usar palabras clave separadas por comas (ej: hola, buenos días, saludo).</small>
        </div>
        <div class="form-group mb-4">
            <label for="answer" class="fw-semibold mb-2" style="font-size:1.08rem;">Respuesta</label>
            <textarea name="answer" id="answer" class="admin-input tinymce-editor w-100" rows="5" style="min-height:120px;"><?php echo e(old('answer')); ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary" style="min-width:160px; font-size:1.08rem;">Añadir Q&A</button>
    </form>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\workspace\ists\resources\views/admin/qas/create.blade.php ENDPATH**/ ?>