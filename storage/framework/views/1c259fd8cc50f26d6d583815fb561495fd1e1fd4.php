
<?php $__env->startSection('title', 'Sobre Nosotros'); ?>
<?php $__env->startSection('content'); ?>
<div class="container py-5">
    <div style="margin-top:2cm"></div>
    <h1 class="mb-4">Sobre Nosotros</h1>
    <p class="mb-4">Conoce la misión, visión, autoridades y planta docente del Instituto Superior Tecnológico Sucúa.</p>
    <div class="mb-5">
        <h2>Misión y Visión</h2>
        <ul>
            <li><strong>Misión:</strong> <?php echo e(App\Models\Setting::get('mision') ?? 'No definida.'); ?></li>
            <li><strong>Visión:</strong> <?php echo e(App\Models\Setting::get('vision') ?? 'No definida.'); ?></li>
        </ul>
    </div>
    <div class="mb-5">
        <h2>Autoridades</h2>
        <ul>
            <?php $__currentLoopData = App\Models\Autoridad::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $autoridad): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($autoridad->name); ?> - <?php echo e($autoridad->role); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
    <div class="mb-5">
        <h2>Planta Docente</h2>
        <ul>
            <?php $__currentLoopData = App\Models\Teacher::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teacher): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($teacher->name); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.public', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\workspace\ISTSSYSTEM\resources\views/public/acerca.blade.php ENDPATH**/ ?>