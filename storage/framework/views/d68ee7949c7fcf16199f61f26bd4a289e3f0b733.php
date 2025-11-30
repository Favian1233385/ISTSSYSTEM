<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($title ?? 'Planta Docente - ISTS Sucúa'); ?></title>
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/harvard-style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/harvard-exact.css')); ?>">
</head>
<body>
    <?php echo $__env->make('public.partials.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <main class="main-content">
        <!-- Page Header -->
        <section class="about-page-header">
            <div class="container text-center">
                <h1 class="about-page-title">Planta Docente</h1>
            </div>
        </section>

        <!-- Content Section -->
        <section class="about-content-area">
            <div class="container">
                <div class="team-grid">
                    <?php if(isset($teachers) && count($teachers) > 0): ?>
                        <?php $__currentLoopData = $teachers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teacher): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="team-member-card">
                                <?php if($teacher->image_path): ?>
                                    <img src="<?php echo e(asset('storage/' . $teacher->image_path)); ?>" alt="<?php echo e($teacher->name); ?>" class="team-member-img">
                                <?php endif; ?>
                                <div class="team-member-info">
                                    <h3><?php echo e($teacher->name); ?></h3>
                                    <p class="position"><?php echo e($teacher->title); ?></p>
                                    <p class="department"><?php echo e($teacher->department); ?></p>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <p>No hay docentes para mostrar.</p>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    </main>

    <?php echo $__env->make('public.partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('public.acerca.partials.about-styles', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>
</html>
<?php /**PATH C:\worspace\ISTSSYSTEM\resources\views/public/planta-docente.blade.php ENDPATH**/ ?>