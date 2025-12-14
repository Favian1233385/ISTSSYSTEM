

<?php $__env->startSection('content'); ?>
<div class="container py-4">
    <a href="<?php echo e(route('public.events.index')); ?>" class="btn btn-secondary mb-3">← Volver a eventos</a>
    <div class="row">
        <div class="col-md-8">
            <h1 style="margin-top:2cm; text-align:center; font-size:2.2rem; font-weight:800; color:#00796b; margin-bottom:1.2rem; letter-spacing:-1px;">
                <?php echo e($event->title); ?>

            </h1>
            <p><strong>Fecha:</strong> <?php echo e($event->date->format('d/m/Y')); ?></p>
            <p><strong>Lugar:</strong> <?php echo e($event->place); ?></p>
            <div class="mb-3"><?php echo $event->description; ?></div>
            <?php if($event->files->count()): ?>
                <h5>Archivos adjuntos</h5>
                <ul>
                    <?php $__currentLoopData = $event->files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><a href="<?php echo e(asset('storage/' . $file->file_path)); ?>" target="_blank"><?php echo e($file->file_name); ?></a></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            <?php endif; ?>
            <?php if($event->links->count()): ?>
                <h5>Enlaces relacionados</h5>
                <ul>
                    <?php $__currentLoopData = $event->links; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><a href="<?php echo e($link->url); ?>" target="_blank"><?php echo e($link->label ?: $link->url); ?></a></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            <?php endif; ?>
        </div>
        <div class="col-md-4">
            <?php if($event->images->count()): ?>
                <div id="eventGallery" class="carousel slide mb-3" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <?php $__currentLoopData = $event->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="carousel-item <?php echo e($loop->first ? 'active' : ''); ?>">
                                <img src="<?php echo e(asset('storage/' . $img->image_path)); ?>" class="d-block w-100" alt="Imagen evento">
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('public.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\workspace\ISTSSYSTEM\resources\views/public/events/show.blade.php ENDPATH**/ ?>