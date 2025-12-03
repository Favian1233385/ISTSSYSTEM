    @extends('layouts.public')

    @section('content')
    <div class="container main-content py-5">
        <h1 class="text-center mb-4">Sección Visitar</h1>
        <p class="text-center lead">Aquí encontrarás información sobre cómo visitar nuestras instalaciones.</p>

        <div class="row mt-5">
            <div class="col-md-8 offset-md-2">
                <div class="card p-4 shadow-sm">
                    <h3>¡Bienvenido a nuestro campus!</h3>
                    <p>Estamos emocionados de que consideres visitarnos. Nuestro campus ofrece un ambiente vibrante para el aprendizaje y la innovación. Puedes explorar nuestras instalaciones, conocer a nuestros estudiantes y profesores, y descubrir todo lo que el ISTS tiene para ofrecerte.</p>
                    <p>Para programar una visita guiada o si tienes alguna pregunta, no dudes en contactarnos.</p>
                    <a href="{{ route('contact') }}" class="btn btn-primary mt-3">Contactar para Visita</a>
                </div>
            </div>
        </div>
    </div>
    @endsection
