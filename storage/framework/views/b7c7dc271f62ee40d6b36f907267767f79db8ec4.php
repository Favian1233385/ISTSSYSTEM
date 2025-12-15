
<?php $__env->startSection('title', 'Crear Evento Académico'); ?>
<?php $__env->startSection('content'); ?>
<div class="container py-4">
    <h1 class="mb-4">Crear Evento Académico</h1>
    <form action="<?php echo e(route('admin.academic-calendar.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <div class="mb-3">
            <label for="title" class="form-label">Título</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Descripción</label>
            <textarea name="description" id="description" class="form-control" rows="3"></textarea>
        </div>
        <div class="mb-3">
            <label for="start_date" class="form-label">Fecha de inicio</label>
            <input type="date" name="start_date" id="start_date" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="end_date" class="form-label">Fecha de fin</label>
            <input type="date" name="end_date" id="end_date" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="color" class="form-label">Color (opcional)</label>
            <input type="color" name="color" id="color" class="form-control form-control-color" value="#00a86b">
        </div>
        <button type="submit" class="btn btn-success">Guardar Evento</button>
        <a href="<?php echo e(route('admin.academic-calendar.index')); ?>" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\workspace\ISTSSYSTEM\resources\views/admin/academic_calendar/create.blade.php ENDPATH**/ ?>