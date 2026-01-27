

<?php $__env->startSection('content'); ?>
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h1 class="display-4 fw-bold text-primary"><?php echo e($section->title); ?></h1>
        </div>
        <div class="d-flex justify-content-center">
            <div class="card shadow-lg mb-4 animate__animated animate__fadeIn" style="border-top:6px solid var(--color-success,#2e7d32); max-width:900px; width:100%;">
                <div class="card-body p-4">
                    <?php if($section->mission): ?>
                        <h5 class="text-primary mt-3">Misión</h5>
                        <p class="lead"><?php echo e($section->mission); ?></p>
                    <?php endif; ?>
                    <?php if($section->functions && is_array($section->functions)): ?>
                        <h5 class="text-primary mt-4">Funciones</h5>
                        <ul class="list-unstyled">
                            <?php $__currentLoopData = $section->functions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $funcion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i><?php echo e($funcion); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    <?php endif; ?>
                    <?php if($section->schedule): ?>
                        <p class="mt-3"><strong>Horario:</strong> <?php echo e($section->schedule); ?></p>
                    <?php endif; ?>
                    <?php if($section->location): ?>
                        <p><strong>Ubicación:</strong> <?php echo e($section->location); ?></p>
                    <?php endif; ?>
                    <?php if($section->phone): ?>
                        <p><strong>Teléfono:</strong> <?php echo e($section->phone); ?></p>
                    <?php endif; ?>
                    <?php if($section->email): ?>
                        <p><strong>Email:</strong> <a href="mailto:<?php echo e($section->email); ?>"><?php echo e($section->email); ?></a></p>
                    <?php endif; ?>
                    <?php if($section->additional_info): ?>
                        <div class="mt-4"><?php echo nl2br(e($section->additional_info)); ?></div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.public', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\workspace\ists\resources\views/public/visit-section.blade.php ENDPATH**/ ?>