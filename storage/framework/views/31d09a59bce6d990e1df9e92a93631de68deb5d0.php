<!-- Textos estáticos para Misión y Visión en el dashboard principal -->
<?php
    $title = 'Misión y Visión';
    $mision = 'Formar profesionales de calidad y excelencia, competentes con pensamiento crítico, compromiso ético, valores y principios, garantizando el uso racional de los recursos naturales, que les permita insertarse al mundo laboral y social, por lo que la labor diaria, es la formación integral de ciudadanos, fortaleciendo la investigación, desarrollo e innovación, la vinculación con la sociedad y la cultura ecológica, promoviendo la mejora continua.';
    $vision = 'Ser una Institución de Educación Superior modelo y líder en la Provincia, generando conocimiento innovador en base a la investigación científica y aplicada, desarrollando la capacidad para ser productivos, con docentes comprometidos y de excelencia, con perfiles profesionales acorde a las carreras que oferta, contando con implementación tecnológica adecuada para garantizar la formación de profesionales proactivos comprometidos para construir una sociedad equitativa libre de violencia y en equilibrio con el medio ambiente.';
?>

<!-- Sección separada: Misión y Visión como bloque independiente bajo el hero -->
<section class="mv-section">
    <div class="container">
        <div class="section-page-header">
            <div class="container text-center">
                <h1 class="section-page-title" style="
                    font-size:2.3rem;
                    font-weight:800;
                    color:#00796b;
                    margin-bottom:0.7rem;
                    letter-spacing:-1px;
                    text-align:center;
                    position:relative;">
                    <?php echo e($title); ?>

                    <span style="display:block; height:4px; width:54px; background:linear-gradient(90deg,#1abc9c,#3498db); border-radius:2px; margin:10px auto 0 auto;"></span>
                </h1>
                <p class="section-page-subtitle" style="font-size:1.18rem; color:#1976d2; text-align:center; max-width:700px; margin:0 auto 1.7rem auto; font-weight:500;">
                    Conoce la misión y visión que guían nuestro trabajo educativo
                </p>
            </div>
        </div>

        <div class="mv-cards">
            <article class="mv-card">
                <div class="mv-card-icon">
                    <!-- target icon -->
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="12" cy="12" r="10" fill="#1766a3"/><circle cx="12" cy="12" r="6" fill="#fff"/><circle cx="12" cy="12" r="4" fill="#10b981"/></svg>
                </div>
                <h3>Misión</h3>
                <p class="mv-excerpt"><?php echo e($mision); ?></p>
            </article>
            <article class="mv-card">
                <div class="mv-card-icon">
                    <!-- vision icon -->
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><ellipse cx="12" cy="12" rx="10" ry="7" fill="#1766a3"/><circle cx="12" cy="12" r="4" fill="#10b981"/></svg>
                </div>
                <h3>Visión</h3>
                <p class="mv-excerpt"><?php echo e($vision); ?></p>
            </article>
        </div>
    </div>
</section>

<!-- Modal placeholder -->
<div id="mv-modal" class="mv-modal" style="display:none;">
    <div class="mv-modal-content">
        <button id="mv-modal-close" class="modal-close">✕</button>
        <div class="mv-modal-body" style="min-height:80px;padding:6px 0;"></div>
    </div>
</div>

<script>
    (function(){
        var buttons = document.querySelectorAll('.mv-fetch');
        var modal = document.getElementById('mv-modal');
        var close = document.getElementById('mv-modal-close');
        var bodyEl = document.querySelector('.mv-modal-body');

        function openModalWithHtml(html){
            if(!modal || !bodyEl) return;
            bodyEl.innerHTML = html || '';
            modal.style.display = 'flex';
            document.body.style.overflow = 'hidden';
            var mc = document.querySelector('.mv-modal-content'); if(mc) mc.scrollTop = 0;
        }

        function closeModal(){
            if(!modal) return;
            modal.style.display = 'none';
            document.body.style.overflow = '';
        }

        buttons.forEach(function(b){
            b.addEventListener('click', function(e){
                var part = e.currentTarget.getAttribute('data-part') || 'mision';
                fetch('/ajax/content/mision-vision?part=' + encodeURIComponent(part))
                    .then(function(r){ return r.json(); })
                    .then(function(d){
                        openModalWithHtml(d.html || '');
                    })
                    .catch(function(){ openModalWithHtml('<p>No se pudo cargar el contenido.</p>'); });
            });
        });

        if(close) close.addEventListener('click', closeModal);
        window.addEventListener('click', function(e){ if(e.target === modal) closeModal(); });
        window.addEventListener('keydown', function(e){ if(e.key === 'Escape') closeModal(); });
    })();
</script>

<style>
    .mv-modal{position:fixed;left:0;top:0;width:100%;height:100%;background:rgba(0,0,0,0.6);display:flex;align-items:center;justify-content:center;padding:20px;z-index:2000}
    .mv-modal-content{background:#fff;padding:20px;border-radius:8px;max-width:900px;width:100%;position:relative;max-height:80vh;overflow:auto}
    .modal-close{position:absolute;right:10px;top:10px;border:none;background:transparent;font-size:18px}
</style>
<?php /**PATH C:\workspace\ists\resources\views/public/partials/home_mision_vision.blade.php ENDPATH**/ ?>