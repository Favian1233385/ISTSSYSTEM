@if(isset($updates) && count($updates))
<section class="updates-section">
    <div class="container">
        <div class="section-header">
            <h2>Últimas actualizaciones</h2>
            <p>Videos, imágenes y novedades recientes del ISTS.</p>
        </div>
        <div class="updates-container">
            @foreach($updates as $update)
                <div class="update-card-full">
                    <div class="update-header-section">
                        <h3>{{ $update->title }}</h3>
                        <div class="update-date-inline">
                            <svg width="18" height="18" fill="none" stroke="#666" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
                            <span>{{ $update->date->format('d/m/Y') }}</span>
                        </div>
                        <p>{{ $update->description }}</p>
                    </div>
                    <div class="update-media-section">
                        <div class="update-video-column">
                            <div class="video-container">
                                @if($update->video_url)
                                    <iframe src="{{ $update->video_url }}" allowfullscreen></iframe>
                                @elseif($update->video_path)
                                    <video controls>
                                        <source src="{{ asset('storage/' . $update->video_path) }}" type="video/mp4">
                                        Tu navegador no soporta el video.
                                    </video>
                                @else
                                    <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;color:#aaa;">Sin video</div>
                                @endif
                            </div>
                        </div>
                        <div class="update-image-column">
                            @if($update->image_path)
                                <img src="{{ asset('storage/' . $update->image_path) }}" alt="{{ $update->title }}">
                            @else
                                <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;color:#bbb;">Sin imagen</div>
                            @endif
                        </div>
                    </div>
                    @if($update->link_url)
                        <div style="text-align:center;margin:1rem 0;">
                            <a href="{{ $update->link_url }}" class="btn btn-outline" target="_blank">{{ $update->link_text ?? 'Ver más' }}</a>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif
