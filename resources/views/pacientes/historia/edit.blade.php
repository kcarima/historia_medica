<x-app-layout>
@section('contenido')
<head>
    <title>Editar Historia Médica</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/estilos_historia_medica.css') }}" rel="stylesheet">
</head>

<div class="contenedor-principal">
    <div class="contenido-principal">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="mb-0">Editar Historia Médica</h1>
            <span class="badge bg-primary fs-6">
                Historia N°: {{ $paciente->historia }}
            </span>
        </div>

        <form action="{{ route('historia.update', [$paciente->historia, $historia->id]) }}" method="POST">
            @csrf
            @method('PUT')

            <h3 id="informacion_consulta">Información Específica de la Consulta o Atención</h3>

            <div class="form-group mb-3">
                <label for="fecha_atencion_mostrar">Fecha y Hora de la Atención:</label>
                <input type="text" id="fecha_atencion_mostrar" name="fecha_atencion_mostrar" class="form-control" readonly>
                <input type="hidden" id="fecha_atencion" name="fecha_atencion" value="{{ old('fecha_atencion', $historia->fecha_atencion) }}" required>
            </div>

            <div class="form-group mb-3">
                <label for="motivo_consulta">Motivo de la Consulta:</label>
                <textarea id="motivo_consulta" name="motivo_consulta" class="form-control" rows="3" required>{{ old('motivo_consulta', $historia->motivo_consulta) }}</textarea>
            </div>

            <div class="form-group mb-3">
                <label for="diagnostico">Diagnóstico (CIE-10):</label>
                <input type="text" id="diagnostico" name="diagnostico" class="form-control" value="{{ old('diagnostico', $historia->diagnostico) }}">
            </div>

            <div class="form-group mb-3">
                <label for="plan_tratamiento">Plan de Tratamiento e Indicaciones:</label>
                <textarea id="plan_tratamiento" name="plan_tratamiento" class="form-control" rows="5">{{ old('plan_tratamiento', $historia->plan_tratamiento) }}</textarea>
            </div>

            <div class="form-group mb-3">
                <label for="tratamiento_farmacologico">Tratamiento Farmacológico:</label>
                <textarea id="tratamiento_farmacologico" name="tratamiento_farmacologico" class="form-control" rows="3">{{ old('tratamiento_farmacologico', $historia->tratamiento_farmacologico) }}</textarea>
            </div>

            <div class="form-group mb-3">
                <label for="ordenes_examenes">Órdenes de Exámenes Complementarios:</label>
                <textarea id="ordenes_examenes" name="ordenes_examenes" class="form-control" rows="3">{{ old('ordenes_examenes', $historia->ordenes_examenes) }}</textarea>
            </div>

            <div class="form-group mb-3">
                <label for="evolucion">Evolución Clínica:</label>
                <textarea id="evolucion" name="evolucion" class="form-control" rows="4">{{ old('evolucion', $historia->evolucion) }}</textarea>
            </div>

            <div class="form-group mb-3">
                <label for="interconsultas">Interconsultas Realizadas:</label>
                <textarea id="interconsultas" name="interconsultas" class="form-control" rows="3">{{ old('interconsultas', $historia->interconsultas) }}</textarea>
            </div>

            <div class="form-group mb-3">
                <label for="observaciones">Observaciones Adicionales:</label>
                <textarea id="observaciones" name="observaciones" class="form-control" rows="3">{{ old('observaciones', $historia->observaciones) }}</textarea>
            </div>

            <div class="d-flex justify-content-end gap-2 mt-4">
                <a href="{{ route('historia.show', [$paciente->historia, $historia->id]) }}" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-primary">Actualizar</button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const backendDate = "{{ old('fecha_atencion', $historia->fecha_atencion) }}";

    if (backendDate) {
        let dateStr = backendDate.replace(' ', 'T');
        if (dateStr.length === 16) dateStr += ':00';
        const dateObj = new Date(dateStr);

        let day = String(dateObj.getDate()).padStart(2, '0');
        let month = String(dateObj.getMonth() + 1).padStart(2, '0');
        let year = dateObj.getFullYear();

        let hours = dateObj.getHours();
        let minutes = String(dateObj.getMinutes()).padStart(2, '0');
        let ampm = hours >= 12 ? 'PM' : 'AM';
        let displayHours = hours % 12;
        displayHours = displayHours ? displayHours : 12;

        let displayDate = `${day}/${month}/${year} ${displayHours}:${minutes} ${ampm}`;
        document.getElementById('fecha_atencion_mostrar').value = displayDate;

        let backendHours = String(hours).padStart(2, '0');
        let backendFormatted = `${year}-${month}-${day} ${backendHours}:${minutes}:00`;
        document.getElementById('fecha_atencion').value = backendFormatted;
    }
});
</script>
@endsection
</x-app-layout>
