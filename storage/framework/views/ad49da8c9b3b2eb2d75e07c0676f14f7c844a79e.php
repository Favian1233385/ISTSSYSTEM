
<header class="header-public">
    
    <?php
        $allCareers = \App\Models\Career::where('is_active', true)->orderBy('name')->get();
        $courses = \Illuminate\Support\Facades\DB::table('contents')->where('category', 'course')->where('status', 'published')->orderBy('title')->get();
        $transparencyContents = \Illuminate\Support\Facades\DB::table('contents')->where('category', 'transparency')->whereNull('parent_id')->where('status', 'published')->orderBy('title')->get();
        $tramites = \Illuminate\Support\Facades\DB::table('contents')->where('category', 'tramites')->where('status', 'published')->orderBy('title')->get();
    ?>
    <nav class="header-navbar">
        <ul class="header-menu">
            <li>
                <a href="<?php echo e(url('/')); ?>">
                    <img src="<?php echo e(asset('assets/images/logoists.png')); ?>" alt="Logo ISTS" style="height: 50px; vertical-align: middle;">
                </a>
            </li>
            <li class="dropdown">
                <a href="javascript:void(0);" class="header-link">ACADÉMICOS</a>
                <div class="dropdown-content two-column">
                    <div class="column">
                        <h4>Carreras</h4>
                        <ul>
                            <?php $__currentLoopData = $allCareers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $career): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><a href="<?php echo e(url('/carrera/' . $career->slug)); ?>"><?php echo e($career->name); ?></a></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                    <div class="column">
                        <h4>Cursos</h4>
                        <ul>
                            <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><a href="<?php echo e(url('/contenido/' . $course->slug)); ?>"><?php echo e($course->title); ?></a></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                </div>
            </li>
            <li class="dropdown">
                <a href="javascript:void(0);" class="header-link<?php echo e(request()->is('campus*') ? ' active' : ''); ?>">CAMPUS</a>
                <ul class="dropdown-content">
                    <li><a href="<?php echo e(url('/campus/instalaciones')); ?>">Instalaciones</a></li>
                    <li><a href="<?php echo e(url('/campus/servicios')); ?>">Servicios</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="javascript:void(0);" class="header-link<?php echo e(request()->is('transparencia*') ? ' active' : ''); ?>">TRANSPARENCIA</a>
                <ul class="dropdown-content">
                    <?php $__currentLoopData = $transparencyContents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><a href="<?php echo e(url('/transparencia/' . $item->slug)); ?>"><?php echo e($item->title); ?></a></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </li>
            <li class="dropdown">
                <a href="javascript:void(0);" class="header-link<?php echo e(request()->is('visitar*') ? ' active' : ''); ?>">VISITAR</a>
                <ul class="dropdown-content">
                    <li><a href="<?php echo e(url('/visitar')); ?>">Visitar ISTS</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="javascript:void(0);" class="header-link<?php echo e(request()->is('acerca*') ? ' active' : ''); ?>">ACERCA</a>
                <ul class="dropdown-content">
                    <li><a href="<?php echo e(url('/acerca')); ?>">Sobre el ISTS</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="javascript:void(0);" class="header-link<?php echo e(request()->is('noticias*') ? ' active' : ''); ?>">NOTICIAS</a>
                <ul class="dropdown-content">
                    <li><a href="<?php echo e(url('/noticias')); ?>">Todas las Noticias</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="javascript:void(0);" class="header-link<?php echo e(request()->is('tramites*') ? ' active' : ''); ?>">TRÁMITES</a>
                <ul class="dropdown-content">
                    <?php $__currentLoopData = $tramites; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><a href="<?php echo e(url('/tramites/' . $item->slug)); ?>"><?php echo e($item->title); ?></a></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </li>
        </ul>
    </nav>
</header>

<style>
    .header-public {
        width: 100%;
        background: transparent;
        box-shadow: 0 2px 8px rgba(0,0,0,0.07);
        position: fixed;
        top: 0;
        left: 0;
        z-index: 1000;
        transition: background 0.3s, box-shadow 0.3s, transform 0.3s ease-in-out;
        transform: translateY(0);
    }
    .header-hidden {
        transform: translateY(-100%);
    }
    .scrolled-header {
        background: rgba(44,62,80,0.95) !important;
        box-shadow: 0 4px 16px rgba(0,0,0,0.15);
    }
