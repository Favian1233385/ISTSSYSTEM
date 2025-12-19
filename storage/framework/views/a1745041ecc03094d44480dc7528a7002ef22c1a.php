

<?php $__env->startSection('header'); ?>
    <?php echo $__env->make('public.partials.event_header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container" style="margin-top:2.5cm; max-width:1100px;">
    <h1 style="
        font-size:2.3rem;
        font-weight:800;
        color:#00796b;
        margin-bottom:0.7rem;
        letter-spacing:-1px;
        text-align:center;
        position:relative;">
        Eventos Institucionales
        <span style="display:block; height:4px; width:54px; background:linear-gradient(90deg,#1abc9c,#3498db); border-radius:2px; margin:10px auto 0 auto;"></span>
    </h1>

    
    <?php
        $bannerEvent = $events->first(function($e) { return $e->banner_path; });
    ?>
    <?php if($bannerEvent && $bannerEvent->banner_path): ?>
        <div style="margin: 0 auto 2.2rem auto; max-width:900px; text-align:center;">
            <?php if($bannerEvent->banner_link): ?>
                <a href="<?php echo e($bannerEvent->banner_link); ?>" target="_blank" style="display:inline-block; text-decoration:none;">
                    <img src="<?php echo e(asset('storage/' . $bannerEvent->banner_path)); ?>" alt="Banner evento" style="width:100%; max-width:900px; border-radius:14px; box-shadow:0 2px 16px rgba(44,62,80,0.13);">
                </a>
            <?php else: ?>
                <img src="<?php echo e(asset('storage/' . $bannerEvent->banner_path)); ?>" alt="Banner evento" style="width:100%; max-width:900px; border-radius:14px; box-shadow:0 2px 16px rgba(44,62,80,0.13);">
            <?php endif; ?>
            <?php if($bannerEvent->banner_message): ?>
                <div style="margin-top:0.7rem; font-size:1.18rem; font-weight:600; color:#1976d2;"><?php echo e($bannerEvent->banner_message); ?></div>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <?php if($events->count() === 0): ?>
        <p>No hay eventos disponibles.</p>
    <?php else: ?>
        <div class="news-grid" style="display:grid; grid-template-columns:repeat(auto-fit,minmax(320px,1fr)); gap:32px; margin-top:2.2rem;">
            <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="news-card" style="background:#fff; border-radius:18px; box-shadow:0 2px 16px rgba(44,62,80,0.08); overflow:hidden; display:flex; flex-direction:column;">
                    <div class="news-image" style="width:100%; height:180px; overflow:hidden; background:#f3f3f3;">
                        <?php if($event->images->count()): ?>
                            <img src="<?php echo e(asset('storage/' . ltrim($event->images->first()->image_path, '/'))); ?>" alt="<?php echo e($event->title); ?>" style="width:100%; height:100%; object-fit:cover; display:block;">
                        <?php else: ?>
                            <img src="<?php echo e(asset('uploads/images/placeholder.jpg')); ?>" alt="<?php echo e($event->title); ?>" style="width:100%; height:100%; object-fit:cover; display:block;">
                        <?php endif; ?>
                    </div>
                    <div class="news-content" style="padding:1.3rem 1.2rem 1.2rem 1.2rem; flex:1; display:flex; flex-direction:column;">
                        <span class="news-category" style="display:inline-block; background:#10b981; color:#fff; font-size:0.98rem; font-weight:600; border-radius:8px; padding:2px 14px 2px 12px; margin-bottom:0.7rem;"><?php echo e(ucfirst($event->category ?? 'Evento')); ?></span>
                        <h3 style="font-size:1.25rem; font-weight:700; margin-bottom:0.5rem; color:#222;"><?php echo e($event->title); ?></h3>
                        <div style="color:#888; font-size:0.98rem; margin-bottom:0.7rem;">
                            <?php echo e(optional($event->date)->format('d/m/Y')); ?>

                            <?php if($event->place): ?>
                                &nbsp;|&nbsp;<span style="color:#1976d2;"><?php echo e($event->place); ?></span>
                            <?php endif; ?>
                        </div>
                        <p style="flex:1; color:#444; margin-bottom:1.1rem;"><?php echo e(\Illuminate\Support\Str::limit(strip_tags($event->description), 120)); ?></p>
                        <a href="<?php echo e(route('public.events.show', $event->id)); ?>" class="read-more" style="color:#1976d2; font-weight:600; text-decoration:none;">Ver detalles →</a>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <div class="pagination" style="margin-top:2.5rem; text-align:center;">
            <?php echo e($events->links()); ?>

        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('public.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\workspace\ISTSSYSTEM\resources\views/public/events/index.blade.php ENDPATH**/ ?>