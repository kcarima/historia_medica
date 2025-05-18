<x-app-layout>
    @section('contenido')
<head>
    <title>Registro de Historia Médica</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/solicitud_laboratorio.css') }}" rel="stylesheet">

</head>
    <button type="button" class="btn btn-atras" onclick="history.back()">← Atrás</button>

    <div class="contenedor-laboratorio">

        <h1>Solicitud de Laboratorio</h1>

        <div class="section-title">Seleccione los exámenes de laboratorio</div>

        <form action="{{ route('pacientes.solicitud_laboratorio') }}" method="POST">
            @csrf
            <!-- Química -->
            <div class="lab-group">
                <div class="lab-group-title">Química</div>
                <div class="lab-list">
                    <label><input type="checkbox" name="lab[]" value="Glucosa"> Glucosa</label>
                    <label><input type="checkbox" name="lab[]" value="Urea"> Urea</label>
                    <label><input type="checkbox" name="lab[]" value="Creatinina"> Creatinina</label>
                    <label><input type="checkbox" name="lab[]" value="Colesterol total"> Colesterol total</label>
                    <label><input type="checkbox" name="lab[]" value="Triglicéridos"> Triglicéridos</label>
                    <label><input type="checkbox" name="lab[]" value="Ácido úrico"> Ácido úrico</label>
                    <label><input type="checkbox" name="lab[]" value="Transaminasas (TGO/TGP)"> Transaminasas (TGO/TGP)</label>
                    <label><input type="checkbox" name="lab[]" value="Bilirrubinas"> Bilirrubinas</label>
                    <label><input type="checkbox" name="lab[]" value="Fosfatasa alcalina"> Fosfatasa alcalina</label>
                    <label><input type="checkbox" name="lab[]" value="GGT"> GGT</label>
                    <label><input type="checkbox" name="lab[]" value="Proteínas totales y fraccionadas"> Proteínas totales y fraccionadas</label>
                    <label><input type="checkbox" name="lab[]" value="Electrolitos (Na, K, Cl)"> Electrolitos (Na, K, Cl)</label>
                    <label><input type="checkbox" name="lab[]" value="Calcio"> Calcio</label>
                    <label><input type="checkbox" name="lab[]" value="Fósforo"> Fósforo</label>
                    <label><input type="checkbox" name="lab[]" value="Magnesio"> Magnesio</label>
                </div>
            </div>

            <!-- Hematología -->
            <div class="lab-group">
                <div class="lab-group-title">Hematología</div>
                <div class="lab-list">
                    <label><input type="checkbox" name="lab[]" value="Hemograma completo"> Hemograma completo</label>
                    <label><input type="checkbox" name="lab[]" value="VSG"> VSG</label>
                    <label><input type="checkbox" name="lab[]" value="Pruebas de coagulación"> Pruebas de coagulación</label>
                    <label><input type="checkbox" name="lab[]" value="Grupo sanguíneo y factor RH"> Grupo sanguíneo y factor RH</label>
                </div>
            </div>

            <!-- Orina y Cultivos -->
            <div class="lab-group">
                <div class="lab-group-title">Orina y Cultivos</div>
                <div class="lab-list">
                    <label><input type="checkbox" name="lab[]" value="Orina completa"> Orina completa</label>
                    <label><input type="checkbox" name="lab[]" value="Urocultivo"> Urocultivo</label>
                    <label><input type="checkbox" name="lab[]" value="Coprológico"> Coprológico</label>
                    <label><input type="checkbox" name="lab[]" value="Coprocultivo"> Coprocultivo</label>
                </div>
            </div>

            <!-- Serología -->
            <div class="lab-group">
                <div class="lab-group-title">Serología</div>
                <div class="lab-list">
                    <label><input type="checkbox" name="lab[]" value="Serología (VDRL, HIV, HBsAg, HCV)"> Serología (VDRL, HIV, HBsAg, HCV)</label>
                    <label><input type="checkbox" name="lab[]" value="Test de embarazo"> Test de embarazo</label>
                    <label><input type="checkbox" name="lab[]" value="PCR"> PCR</label>
                </div>
            </div>

            <!-- Perfiles -->
            <div class="lab-group">
                <div class="lab-group-title">Perfiles</div>
                <div class="lab-list">
                    <label><input type="checkbox" name="lab[]" value="Perfil tiroideo"> Perfil tiroideo</label>
                    <label><input type="checkbox" name="lab[]" value="Perfil lipídico"> Perfil lipídico</label>
                    <label><input type="checkbox" name="lab[]" value="Perfil hepático"> Perfil hepático</label>
                    <label><input type="checkbox" name="lab[]" value="Perfil renal"> Perfil renal</label>
                    <label><input type="checkbox" name="lab[]" value="Perfil reumático"> Perfil reumático</label>
                </div>
            </div>

            <!-- Otros -->
            <div class="lab-group">
                <div class="lab-group-title">Otros</div>
                <div class="lab-list">
                    <label>
                        <input type="checkbox" name="lab[]" value="Otros" id="check-otros">
                        Otros
                    </label>
                </div>
                <div class="otros-lab" id="otrosLabDiv" style="display:none;">
                    <label for="otrosLab">Especifique otros exámenes:</label>
                    <textarea name="otrosLab" id="otrosLab" placeholder="Ingrese otros estudios de laboratorio..."></textarea>
                </div>
            </div>

            <div class="botones">
                <button type="submit" class="btn guardar">Guardar</button>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('check-otros').addEventListener('change', function() {
            var otrosDiv = document.getElementById('otrosLabDiv');
            if (this.checked) {
                otrosDiv.style.display = 'block';
                document.getElementById('otrosLab').focus();
            } else {
                otrosDiv.style.display = 'none';
                document.getElementById('otrosLab').value = '';
            }
        });
    </script>

    @endsection
</x-app-layout>
