<x-app-layout>

@section('contenido')


<head>
    <title>Registro de Historia Médica</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/consideraciones_menor.css') }}" rel="stylesheet">

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

      <h3 id="consideraciones">Consideraciones del niño</h3>

      <form class="form-two-columns">
        <div class="form-group">
          <label for="nombre_representante">Nombre Completo del Representante Legal:</label>
          <input type="text" id="nombre_representante" name="nombre_representante">
        </div>
        <div class="form-group">
          <label for="identificacion_representante">Identificación del Representante Legal:</label>
          <input type="text" id="identificacion_representante" name="identificacion_representante">
        </div>
        <div class="form-group">
          <label for="relacion_representante">Relación con el Menor:</label>
          <input type="text" id="relacion_representante" name="relacion_representante">
        </div>

        <div class="form-group">
          <label for="desarrollo_psicomotor_nino">Desarrollo Psicomotor (en niños):</label>
          <textarea id="desarrollo_psicomotor_nino" name="desarrollo_psicomotor_nino" rows="3"></textarea>
        </div>
        <div class="form-group">
          <label for="esquema_vacunacion">Esquema de Vacunación:</label>
          <textarea id="esquema_vacunacion" name="esquema_vacunacion" rows="3"></textarea>
        </div>
      </form>
    </div>
  </body>
@endsection
</x-app-layout>
