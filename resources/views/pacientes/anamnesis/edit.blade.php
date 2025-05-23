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


        <h3 id="anamnesis">Anamnesis (Interrogatorio)</h3>
        <h4>Enfermedad Actual</h4>
        <div class="form-group">
            <label for="enfermedad_actual">Descripción:</label>
            <textarea id="enfermedad_actual" name="enfermedad_actual" rows="5"></textarea>
        </div>

</body>
@endsection
</x-app-layout>
