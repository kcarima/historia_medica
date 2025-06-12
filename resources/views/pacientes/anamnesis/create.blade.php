<x-app-layout>
@section('contenido')

<head>
    <title>Registro de Historia Médica</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/estilos_historia_medica.css') }}" rel="stylesheet">
</head>

<div class="container my-4">
    <!-- Título y número de historia -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="mb-0">Historias</h1>
        <span class="badge bg-primary fs-6">
            Historia N°: {{ $paciente->historia }}
        </span>
    </div>

    <div class="contenedor-principal d-flex gap-4">
        <div class="contenido-principal flex-grow-1">
            <form action="{{ route('anamnesis.store', $paciente->historia) }}" method="post" class="form-container">
                @csrf

                <h3 id="anamnesis">Anamnesis (Interrogatorio)</h3>
                <h4>Enfermedad Actual</h4>
                <div class="form-group mb-3">
                    <label for="enfermedad_actual">Descripción:</label>
                    <textarea id="enfermedad_actual" name="enfermedad_actual" rows="5" class="form-control"></textarea>
                </div>

                <!-- ANTECEDENTES PERSONALES -->
                <h3 id="AntecedentesPersonales">Antecedentes Personales</h3>
                <div class="sections-grid row">
                    <div class="minor-section col-md-6">
                        <h5>Fisiológicos</h5>
                        <div class="form-group">
                            <label for="desarrollo_psicomotor">Desarrollo Psicomotor (en niños):</label>
                            <textarea id="desarrollo_psicomotor" name="desarrollo_psicomotor" rows="2" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="alimentacion">Alimentación:</label>
                            <textarea id="alimentacion" name="alimentacion" rows="2" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="sueno">Sueño:</label>
                            <textarea id="sueno" name="sueno" rows="2" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="eliminacion">Eliminación:</label>
                            <textarea id="eliminacion" name="eliminacion" rows="2" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="vacunacion">Vacunación (fechas y tipos):</label>
                            <textarea id="vacunacion" name="vacunacion" rows="3" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="alergias">Alergias (medicamentos, alimentos, ambientales):</label>
                            <textarea id="alergias" name="alergias" rows="2" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="habitos">Hábitos (ejercicio, tabaquismo, alcoholismo, drogas):</label>
                            <textarea id="habitos" name="habitos" rows="2" class="form-control"></textarea>
                        </div>
                    </div>

                    <div class="minor-section col-md-6">
                        <h5>Patológicos</h5>
                        <div class="form-group">
                            <label for="enfermedades_previas">Enfermedades Previas:</label>
                            <textarea id="enfermedades_previas" name="enfermedades_previas" rows="3" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="cirugias">Cirugías:</label>
                            <textarea id="cirugias" name="cirugias" rows="2" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="hospitalizaciones">Hospitalizaciones:</label>
                            <textarea id="hospitalizaciones" name="hospitalizaciones" rows="2" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="traumatismos">Traumatismos:</label>
                            <textarea id="traumatismos" name="traumatismos" rows="2" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="congénitas_perinatales">Enfermedades Congénitas o Perinatales (en niños):</label>
                            <textarea id="congénitas_perinatales" name="congénitas_perinatales" rows="2" class="form-control"></textarea>
                        </div>
                    </div>
                </div>

                <!-- ANTECEDENTES FAMILIARES -->
                <h3 id="AntecedentesFamiliares">Antecedentes Familiares</h3>
                <div class="form-group mb-3">
                    <label for="enfermedades_padres">Enfermedades de los padres:</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="enfermedades_padres[]" value="Diabetes" id="padres_diabetes">
                        <label class="form-check-label" for="padres_diabetes">Diabetes</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="enfermedades_padres[]" value="Hipertensión" id="padres_hipertension">
                        <label class="form-check-label" for="padres_hipertension">Hipertensión</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="enfermedades_padres[]" value="Cáncer" id="padres_cancer">
                        <label class="form-check-label" for="padres_cancer">Cáncer</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="enfermedades_padres[]" value="Cardiopatías" id="padres_cardiopatias">
                        <label class="form-check-label" for="padres_cardiopatias">Cardiopatías</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="enfermedades_padres[]" value="Otra" id="padres_otra">
                        <label class="form-check-label" for="padres_otra">Otra</label>
                    </div>
                    <input type="text" name="otra_enfermedad_padres" class="form-control mt-2" placeholder="Especifique otra enfermedad">
                </div>

                <div class="form-group mb-3">
                    <label for="hermanos">¿Algún hermano presenta enfermedades hereditarias?</label>
                    <select name="hermanos" id="hermanos" class="form-select">
                        <option value="No">No</option>
                        <option value="Sí">Sí</option>
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label for="detalle_hermanos">Detalle (si aplica):</label>
                    <input type="text" id="detalle_hermanos" name="detalle_hermanos" class="form-control">
                </div>

                <div class="form-group mb-3">
                    <label for="observaciones">Observaciones adicionales:</label>
                    <textarea id="observaciones" name="observaciones" rows="4" class="form-control"></textarea>
                </div>

                <!-- ANTECEDENTES GINECOLÓGICOS -->
                <h3 id="AntecedentesGinecologicos">Antecedentes Ginecológicos</h3>
                <div class="minor-section gineco-obstetricos mb-4">
                    <div class="form-group">
                        <label for="menarquia">Menarquia:</label>
                        <input type="text" id="menarquia" name="menarquia" placeholder="Edad de la primera menstruación" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="ciclo_menstrual">Ciclo Menstrual:</label>
                        <input type="text" id="ciclo_menstrual" name="ciclo_menstrual" placeholder="Duración y regularidad" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="duracion_menstrual">Duración del sangrado:</label>
                        <input type="text" id="duracion_menstrual" name="duracion_menstrual" placeholder="Días de sangrado" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="dolor_menstrual">Dolor menstrual (dismenorrea):</label>
                        <input type="text" id="dolor_menstrual" name="dolor_menstrual" placeholder="Sí / No, intensidad" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="embarazos">Embarazos:</label>
                        <input type="number" id="embarazos" name="embarazos" min="0" placeholder="Número de embarazos" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="partos">Partos:</label>
                        <input type="number" id="partos" name="partos" min="0" placeholder="Número de partos" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="abortos">Abortos:</label>
                        <input type="number" id="abortos" name="abortos" min="0" placeholder="Número de abortos espontáneos o inducidos" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="cesareas">Cesáreas:</label>
                        <input type="number" id="cesareas" name="cesareas" min="0" placeholder="Número de cesáreas" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="metodo_anticonceptivo">Método Anticonceptivo:</label>
                        <input type="text" id="metodo_anticonceptivo" name="metodo_anticonceptivo" placeholder="Tipo y duración" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="fecha_ultima_menstruacion">Fecha de última menstruación:</label>
                        <input type="date" id="fecha_ultima_menstruacion" name="fecha_ultima_menstruacion" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="fecha_ultimo_parto">Fecha del último parto:</label>
                        <input type="date" id="fecha_ultimo_parto" name="fecha_ultimo_parto" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="complicaciones_embarazo">Complicaciones en embarazos previos:</label>
                        <input type="text" id="complicaciones_embarazo" name="complicaciones_embarazo" placeholder="Describa si aplica" class="form-control">
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('pacientes.index') }}" class="btn btn-danger">Volver</a>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a href="{{ route('fisico.create', $paciente->historia) }}" class="btn btn-primary">Siguiente</a>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection
</x-app-layout>
