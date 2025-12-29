<style>
    .header-public {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        z-index: 1000;
        /* Azul más suave y transparencia */
        background: linear-gradient(90deg, rgba(52,152,219,0.85) 0%, rgba(72,224,164,0.85) 100%);
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        transition: transform 0.4s cubic-bezier(0.4,0,0.2,1);
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let lastScrollTop = window.scrollY;
        let ticking = false;
        const header = document.querySelector('.header-public');
        function onScroll() {
            let st = window.scrollY;
            if (st > lastScrollTop && st > 30) {
                header.style.transform = 'translateY(-100%)';
            } else if (st < lastScrollTop) {
                header.style.transform = 'translateY(0)';
            }
            lastScrollTop = st;
        }
        window.addEventListener('scroll', function() {
            if (!ticking) {
                window.requestAnimationFrame(function() {
                    onScroll();
                    ticking = false;
                });
                ticking = true;
            }
        });
    });
</script>


<header class="header-public">
    <?php
        $allCareers = \App\Models\Career::where('is_active', true)->orderBy('name')->get();
        $tramites = \Illuminate\Support\Facades\DB::table('contents')->where('category', 'tramites')->where('status', 'published')->orderBy('title')->get();
        $menuItems = \App\Models\MenuItem::whereNull('parent_id')->where('is_active', true)->with('children')->orderBy('order')->get();
        $contentModel = new \App\Models\Content();
        $aboutContents = $contentModel->getByCategory('about');
        $acercaMenuItem = $menuItems->firstWhere('title', 'ACERCA');
        $visitSections = \App\Models\VisitSection::active()->ordered()->get();
        $campusItems = \App\Models\CampusItem::active()->where('category', 'servicios')->ordered()->get();
        $vidaEstudiantilItems = \App\Models\CampusItem::active()->where('category', 'Vida Estudiantil')->ordered()->get();
        $icons = [
            'asesoria-juridica' => '⚖️',
            'bienestar-institucional' => '❤️',
            'planificacion-estrategica' => '📈',
            'relaciones-internacionales' => '🌍',
            'secretaria-general' => '📋',
            'seguridad-salud-ocupacional' => '🛡️',
            'talento-humano' => '👥',
            'tecnologias-informacion' => '💻',
            'unidad-administrativa' => '🏢',
            'unidad-comunicacion' => '📢',
        ];
        $transparencyContents = $transparencyContents ?? [];
    ?>
    <nav class="header-navbar" style="width: 100%; background: transparent; box-shadow: none; display: flex; justify-content: center; align-items: center; padding: 0.75rem 0;">
        <ul class="header-menu" style="display: flex; flex-direction: row; align-items: center; gap: 2.5rem; list-style: none; margin: 0 auto; padding: 0; justify-content: center;">
            <li style="margin-right: 2.5rem; display: flex; align-items: center;">
                <a href="<?php echo e(url('/')); ?>" style="display: flex; align-items: center;">
                    <img src="<?php echo e(asset('assets/images/logoists.png')); ?>" alt="Logo ISTS" style="height: 56px; vertical-align: middle; margin-right: 1rem;">
                </a>
            </li>
            <li class="dropdown" style="position: relative;">
                <a href="#" class="header-link" style="font-weight: 600; color: #ffffff; font-size: 1.05rem; letter-spacing: 0.5px; padding: 0.5rem 1.2rem; transition: background 0.2s, color 0.2s;">ACERCA</a>
                <div class="dropdown-content academic-dropdown">
                    <div class="academic-dropdown-header">
                        <h3>Acerca</h3>
                        
                    </div>
                    <div class="academic-dropdown-columns">
                        <div class="academic-column">
                            <div class="academic-title">Secciones</div>
                            <div class="academic-underline"></div>
                            <ul>
                                <?php $__currentLoopData = $aboutContents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if(Str::lower($section['title']) !== 'sobre el ists'): ?>
                                        <li>
                                            <?php if(Str::lower($section['title']) === 'autoridades'): ?>
                                                <a href="<?php echo e(url('/autoridades')); ?>"><?php echo e($section['title']); ?></a>
                                            <?php elseif(Str::lower($section['title']) === 'planta docente'): ?>
                                                <a href="<?php echo e(url('/planta-docente')); ?>"><?php echo e($section['title']); ?></a>
                                            <?php else: ?>
                                                <a href="<?php echo e(url('/contenido/'.$section['slug'])); ?>"><?php echo e($section['title']); ?></a>
                                            <?php endif; ?>
                                        </li>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php if($acercaMenuItem && count($acercaMenuItem->children) > 0): ?>
                                    <?php $__currentLoopData = $acercaMenuItem->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(Str::lower($child->title) !== 'sobre el ists'): ?>
                                            <li>
                                                <a href="<?php echo e(url($child->url)); ?>"><?php echo e($child->title); ?></a>
                                            </li>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </li>
            <?php $__currentLoopData = $menuItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $title = strtoupper($item->title); ?>
                <?php if($title == 'ACERCA'): ?>
                    <?php continue; ?>
                <?php elseif($title == 'ACADÉMICOS'): ?>
                    <li class="dropdown" style="position: relative;">
                        <a href="#" class="header-link<?php echo e(request()->is('academicos') ? ' active' : ''); ?>" style="font-weight: 600; color: #ffffff; font-size: 1.05rem; letter-spacing: 0.5px; padding: 0.5rem 1.2rem; transition: background 0.2s, color 0.2s;">ACADÉMICOS</a>
                        <div class="dropdown-content academic-dropdown">
                            <div class="academic-dropdown-header">
                                <h3>Académicos</h3>
                                
                            </div>
                            <div class="academic-dropdown-columns">
                                <div class="academic-column">
                                    <div class="academic-title">Programas de Grado</div>
                                    <div class="academic-underline"></div>
                                   
                                    <ul>
                                        <?php $__currentLoopData = $allCareers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $career): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li><a href="<?php echo e(route('career.show', $career->slug)); ?>"><?php echo e($career->name); ?></a></li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                                <div class="academic-column">
                                    <div class="academic-title">Educación Continua</div>
                                    <div class="academic-underline"></div>
                                    <?php
                                        $modalidades = \App\Models\AcademicModality::where('is_active', true)->orderBy('order')->get();
                                    ?>
                                    <ul class="educacion-continua-list" style="list-style:none; padding-left:0;">
                                        <?php $__currentLoopData = $modalidades; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li class="modalidad-item" style="margin-bottom:10px;">
                                                <div class="modalidad-title" style="font-weight:bold; margin-bottom:4px;"><?php echo e($mod->title); ?></div>
                                                <?php if($mod->programs()->where('is_active', true)->count()): ?>
                                                    <ul class="programas-list" style="margin-left:20px; list-style:disc;">
                                                        <?php $__currentLoopData = $mod->programs()->where('is_active', true)->orderBy('order')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <li class="programa-item" style="margin-bottom:4px;">
                                                                <a href="<?php echo e(route('inscripcion.create', $prog->id)); ?>" class="programa-link" style="color:#007bff; text-decoration:underline; cursor:pointer; font-weight:500;" target="_blank"><?php echo e($prog->title); ?></a>
                                                            </li>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </ul>
                                                <?php else: ?>
                                                    <div style="margin-left:20px; color:#888; font-size:13px;">No hay cursos registrados.</div>
                                                <?php endif; ?>
                                                <?php if($mod->description): ?>
                                                    <div class="modalidad-desc" style="margin-left:20px; color:#666; font-size:13px;"><?php echo e($mod->description); ?></div>
                                                <?php endif; ?>
                                            </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>
                <?php elseif($title == 'CAMPUS'): ?>
                    <li class="dropdown" style="position: relative;">
                        <a href="#" class="header-link" style="font-weight: 600; color: #ffffff; font-size: 1.05rem; letter-spacing: 0.5px; padding: 0.5rem 1.2rem; transition: background 0.2s, color 0.2s;">SERVICIOS</a>
                        <div class="dropdown-content academic-dropdown">
                            <div class="academic-dropdown-header">
                                <h3>Servicios</h3>
                               
                            </div>
                            <div class="academic-dropdown-columns">
                                <div class="academic-column">
                                    <div class="academic-title">Servicios e Infraestructura</div>
                                    <div class="academic-underline"></div>
                                    <ul>
                                        <?php $__currentLoopData = $campusItems ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $campusItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li>
                                                <a href="<?php echo e($campusItem->url ?? '#'); ?>" style="font-weight:bold;"><?php echo e($campusItem->title); ?></a>
                                            </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                                <div class="academic-column">
                                    <div class="academic-title">Vida Estudiantil</div>
                                    <div class="academic-underline"></div>
                                    <ul>
                                        <?php $__currentLoopData = ($vidaEstudiantilItems ?? []); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $campusItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li>
                                                <a href="<?php echo e($campusItem->url ?? '#'); ?>" style="font-weight:bold;"><?php echo e($campusItem->title); ?></a>
                                                <?php if($campusItem->contents && $campusItem->contents->count()): ?>
                                                    <ul style="margin-left:20px;">
                                                        <?php $__currentLoopData = $campusItem->contents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <li>
                                                                <a href="<?php echo e($content->external_url ?? '#'); ?>" target="_blank" style="color:#007bff; text-decoration:underline;"><?php echo e($content->title); ?></a>
                                                            </li>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </ul>
                                                <?php endif; ?>
                                            </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>
                <?php elseif($title == 'VISITAR'): ?>
                    <?php
                        $total = count($visitSections);
                        $half = ceil($total / 2);
                        $firstCol = $visitSections->slice(0, $half);
                        $secondCol = $visitSections->slice($half);
                    ?>
                    <li class="dropdown" style="position: relative;">
                        <a href="#" class="header-link" style="font-weight: 600; color: #ffffff; font-size: 1.05rem; letter-spacing: 0.5px; padding: 0.5rem 1.2rem; transition: background 0.2s, color 0.2s;">VISITAR</a>
                        <div class="dropdown-content academic-dropdown">
                            <div class="academic-dropdown-header">
                                <h3>Visitar</h3>
                               
                            </div>
                            <div class="academic-dropdown-columns">
                                <div class="academic-column">
                                    <div class="academic-title">Secciones Institucionales</div>
                                    <div class="academic-underline"></div>
                                    <ul>
                                        <?php $__currentLoopData = $firstCol; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li>
                                                <a href="<?php echo e(url('/visitar/'.$section->slug)); ?>">
                                                    <?php echo e($icons[$section->slug] ?? ''); ?> <?php echo e($section->title); ?>

                                                </a>
                                            </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                                <div class="academic-column">
                                    <div class="academic-title">Más Secciones</div>
                                    <div class="academic-underline"></div>
                                    <ul>
                                        <?php $__currentLoopData = $secondCol; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li>
                                                <a href="<?php echo e(url('/visitar/'.$section->slug)); ?>">
                                                    <?php echo e($icons[$section->slug] ?? ''); ?> <?php echo e($section->title); ?>

                                                </a>
                                            </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>
                <?php elseif($title == 'NOTICIAS'): ?>
                    <li><a href="/noticias" class="header-link" style="font-weight: 600; color: #ffffff; font-size: 1.05rem; letter-spacing: 0.5px; padding: 0.5rem 1.2rem; transition: background 0.2s, color 0.2s;">NOTICIAS</a></li>
                <?php elseif($title == 'TRANSPARENCIA'): ?>
                    <li class="dropdown" style="position: relative;">
                        <a href="#" class="header-link" style="font-weight: 600; color: #ffffff; font-size: 1.05rem; letter-spacing: 0.5px; padding: 0.5rem 1.2rem; transition: background 0.2s, color 0.2s;">TRANSPARENCIA</a>
                        <div class="dropdown-content academic-dropdown">
                            <div class="academic-dropdown-header">
                                <h3>Transparencia</h3>
                               
                            </div>
                            <div class="academic-dropdown-columns">
                                <div class="academic-column">
                                    <div class="academic-title">Secciones</div>
                                    <div class="academic-underline"></div>
                                    <ul>
                                        <?php $__currentLoopData = $transparencyContents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $parent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li class="dropdown-item">
                                                <?php
                                                    $url = isset($parent['file_url']) && filter_var($parent['file_url'], FILTER_VALIDATE_URL)
                                                        ? $parent['file_url']
                                                        : (isset($parent['file_url']) && $parent['file_url'] ? asset($parent['file_url']) : url('transparency/' . $parent['slug']));
                                                    $target = (isset($parent['file_url']) && $parent['file_url']) ? '_blank' : '_self';
                                                ?>
                                                <a href="<?php echo e($url); ?>" target="<?php echo e($target); ?>"><?php echo e($parent['title']); ?></a>
                                                <?php if(!empty($parent['children'])): ?>
                                                    <ul class="dropdown-submenu">
                                                        <?php $__currentLoopData = $parent['children']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if($parent['title'] === 'Reglamentos Internos'): ?>
                                                                <li class="dropdown-subitem">
                                                                    <?php
                                                                        $url = isset($child['file_url']) && filter_var($child['file_url'], FILTER_VALIDATE_URL)
                                                                            ? $child['file_url']
                                                                            : (isset($child['file_url']) && $child['file_url'] ? asset($child['file_url']) : url('transparency/' . $child['slug']));
                                                                        $target = (isset($child['file_url']) && $child['file_url']) ? '_blank' : '_self';
                                                                    ?>
                                                                    <a href="<?php echo e($url); ?>" target="<?php echo e($target); ?>"><?php echo e($child['title']); ?></a>
                                                                </li>
                                                            <?php endif; ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </ul>
                                                <?php endif; ?>
                                            </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>
                <?php elseif($title == 'TRÁMITES'): ?>
                    <li class="dropdown" style="position: relative;">
                        <a href="#" class="header-link" style="font-weight: 600; color: #ffffff; font-size: 1.05rem; letter-spacing: 0.5px; padding: 0.5rem 1.2rem; transition: background 0.2s, color 0.2s;">DOCUMENTOS</a>
                        <div class="dropdown-content academic-dropdown">
                            <div class="academic-dropdown-header">
                                <h3>Documentos</h3>
                              
                            </div>
                            <div class="academic-dropdown-columns">
                                <div class="academic-column">
                                    <ul>
                                        <?php $__currentLoopData = $tramites; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tramite): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                                $url = $tramite->url ?? null;
                                                $file = $tramite->file_url ?? null;
                                                $isExternalUrl = $url && filter_var($url, FILTER_VALIDATE_URL);
                                                $isFile = $file && !$isExternalUrl;
                                            ?>
                                            <li class="dropdown-item">
                                                <?php if($isExternalUrl): ?>
                                                    <a href="<?php echo e($url); ?>" target="_blank"><?php echo e($tramite->title); ?></a>
                                                <?php elseif($isFile): ?>
                                                    <a href="<?php echo e(asset($file)); ?>" target="_blank"><?php echo e($tramite->title); ?></a>
                                                <?php else: ?>
                                                    <span><?php echo e($tramite->title); ?></span>
                                                <?php endif; ?>
                                            </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>
                <?php else: ?>
                    <li><a href="<?php echo e($item->url); ?>" class="header-link" style="font-weight: 600; color: #ffffff; font-size: 1.05rem; letter-spacing: 0.5px; padding: 0.5rem 1.2rem; transition: background 0.2s, color 0.2s;"><?php echo e($item->title); ?></a></li>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </nav>
</header>
<?php /**PATH C:\workspace\ISTSSYSTEM\resources\views/public/partials/header.blade.php ENDPATH**/ ?>