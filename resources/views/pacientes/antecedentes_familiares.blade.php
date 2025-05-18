<x-app-layout>

@section('contenido')


<head>
    <title>Registro de Historia Médica</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/antecedentes_familiares.css') }}" rel="stylesheet">

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

    <body>
        <h3 id="Antecedentes">Antecedentes Familiaress</h3>
        <div class="form-container">
            <form action="procesar_antecedentes.php" method="POST">
                 <label for="enfermedades_padres">Enfermedades de los padres:</label><br>
                <input type="checkbox" name="enfermedades_padres[]" value="Diabetes"> Diabetes<br>
                <input type="checkbox" name="enfermedades_padres[]" value="Hipertensión"> Hipertensión<br>
                <input type="checkbox" name="enfermedades_padres[]" value="Cáncer"> Cáncer<br>
                <input type="checkbox" name="enfermedades_padres[]" value="Cardiopatías"> Cardiopatías<br>
                <input type="checkbox" name="enfermedades_padres[]" value="Otra"> Otra<br>
                <input type="text" name="otra_enfermedad_padres" placeholder="Especifique otra enfermedad"><br><br>


                <label for="enfermedades_padres">Enfermedades de los padres:</label><br>
                <input type="checkbox" name="enfermedades_padres[]" value="Diabetes"> Diabetes<br>
                <input type="checkbox" name="enfermedades_padres[]" value="Hipertensión"> Hipertensión<br>
                <input type="checkbox" name="enfermedades_padres[]" value="Cáncer"> Cáncer<br>
                <input type="checkbox" name="enfermedades_padres[]" value="Cardiopatías"> Cardiopatías<br>
                <input type="checkbox" name="enfermedades_padres[]" value="Otra"> Otra<br>
                <input type="text" name="otra_enfermedad_padres" placeholder="Especifique otra enfermedad"><br><br>


                <label for="hermanos">¿Algún hermano presenta enfermedades hereditarias?</label>
                <select name="hermanos" id="hermanos">
                    <option value="No">No</option>
                    <option value="Sí">Sí</option>
                </select><br><br>

                <label for="detalle_hermanos">Detalle (si aplica):</label>
                <input type="text" id="detalle_hermanos" name="detalle_hermanos"><br><br>

                <label for="observaciones">Observaciones adicionales:</label><br>
                <textarea id="observaciones" name="observaciones" rows="4" cols="50"></textarea><br><br>

                <input type="submit" value="Enviar">
            </form>
        </div>
    </body>
</div>



</body>
@endsection
</x-app-layout>
