<?php
    // Helper to safely get key/property from array or object
    $get = function ($src, $key, $default = null) {
        if (is_array($src)) return array_key_exists($key, $src) ? $src[$key] : $default;
        if (is_object($src)) return isset($src->{$key}) ? $src->{$key} : $default;
        return $default;
    };

    $c = $content ?? null;
    $title = $get($c, 'title', 'Misión y Visión');
    $body = $get($c, 'body', $get($c, 'content', ''));

    // Simple excerpt split for Misión and Visión: try to split body text into two parts
    $plain = trim(strip_tags($body));
    $partA = $partB = '';
    if ($plain) {
        $mid = intval(strlen($plain) / 2);
        // split at nearest space
        $pos = strpos($plain, ' ', $mid);
        if ($pos === false) $pos = $mid;
        $partA = substr($plain, 0, $pos);
        $partB = trim(substr($plain, $pos));
        if (strlen($partA) > 280) $partA = substr($partA, 0, 280) . '...';
        if (strlen($partB) > 280) $partB = substr($partB, 0, 280) . '...';
    }
?>

<!-- Sección separada: Misión y Visión como bloque independiente bajo el hero -->
<section class="mv-section">
    <div class="container">
        <div class="section-page-header">
            <div class="container text-center">
                <h1 class="section-page-title"><?php echo e($title); ?></h1>
                <p class="section-page-subtitle">Conoce la misión y visión que guían nuestro trabajo educativo</p>
            </div>
        </div>

        <div class="card">
            <div class="card-body">

                <div class="mv-cards">
                <article class="mv-card">
                    <div class="mv-card-icon">
                        <!-- target icon -->
                        <svg width="36" height="36" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 2a10 10 0 1 0 0 20 10 10 0 0 0 0-20zm0 4a6 6 0 1 1 0 12 6 6 0 0 1 0-12zm0 2a4 4 0 1 0 0 8 4 4 0 0 0 0-8z" fill="#0b3b5a"/></svg>
                    </div>
                    <h3>Misión</h3>
                    <p class="mv-excerpt"><?php echo e($partA); ?></p>
                    <button type="button" class="btn btn-primary mv-fetch" data-part="mision">Leer más</button>
                </article>

                <article class="mv-card">
                    <div class="mv-card-icon">
                        <!-- vision icon -->
                        <svg width="36" height="36" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 5c-7 0-10 7-10 7s3 7 10 7 10-7 10-7-3-7-10-7zm0 11a4 4 0 1 1 0-8 4 4 0 0 1 0 8z" fill="#0b3b5a"/></svg>
                    </div>
                    <h3>Visión</h3>
                    <p class="mv-excerpt"><?php echo e($partB); ?></p>
                    <button type="button" class="btn btn-primary mv-fetch" data-part="vision">Leer más</button>
                </article>
            </div>
            </div>
        </div>
    </div>
</section>

<style>
    .mv-section { margin-top: 48px; }
    .mv-cards { display:flex; gap:18px; }
    .mv-card { flex:1; background: var(--color-muted, #f8fafc); padding:18px; border-radius:10px; transition: transform .18s ease, box-shadow .18s ease; }
    .mv-card:hover { transform: translateY(-6px); box-shadow: 0 18px 36px rgba(3,10,18,0.06); }
    .mv-card-icon{ width:48px; height:48px; border-radius:10px; background:var(--color-soft, #e6eef6); display:flex; align-items:center; justify-content:center; margin-bottom:10px }
    .mv-card h3 { margin:0 0 8px; }
    .mv-excerpt { margin-bottom:12px; text-align:justify; text-justify:inter-word; }

    @media(max-width:900px){
        .mv-section{ margin-top: 28px }
        .mv-cards{ flex-direction:column }
    }
</style>

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
<?php /**PATH C:\worspace\ISTSSYSTEM\resources\views/public/partials/home_mision_vision.blade.php ENDPATH**/ ?>