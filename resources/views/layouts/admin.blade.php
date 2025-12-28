<!doctype html>
<html lang="{{ str_replace('_','-',app()->getLocale()) }}" @if(app()->getLocale() === 'ar') dir="rtl" @endif>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title','ISTS Admin')</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ENjdO4Dr2bkBIFxQpeoA6DQD5l5/2Q2g9lsbU8zT94WrHftjDbrCEXSU1oBoqyl2" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/harvard-style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    @if(app()->getLocale() === 'ar')
        <link rel="stylesheet" href="{{ asset('css/app-rtl.css') }}">
    @endif
    <link rel="icon" type="image/png" href="{{ asset('assets/images/logoists.png') }}" sizes="32x32">
    <style>
        /* Botones de acción alineados horizontalmente en formularios admin */
        .admin-action-buttons {
            display: flex !important;
            flex-direction: row !important;
            justify-content: flex-end !important;
            align-items: center !important;
            gap: 1.2rem !important;
            width: 100%;
            margin-top: 1.5rem;
            margin-bottom: 0;
        }
        .admin-action-buttons > .btn {
            min-width: 130px;
            height: 48px;
            border-radius: 10px;
            font-size: 1.08rem;
            transition: box-shadow .2s, background .2s;
            margin-bottom: 0;
        }
        @media (max-width: 600px) {
            .admin-action-buttons {
                flex-direction: column !important;
                align-items: stretch !important;
                gap: 0.7rem !important;
            }
        }
    </style>
</head>
<body class="admin-body">
    @include('admin.partials.header')

    <main class="admin-main">
        <div class="admin-container">
            @if(request()->query('success'))
                <div class="alert alert-success">
                    <span>✅</span>
                    {{ request()->query('success') }}
                </div>
            @endif

            @if(request()->query('error'))
                <div class="alert alert-error">
                    <span>❌</span>
                    {{ request()->query('error') }}
                </div>
            @endif

            <div class="admin-content">
                @yield('content')
            </div>
        </div>
    </main>

    @include('admin.partials.footer')

    <script src="{{ asset('js/admin.js') }}"></script>
    <script>
        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 300);
            });
        }, 5000);
    </script>

    <script src="https://cdn.tiny.cloud/1/tr5q9gaoe9ca3hwsq6nah42q8dqhrtqznrl0gd9523anjatx/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
      tinymce.init({
        selector: 'textarea.tinymce-editor',
        plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak code fullscreen insertdatetime media table paste help wordcount',
        toolbar: 'undo redo | formatselect | ' +
        'bold italic backcolor | alignleft aligncenter ' +
        'alignright alignjustify | bullist numlist outdent indent | ' +
        'removeformat | help',
        content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
      });
    </script>

    @stack('scripts')
</body>
</html>
