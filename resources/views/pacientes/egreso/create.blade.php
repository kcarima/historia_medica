<x-app-layout>

@section('contenido')


<head>
    <title>Registro de Historia Médica</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/egreso.css') }}" rel="stylesheet">

</head>

  <div class="contenedor-principal">
        <!-- Contenedor formulario (contenido principal) -->
        <div class="contenido-principal">
            <!-- Contenedor flex para título y etiqueta historia -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h1 class="mb-0">Historias</h1>
                <span class="badge bg-primary fs-6">
                    Historia N°: {{ $paciente->historia }}
                </span>
            </div>

    <form action="{{ route('egreso.store', $paciente->historia) }}" method="POST">
            @csrf
      <h3 id="anamnesis">Diagnostico de egreso</h3>

      <div class="container">
        <div class="form-row">
          <div class="form-group">
            <label for="diagnostico_egreso">Diagnóstico al Egreso:</label>
            <textarea id="diagnostico_egreso" name="diagnostico_egreso" rows="3"></textarea>
          </div>
          <div class="form-group">
            <label for="recomendaciones_seguimiento">Recomendaciones y Plan de Seguimiento:</label>
            <textarea id="recomendaciones_seguimiento" name="recomendaciones_seguimiento" rows="3"></textarea>
          </div>
        </div>
                    <a href="{{ route('pacientes.index') }}" class="btn btn-danger">Volver</a>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                   {{--  <a href="{{ route('nota_operatoria.create', $paciente->historia) }}" class="btn btn-secondary">Nota Operatoria</a> --}}
                </div>
      </div>


@endsection
</x-app-layout>
