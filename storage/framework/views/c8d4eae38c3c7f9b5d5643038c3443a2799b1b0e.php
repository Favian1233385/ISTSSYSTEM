<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo e($title ?? 'ISTS Sucúa'); ?></title>
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/harvard-style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/harvard-exact.css')); ?>">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <?php echo $__env->yieldPushContent('styles'); ?>
    <link rel="icon" type="image/png" href="<?php echo e(asset('assets/images/logoists.png')); ?>" sizes="32x32">
</head>
<body>
    <?php echo $__env->make('public.partials.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    
    <?php if(isset($popup) && $popup): ?>
        <div id="popupModal" class="modal fade show" tabindex="-1" aria-modal="true" role="dialog" style="display:block; background:rgba(30,30,30,0.35); z-index:2000;">
            <div class="modal-dialog modal-lg modal-dialog-centered" style="max-width:950px;">
                <div class="modal-content" style="border-radius:18px; overflow:hidden; position:relative;">
                    <button type="button" class="btn-close position-absolute" style="right:18px;top:18px;z-index:10;" aria-label="Cerrar" onclick="document.getElementById('popupModal').style.display='none';"></button>
                    <?php if($popup->link): ?>
                        <a href="<?php echo e($popup->link); ?>" target="_blank" style="display:block;">
                            <img src="<?php echo e(asset('storage/' . $popup->image_path)); ?>" alt="PopUp" style="width:100%; max-width:900px; display:block; margin:0 auto;">
                        </a>
                    <?php else: ?>
                        <img src="<?php echo e(asset('storage/' . $popup->image_path)); ?>" alt="PopUp" style="width:100%; max-width:900px; display:block; margin:0 auto;">
                    <?php endif; ?>
                    <?php if($popup->message): ?>
                        <div style="text-align:center; font-size:1.18rem; font-weight:600; color:#1976d2; margin:0.7rem 0 1.2rem 0;"><?php echo e($popup->message); ?></div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <script>
            // Cerrar modal al hacer click fuera del contenido
            document.addEventListener('click', function(e) {
                var modal = document.getElementById('popupModal');
                if (modal && e.target === modal) {
                    modal.style.display = 'none';
                }
            });
        </script>
    <?php endif; ?>

    <main class="main-content" style="padding-top: 120px;">
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <?php echo $__env->make('public.partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="<?php echo e(asset('js/main.js')); ?>"></script>
    <script src="<?php echo e(asset('ISTSSYSTEM/js/chatbot.js')); ?>?v=<?php echo e(time()); ?>" defer></script>
    <script src="<?php echo e(asset('js/dropdowns.js')); ?>"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var myCarousel = document.querySelector('#heroCarousel');
        if (myCarousel) {
            var carousel = new bootstrap.Carousel(myCarousel, {
                interval: 5000,
                ride: 'carousel',
                pause: false,
                wrap: true
            });
            console.log('Bootstrap Carousel inicializado:', carousel);
            // Forzar avance cada 5 segundos para depuración
            setInterval(function() {
                carousel.next();
                console.log('Forzando avance de slide');
            }, 5000);
        } else {
            console.log('Bootstrap Carousel: no encontrado en el DOM');
        }
    });
    </script>
    <?php echo $__env->yieldPushContent('scripts'); ?>

    <?php echo $__env->make('public.partials.social_floating', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</body>
</html>
<?php /**PATH C:\workspace\ISTSSYSTEM\resources\views/layouts/public.blade.php ENDPATH**/ ?>