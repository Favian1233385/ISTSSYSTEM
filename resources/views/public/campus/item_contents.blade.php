@foreach($campusItem->contents()->where('is_active', true)->orderBy('date', 'desc')->get() as $content)
    <div class="campus-content-block">
        <h3>{{ $content->title }}</h3>
        @if($content->date)
            <div class="meta">Fecha: {{ $content->date }}</div>
        @endif
        <div class="description">{!! $content->description !!}</div>
        @if($content->external_url)
            <div><a href="{{ $content->external_url }}" target="_blank" class="btn btn-outline-primary">Enlace externo</a></div>
        @endif
        @if($content->pdf_url)
            <div><a href="{{ asset($content->pdf_url) }}" target="_blank" class="btn btn-outline-secondary">Ver PDF</a></div>
        @endif
        @if($content->contact_name || $content->contact_email || $content->contact_phone)
            <div class="contact-info">
                <strong>Contacto:</strong>
                <ul>
                    @if($content->contact_name)<li>Nombre: {{ $content->contact_name }}</li>@endif
                    @if($content->contact_email)<li>Email: <a href="mailto:{{ $content->contact_email }}">{{ $content->contact_email }}</a></li>@endif
                    @if($content->contact_phone)<li>Teléfono: {{ $content->contact_phone }}</li>@endif
                </ul>
            </div>
        @endif
        @if($content->form_html)
            <div class="custom-form">{!! $content->form_html !!}</div>
        @endif
    </div>
@endforeach
