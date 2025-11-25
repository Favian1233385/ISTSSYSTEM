@php
    // Helper to safely get key/property from array or object
    $get = function ($src, $key, $default = null) {
        if (is_array($src)) {
            return array_key_exists($key, $src) ? $src[$key] : $default;
        }
        if (is_object($src)) {
            return isset($src->{$key}) ? $src->{$key} : $default;
        }
        return $default;
    };

    $c = $content ?? null;
    $title = $get($c, 'title', 'Contenido');
    $body = $get($c, 'body', $get($c, 'content', ''));
    $description = $get($c, 'description', null);
    $images = $get($c, 'images', null);
    $image_url = $get($c, 'image_url', null);
    $file_url = $get($c, 'file_url', null);
@endphp

<!-- Page Header (same as Acerca) -->
<section class="about-page-header">
    <div class="container text-center">
        <h1 class="about-page-title">{{ $title }}</h1>
        @if($description)
            <p class="about-page-subtitle">{{ $description }}</p>
        @endif
        @if($file_url)
            @php
                $pdfs = json_decode($file_url, true);
                if (is_array($pdfs)) {
                    echo '<div class="pdf-download-links">';
                    foreach ($pdfs as $index => $pdf) {
                        $filename = basename($pdf);
                        echo '<div class="pdf-link-item">';
                        echo '<a href="' . asset($pdf) . '" target="_blank" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i> Ver Reglamento ' . ($index + 1) . '</a> ';
                        echo '<a href="' . asset($pdf) . '" download="' . $filename . '" class="btn btn-secondary btn-sm"><i class="fas fa-download"></i> Descargar Reglamento ' . ($index + 1) . '</a>';
                        echo '</div>';
                    }
                    echo '</div>';
                } else {
                    echo '<div class="pdf-download-link">';
                    echo '<a href="' . asset($file_url) . '" target="_blank" class="btn btn-primary"><i class="fas fa-eye"></i> Ver PDF</a> ';
                    echo '<a href="' . asset($file_url) . '" download class="btn btn-secondary"><i class="fas fa-download"></i> Descargar PDF</a>';
                    echo '</div>';
                }
            @endphp
        @endif
    </div>
</section>

<!-- Content Section (same layout as Acerca) -->
<section class="about-content-area">
    <div class="container">
        <article class="about-box">
            <div class="about-content-layout">
                <div class="about-text-content">
                    {!! $body !!}
                </div>

                @if(!empty($images) && count((array)$images) > 0)
                    <div class="about-image-container">
                        <div class="carousel-container">
                            <div class="carousel-slides">
                                @foreach($images as $image)
                                    @php
                                        $imgPath = '';
                                        if (is_array($image)) {
                                            $imgPath = $image['image_path'] ?? $image['path'] ?? '';
                                        } elseif (is_object($image)) {
                                            $imgPath = $image->image_path ?? $image->path ?? '';
                                        }
                                    @endphp
                                    <div class="carousel-slide">
                                        @php
                                            $src = '';
                                            if ($imgPath) {
                                                // Full URL -> use as-is
                                                if (preg_match('/^https?:\/\//i', $imgPath)) {
                                                    $src = $imgPath;
                                                }
                                                // Legacy public uploads or assets (e.g. /uploads/... or uploads/...) -> asset(ltrim(path))
                                                elseif (preg_match('/^\/?(uploads|assets)\//i', $imgPath)) {
                                                    $src = asset(ltrim($imgPath, '/'));
                                                }
                                                // Already references storage/... -> use asset(path)
                                                elseif (preg_match('/^storage\//i', $imgPath)) {
                                                    $src = asset($imgPath);
                                                }
                                                // Otherwise assume it's a storage path fragment and prefix with storage/
                                                else {
                                                    $src = asset('storage/' . ltrim($imgPath, '/'));
                                                }
                                            }
                                        @endphp
                                        <img src="{{ $src }}" alt="{{ $title }}">
                                    </div>
                                @endforeach
                            </div>
                            <button class="carousel-prev">&#10094;</button>
                            <button class="carousel-next">&#10095;</button>
                        </div>
                    </div>
                @elseif(!empty($image_url))
                    <div class="about-image-container">
                        @php
                            $imgSrc = '';
                            if (!empty($image_url)) {
                                if (preg_match('/^https?:\/\//i', $image_url)) {
                                    $imgSrc = $image_url;
                                } elseif (preg_match('/^\/?(uploads|assets)\//i', $image_url)) {
                                    $imgSrc = asset(ltrim($image_url, '/'));
                                } elseif (preg_match('/^storage\//i', $image_url)) {
                                    $imgSrc = asset($image_url);
                                } else {
                                    $imgSrc = asset('storage/' . ltrim($image_url, '/'));
                                }
                            }
                        @endphp
                        <img src="{{ $imgSrc }}" alt="{{ $title }}">
                    </div>
                @endif
            </div>
        </article>

        @if(isset($children) && !empty($children))
            <div class="children-section" id="documentos-relacionados">
                <h3 class="related-docs-title">Documentos Relacionados</h3>
                <ul class="children-list">
                    @foreach($children as $child)
                        <li id="{{ $child['slug'] }}">
                            @php
                                $link = route('transparencia.show', $child['slug']); // Fallback link
                                $target = '';
                                if (!empty($child['file_url'])) {
                                    $pdfs = json_decode($child['file_url'], true);
                                    if (is_array($pdfs) && !empty($pdfs[0])) {
                                        $link = asset($pdfs[0]);
                                        $target = '_blank';
                                    } elseif (is_string($child['file_url'])) {
                                        $link = asset($child['file_url']);
                                        $target = '_blank';
                                    }
                                }
                            @endphp
                            <a href="{{ $link }}" @if($target) target="{{ $target }}" @endif>{{ $child['title'] }}</a>
                            @if(!empty($child['description']))
                                <p>{{ $child['description'] }}</p>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</section>

@include('public.acerca.partials.about-styles')
