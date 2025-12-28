

<?php $__env->startSection('title', 'Editar Slide del Carrusel'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <h2>Editar slide</h2>
    <form action="<?php echo e(route('admin.hero-slides.update', $heroSlide->id)); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        <div class="mb-3">
            <label for="title" class="form-label">Título</label>
            <input type="text" 
                   name="title" 
                   id="title" 
                   class="form-control" 
                   value="<?php echo e($heroSlide->title); ?>" 
                   required>
        </div>
        <div class="mb-3">
            <label for="subtitle" class="form-label">Subtítulo</label>
            <input type="text" 
                   name="subtitle" 
                   id="subtitle" 
                   class="form-control" 
                   value="<?php echo e($heroSlide->subtitle); ?>">
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Imagen actual</label><br>
            <?php if($heroSlide->image_path): ?>
                <img src="<?php echo e(asset('uploads/images/' . $heroSlide->image_path)); ?>" 
                     alt="<?php echo e($heroSlide->title); ?>" 
                     style="width: 100px;">
            <?php endif; ?>
            <input type="file" 
                   name="image" 
                   id="image" 
                   class="form-control mt-2" 
                   accept="image/*">
        </div>
        <div class="mb-3">
            <label for="link" class="form-label">Enlace</label>
            <input type="text" 
                   name="link" 
                   id="link" 
                   class="form-control" 
                   value="<?php echo e($heroSlide->link); ?>">
        </div>
        <div class="mb-3">
            <label for="sort_order" class="form-label">Orden</label>
            <input type="number" 
                   name="sort_order" 
                   id="sort_order" 
                   class="form-control" 
                   value="<?php echo e($heroSlide->sort_order); ?>">
        </div>
        <div class="mb-3">
            <label for="is_active" class="form-label">Activo</label>
            <select name="is_active" id="is_active" class="form-control">
                <option value="1" <?php if($heroSlide->is_active): ?> selected <?php endif; ?>>Sí</option>
                <option value="0" <?php if(!$heroSlide->is_active): ?> selected <?php endif; ?>>No</option>
            </select>
        </div>
        <div class="admin-action-buttons mt-4">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-save me-1"></i> Actualizar
            </button>
            <a href="<?php echo e(route('admin.hero-slides.index')); ?>" class="btn btn-secondary">
                <i class="bi bi-x-circle me-1"></i> Cancelar
            </a>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\workspace\ISTSSYSTEM\resources\views/admin/hero-slides/edit.blade.php ENDPATH**/ ?>