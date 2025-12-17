

<?php $__env->startSection('content'); ?>
    <h1>Editar enlace de <?php echo e(ucfirst($link->name)); ?></h1>
    <form method="POST" action="<?php echo e(route('admin.social_links.update', $link->id)); ?>">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        <div class="form-group">
            <label for="url">Enlace</label>
            <input type="url" name="url" id="url" class="form-control" value="<?php echo e(old('url', $link->url)); ?>" required>
            <?php $__errorArgs = ['url'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="text-danger"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div class="form-group">
            <label for="bg_color">Color de fondo (hex o CSS)</label>
            <input type="text" name="bg_color" id="bg_color" class="form-control" value="<?php echo e(old('bg_color', $link->bg_color)); ?>" required>
        </div>
        <div class="form-group">
            <label for="icon_svg">SVG del ícono</label>
            <textarea name="icon_svg" id="icon_svg" class="form-control" rows="3" required><?php echo e(old('icon_svg', $link->icon_svg)); ?></textarea>
            <small>Pega aquí el código SVG (sin etiquetas &lt;script&gt;).</small>
        </div>
        <div class="form-check">
            <input type="checkbox" name="active" id="active" class="form-check-input" <?php echo e($link->active ? 'checked' : ''); ?>>
            <label for="active" class="form-check-label">Activo</label>
        </div>
        <button type="submit" class="btn btn-success mt-2">Guardar</button>
        <a href="<?php echo e(route('admin.social_links.index')); ?>" class="btn btn-secondary mt-2">Cancelar</a>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\workspace\ISTSSYSTEM\resources\views/admin/social_links/edit.blade.php ENDPATH**/ ?>