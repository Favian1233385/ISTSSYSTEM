<header class="header">
    <div class="section-page-header">
        <div class="container text-center">
            <h1 class="section-page-title">Instituto Superior de Tecnología y Servicios</h1>
            <p class="section-page-subtitle">Educación de calidad para un futuro mejor</p>
        </div>
    </div>

    
    <div class="header-main">
        <div class="container" style="display: flex; justify-content: space-between; align-items: center;">
            <nav class="main-nav">
                <ul style="list-style: none; display: flex; gap: 1rem; margin: 0; padding: 0;">
                    <li><a href="<?php echo e(url(ltrim(($base ?? '') . '/','/'))); ?>" <?php echo e(request()->is('/') ? 'class="active"' : ''); ?> style="color: #343a40; text-decoration: none;">Inicio</a></li>
                    <li><a href="<?php echo e(url(ltrim(($base ?? '') . '/academicos','/'))); ?>" <?php echo e(request()->is('academicos*') ? 'class="active"' : ''); ?> style="color: #343a40; text-decoration: none;">Académicos</a></li>
                    <li><a href="<?php echo e(url(ltrim(($base ?? '') . '/campus','/'))); ?>" <?php echo e(request()->is('campus*') ? 'class="active"' : ''); ?> style="color: #343a40; text-decoration: none;">Campus</a></li>
                    <li><a href="<?php echo e(url(ltrim(($base ?? '') . '/noticias','/'))); ?>" <?php echo e(request()->is('noticias*') ? 'class="active"' : ''); ?> style="color: #343a40; text-decoration: none;">Noticias</a></li>
                    <li><a href="<?php echo e(url(ltrim(($base ?? '') . '/contacto','/'))); ?>" <?php echo e(request()->is('contacto*') ? 'class="active"' : ''); ?> style="color: #343a40; text-decoration: none;">Contacto</a></li>
                </ul>
            </nav>

            <div class="search-box" style="display: flex; align-items: center; gap: 0.5rem;">
                <input type="text" placeholder="Buscar..." style="padding: 0.5rem; border: 1px solid #e5e7eb; border-radius: 4px;">
                <button type="submit" style="padding: 0.5rem 1rem; background-color: #198754; color: #fff; border: none; border-radius: 4px;">Buscar</button>
            </div>
        </div>
    </div>
</header>

<style>
    .section-page-header {
        background-color: #f8f9fa;
        padding: 2rem 0;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    .section-page-title {
        font-size: 2rem;
        font-weight: 700;
        color: #343a40;
        margin: 0;
    }
    .section-page-subtitle {
        font-size: 1.25rem;
        color: #6c757d;
        margin-top: 0.5rem;
    }
</style>
<?php /**PATH C:\worspace\ISTSSYSTEM\resources\views/public/partials/header.blade.php ENDPATH**/ ?>