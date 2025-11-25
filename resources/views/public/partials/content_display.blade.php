@php
    // $rawOnly: if true, attempt to render raw inner HTML without outer wrapper divs
    $rawOnly = $rawOnly ?? false;
    $title = $content->title ?? ($content['title'] ?? 'Contenido');
    $description = $content->description ?? $content['description'] ?? null;
    $bodyHtml = $content->body ?? $content->content ?? $content['body'] ?? $content['content'] ?? '';
    if ($rawOnly) {
        // Strip a single outer wrapper div if present to avoid duplicating layout-specific containers
        if (preg_match('/^\s*<div[^>]*>(.*)<\/div>\s*$/is', $bodyHtml, $m)) {
            $bodyHtml = $m[1];
        }
    }
@endphp

<div class="content-display">
    <h1>{{ $title }}</h1>

    @if($description)
        <p>{{ $description }}</p>
    @endif

    <div class="content-body">{!! $bodyHtml !!}</div>
</div>
