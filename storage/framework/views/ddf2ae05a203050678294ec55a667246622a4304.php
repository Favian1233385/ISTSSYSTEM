<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($title ?? 'Gestión de Contenidos - ISTS Admin'); ?></title>
    <link rel="stylesheet" href="<?php echo e(asset('public/css/style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('public/css/admin.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('public/css/harvard-style.css')); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>
<body class="admin-body">
    <!-- Header Administrativo -->
    <header class="admin-header">
        <div class="admin-header-content">
            <div class="admin-logo">
                <img src="<?php echo e(asset('public/assets/images/logo-ists.png')); ?>" alt="ISTS Logo" class="admin-logo-img">
                <h1>ISTS Admin</h1>
            </div>

            <nav class="admin-nav">
                <ul class="admin-nav-menu">
                    <li><a href="<?php echo e(url('admin/dashboard')); ?>">📊 Dashboard</a></li>
                    <li><a href="<?php echo e(url('contents/create')); ?>" class="active">📝 Contenidos</a></li>
                    <li><a href="<?php echo e(url('news/create')); ?>">📰 Noticias</a></li>
                    <li><a href="<?php echo e(url('users')); ?>">👥 Usuarios</a></li>
                    <li><a href="<?php echo e(url('settings')); ?>">⚙️ Configuración</a></li>
                </ul>
            </nav>

            <div class="admin-user-menu">
                <div class="user-info">
                    <span class="user-name"><?php echo e(session('user_email', 'Usuario')); ?></span>
                    <div class="user-dropdown">
                        <a href="<?php echo e(url('admin/profile')); ?>">👤 Perfil</a>
                        <a href="<?php echo e(url('auth/change-password')); ?>">🔒 Cambiar Contraseña</a>
                        <a href="<?php echo e(url('auth/logout')); ?>">🚪 Cerrar Sesión</a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Contenido Principal -->
    <main class="admin-main">
        <div class="admin-container">
            <div class="admin-content">
                <div class="dashboard-header">
                    <h1>📝 Gestión de Contenidos</h1>
                    <p>Administra los contenidos del sitio.</p>
                    <a href="<?php echo e(route('admin.contents.create')); ?>" class="btn btn-primary">Crear Contenido</a>
                </div>

                <?php if(session('success')): ?>
                    <div class="alert alert-success"><?php echo e(session('success')); ?></div>
                <?php endif; ?>
                <?php if($errors->any()): ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Título</th>
                                <th>Documentos</th>
                                <th>Sitios Externos</th>
                                <th>Estado</th>
                                <th>Creado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(isset($is_hierarchical) && $is_hierarchical): ?>
                                <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $parent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($parent["id"]); ?></td>
                                        <td><strong><?php echo e($parent["title"]); ?></strong></td>
                                        <td>
                                            <?php if(!empty($parent['file_url'])): ?>
                                                <?php $files = json_decode($parent['file_url'], true); ?>
                                                <?php if(is_array($files)): ?>
                                                    <?php $__currentLoopData = $files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <a href="<?php echo e(asset($file)); ?>" target="_blank">Ver Archivo</a><br>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php elseif(filter_var($parent['file_url'], FILTER_VALIDATE_URL)): ?>
                                                    <a href="<?php echo e($parent['file_url']); ?>" target="_blank">Ver Archivo Externo</a>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                -
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if(!empty($parent['is_external']) && !empty($parent['url'])): ?>
                                                <a href="<?php echo e($parent['url']); ?>" target="_blank"><?php echo e($parent['url']); ?></a>
                                            <?php else: ?>
                                                -
                                            <?php endif; ?>
                                        </td>
                                        <td><span class="badge status-<?php echo e($parent["status"]); ?>"><?php echo e($parent["status"]); ?></span></td>
                                        <td><?php echo e(\Carbon\Carbon::parse($parent["created_at"])->format('d/m/Y')); ?></td>
                                        <td class="actions">
                                            <a href="<?php echo e(route('admin.contents.edit', $parent['id'])); ?>" class="btn btn-sm btn-secondary">Editar</a>
                                            <form action="<?php echo e(route('admin.contents.destroy', $parent['id'])); ?>" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de que quieres eliminar este contenido?');">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php if(!empty($parent['children'])): ?>
                                    <?php $__currentLoopData = $parent['children']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr style="background-color: #f9f9f9;">
                                            <td><?php echo e($child["id"]); ?></td>
                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;└─ <?php echo e($child["title"]); ?> <small>(Sub-reglamento)</small></td>
                                            <td>
                                                <?php if(!empty($child['file_url'])): ?>
                                                    <?php $files = json_decode($child['file_url'], true); ?>
                                                    <?php if(is_array($files)): ?>
                                                        <?php $__currentLoopData = $files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <a href="<?php echo e(asset($file)); ?>" target="_blank">Ver Archivo</a><br>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php elseif(filter_var($child['file_url'], FILTER_VALIDATE_URL)): ?>
                                                        <a href="<?php echo e($child['file_url']); ?>" target="_blank">Ver Archivo Externo</a>
                                                    <?php endif; ?>
                                                <?php else: ?>
                                                    -
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if(!empty($child['is_external']) && !empty($child['url'])): ?>
                                                    <a href="<?php echo e($child['url']); ?>" target="_blank"><?php echo e($child['url']); ?></a>
                                                <?php else: ?>
                                                    -
                                                <?php endif; ?>
                                            </td>
                                            <td><span class="badge status-<?php echo e($child["status"]); ?>"><?php echo e($child["status"]); ?></span></td>
                                            <td><?php echo e(\Carbon\Carbon::parse($child["created_at"])->format('d/m/Y')); ?></td>
                                            <td class="actions">
                                                <a href="<?php echo e(route('admin.contents.edit', $child['id'])); ?>" class="btn btn-sm btn-secondary">Editar</a>
                                                <form action="<?php echo e(route('admin.contents.destroy', $child['id'])); ?>" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de que quieres eliminar este contenido?');">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($item["id"]); ?></td>
                                        <td><?php echo e($item["title"]); ?></td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td><span class="badge status-<?php echo e($item["status"]); ?>"><?php echo e($item["status"]); ?></span></td>
                                        <td><?php echo e(\Carbon\Carbon::parse($item["created_at"])->format('d/m/Y')); ?></td>
                                        <td class="actions">
                                            <a href="<?php echo e(route('admin.contents.edit', $item['id'])); ?>" class="btn btn-sm btn-secondary">Editar</a>
                                            <form action="<?php echo e(route('admin.contents.destroy', $item['id'])); ?>" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de que quieres eliminar este contenido?');">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Paginación -->
                <?php echo e($items->links()); ?>

            </div>
        </div>
    </main>

    <!-- Footer Administrativo -->
    <footer class="admin-footer">
        <div class="admin-footer-content">
            <p>&copy; <?php echo e(date('Y')); ?> Instituto Superior Tecnológico Sucúa - Panel Administrativo Todos los Derechos reservados F.C</p>
            <div class="admin-footer-links">
                <a href="<?php echo e(url('/')); ?>" target="_blank">🌐 Ver Sitio Web</a>
                <a href="<?php echo e(url('/admin/help')); ?>">❓ Ayuda</a>
                <a href="<?php echo e(url('/admin/logs')); ?>">📋 Logs del Sistema</a>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="<?php echo e(asset('js/admin.js')); ?>"></script>
</body>
</html>
<?php /**PATH C:\worspace\ISTSSYSTEM\resources\views/admin/crud/contents/list.blade.php ENDPATH**/ ?>