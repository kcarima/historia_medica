<x-app-layout>
    @section('contenido')
    <head>
        <title>Registro de Historia Médica</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="{{ asset('css/examen_fisico.css') }}" rel="stylesheet">
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

    <form action="{{ route('fisico.store', $paciente->historia) }}" method="POST">
            @csrf
    <div class="container">
            <h3 id="examen_fisico">Examen Fisico</h3>
            <div class="form-grid">
              <div class="form-group">
                <label for="presion_arterial">Presión Arterial:</label>
                <input type="text" id="presion_arterial" name="presion_arterial">
              </div>
              <div class="form-group">
                <label for="frecuencia_cardiaca">Frecuencia Cardíaca:</label>
                <input type="number" id="frecuencia_cardiaca" name="frecuencia_cardiaca">
              </div>
              <div class="form-group">
                <label for="frecuencia_respiratoria">Frecuencia Respiratoria:</label>
                <input type="number" id="frecuencia_respiratoria" name="frecuencia_respiratoria">
              </div>
              <div class="form-group">
                <label for="temperatura">Temperatura (°C):</label>
                <input type="number" step="0.1" id="temperatura" name="temperatura">
              </div>
              <div class="form-group">
                <label for="saturacion_oxigeno">Saturación de Oxígeno (%):</label>
                <input type="number" id="saturacion_oxigeno" name="saturacion_oxigeno">
              </div>
              <div class="form-group">
                <label for="peso">Peso (kg):</label>
                <input type="number" step="0.01" id="peso" name="peso">
              </div>
              <div class="form-group">
                <label for="talla">Talla (cm):</label>
                <input type="number" step="0.1" id="talla" name="talla">
              </div>
              <div class="form-group full-width">
                <label for="examen_general">Examen General:</label>
                <textarea id="examen_general" name="examen_general" rows="3"></textarea>
              </div>
              <div class="form-group full-width">
                <label for="examen_por_sistemas">Exploración Física por Sistemas:</label>
                <textarea id="examen_por_sistemas" name="examen_por_sistemas" rows="5"></textarea>
              </div>
            </div>


                <div class="d-flex justify-content-end gap-2 mt-4">
  <a href="{{ route('historia.create', $paciente->historia) }}" class="btn btn-secondary">Emergencia/Consulta</a>
                    <a href="{{ route('pacientes.index') }}" class="btn btn-danger">Volver</a>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                     <a href="{{ route('nota_operatoria.create', $paciente->historia) }}" class="btn btn-primary">Nota Operatoria</a>

                </div>
            </form>
        </div>
    </div>



    @endsection
</x-app-layout>
