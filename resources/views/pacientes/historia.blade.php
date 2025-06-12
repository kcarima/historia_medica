<x-app-layout>

@section('contenido')


<head>
    <title>Registro de Historia Médica</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/estilos_historia_medica.css') }}" rel="stylesheet">

</head>


<body>

    <div class="menu-container-center">
        <ul class="menu-center" role="menubar" aria-label="Menú secundario">
         <li role="none"><a role="menuitem" href="{{ route('pacientes.historia') }}">Consulta</a></li>
         <li role="none"><a role="menuitem" href="{{ route('pacientes.anamnesis') }}">Anamnesis</a></li>
         <li role="none"><a role="menuitem" href="{{ route('pacientes.antecedentes_personales') }}">Antecedentes</a></li>
         <li role="none"><a role="menuitem" href="{{ route('pacientes.antecedentes_familiares') }}">Familiares</a></li>
         <li role="none"><a role="menuitem" href="{{ route('pacientes.antecedentes_ginecologicos') }}">Ginecológicos</a></li>
         <li role="none"><a role="menuitem" href="{{ route('pacientes.examen_fisico') }}">Examen</a></li>
         <li role="none"><a role="menuitem" href="{{ route('pacientes.diagnostico_tratamiento') }}">Diagnóstico</a></li>
         <li role="none"><a role="menuitem" href="{{ route('pacientes.egreso') }}">Egreso</a></li>
         <li role="none"><a role="menuitem" href="{{ route('pacientes.consideraciones_menor') }}">Consideraciones</a></li>
        </ul>
       </div>
    <h2>Historia Médica</h2>

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

  <!-- Menú lateral izquierdo -->
  <nav class="menu-izquierda flex-shrink-0" role="navigation" aria-label="Menú lateral">
    <ul class="list-unstyled m-0 p-0">
      <li><a href="{{ route('pacientes.nota_operatoria') }}" class="btn btn-outline-primary btn-sm w-100 mb-2">Nota Operatoria</a></li>
      <li><a href="{{ route('pacientes.imagenologia') }}" class="btn btn-outline-primary btn-sm w-100 mb-2">Imagenología</a></li>
      <li><a href="{{ route('pacientes.solicitud_laboratorio') }}" class="btn btn-outline-primary btn-sm w-100 mb-2">Solicitud de Laboratorio</a></li>
      <li><a href="{{ route('pacientes.solicitud_banco_sangre') }}" class="btn btn-outline-primary btn-sm w-100 mb-2">Solicitud de Sangre</a></li>
      <li><a href="{{ route('pacientes.solicitud_imagenes') }}" class="btn btn-outline-primary btn-sm w-100 mb-2">Solicitud de Imagenología</a></li>
      <li><a href="{{ route('pacientes.informe') }}" class="btn btn-outline-primary btn-sm w-100 mb-2">Informe</a></li>
      <li><a href="{{ route('pacientes.diagnostico_tratamiento') }}" class="btn btn-outline-primary btn-sm w-100 mb-2">Diagnóstico</a></li>
      <li><a href="{{ route('pacientes.pre_anestesia') }}" class="btn btn-outline-primary btn-sm w-100 mb-2">Pre Anestesia</a></li>
      <li><a href="{{ route('pacientes.consideraciones_menor') }}" class="btn btn-outline-primary btn-sm w-100 mb-2">Consideraciones</a></li>
    </ul>
  </nav>

</div>

@endsection
</x-app-layout>
