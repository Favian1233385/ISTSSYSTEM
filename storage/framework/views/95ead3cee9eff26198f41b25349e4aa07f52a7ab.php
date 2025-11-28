<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Editar Autoridad</h1>
    <p class="mb-4">Modifica los detalles de la autoridad seleccionada.</p>

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

            <form action="<?php echo e(route('admin.autoridades.update', $autoridad)); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <div class="form-group">
                    <label for="nombre">Nombre Completo</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" value="<?php echo e(old('nombre', $autoridad->nombre)); ?>" required>
                </div>

                <div class="form-group">
                    <label for="cargo">Cargo</label>
                    <input type="text" name="cargo" id="cargo" class="form-control" value="<?php echo e(old('cargo', $autoridad->cargo)); ?>" placeholder="Ej: Rector, Vicerrector" required>
                </div>

                <div class="form-group">
                    <label for="categoria">Categoría</label>
                    <input type="text" name="categoria" id="categoria" class="form-control" value="<?php echo e(old('categoria', $autoridad->categoria)); ?>" placeholder="Ej: Directivos, OCS" required>
                </div>

                <div class="form-group">
                    <label for="biografia">Biografía (Opcional)</label>
                    <textarea name="biografia" id="biografia" class="form-control tinymce-editor" rows="10"><?php echo e(old('biografia', $autoridad->biografia)); ?></textarea>
                </div>

                <div class="form-group">
                    <label>Foto (Opcional)</label>
                    <?php if($autoridad->foto_path): ?>
                        <div class="mb-2">
                            <p>Foto actual:</p>
                            <img src="<?php echo e(asset('storage/' . $autoridad->foto_path)); ?>" alt="Foto actual" style="max-width: 200px; height: auto;">
                        </div>
                    <?php endif; ?>
                    <div class="custom-file-upload">
                        <label for="foto_path" class="btn btn-info">Seleccionar Imagen</label>
                        <span id="foto_path_name" style="margin-left: 10px;">No se ha seleccionado ninguna imagen.</span>
                        <input type="file" name="foto_path" id="foto_path" style="display: none;" onchange="document.getElementById('foto_path_name').textContent = this.files.length > 0 ? this.files[0].name : 'No se ha seleccionado ninguna imagen.';">
                    </div>
                    <small class="form-text text-muted">Sube una nueva foto para reemplazar la actual.</small>
                </div>

                <div class="form-group">
                    <label>Currículum en PDF (Opcional)</label>
                    <?php if($autoridad->pdf_path): ?>
                        <div class="mb-2">
                            <p>PDF actual: <a href="<?php echo e(asset('storage/' . $autoridad->pdf_path)); ?>" target="_blank">Ver PDF</a></p>
                        </div>
                    <?php endif; ?>
                    <div class="custom-file-upload">
                        <label for="pdf_path" class="btn btn-info">Seleccionar PDF</label>
                        <span id="pdf_path_name" style="margin-left: 10px;">No se ha seleccionado ningún PDF.</span>
                        <input type="file" name="pdf_path" id="pdf_path" accept="application/pdf" style="display: none;" onchange="document.getElementById('pdf_path_name').textContent = this.files.length > 0 ? this.files[0].name : 'No se ha seleccionado ningún PDF.';">
                    </div>
                    <small class="form-text text-muted">Sube un nuevo PDF para reemplazar el actual.</small>
                </div>

                <div class="form-group">
                    <label for="orden">Orden de Aparición</label>
                    <input type="number" name="orden" id="orden" class="form-control" value="<?php echo e(old('orden', $autoridad->orden)); ?>" required>
                </div>

                <button type="submit" class="btn btn-success">Actualizar Autoridad</button>
                <a href="<?php echo e(route('admin.autoridades.index')); ?>" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\worspace\ISTSSYSTEM\resources\views/admin/autoridades/edit.blade.php ENDPATH**/ ?>