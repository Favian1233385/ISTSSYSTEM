<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Contacta con el Instituto Superior Tecnológico Sudamericano - Información de contacto y formulario">
    <title>{{ $title ?? 'Contacto - ISTS' }}</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        .contact-hero {
            background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-secondary) 100%);
            color: var(--color-white);
            padding: 4rem 0;
            text-align: center;
        }

        .contact-hero h1 {
            font-size: 3rem;
            margin-bottom: 1rem;
            font-family: var(--font-primary);
        }

        .contact-hero p {
            font-size: 1.25rem;
            opacity: 0.9;
        }

        .contact-section {
            padding: 4rem 0;
        }

        .contact-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            margin-bottom: 4rem;
        }

        .contact-info {
            background-color: var(--color-white);
        }
    </style>
</head>
<body>
    <!-- Header -->
    @include('public.header')

    <!-- Hero Section -->
    <section class="contact-hero">
        <div class="container">
            <h1>Contacto</h1>
            <p>Estamos aquí para ayudarte. Contáctanos a través del formulario o visita nuestras oficinas.</p>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact-section">
        <div class="container">
            <div class="contact-grid">
                <div class="contact-info">
                    <h2>Información de Contacto</h2>
                    <p>Dirección: {{ $contact['address'] ?? 'No disponible' }}</p>
                    <p>Teléfono: {{ $contact['phone'] ?? 'No disponible' }}</p>
                    <p>Email: {{ $contact['email'] ?? 'No disponible' }}</p>
                </div>

                <div class="contact-form">
                    <h2>Formulario de Contacto</h2>
                    <form action="{{ url('/contact/send') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input type="text" id="name" name="name" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Correo Electrónico</label>
                            <input type="email" id="email" name="email" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="message">Mensaje</label>
                            <textarea id="message" name="message" class="form-control" rows="5" required></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    @include('public.footer')
</body>
</html>
