<x-app-layout>

@section('contenido')


<head>
    <title>Registro de Historia Médica</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/antecedentes_ginecologicos.css') }}" rel="stylesheet">

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

        <h3 id="Antecedentes">Antecedentes Ginecologico</h3>
<div class="minor-section gineco-obstetricos">
    <div class="form-group">
        <label for="menarquia">Menarquia:</label>
        <input type="text" id="menarquia" name="menarquia" placeholder="Edad de la primera menstruación">
    </div>
    <div class="form-group">
        <label for="ciclo_menstrual">Ciclo Menstrual:</label>
        <input type="text" id="ciclo_menstrual" name="ciclo_menstrual" placeholder="Duración y regularidad">
    </div>
    <div class="form-group">
        <label for="duracion_menstrual">Duración del sangrado:</label>
        <input type="text" id="duracion_menstrual" name="duracion_menstrual" placeholder="Días de sangrado">
    </div>
    <div class="form-group">
        <label for="dolor_menstrual">Dolor menstrual (dismenorrea):</label>
        <input type="text" id="dolor_menstrual" name="dolor_menstrual" placeholder="Sí / No, intensidad">
    </div>
    <div class="form-group">
        <label for="embarazos">Embarazos:</label>
        <input type="number" id="embarazos" name="embarazos" min="0" placeholder="Número de embarazos">
    </div>
    <div class="form-group">
        <label for="partos">Partos:</label>
        <input type="number" id="partos" name="partos" min="0" placeholder="Número de partos">
    </div>
    <div class="form-group">
        <label for="abortos">Abortos:</label>
        <input type="number" id="abortos" name="abortos" min="0" placeholder="Número de abortos espontáneos o inducidos">
    </div>
    <div class="form-group">
        <label for="cesareas">Cesáreas:</label>
        <input type="number" id="cesareas" name="cesareas" min="0" placeholder="Número de cesáreas">
    </div>
    <div class="form-group">
        <label for="metodo_anticonceptivo">Método Anticonceptivo:</label>
        <input type="text" id="metodo_anticonceptivo" name="metodo_anticonceptivo" placeholder="Tipo y duración">
    </div>
    <div class="form-group">
        <label for="fecha_ultima_menstruacion">Fecha de última menstruación:</label>
        <input type="date" id="fecha_ultima_menstruacion" name="fecha_ultima_menstruacion">
    </div>
    <div class="form-group">
        <label for="fecha_ultimo_parto">Fecha del último parto:</label>
        <input type="date" id="fecha_ultimo_parto" name="fecha_ultimo_parto">
    </div>
    <div class="form-group">
        <label for="complicaciones_embarazo">Complicaciones en embarazos previos:</label>
        <input type="text" id="complicaciones_embarazo" name="complicaciones_embarazo" placeholder="Describa si aplica">
    </div>
</div>


</body>
@endsection
</x-app-layout>
