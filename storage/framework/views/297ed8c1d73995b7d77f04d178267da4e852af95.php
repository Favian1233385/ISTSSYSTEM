<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Crear Nueva Sección de "Acerca"</h1>
    <p class="mb-4">Completa el formulario para añadir una nueva sección de contenido a la página "Acerca".</p>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Formulario de Creación</h6>
        </div>
        <div class="card-body">

            
            <?php if($errors->any()): ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form action="<?php echo e(route('about.store')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="form-group">
                    <label for="title">Título</label>
                    <input type="text" name="title" id="title" class="form-control" value="<?php echo e(old('title')); ?>" required>
                </div>

                <div class="form-group">
                    <label for="body">Contenido</label>
                    
                    <textarea name="body" id="body" class="form-control tinymce-editor" rows="10"><?php echo e(old('body')); ?></textarea>
                </div>

                <div class="form-group">
                    <label for="image_url">Imagen (Opcional)</label>
                    <input type="file" name="image_url" id="image_url" class="form-control-file">
                </div>

                <div class="form-group">
                    <label for="file_url">Archivo PDF (Opcional)</label>
                    <input type="file" name="file_url" id="file_url" class="form-control-file" accept="application/pdf">
                </div>

                <div class="form-group">
                    <label for="status">Estado</label>
                    <select name="status" id="status" class="form-control">
                        <option value="published" selected>Publicado</option>
                        <option value="draft">Borrador</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-success">Guardar Sección</button>
                <a href="<?php echo e(route('about.index')); ?>" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\worspace\ISTSSYSTEM\resources\views/admin/about/create.blade.php ENDPATH**/ ?>