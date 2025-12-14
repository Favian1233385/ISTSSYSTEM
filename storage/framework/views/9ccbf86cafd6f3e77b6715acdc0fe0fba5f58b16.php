

<?php $__env->startSection('header'); ?>
    <header class="bg-emerald-700 py-8 mb-8 shadow-lg">
        <div class="max-w-5xl mx-auto px-4">
            <h1 class="text-3xl md:text-4xl font-bold text-white text-center drop-shadow">Índice A-Z Institucional</h1>
            <p class="text-emerald-100 text-center mt-2">Encuentra personas, carreras, servicios, autoridades y más.</p>
        </div>
    </header>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-5xl mx-auto mb-8">
    <input type="text" id="az-search" class="form-control mb-5" placeholder="Buscar por nombre, tipo, área, etc..." style="font-size:1.1rem; padding:0.8rem 1.2rem; border-radius:12px; border:1px solid #cbd5e1;">
    <div id="az-results">
        <!-- Resultados agrupados -->
        
        <h2 class="text-xl font-bold mt-8 mb-3 text-emerald-800">Personas</h2>
        <?php
            $personasAgrupadas = $personas->groupBy(function($p) {
                $nombre = $p->name ?? ($p->first_name.' '.$p->last_name);
                return strtoupper(mb_substr(trim($nombre), 0, 1));
            })->sortKeys();
        ?>
        <div class="mb-8">
            <?php $__currentLoopData = $personasAgrupadas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $letra => $grupo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="mb-6">
                    <div class="text-lg font-bold text-emerald-700 mb-3 border-b border-emerald-200 pb-1"><?php echo e($letra); ?></div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                        <?php $__currentLoopData = $grupo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="az-item bg-white rounded-xl shadow-md p-5 flex flex-col gap-2 transition hover:shadow-lg border border-emerald-100 hover:border-emerald-400" data-type="persona" data-name="<?php echo e(strtolower($p->name ?? ($p->first_name.' '.$p->last_name))); ?>" data-role="<?php echo e(strtolower($p->role ?? '')); ?>">
                                <div class="flex items-center gap-3 mb-2">
                                    
                                    <?php
                                        $avatar = $p->avatar ?? null;
                                        $nombre = $p->name ?? ($p->first_name.' '.$p->last_name);
                                        $iniciales = collect(explode(' ', $nombre))->map(fn($n) => mb_substr($n,0,1))->join('');
                                    ?>
                                    <?php if($avatar): ?>
                                        <img src="<?php echo e(asset('storage/'.$avatar)); ?>" alt="Avatar" class="w-10 h-10 rounded-full object-cover border border-emerald-200">
                                    <?php else: ?>
                                        <div class="w-10 h-10 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-700 font-bold text-lg border border-emerald-200"><?php echo e($iniciales); ?></div>
                                    <?php endif; ?>
                                    <div class="flex flex-col">
                                        <a href="<?php echo e(route('profile.show', $p->id)); ?>" class="font-semibold text-emerald-900 text-base hover:underline hover:text-emerald-700" title="Ver perfil"><?php echo e($nombre); ?></a>
                                        <?php if(!empty($p->role)): ?>
                                            <span class="text-gray-500 text-xs"><?php echo e($p->role); ?></span>
                                        <?php endif; ?>
                                        <?php if(!empty($p->area)): ?>
                                            <span class="text-gray-400 text-xs"><?php echo e($p->area); ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <?php if(!empty($p->email)): ?>
                                    <div class="text-gray-400 text-xs"><a href="mailto:<?php echo e($p->email); ?>" class="hover:underline"><?php echo e($p->email); ?></a></div>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        
        <h2 class="text-xl font-bold mt-8 mb-3 text-emerald-800">Carreras</h2>
        <?php
            $carrerasAgrupadas = $carreras->groupBy(function($c) {
                return strtoupper(mb_substr(trim($c->name), 0, 1));
            })->sortKeys();
        ?>
        <div class="mb-8">
            <?php $__currentLoopData = $carrerasAgrupadas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $letra => $grupo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="mb-6">
                    <div class="text-lg font-bold text-blue-700 mb-3 border-b border-blue-200 pb-1"><?php echo e($letra); ?></div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                        <?php $__currentLoopData = $grupo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="az-item bg-white rounded-xl shadow-md p-5 flex flex-col gap-2 transition hover:shadow-lg border border-blue-100 hover:border-blue-400" data-type="carrera" data-name="<?php echo e(strtolower($c->name)); ?>">
                                <div class="font-semibold text-blue-900 text-base flex items-center gap-2">
                                    <a href="<?php echo e(route('career.show', $c->slug)); ?>" class="hover:underline hover:text-blue-700" title="Ver carrera"><?php echo e($c->name); ?></a>
                                </div>
                                <?php if(!empty($c->code)): ?>
                                    <div class="text-gray-500 text-sm"><?php echo e($c->code); ?></div>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <h2 class="text-xl font-bold mt-8 mb-3 text-emerald-800">Áreas y Servicios</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
            <?php $__currentLoopData = $secciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="bg-white rounded-lg shadow p-4 flex items-center gap-4 az-item" data-type="seccion" data-name="<?php echo e(strtolower($s->name)); ?>">
                    <span class="inline-block bg-purple-600 text-white text-xs font-bold px-3 py-1 rounded-full mr-2">Sección</span>
                    <div>
                        <div class="font-semibold"><?php echo e($s->name); ?></div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php $__currentLoopData = $servicios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $srv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="bg-white rounded-lg shadow p-4 flex items-center gap-4 az-item" data-type="servicio" data-name="<?php echo e(strtolower($srv->title)); ?>">
                    <span class="inline-block bg-pink-600 text-white text-xs font-bold px-3 py-1 rounded-full mr-2">Servicio</span>
                    <div>
                        <div class="font-semibold"><?php echo e($srv->title); ?></div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const search = document.getElementById('az-search');
        search.addEventListener('input', function() {
            const val = this.value.toLowerCase();
            document.querySelectorAll('.az-item').forEach(function(item) {
                const name = item.getAttribute('data-name') || '';
                const type = item.getAttribute('data-type') || '';
                const role = item.getAttribute('data-role') || '';
                if (name.includes(val) || type.includes(val) || role.includes(val)) {
                    item.style.display = '';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('public.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\workspace\ISTSSYSTEM\resources\views/public/azindex.blade.php ENDPATH**/ ?>