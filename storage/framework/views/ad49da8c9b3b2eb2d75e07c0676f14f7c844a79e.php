<header class="header">
    
    <div class="topbar">
        <div class="topbar-inner container">
            <nav class="topbar-nav">
                <ul>
                    <li <?php echo e(request()->is('academicos') ? 'class="active"' : ''); ?>>
                        <a href="<?php echo e(url(ltrim(($base ?? '') . '/academicos','/'))); ?>">ACADÉMICOS</a>
                        <div class="dropdown-menu">
                            <div class="dropdown-section">
                                <h4>🎓 Carreras</h4>
                                <?php
                                    $careers = \App\Models\Career::active()->ordered()->get();
                                ?>
                                <?php $__currentLoopData = $careers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $career): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <a href="<?php echo e(url(ltrim(($base ?? '') . '/carrera/' . $career->slug,'/'))); ?>"><?php echo e($career->name); ?></a>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <div class="dropdown-section">
                                <h4>📚 Modalidades y Cursos</h4>
                                <div class="dropdown-modes">
                                    <span>Modalidad Presencial</span>
                                    <span>Modalidad Dual</span>
                                </div>
                                <?php
                                    $sections = \App\Models\AcademicSection::active()->ordered()->get();
                                ?>
                                <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <a href="<?php echo e(url(ltrim(($base ?? '') . '/educacion-continua/' . $section->slug,'/'))); ?>"><?php echo e($section->title); ?></a>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </li>

                    <li <?php echo e(request()->is('campus') ? 'class="active"' : ''); ?>>
                        <a href="<?php echo e(url(ltrim(($base ?? '') . '/campus','/'))); ?>">CAMPUS</a>
                    </li>

                    <li <?php echo e(request()->is('enfoque') ? 'class="active"' : ''); ?>>
                        <a href="<?php echo e(url(ltrim(($base ?? '') . '/enfoque','/'))); ?>">ENFOQUE</a>
                    </li>

                    <li <?php echo e(request()->is('visitar') ? 'class="active"' : ''); ?>>
                        <a href="<?php echo e(url(ltrim(($base ?? '') . '/visitar','/'))); ?>">VISITAR</a>
                    </li>

                    <li <?php echo e(request()->is('acerca') ? 'class="active"' : ''); ?>>
                        <a href="<?php echo e(url(ltrim(($base ?? '') . '/acerca','/'))); ?>">ACERCA</a>
                    </li>

                    <li>
                        <a href="#">TRANSPARENCIA</a>
                        <div class="dropdown-menu">
                            <?php
                                $transparencyContents = DB::table('contents')->where('category', 'transparency')->whereNull('parent_id')->get()->map(function($item) {
                                    return (array) $item;
                                });
                            ?>
                            <?php $__currentLoopData = $transparencyContents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a href="<?php echo e(route('transparency.show', $content['slug'])); ?>"><?php echo e($content['title']); ?></a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </li>

                    <li <?php echo e(request()->is('noticias*') ? 'class="active"' : ''); ?>>
                        <a href="<?php echo e(url(ltrim(($base ?? '') . '/noticias','/'))); ?>">NOTICIAS</a>
                    </li>

                    <li <?php echo e(request()->is('egresados') ? 'class="active"' : ''); ?>>
                        <a href="<?php echo e(url(ltrim(($base ?? '') . '/egresados','/'))); ?>">EGRESADOS</a>
                    </li>
    </div>

    
    <div class="header-main">
        <div class="container">
            <div class="logo-section">
                <h1 class="institution-name">Instituto Superior de Tecnología y Servicios</h1>
                <img src="<?php echo e(asset('assets/images/logoists.png')); ?>" alt="Logo ISTS" style="height: 70px;">
            </div>

            <nav class="main-nav">
                <ul>
                    <li><a href="<?php echo e(url(ltrim(($base ?? '') . '/','/'))); ?>" <?php echo e(request()->is('/') ? 'class="active"' : ''); ?>>Inicio</a></li>
                    <li><a href="<?php echo e(url(ltrim(($base ?? '') . '/academicos','/'))); ?>" <?php echo e(request()->is('academicos*') ? 'class="active"' : ''); ?>>Académicos</a></li>
                    <li><a href="<?php echo e(url(ltrim(($base ?? '') . '/campus','/'))); ?>" <?php echo e(request()->is('campus*') ? 'class="active"' : ''); ?>>Campus</a></li>
                    <li><a href="<?php echo e(url(ltrim(($base ?? '') . '/noticias','/'))); ?>" <?php echo e(request()->is('noticias*') ? 'class="active"' : ''); ?>>Noticias</a></li>
                    <li><a href="<?php echo e(url(ltrim(($base ?? '') . '/contacto','/'))); ?>" <?php echo e(request()->is('contacto*') ? 'class="active"' : ''); ?>>Contacto</a></li>
                </ul>
            </nav>

            <div class="search-box">
                <input type="text" placeholder="Buscar...">
                <button type="submit">Buscar</button>
            </div>
        </div>
    </div>

</header>
<?php /**PATH C:\worspace\ISTSSYSTEM\resources\views/public/partials/header.blade.php ENDPATH**/ ?>