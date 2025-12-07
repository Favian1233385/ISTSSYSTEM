

<?php $__env->startSection('content'); ?>
    <div class="container">
        <h1><?php echo e($title ?? 'Noticias'); ?></h1>

        <?php if($news->count() === 0): ?>
            <p>No hay noticias publicadas.</p>
        <?php else: ?>
            <ul>
                <?php $__currentLoopData = $news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $n): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li>
                        <a href="<?php echo e(url(ltrim(($base ?? '') . '/noticias/' . ($n->slug ?? $n->id), '/'))); ?>"><?php echo e($n->title ?? 'Sin título'); ?></a>
                        <div class="meta"><?php echo e(optional(\Carbon\Carbon::parse($n->published_at ?? null))->format('d/m/Y')); ?></div>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>

            <div class="pagination">
                <?php echo e($news->links()); ?>

            </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.site', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\worspace\ISTSSYSTEM\resources\views/public/news/index.blade.php ENDPATH**/ ?>