.dropdown {
    position: relative;
}
.dropdown-content {
    display: none;
    position: absolute;
    top: 100%;
    left: 0;
    min-width: 500px;
    background: rgba(44,62,80,0.95);
    box-shadow: 0 4px 16px rgba(0,0,0,0.10);
    border-radius: 6px;
    padding: 1.5rem;
    z-index: 9999;
    margin-top: 0.5rem;
}
    .two-column {
        display: flex;
        gap: 2rem;
    }
    .two-column .column {
        flex: 1;
    }
    .two-column .column h4 {
        color: #2eaf3b;
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
        text-transform: uppercase;
    }
    .two-column .column ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .two-column .column li {
        margin-bottom: 0.4rem;
    }
    .dropdown:hover .dropdown-content,
    .dropdown:focus-within .dropdown-content {
        display: block;
    }
    .dropdown-content li {
        margin-bottom: 0.4rem;
    }
    .dropdown-content li:last-child {
        margin-bottom: 0;
    }
    .dropdown-content a {
        color: #fff;
        text-decoration: none;
        font-size: 1rem;
        font-weight: 500;
        transition: color 0.2s;
    }
    .dropdown-content a:hover {
        color: #2eaf3b;
    }
    .header-logo {
        width: 70px;
        height: auto;
        margin-bottom: 0.2rem;
    }
    .header-logo-text {
        text-align: center;
        font-family: 'Inter', Arial, sans-serif;
        font-size: 1rem;
        color: #1a3c2b;
        font-weight: 500;
        line-height: 1.1;
    }
    .header-logo-title {
        font-size: 1.1rem;
        font-weight: 600;
        letter-spacing: 0.5px;
    }
    .header-logo-subtitle {
        color: #2eaf3b;
        font-size: 1.2rem;
        font-weight: 700;
        letter-spacing: 1px;
    }
    .header-navbar {
        width: 100%;
        display: flex;
        justify-content: center;
        background: transparent;
        border-top: 1px solid rgba(0,0,0,0.04);
        border-bottom: 1px solid rgba(0,0,0,0.07);
        margin-bottom: 0.5rem;
    }
    .header-menu {
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;
        gap: 2.5rem;
        list-style: none;
        margin: 0;
        padding: 0.7rem 0;
    }
    .header-link {
        color: #fff;
        font-size: 1.25rem;
        font-weight: 700;
        text-transform: uppercase;
        text-decoration: none;
        letter-spacing: 1px;
        text-shadow: 1px 1px 4px rgba(0,0,0,0.25);
        transition: color 0.2s;
        padding: 0.2rem 0.7rem;
        border-radius: 3px;
        position: relative;
    }
    .header-link.active,
    .header-link:hover {
        color: #2eaf3b;
        background: rgba(255,255,255,0.15);
    }
    @media (max-width: 900px) {
        .header-menu {
            gap: 1.2rem;
        }
        .header-link {
            font-size: 1rem;
        }
        .header-logo {
            width: 50px;
        }
    }
    @media (max-width: 600px) {
        .header-menu {
            flex-wrap: wrap;
            gap: 0.7rem;
        }
        .header-logo-bar {
            padding-bottom: 0.2rem;
        }
    }
</style>

<script>
let lastScrollTop = 0;
const header = document.querySelector('.header-public');
const scrollThreshold = 50; // a little bit of scroll before anything happens

window.addEventListener('scroll', function() {
    let scrollTop = window.pageYOffset || document.documentElement.scrollTop;

    if (scrollTop > lastScrollTop && scrollTop > scrollThreshold) {
        // Scroll Down
        header.classList.add('header-hidden');
    } else {
        // Scroll Up
        header.classList.remove('header-hidden');
    }

    if (scrollTop > 30) {
        header.classList.add('scrolled-header');
    } else {
        header.classList.remove('scrolled-header');
    }

    lastScrollTop = scrollTop <= 0 ? 0 : scrollTop; // For Mobile or negative scrolling
}, false);
</script>
<?php /**PATH C:\worspace\ISTSSYSTEM\resources\views/public/partials/header.blade.php ENDPATH**/ ?>