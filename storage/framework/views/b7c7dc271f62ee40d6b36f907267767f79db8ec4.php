
<?php $__env->startSection('title', 'Crear Calendario Académico'); ?>
<?php $__env->startSection('content'); ?>
<div class="container py-4">
    <h1 class="mb-4">Crear Calendario Académico</h1>
    <form action="<?php echo e(route('admin.academic-calendar.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <div class="mb-4">
            <label for="title" class="fw-semibold mb-2" style="font-size:1.08rem;">Título</label>
            <input type="text" name="title" id="title" class="admin-input" required>
        </div>
        <div class="mb-4">
            <label for="description" class="fw-semibold mb-2" style="font-size:1.08rem;">Descripción</label>
            <textarea name="description" id="description" class="admin-input tinymce-editor" rows="5"></textarea>
        </div>
        <div class="mb-4">
            <label for="start_date" class="fw-semibold mb-2" style="font-size:1.08rem;">Fecha de inicio</label>
            <input type="date" name="start_date" id="start_date" class="admin-input" required>
        </div>
        <div class="mb-4">
            <label for="end_date" class="fw-semibold mb-2" style="font-size:1.08rem;">Fecha de fin</label>
            <input type="date" name="end_date" id="end_date" class="admin-input" required>
        </div>
        <div class="mb-4 d-flex align-items-center gap-3">
            <label for="color" class="fw-semibold mb-2" style="font-size:1.08rem; min-width:120px;">Color (opcional)</label>
            <input type="color" name="color" id="color" class="admin-input" value="#00a86b" style="width:48px; height:48px; padding:0; border-radius:8px;">
        </div>
        <div class="d-flex gap-3 mt-4 justify-content-start align-items-center flex-row" style="flex-wrap:nowrap;">
            <div style="width: 190px; height: 52px; display: flex; align-items: center; flex-shrink:0;">
                <button type="submit" class="btn btn-primary w-100 h-100" style="font-size:1.08rem;">Guardar Calendario</button>
            </div>
            <div style="width: 150px; height: 52px; display: flex; align-items: center; flex-shrink:0;">
                <a href="<?php echo e(route('admin.academic-calendar.index')); ?>" class="btn btn-secondary w-100 h-100 d-flex align-items-center justify-content-center" style="font-size:1.08rem;">Cancelar</a>
            </div>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\workspace\ISTSSYSTEM\resources\views/admin/academic_calendar/create.blade.php ENDPATH**/ ?>