

<?php $__env->startSection('header'); ?>
    <?php echo $__env->make('public.partials.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<main class="main-content py-5">
    <div class="container">
        <h1 class="autoridades-title">Nuestras Autoridades</h1>
        <div class="autoridades-grid fade-in">
            <?php $__empty_1 = true; $__currentLoopData = $autoridades; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $autoridad): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="autoridad-card">
                    <div class="autoridad-img-wrap">
                        <?php if($autoridad->foto_path): ?>
                            <img src="<?php echo e(asset('storage/uploads/images/' . $autoridad->foto_path)); ?>" alt="Foto de <?php echo e($autoridad->nombre); ?>" class="autoridad-img">
                        <?php else: ?>
                            <div class="autoridad-img autoridad-img-placeholder">Sin foto</div>
                        <?php endif; ?>
                    </div>
                    <div class="autoridad-info">
                        <h3 class="autoridad-nombre"><?php echo e($autoridad->nombre); ?></h3>
                        <div class="autoridad-cargo"><?php echo e($autoridad->cargo); ?></div>
                        <div class="autoridad-categoria"><?php echo e($autoridad->categoria); ?></div>
                        <?php if($autoridad->biografia): ?>
                            <div class="autoridad-bio"><?php echo $autoridad->biografia; ?></div>
                        <?php endif; ?>
                        <?php if($autoridad->pdf_path): ?>
                            <a href="<?php echo e(asset('storage/' . $autoridad->pdf_path)); ?>" target="_blank" class="autoridad-cv-btn">Descargar Currículum (PDF)</a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="alert alert-info text-center" role="alert">
                    No hay autoridades registradas en este momento.
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<style>
body {
    font-family: 'Montserrat', 'Segoe UI', Arial, sans-serif;
    background: #f4f8fb;
}
.autoridades-title {
    text-align: center;
    font-size: 2.7rem;
    font-weight: 900;
    margin-bottom: 2.5rem;
    color: #00796b;
    letter-spacing: 1px;
    text-shadow: 0 2px 8px rgba(44,62,80,0.08);
}
.autoridades-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
    gap: 2.5rem;
}
.autoridad-card {
    background: #fff;
    border-radius: 1.5rem;
    box-shadow: 0 6px 32px rgba(44,62,80,0.10), 0 1.5px 4px rgba(0,0,0,0.04);
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 2.2rem 1.7rem 1.7rem 1.7rem;
    transition: box-shadow 0.2s, transform 0.2s;
    min-height: 420px;
    border: 1.5px solid #e0e7ef;
    position: relative;
}
.autoridad-card:hover {
    box-shadow: 0 12px 40px rgba(44,62,80,0.16), 0 2px 8px rgba(0,0,0,0.08);
    transform: translateY(-6px) scale(1.025);
    border-color: #b2dfdb;
}
.autoridad-img-wrap {
    width: 140px;
    height: 140px;
    margin-bottom: 1.2rem;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #e0f7fa 0%, #f7faff 100%);
    border-radius: 50%;
    overflow: hidden;
    box-shadow: 0 2px 12px rgba(44,62,80,0.10);
    border: 3px solid #b2dfdb;
}
.autoridad-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 50%;
}
.autoridad-img-placeholder {
    color: #aaa;
    font-size: 1.1rem;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    height: 100%;
    background: #f0f0f0;
    border-radius: 50%;
}
.autoridad-info {
    text-align: center;
    margin-top: 0.5rem;
}
.autoridad-nombre {
    font-size: 1.5rem;
    font-weight: 800;
    margin-bottom: 0.3rem;
    color: #00796b;
    letter-spacing: 0.5px;
}
.autoridad-cargo {
    font-size: 1.1rem;
    font-weight: 600;
    color: #1976d2;
    margin-bottom: 0.2rem;
}
.autoridad-categoria {
    font-size: 1rem;
    color: #888;
    margin-bottom: 0.7rem;
}
.autoridad-bio {
    font-size: 1rem;
    color: #444;
    margin-bottom: 0.7rem;
    text-align: justify;
}
.autoridad-cv-btn {
    display: inline-block;
    background: linear-gradient(90deg,#1abc9c,#3498db);
    color: #fff;
    border: none;
    padding: 0.5rem 1.2rem;
    border-radius: 6px;
    text-decoration: none;
    font-weight: 700;
    margin-top: 0.7rem;
    transition: background 0.2s, box-shadow 0.2s;
    box-shadow: 0 2px 8px rgba(44,62,80,0.08);
    letter-spacing: 0.5px;
}
.autoridad-cv-btn:hover {
    background: linear-gradient(90deg,#3498db,#1abc9c);
    box-shadow: 0 4px 16px rgba(44,62,80,0.13);
}
.fade-in {
    animation: fadeIn 1.2s cubic-bezier(0.23, 1, 0.32, 1);
}
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: none; }
}
@media (max-width: 600px) {
    .main-content {
        padding-top: 70px;
    }
    .autoridades-title {
        font-size: 1.5rem;
    }
    .autoridades-grid {
        gap: 1rem;
    }
    .autoridad-card {
        padding: 1.2rem 0.5rem 1rem 0.5rem;
        min-height: 340px;
    }
    .autoridad-img-wrap {
        width: 90px;
        height: 90px;
    }
    .autoridad-nombre {
        font-size: 1.1rem;
    }
}
</style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('public.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\workspace\ISTSSYSTEM\resources\views/public/autoridades/index.blade.php ENDPATH**/ ?>