<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Editar Sección de "Acerca"</h1>
    <p class="mb-4">Modifica los detalles de la sección de contenido de la página "Acerca".</p>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Formulario de Edición</h6>
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

            <form action="<?php echo e(route('about.update', $about['id'])); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <div class="form-group">
                    <label for="title">Título</label>
                    <input type="text" name="title" id="title" class="form-control" value="<?php echo e(old('title', $about['title'])); ?>" required>
                </div>

                <div class="form-group">
                    <label for="body">Contenido</label>
                    
                    <textarea name="body" id="body" class="form-control tinymce-editor" rows="10"><?php echo e(old('body', $about['content'])); ?></textarea>
                </div>

                <div class="form-group">
                    <label for="image_url">Imagen (Opcional)</label>
                    <?php if(!empty($about['image_url'])): ?>
                        <div class="mb-2">
                            <p>Imagen actual:</p>
                            <img src="<?php echo e(asset('storage/' . $about['image_url'])); ?>" alt="Imagen actual" style="max-width: 200px; height: auto;">
                        </div>
                    <?php endif; ?>
                    <input type="file" name="image_url" id="image_url" class="form-control-file">
                    <small class="form-text text-muted">Sube una nueva imagen para reemplazar la actual.</small>
                </div>

                <div class="form-group">
                    <label for="file_url">Archivo PDF (Opcional)</label>
                     <?php if(!empty($about['file_url'])): ?>
                        <div class="mb-2">
                            <p>PDF actual: <a href="<?php echo e(asset('storage/' . $about['file_url'])); ?>" target="_blank">Ver PDF</a></p>
                        </div>
                    <?php endif; ?>
                    <input type="file" name="file_url" id="file_url" class="form-control-file" accept="application/pdf">
                    <small class="form-text text-muted">Sube un nuevo PDF para reemplazar el actual.</small>
                </div>

                <div class="form-group">
                    <label for="status">Estado</label>
                    <select name="status" id="status" class="form-control">
                        <option value="published" <?php echo e(old('status', $about['status']) == 'published' ? 'selected' : ''); ?>>Publicado</option>
                        <option value="draft" <?php echo e(old('status', $about['status']) == 'draft' ? 'selected' : ''); ?>>Borrador</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-success">Actualizar Sección</button>
                <a href="<?php echo e(route('about.index')); ?>" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\worspace\ISTSSYSTEM\resources\views/admin/about/edit.blade.php ENDPATH**/ ?>