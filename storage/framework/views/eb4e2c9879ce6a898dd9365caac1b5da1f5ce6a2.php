<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_','-',app()->getLocale())); ?>" <?php if(app()->getLocale() === 'ar'): ?> dir="rtl" <?php endif; ?>>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo e($title ?? config('app.name', 'ISTS')); ?></title>
    <?php
        // Prefer the server base path (e.g. when deployed under a subfolder),
        // otherwise fall back to the APP_BASE env var or config('app.base_path').
        $reqBase = request()->getBasePath();
        $envBase = env('APP_BASE', config('app.base_path', ''));
        $computed = $reqBase ?: $envBase;
        // normalize: make empty string or leading-slash path (/ISTSSYSTEM)
        $base = $computed ? '/'.ltrim(rtrim($computed, '/'), '/') : '';
    ?>
    
    <link rel="stylesheet" href="<?php echo e($base); ?>/css/app.css">
    
    <link rel="stylesheet" href="<?php echo e($base); ?>/css/admin.css">
    <link rel="stylesheet" href="<?php echo e($base); ?>/css/style.css">
    <?php if(app()->getLocale() === 'ar'): ?>
        <link rel="stylesheet" href="<?php echo e($base); ?>/css/app-rtl.css">
    <?php endif; ?>
</head>
<body>
    <div class="site-main">
        <?php echo $__env->make('public.partials.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <main>
            <?php echo $__env->yieldContent('content'); ?>
        </main>
        <?php echo $__env->make('public.partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>

    <script src="<?php echo e($base); ?>/js/main.js"></script>
    <script src="<?php echo e($base); ?>/js/dropdowns.js"></script>
</body>
</html>
<?php /**PATH C:\worspace\ISTSSYSTEM\resources\views/layouts/site.blade.php ENDPATH**/ ?>