<x-app-layout>
    @section('contenido')
<head>
    <title>Registro de Historia Médica</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/solicitud_banco_sangre.css') }}" rel="stylesheet">

</head>
<div class="container mi-contenedor mt-4">
    <h2 class="mb-4 text-center">Solicitud de Estudio de Imagenología</h2>



        {{-- Datos del Paciente --}}
        <h5>Datos del Paciente</h5>
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="nombre" class="form-label">Nombre completo</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="col-md-2">
                <label for="edad" class="form-label">Edad</label>
                <input type="number" class="form-control" id="edad" name="edad" required min="0">
            </div>
            <div class="col-md-4">
                <label for="sexo" class="form-label">Sexo</label>
                <select class="form-select" id="sexo" name="sexo" required>
                    <option value="" selected disabled>Seleccione</option>
                    <option value="Masculino">Masculino</option>
                    <option value="Femenino">Femenino</option>
                    <option value="Otro">Otro</option>
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-4">
                <label for="cedula" class="form-label">Cédula de Identidad / Documento</label>
                <input type="text" class="form-control" id="cedula" name="cedula" required>
            </div>
            <div class="col-md-4">
                <label for="procedencia" class="form-label">Procedencia / Servicio</label>
                <input type="text" class="form-control" id="procedencia" name="procedencia" required>
            </div>
            <div class="col-md-4">
                <label for="fecha_solicitud" class="form-label">Fecha de Solicitud</label>
                <input type="date" class="form-control" id="fecha_solicitud" name="fecha_solicitud" required>
            </div>
        </div>

        {{-- Datos del examen solicitado --}}
        <h5>Examen Solicitado</h5>
        <div class="mb-3">
            <label for="examen_solicitado" class="form-label">Tipo de Estudio</label>
            <select class="form-select" id="examen_solicitado" name="examen_solicitado" required>
                <option value="" selected disabled>Seleccione un examen</option>
                <option value="Radiografía de tórax">Radiografía
                <option value="Ecografía">Ecografía</option>
                <option value="Tomografía computarizada (TC)">Tomografía computarizada (TC)</option>
                <option value="Resonancia magnética (RM)">Resonancia magnética (RM)</option>
                <option value="Mamografía">Mamografía</option>
                <option value="Otros">Otros</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="examen_otro" class="form-label">Si seleccionó "Otros", especifique</label>
            <input type="text" class="form-control" id="examen_otro" name="examen_otro" placeholder="Especifique otro examen">
        </div>


        {{-- Diagnóstico presuntivo --}}
        <div class="mb-3">
            <label for="diagnostico_presuntivo" class="form-label">Diagnóstico presuntivo</label>
            <input type="text" class="form-control" id="diagnostico_presuntivo" name="diagnostico_presuntivo" required>
        </div>

        {{-- Firma del médico --}}
        <div class="row mb-3">
            <div class="col-md-8">
                <label for="medico_solicitante" class="form-label">Nombre del Médico Solicitante</label>
                <input type="text" class="form-control" id="medico_solicitante" name="medico_solicitante" required>
            </div>
            <div class="col-md-4">
                <label for="fecha_firma" class="form-label">Fecha</label>
                <input type="date" class="form-control" id="fecha_firma" name="fecha_firma" required>
            </div>
        </div>

        <button type="submit" class="btn btn-primary w-10 mt-3">Enviar Solicitud</button>
    </form>
</div>
    @endsection
</x-app-layout>
