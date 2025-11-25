@if(!empty($rector))
<section class="rector-section">
    <div class="container rector-container">
        <div class="rector-inner">
            @if(!empty($rector->image_path))
            <div class="rector-image">
                @php
                    $img = $rector->image_path;
                    $imgSrc = preg_match('/^https?:\/\//i', $img) ? $img : asset('storage/' . $img);
                @endphp
                <img src="{{ $imgSrc }}" alt="Rector" />
            </div>
            @endif
            <div class="rector-content">
                <h2>Mensaje del Rector</h2>
                <h3>{{ $rector->name }}</h3>
                @if(!empty($rector->position) || !empty($rector->academic_title))
                    <p class="rector-meta" style="margin:6px 0;color:#666;">
                        @if(!empty($rector->position))<strong>{{ $rector->position }}</strong>@endif
                        @if(!empty($rector->position) && !empty($rector->academic_title)) — @endif
                        @if(!empty($rector->academic_title)){{ $rector->academic_title }}@endif
                    </p>
                @endif
                @php
                    $raw = $rector->message ?? '';
                    $paragraphs = [];
                    if (preg_match('/<p/i', $raw)) {
                        $parts = preg_split('/<\/p>/i', $raw);
                        foreach ($parts as $p) {
                            $p = trim($p);
                            if ($p !== '') {
                                // ensure opening <p> removed
                                $p = preg_replace('/^<p[^>]*>/i', '', $p);
                                $paragraphs[] = $p;
                            }
                        }
                    } else {
                        // split by double newline or single newlines
                        $parts = preg_split('/\r\n|\r|\n{2,}/', strip_tags($raw));
                        foreach ($parts as $p) {
                            $p = trim($p);
                            if ($p !== '') {
                                $paragraphs[] = e($p);
                            }
                        }
                    }
                    $firstParagraph = $paragraphs[0] ?? strip_tags($raw);
                @endphp

                <div class="rector-excerpt">{!! Str::limit($firstParagraph, 400) !!}</div>
                <button class="btn btn-secondary" id="rector-vermas">Leer mensaje completo</button>
            </div>
        </div>
    </div>

    {{-- Modal simple para mostrar mensaje completo --}}
    <div id="rector-modal" class="rector-modal" style="display:none;">
        <div class="rector-modal-content">
            <button id="rector-modal-close" class="modal-close">✕</button>
            <div class="rector-modal-body">
                @if($rector->image_path)
                    <img src="{{ asset('storage/' . $rector->image_path) }}" alt="Rector" style="max-width:200px;margin-bottom:10px;">
                @endif
                <h3>{{ $rector->name }}</h3>

                <div id="rector-paragraph-view">
                    <div id="rector-paragraph-content" style="min-height:80px;padding:6px 0;"></div>
                    <div style="margin-top:10px;display:flex;gap:8px;align-items:center">
                        <button id="rector-prev" class="btn btn-sm btn-outline-primary">Anterior</button>
                        <button id="rector-next" class="btn btn-sm btn-outline-primary">Siguiente</button>
                        <button id="rector-show-all" class="btn btn-sm btn-secondary">Ver todo</button>
                        <span id="rector-paragraph-indicator" style="margin-left:8px;color:#666;font-size:13px"></span>
                    </div>
                </div>

                <div id="rector-paragraph-all" style="display:none;margin-top:10px;">
                    <div class="rector-full-message">{!! $rector->message ?? '' !!}</div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .rector-container{display:flex;align-items:center;padding:30px 0}
        .rector-inner{display:flex;gap:20px;align-items:flex-start}
        .rector-image img{max-width:220px;border-radius:6px}
        .rector-content h2{color:var(--color-primary);margin:0 0 6px}
        .rector-excerpt{margin-bottom:10px}
        .rector-modal{position:fixed;left:0;top:0;width:100%;height:100%;background:rgba(0,0,0,0.6);display:flex;align-items:center;justify-content:center;padding:20px;z-index:2000}
        .rector-modal-content{background:#fff;padding:20px;border-radius:8px;max-width:800px;width:100%;position:relative;max-height:80vh;overflow:auto}
        .modal-close{position:absolute;right:10px;top:10px;border:none;background:transparent;font-size:18px}
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function(){
            var btn = document.getElementById('rector-vermas');
            var modal = document.getElementById('rector-modal');
            var close = document.getElementById('rector-modal-close');
            var paragraphView = document.getElementById('rector-paragraph-view');
            var paragraphContent = document.getElementById('rector-paragraph-content');
            var paragraphAll = document.getElementById('rector-paragraph-all');
            var modalContent = document.querySelector('.rector-modal-content');
            var prevBtn = document.getElementById('rector-prev');
            var nextBtn = document.getElementById('rector-next');
            var showAllBtn = document.getElementById('rector-show-all');
            var indicator = document.getElementById('rector-paragraph-indicator');

            // Build paragraphs array from the hidden full message HTML
            var rawHtml = paragraphAll ? paragraphAll.querySelector('.rector-full-message').innerHTML : '';
            var paragraphs = [];
            if(rawHtml){
                // Try splitting by closing </p>
                var parts = rawHtml.split(/<\/p>/i);
                for(var i=0;i<parts.length;i++){
                    var p = parts[i].trim();
                    if(!p) continue;
                    // remove opening <p ...>
                    p = p.replace(/^<p[^>]*>/i,'').trim();
                    if(p) paragraphs.push(p);
                }
            }

            var idx = 0;
            function renderParagraph(i){
                if(!paragraphContent) return;
                if(paragraphs.length === 0){
                    paragraphContent.innerHTML = paragraphAll ? paragraphAll.querySelector('.rector-full-message').innerHTML : '';
                    indicator.innerText = '';
                    prevBtn.style.display = 'none'; nextBtn.style.display = 'none';
                    return;
                }
                idx = Math.max(0, Math.min(i, paragraphs.length-1));
                paragraphContent.innerHTML = '<p>'+paragraphs[idx]+'</p>';
                indicator.innerText = (idx+1) + ' / ' + paragraphs.length;
                prevBtn.disabled = (idx === 0);
                nextBtn.disabled = (idx === paragraphs.length-1);
            }

            if(btn){ btn.addEventListener('click', function(){ modal.style.display='flex'; renderParagraph(0); paragraphView.style.display='block'; paragraphAll.style.display='none'; }); }
            if(close){ close.addEventListener('click', function(){ modal.style.display='none'; }); }
            window.addEventListener('click', function(e){ if(e.target === modal){ modal.style.display='none'; }});

            if(prevBtn){ prevBtn.addEventListener('click', function(){ renderParagraph(idx-1); }); }
            if(nextBtn){ nextBtn.addEventListener('click', function(){ renderParagraph(idx+1); }); }
            if(showAllBtn){ showAllBtn.addEventListener('click', function(){
                paragraphView.style.display='none';
                paragraphAll.style.display='block';
                // after rendering, scroll modal content to top so user can slide/scroll down
                setTimeout(function(){
                    try {
                        if(modalContent){
                            modalContent.scrollTo({ top: 0, behavior: 'smooth' });
                        }
                        var full = paragraphAll.querySelector('.rector-full-message');
                        if(full){ full.setAttribute('tabindex','-1'); full.focus(); }
                    } catch(e){}
                }, 80);
            }); }
        });
    </script>
</section>
@endif
