<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($title ?? 'ISTS Admin'); ?></title>
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/admin.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/harvard-style.css')); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>
<body>
    <?php if(!session('user_id') || session('user_role') !== 'admin'): ?>
        <script>
            window.location.href = "<?php echo e(url('/admin/login')); ?>";
        </script>
    <?php endif; ?>

    <div class="admin-layout" style="padding: 2rem;">
        <?php echo $__env->make('admin.partials.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <main>
            <?php echo $__env->yieldContent('content'); ?>
        </main>

        <?php echo $__env->make('admin.partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
</body>
</html><?php /**PATH C:\worspace\ISTSSYSTEM\resources\views/admin/layout.blade.php ENDPATH**/ ?>