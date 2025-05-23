<x-app-layout>

@section('contenido')


<head>
    <title>Registro de Historia Médica</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/egreso.css') }}" rel="stylesheet">

</head>
<body>
    <div class="container">
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
      </div>


@endsection
</x-app-layout>
