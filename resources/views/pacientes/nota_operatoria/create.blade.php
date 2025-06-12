<x-app-layout>

@section('contenido')
 <!-- Contenedor formulario (contenido principal) -->
        <div class="contenido-principal">
            <!-- Contenedor flex para título y etiqueta historia -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h1 class="mb-0">Historias</h1>
                <span class="badge bg-primary fs-6">
                    Historia N°: {{ $paciente->historia }}
                </span>
            </div>
<head>

    <title>Nota Operatoria</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/nota_operatoria.css') }}" rel="stylesheet">
</head>
<body>
    <div class="contenedor-nota">
        <h2>Nota operatoria</h2>
        <<form action="{{ route('nota_operatoria.store', $paciente->historia) }}" method="POST">
            @csrf
            <textarea name="nota" class="campo-nota" required placeholder="Escribe la nota operatoria..."></textarea>

                    <a href="{{ route('pacientes.index') }}" class="btn btn-danger">Volver</a>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a href="{{ route('egreso.create', $paciente->historia) }}" class="btn btn-secondary">Egreso</a>
                </div>
        </form>

    </div>
</body>
</html>
@endsection
</x-app-layout>
