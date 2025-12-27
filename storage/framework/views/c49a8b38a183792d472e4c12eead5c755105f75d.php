<?php if(isset($updates) && count($updates)): ?>
<section class="updates-section">
    <div class="container">
        <div class="section-header">
            <h2 style="
                font-size:2.3rem;
                font-weight:800;
                color:#00796b;
                margin-bottom:0.7rem;
                letter-spacing:-1px;
                text-align:center;
                position:relative;">
                Últimas actualizaciones
                <span style="display:block; height:4px; width:54px; background:linear-gradient(90deg,#1abc9c,#3498db); border-radius:2px; margin:10px auto 0 auto;"></span>
            </h2>
            <p style="font-size:1.18rem; color:#1976d2; text-align:center; max-width:700px; margin:0 auto 1.7rem auto; font-weight:500;">
                Videos, imágenes y novedades recientes del ISTS.
            </p>
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
                            <a href="<?php echo e($update->link_url); ?>" class="btn-update-link" target="_blank">
                                <?php echo e($update->link_text ?? 'Entra Aquí!'); ?>

                                <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="margin-left:0.3em;">
                                    <path d="M5 12h14"></path>
                                    <path d="M13 6l6 6-6 6"></path>
                                </svg>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php endif; ?>
<?php /**PATH C:\workspace\ISTSSYSTEM\resources\views/public/partials/updates.blade.php ENDPATH**/ ?>