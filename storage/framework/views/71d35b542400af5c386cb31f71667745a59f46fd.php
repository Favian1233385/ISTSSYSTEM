<?php $__env->startSection('content'); ?>
<div class="admin-content">
    <div class="dashboard-header">
        <h1>🤖 Editar Q&A</h1>
        <p>Modifica el formulario para editar la pregunta y respuesta.</p>
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

    <form action="<?php echo e(route('admin.qas.update', $item)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        <div class="form-group">
            <label for="question">Pregunta o Palabras Clave</label>
            <input type="text" name="question" id="question" class="form-control" value="<?php echo e(old('question', $item->question)); ?>" required>
            <small class="form-text text-muted">Puedes usar palabras clave separadas por comas (ej: hola, buenos días, saludo).</small>
        </div>
        <div class="form-group">
            <label for="answer">Respuesta</label>
            <textarea name="answer" id="answer" class="form-control" rows="5" required><?php echo e(old('answer', $item->answer)); ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar Q&A</button>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\workspace\ISTSSYSTEM\resources\views/admin/qas/edit.blade.php ENDPATH**/ ?>