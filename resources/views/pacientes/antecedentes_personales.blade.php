<x-app-layout>

@section('contenido')


<head>
    <title>Registro de Historia Médica</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/antecedentes_personales.css') }}" rel="stylesheet">

</head>


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

    <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
</nav>
<body>

        <div class="container">
            <h3 id="Antecedentes">Antecedentes Personales</h3>

            <div class="sections-grid">
                <div class="minor-section">
                    <h5>Fisiológicos</h5>
                    <div class="form-group">
                        <label for="desarrollo_psicomotor">Desarrollo Psicomotor (en niños):</label>
                        <textarea id="desarrollo_psicomotor" name="desarrollo_psicomotor" rows="2"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="alimentacion">Alimentación:</label>
                        <textarea id="alimentacion" name="alimentacion" rows="2"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="sueno">Sueño:</label>
                        <textarea id="sueno" name="sueno" rows="2"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="eliminacion">Eliminación:</label>
                        <textarea id="eliminacion" name="eliminacion" rows="2"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="vacunacion">Vacunación (fechas y tipos):</label>
                        <textarea id="vacunacion" name="vacunacion" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="alergias">Alergias (medicamentos, alimentos, ambientales):</label>
                        <textarea id="alergias" name="alergias" rows="2"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="habitos">Hábitos (ejercicio, tabaquismo, alcoholismo, drogas):</label>
                        <textarea id="habitos" name="habitos" rows="2"></textarea>
                    </div>
                </div>

                <div class="minor-section">
                    <h5>Patológicos</h5>
                    <div class="form-group">
                        <label for="enfermedades_previas">Enfermedades Previas:</label>
                        <textarea id="enfermedades_previas" name="enfermedades_previas" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="cirugias">Cirugías:</label>
                        <textarea id="cirugias" name="cirugias" rows="2"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="hospitalizaciones">Hospitalizaciones:</label>
                        <textarea id="hospitalizaciones" name="hospitalizaciones" rows="2"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="traumatismos">Traumatismos:</label>
                        <textarea id="traumatismos" name="traumatismos" rows="2"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="congénitas_perinatales">Enfermedades Congénitas o Perinatales (en niños):</label>
                        <textarea id="congénitas_perinatales" name="congénitas_perinatales" rows="2"></textarea>
                    </div>
                </div>
            </div>
        </div>


</body>
@endsection
</x-app-layout>
