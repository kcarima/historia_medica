<x-app-layout>
    @section('contenido')

    <head>
        <title>Registro de Historia Médica</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="{{ asset('css/estilo stretch.css') }}" rel="stylesheet">


    </head>    <main class="main">

        <section id="hero" class="hero section">

            <div id="hero-carousel" class="carousel slide carousel-fade position-relative" data-bs-ride="carousel" data-bs-interval="5000"
                 style="background-image: url('{{ asset('assets/img/anfe central.png') }}'); background-size: cover; background-position: center; min-height: 400px;">

                <div class="position-absolute bottom-0 start-50 translate-middle-x text-center text-white" style="width: 100%; padding-bottom: 50px;">

                </div>

            </div>

        </section>

    </main>

    @endsection
</x-app-layout>

