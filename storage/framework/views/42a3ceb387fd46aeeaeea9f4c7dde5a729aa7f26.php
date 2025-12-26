<!DOCTYPE html>
<html lang="es" <?php if(app()->getLocale() === 'ar'): ?> dir="rtl" <?php endif; ?>>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($title ?? 'Crear Noticia - ISTS Admin'); ?></title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/admin.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/harvard-style.css')); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <?php if(app()->getLocale() === 'ar'): ?>
        <link rel="stylesheet" href="<?php echo e(asset('css/app-rtl.css')); ?>">
    <?php endif; ?>
    <link rel="icon" type="image/png" href="<?php echo e(asset('assets/images/logoists.png')); ?>" sizes="32x32">
</head>
<body class="admin-body">
    <!-- Header Administrativo -->
    <header class="admin-header">
        <div class="admin-header-content">
                <div class="admin-logo">
                <img src="<?php echo e(asset('assets/images/logoists.png')); ?>" alt="ISTS Logo" class="admin-logo-img">
                <h1>ISTS Admin</h1>
            </div>

            <nav class="admin-nav">
                <ul class="admin-nav-menu">
                    <li><a href="<?php echo e(url('/admin/dashboard')); ?>">📊 Dashboard</a></li>
                    <li><a href="<?php echo e(url('/admin/contents')); ?>">📝 Contenidos</a></li>
                    <li><a href="<?php echo e(url('/admin/news')); ?>" class="active">📰 Noticias</a></li>
                    <li><a href="<?php echo e(url('/admin/users')); ?>">👥 Usuarios</a></li>
                    <li><a href="<?php echo e(url('/admin/settings')); ?>">⚙️ Configuración</a></li>
                </ul>
            </nav>

            <div class="admin-user-menu">
                <div class="user-info">
                    <span class="user-name"><?php echo e(optional(Auth::user())->email ?? 'Usuario'); ?></span>
                    <div class="user-dropdown">
                        <a href="<?php echo e(url('/admin/profile')); ?>">👤 Perfil</a>
                        <a href="<?php echo e(url('/auth/change-password')); ?>">🔒 Cambiar Contraseña</a>
                        <a href="<?php echo e(url('/auth/logout')); ?>">🚪 Cerrar Sesión</a>
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
                    <h1>📰 Crear Noticia</h1>
                    <p>Rellena el formulario para crear una nueva noticia.</p>
                </div>

                <?php if($errors->any()): ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form action="<?php echo e(route('admin.news.store')); ?>" method="POST" enctype="multipart/form-data" style="max-width:600px; margin: 0 auto;">
                    <?php echo csrf_field(); ?>
                    <div class="mb-3">
                        <label for="title" class="form-label fw-bold text-primary">Título</label>
                        <input type="text" name="title" id="title" class="form-control" value="<?php echo e(old('title')); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="summary" class="form-label fw-bold text-primary">Resumen</label>
                        <textarea name="summary" id="summary" class="form-control tinymce-editor" rows="3"><?php echo e(old('summary')); ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="content" class="form-label fw-bold text-primary">Contenido</label>
                        <textarea name="content" id="content" class="form-control tinymce-editor" rows="10"><?php echo e(old('content')); ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="images" class="form-label fw-bold text-primary">Imágenes</label>
                        <input type="file" name="images[]" id="images" class="form-control" multiple>
                        <small class="form-text text-muted">Puedes seleccionar varias imágenes. La primera será la principal.</small>
                    </div>
                    <div class="mb-3">
                        <label for="order" class="form-label fw-bold text-primary">Orden/Prioridad</label>
                        <input type="number" name="order" id="order" class="form-control" min="1" value="<?php echo e(old('order')); ?>">
                        <small class="form-text text-muted">1 = más importante. Si se deja vacío, se ordena por fecha.</small>
                    </div>
                    <div class="mb-3">
                        <label for="category" class="form-label fw-bold text-primary">Categoría</label>
                        <select name="category" id="category" class="form-select">
                            <option value="noticias" <?php if(old('category') == 'noticias'): ?> selected <?php endif; ?>>Noticias</option>
                            <option value="institucional" <?php if(old('category') == 'institucional'): ?> selected <?php endif; ?>>Institucional</option>
                            <option value="eventos" <?php if(old('category') == 'eventos'): ?> selected <?php endif; ?>>Eventos</option>
                            <option value="comunicados" <?php if(old('category') == 'comunicados'): ?> selected <?php endif; ?>>Comunicados</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="status" class="form-label fw-bold text-primary">Estado</label>
                        <select name="status" id="status" class="form-select">
                            <option value="draft" <?php if(old('status') == 'draft'): ?> selected <?php endif; ?>>Borrador</option>
                            <option value="published" <?php if(old('status') == 'published'): ?> selected <?php endif; ?>>Publicado</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 fw-bold">Crear Noticia</button>
                </form>
                    <script src="https://cdn.tiny.cloud/1/tr5q9gaoe9ca3hwsq6nah42q8dqhrtqznrl0gd9523anjatx/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
                    <script>
                        tinymce.init({
                            selector: 'textarea.tinymce-editor',
                            height: 350,
                            menubar: true,
                            plugins: [
                                'advlist autolink lists link image charmap preview anchor',
                                'searchreplace visualblocks code fullscreen',
                                'insertdatetime media table paste code help wordcount',
                                'align'
                            ],
                            toolbar: 'undo redo | formatselect | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
                            language: 'es',
                        });
                        document.addEventListener('DOMContentLoaded', function() {
                            var form = document.querySelector('form[action][method="POST"]');
                            if (form) {
                                form.addEventListener('submit', function(e) {
                                    if (window.tinymce) {
                                        tinymce.triggerSave();
                                    }
                                });
                            }
                        });
                    </script>
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
    <?php $__env->startPush('scripts'); ?>
        <script src="https://cdn.tiny.cloud/1/tr5q9gaoe9ca3hwsq6nah42q8dqhrtqznrl0gd9523anjatx/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
        <script>
            tinymce.init({
                selector: '#summary, #content',
                height: 350,
                menubar: true,
                plugins: [
                    'advlist autolink lists link image charmap preview anchor',
                    'searchreplace visualblocks code fullscreen',
                    'insertdatetime media table paste code help wordcount',
                    'align'
                ],
                toolbar: 'undo redo | formatselect | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
                language: 'es',
            });
            document.addEventListener('DOMContentLoaded', function() {
                var form = document.querySelector('form[action][method="POST"]');
                if (form) {
                    form.addEventListener('submit', function(e) {
                        if (window.tinymce) {
                            tinymce.triggerSave();
                        }
                    });
                }
            });
        </script>
    <?php $__env->stopPush(); ?>
</body>
</html>
<?php /**PATH C:\workspace\ISTSSYSTEM\resources\views/admin/crud/news/create.blade.php ENDPATH**/ ?>