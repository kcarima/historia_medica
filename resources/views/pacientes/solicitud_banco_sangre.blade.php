<x-app-layout>
    @section('contenido')
<head>
    <title>Registro de Historia Médica</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/solicitud_banco_sangre.css') }}" rel="stylesheet">

</head>
<div class="mi-contenedor container mt-4">

<div class="container mi-contenedor mt-4">
    <h2 class="mb-4 text-center">Solicitud de Procedimientos de Banco de Sangre</h2>



        {{-- Datos del Paciente --}}
        <h5>Datos del Paciente</h5>
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="nombre" class="form-label">Nombre completo</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="col-md-3">
                <label for="fecha_nacimiento" class="form-label">Fecha de nacimiento</label>
                <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required>
            </div>
            <div class="col-md-3">
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
                <label for="identificacion" class="form-label">Número de identificación / Historia clínica</label>
                <input type="text" class="form-control" id="identificacion" name="identificacion" required>
            </div>
            <div class="col-md-4">
                <label for="peso" class="form-label">Peso (kg)</label>
                <input type="number" step="0.1" class="form-control" id="peso" name="peso" required>
            </div>
            <div class="col-md-4">
                <label for="grupo_sanguineo" class="form-label">Grupo sanguíneo (si se conoce)</label>
                <input type="text" class="form-control" id="grupo_sanguineo" name="grupo_sanguineo">
            </div>
        </div>

        {{-- Datos del Solicitante --}}
        <h5>Datos del Solicitante (Médico / Servicio)</h5>
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="medico" class="form-label">Nombre del médico</label>
                <input type="text" class="form-control" id="medico" name="medico" required>
            </div>
            <div class="col-md-6">
                <label for="servicio" class="form-label">Servicio / Departamento</label>
                <input type="text" class="form-control" id="servicio" name="servicio" required>
            </div>
        </div>
        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono de contacto</label>
            <input type="tel" class="form-control" id="telefono" name="telefono" required>
        </div>

        {{-- Fecha y hora de solicitud --}}
        <div class="mb-3">
            <label for="fecha_hora_solicitud" class="form-label">Fecha y hora de la solicitud</label>
            <input type="datetime-local" class="form-control" id="fecha_hora_solicitud" name="fecha_hora_solicitud" required>
        </div>

        {{-- Procedimientos solicitados --}}
        <h5>Procedimiento(s) Solicitado(s)</h5>
        <div class="mb-3">
            @php
                $procedimientos = [
                    'Transfusión de sangre total',
                    'Transfusión de glóbulos rojos concentrados',
                    'Transfusión de plasma fresco congelado',
                    'Transfusión de plaquetas',
                    'Autotransfusión',
                    'Sangría terapéutica',
                    'Estudios inmunohematológicos',
                    'Pruebas cruzadas (compatibilidad)',
                ];
            @endphp

            @foreach ($procedimientos as $index => $procedimiento)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="procedimientos[]" id="procedimiento{{ $index }}" value="{{ $procedimiento }}">
                    <label class="form-check-label" for="procedimiento{{ $index }}">
                        {{ $procedimiento }}
                    </label>
                </div>
            @endforeach

            <div class="form-check mt-2">
                <input class="form-check-input" type="checkbox" name="procedimientos[]" id="procedimiento_otro" value="Otro">
                <label class="form-check-label" for="procedimiento_otro">Otro</label>
            </div>
            <input type="text" class="form-control mt-1" name="procedimiento_otro_detalle" placeholder="Especifique otro procedimiento si aplica">
        </div>

        {{-- Motivo y diagnóstico --}}
        <div class="mb-3">
            <label for="motivo" class="form-label">Motivo de la Solicitud / Diagnóstico Clínico</label>
            <textarea class="form-control" id="motivo" name="motivo" rows="3" required></textarea>
        </div>

        {{-- Cantidad requerida --}}
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="cantidad" class="form-label">Cantidad requerida (volumen o unidades)</label>
                <input type="text" class="form-control" id="cantidad" name="cantidad" required>
            </div>
            <div class="col-md-6">
                <label for="fecha_hora_requerida" class="form-label">Fecha y hora requerida</label>
                <input type="datetime-local" class="form-control" id="fecha_hora_requerida" name="fecha_hora_requerida" required>
            </div>
        </div>

        {{-- Observaciones --}}
        <div class="mb-3">
            <label for="observaciones" class="form-label">Información adicional / Observaciones</label>
            <textarea class="form-control" id="observaciones" name="observaciones" rows="2"></textarea>
        </div>

        {{-- Firma --}}
        <div class="mb-3">
            <label for="firma_medico" class="form-label">Nombre del médico solicitante</label>
            <input type="text" class="form-control" id="firma_medico" name="firma_medico" required>
        </div>

        <button type="submit" class="btn btn-primary w-10">Enviar Solicitud</button>
    </form>
</div>
    @endsection
</x-app-layout>
