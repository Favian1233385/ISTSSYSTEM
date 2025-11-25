

<?php $__env->startSection('content'); ?>
<div class="academicos-page">
    <div class="container">
        <div class="page-header">
            <h1>Académicos</h1>
            <p class="lead">Descubre nuestras carreras y programas de educación continua</p>
        </div>

        <div class="academicos-content">
            <section class="careers-section">
                <h2>🎓 Carreras</h2>
                <div class="careers-grid">
                    <?php $__currentLoopData = $careers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $career): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="career-card has-image">
                            <div class="career-image">
                                <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='300' height='200'%3E%3Crect width='300' height='200' fill='blue'/%3E%3Ctext x='50%' y='50%' dominant-baseline='middle' text-anchor='middle' fill='white'%3EImage%3C/text%3E%3C/svg%3E" alt="<?php echo e($career->name); ?>" class="img-fluid">
                            </div>
                            <div class="career-info">
                                <h3><a href="<?php echo e(route('career.show', $career->slug)); ?>"><?php echo e($career->name); ?></a></h3>
                                <?php if($career->description): ?>
                                    <p><?php echo e(Str::limit($career->description, 100)); ?></p>
                                <?php endif; ?>
                                <a href="<?php echo e(route('career.show', $career->slug)); ?>" class="btn btn-primary">Ver más</a>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </section>

            <section class="sections-section">
                <h2>📚 Educación Continua</h2>
                <div class="sections-grid">
                    <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="section-card has-image">
                            <div class="section-image">
                                <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='300' height='200'%3E%3Crect width='300' height='200' fill='green'/%3E%3Ctext x='50%' y='50%' dominant-baseline='middle' text-anchor='middle' fill='white'%3EImage%3C/text%3E%3C/svg%3E" alt="<?php echo e($section->title); ?>" class="img-fluid">
                            </div>
                            <div class="section-info">
                                <h3><a href="<?php echo e(route('academic-section.show', $section->slug)); ?>"><?php echo e($section->title); ?></a></h3>
                                <?php if($section->description): ?>
                                    <p><?php echo e(Str::limit($section->description, 100)); ?></p>
                                <?php endif; ?>
                                <a href="<?php echo e(route('academic-section.show', $section->slug)); ?>" class="btn btn-primary">Ver más</a>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </section>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.site', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\worspace\ISTSSYSTEM\resources\views/public/academicos.blade.php ENDPATH**/ ?>