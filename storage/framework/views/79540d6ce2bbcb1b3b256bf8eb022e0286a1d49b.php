<?php $__env->startSection('content'); ?>

<div class="container my-4">
    <div class="card shadow-sm mx-auto" style="max-width:900px;">
        <div class="card-body pb-0">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <div class="d-flex align-items-center gap-3">
                    <span style="font-size:2.2rem; color:#2563eb;">👩‍🏫</span>
                    <div>
                        <h2 class="fw-bold mb-0" style="font-size:1.7rem; letter-spacing:0.5px;">Añadir Docente</h2>
                        <p class="mb-0 text-muted" style="font-size:1.08rem;">Rellena el formulario para añadir un nuevo docente.</p>
                    </div>
                </div>
                <a href="<?php echo e(route('admin.teachers.index')); ?>" class="btn btn-outline-primary fw-bold">← Volver</a>
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

    <form class="card p-4 shadow-sm mx-auto" style="max-width:540px;" method="POST" action="<?php echo e(route('admin.teachers.store')); ?>" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <div class="mb-3">
            <label for="name" class="form-label fw-bold text-primary">Nombre</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="title" class="form-label fw-bold text-primary">Título</label>
            <input type="text" name="title" id="title" class="form-control">
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="department" class="form-label fw-bold text-primary">Departamento</label>
                <input type="text" name="department" id="department" class="form-control">
            </div>
            <div class="col">
                <label for="order" class="form-label fw-bold text-primary">Orden</label>
                <input type="number" name="order" id="order" value="0" class="form-control">
            </div>
        </div>
        <div class="mb-3">
            <label for="bio" class="form-label fw-bold text-primary">Biografía</label>
            <textarea name="bio" id="bio" class="form-control tinymce-editor"></textarea>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="image" class="form-label fw-bold text-primary">Imagen</label>
                <input type="file" name="image" id="image" accept="image/*" class="form-control">
            </div>
            <div class="col">
                <label for="pdf" class="form-label fw-bold text-primary">PDF (Currículum)</label>
                <input type="file" name="pdf" id="pdf" accept="application/pdf" class="form-control">
            </div>
        </div>
        <button type="submit" class="btn btn-primary w-100 fw-bold">Añadir Docente</button>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\workspace\ISTSSYSTEM\resources\views/admin/teachers/create.blade.php ENDPATH**/ ?>