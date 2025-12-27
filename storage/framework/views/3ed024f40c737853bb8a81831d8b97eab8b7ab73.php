
<?php $__env->startSection('title', 'Admisión y Actualizaciones'); ?>
<?php $__env->startSection('content'); ?>
<div class="container py-5">
    <div style="margin-top:2cm"></div>
    <h1 class="mb-4" style="color: var(--color-primary); font-family: var(--font-heading); font-weight: 700;">Admisión y Últimas Actualizaciones</h1>
    <p class="mb-4" style="color: var(--color-secondary); font-size: 1.2rem;">Consulta aquí la información más reciente sobre procesos de admisión, requisitos y novedades institucionales.</p>

    <?php
        $destacada = App\Models\Update::active()->ordered()->first();
    ?>
    <?php if($destacada): ?>
        <div class="mb-5 text-center">
            <?php if($destacada->video_url): ?>
                <div class="mb-3">
                    <iframe width="560" height="315" src="<?php echo e($destacada->video_url); ?>" frameborder="0" allowfullscreen style="max-width:100%;"></iframe>
                </div>
            <?php elseif($destacada->image_path): ?>
                <div class="mb-3">
                    <img src="<?php echo e(asset($destacada->image_path)); ?>" alt="Actualización destacada" style="max-width:100%;height:auto;">
                </div>
            <?php endif; ?>
            <h2 style="color: var(--color-primary); font-family: var(--font-heading); font-weight: 600;"><?php echo e($destacada->title); ?></h2>
            <p style="color: var(--color-secondary);"><?php echo e($destacada->description); ?></p>
        </div>
    <?php endif; ?>

    <div class="row">
        <?php $__currentLoopData = App\Models\Update::orderBy('created_at', 'desc')->take(10)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $update): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo e($update->title); ?></h5>
                        <p class="card-text"><?php echo e($update->description); ?></p>
                        <small class="text-muted"><?php echo e($update->created_at->format('d/m/Y')); ?></small>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.public', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\workspace\ISTSSYSTEM\resources\views/public/actualizaciones.blade.php ENDPATH**/ ?>