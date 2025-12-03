<?php if(isset($updates) && count($updates)): ?>
<section class="updates-section">
    <div class="container">
        <div class="section-header">
            <h2>Últimas actualizaciones</h2>
            <p>Videos, imágenes y novedades recientes del ISTS.</p>
        </div>
        <div class="updates-container">
            <?php $__currentLoopData = $updates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $update): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="update-card-full">
                    <div class="update-header-section">
                        <h3><?php echo e($update->title); ?></h3>
                        <div class="update-date-inline">
                            <svg width="18" height="18" fill="none" stroke="#666" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
                            <span><?php echo e($update->date->format('d/m/Y')); ?></span>
                        </div>
                        <p><?php echo e($update->description); ?></p>
                    </div>
                    <div class="update-media-section">
                        <div class="update-video-column">
                            <div class="video-container">
                                <?php if($update->video_url): ?>
                                    <iframe src="<?php echo e($update->video_url); ?>" allowfullscreen></iframe>
                                <?php elseif($update->video_path): ?>
                                    <video controls>
                                        <source src="<?php echo e(asset('storage/' . $update->video_path)); ?>" type="video/mp4">
                                        Tu navegador no soporta el video.
                                    </video>
                                <?php else: ?>
                                    <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;color:#aaa;">Sin video</div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="update-image-column">
                            <?php if($update->image_path): ?>
                                <img src="<?php echo e(asset('storage/' . $update->image_path)); ?>" alt="<?php echo e($update->title); ?>">
                            <?php else: ?>
                                <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;color:#bbb;">Sin imagen</div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php if($update->link_url): ?>
                        <div style="text-align:center;margin:1rem 0;">
                            <a href="<?php echo e($update->link_url); ?>" class="btn btn-outline" target="_blank"><?php echo e($update->link_text ?? 'Ver más'); ?></a>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php endif; ?>
<?php /**PATH C:\worspace\ISTSSYSTEM\resources\views/public/partials/updates.blade.php ENDPATH**/ ?>