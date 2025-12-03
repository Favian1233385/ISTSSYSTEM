<header class="admin-header">
    <div class="admin-header-content">
        <?php $base = rtrim(request()->getBasePath(), '/'); ?>
        <div class="admin-logo">
            <img src="<?php echo e(($base !== '' ? $base : '') . '/assets/images/logoists.png'); ?>" alt="ISTS Logo" class="admin-logo-img">
            <h1>ISTS Admin</h1>
        </div>

        <nav class="admin-nav">
            <ul class="admin-nav-menu">
                <li><a href="<?php echo e(url('/admin/dashboard')); ?>" class="<?php echo e(request()->is('admin/dashboard') ? 'active':''); ?>">📊 Dashboard</a></li>
                <li><a href="<?php echo e(url('/admin/contents')); ?>" class="<?php echo e(request()->is('admin/contents*') ? 'active':''); ?>">📝 Contenidos</a></li>
                <li><a href="<?php echo e(url('/admin/news')); ?>" class="<?php echo e(request()->is('admin/news*') ? 'active':''); ?>">📰 Noticias</a></li>
                <li><a href="<?php echo e(url('/admin/about')); ?>" class="<?php echo e(request()->is('admin/about*') ? 'active':''); ?>">ℹ️ Acerca</a></li>
                <li><a href="<?php echo e(route('admin.autoridades.index')); ?>" class="<?php echo e(request()->is('admin/autoridades*') ? 'active':''); ?>">👨‍💼 Autoridades</a></li>
                <li><a href="<?php echo e(url('/admin/users')); ?>" class="<?php echo e(request()->is('admin/users*') ? 'active':''); ?>">👥 Usuarios</a></li>
                <li><a href="<?php echo e(url('/admin/settings')); ?>" class="<?php echo e(request()->is('admin/settings') ? 'active':''); ?>">⚙️ Configuración</a></li>
            </ul>
        </nav>

        <div class="admin-user-menu">
            <div class="user-info">
                <span class="user-name"><?php echo e(optional(Auth::user())->email ?? 'Usuario'); ?></span>
                <div class="user-dropdown">
                    <a href="<?php echo e(url('/admin/profile')); ?>">👤 Perfil</a>
                    <a href="<?php echo e(url('/auth/change-password')); ?>">🔒 Cambiar Contraseña</a>
                    <a href="<?php echo e(url('/logout')); ?>">🚪 Cerrar Sesión</a>
                </div>
            </div>
        </div>
    </div>
</header>
<?php /**PATH C:\worspace\ISTSSYSTEM\resources\views/admin/partials/header.blade.php ENDPATH**/ ?>