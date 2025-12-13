

<?php $__env->startSection('content'); ?>
    <div class="container">
        <h1><?php echo e($news['title'] ?? 'Noticia'); ?></h1>
        <p class="meta"><?php echo e(optional(\Carbon\Carbon::parse($news['published_at'] ?? null))->format('d/m/Y')); ?></p>
        <?php if(isset($news['images']) && is_array($news['images']) && count($news['images']) > 0): ?>
            <div class="news-gallery" style="margin-bottom: 1.5rem;">
                <?php $__currentLoopData = $news['images']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <img src="<?php echo e(asset('storage/' . ltrim($img, '/'))); ?>" alt="Imagen noticia" style="max-width: 220px; margin-right: 8px; margin-bottom: 8px; display:inline-block;">
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>
        <div class="body">
            <?php echo $news['content'] ?? ($news['summary'] ?? ''); ?>

        </div>
        <p><a href="<?php echo e(url(ltrim(($base ?? '') . '/noticias','/'))); ?>">Volver a Noticias</a></p>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.site', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\workspace\ISTSSYSTEM\resources\views/public/news/show.blade.php ENDPATH**/ ?>