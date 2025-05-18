<x-app-layout>

@section('contenido')


<head>
    <title>Registro de Historia Médica</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/examen_fisico.css') }}" rel="stylesheet">

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


            <div class="button-group" style="margin-top: 30px;">
              <button type="button" id="btnSiguiente">Siguiente</button>
            </div>
          </div>

</body>
@endsection
</x-app-layout>
