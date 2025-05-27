<x-app-layout>

@section('contenido')


<!-- Contenedor flex para título y etiqueta historia -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="mb-0">Historias</h1>
        <span class="badge bg-primary fs-6">
           {{-- HOLA --}}
             Historia N°: {{ $paciente->historia }}
        </span>
    </div>

<div class="contenedor-principal d-flex gap-4">

  <!-- Contenedor formulario (contenido principal) -->
  <div class="contenido-principal flex-grow-1">
<form action="guardar_historia_medica.php" method="post" class="form-container">

      <h3 id="informacion_consulta">Información Específica de la Consulta o Atención</h3>
      <div class="form-group">
        <label for="fecha_atencion">Fecha y Hora de la Atención:</label>
        <input type="datetime-local" id="fecha_atencion" name="fecha_atencion" required>
      </div>
      <div class="form-group">
        <label for="motivo_consulta">Motivo de la Consulta:</label>
        <textarea id="motivo_consulta" name="motivo_consulta" rows="3" required></textarea>


    <button type="submit">Guardar</button>
  </div>

      <!-- Aquí más campos del formulario -->
    </form>
  </div>

@endsection
</x-app-layout>
