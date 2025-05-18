<x-app-layout>

@section('contenido')


<head>
    <title>Registro de Historia Médica</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/diagnostico_tratamiento.css') }}" rel="stylesheet">

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

      <h3 id="anamnesis">Diagnostico</h3>


      <div class="form-columns-wrapper">
        <div class="form-column">
          <div class="form-group">
            <label for="diagnostico">Diagnóstico (CIE-10):</label>
            <input type="text" id="diagnostico" name="diagnostico">
          </div>
          <div class="form-group">
            <label for="fecha_diagnostico">Fecha del Diagnóstico:</label>
            <input type="date" id="fecha_diagnostico" name="fecha_diagnostico">
          </div>
          <div class="form-group">
            <label for="plan_tratamiento">Plan de Tratamiento e Indicaciones:</label>
            <textarea id="plan_tratamiento" name="plan_tratamiento" rows="5"></textarea>
          </div>
          <div class="form-group">
            <label for="tratamiento_farmacologico">Tratamiento Farmacológico:</label>
            <textarea id="tratamiento_farmacologico" name="tratamiento_farmacologico" rows="3"></textarea>
          </div>
          <div class="form-group">
            <label for="ordenes_examenes">Órdenes de Exámenes Complementarios:</label>
            <textarea id="ordenes_examenes" name="ordenes_examenes" rows="3"></textarea>
          </div>
        </div>

        <div class="form-column">
          <div class="form-group">
            <label for="evolucion">Evolución Clínica:</label>
            <textarea id="evolucion" name="evolucion" rows="4"></textarea>
          </div>
          <div class="form-group">
           <div class="form-group">
            <label for="interconsultas">Interconsultas Realizadas:</label>
            <textarea id="interconsultas" name="interconsultas" rows="3"></textarea>
          </div>

          <div class="form-group">
            <label for="observaciones">Observaciones Adicionales:</label>
            <textarea id="observaciones" name="observaciones" rows="3"></textarea>
          </div>
        </div>
      </div>
    </div>
  </body>

@endsection
</x-app-layout>
