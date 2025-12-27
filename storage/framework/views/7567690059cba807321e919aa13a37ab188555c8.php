
<?php $__env->startSection('title', 'Carreras'); ?>
<?php $__env->startSection('content'); ?>
<div class="container py-5">
    <div style="margin-top:2cm"></div>
    <h1 class="mb-4" style="color: var(--color-primary); font-family: var(--font-heading); font-weight: 700;">Todas las Carreras</h1>
    <p class="mb-4" style="color: var(--color-secondary); font-size: 1.2rem;">Aquí puedes consultar todas las carreras ofertadas por el Instituto Superior Tecnológico Sucúa. Haz clic en cada una para ver más detalles.</p>
    <div class="row">
        <?php $__currentLoopData = App\Models\Career::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $career): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <?php if($career->image_path): ?>
                        <img src="<?php echo e(asset($career->image_path)); ?>" alt="<?php echo e($career->name); ?>" class="card-img-top" style="height:180px;object-fit:cover;">
                    <?php else: ?>
                        <img src="<?php echo e(asset('assets/images/default-career.jpg')); ?>" alt="<?php echo e($career->name); ?>" class="card-img-top" style="height:180px;object-fit:cover;">
                    <?php endif; ?>
                    <div class="card-body">
                        <h5 class="card-title" style="color: var(--color-primary); font-family: var(--font-heading); font-weight: 600;"><?php echo e($career->name); ?></h5>
                        <p class="card-text" style="color: var(--color-secondary);"><?php echo e($career->description ?? 'Sin descripción.'); ?></p>
                        <a href="<?php echo e(route('career.show', $career->slug ?? $career->id)); ?>" class="btn btn-primary">Ver detalles</a>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.public', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\workspace\ISTSSYSTEM\resources\views/public/carreras.blade.php ENDPATH**/ ?>