<x-app-layout>
@section('contenido')
<head>
    <title>Registro de Historia Médica</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/estilos_historia_medica.css') }}" rel="stylesheet">
</head>

<a href="{{ route('historia.pdf', 'pdf' . str_pad($paciente->historia, 6, '0', STR_PAD_LEFT)) }}"
   class="btn btn-primary"
   target="_blank">
    Descargar PDF
</a>
<a href="{{ route('historia.reposo', 'reposo' . str_pad($paciente->historia, 6, '0', STR_PAD_LEFT)) }}"
   class="btn btn-primary"
   target="_blank">
   Reposo
</a>
<a href="{{ route('historia.informeMedico', 'informeMedico' . str_pad($paciente->historia, 6, '0', STR_PAD_LEFT)) }}"
   class="btn btn-primary"
   target="_blank">
   Informe Medico
</a>

<contenedor-principal">
    <div class="contenido-principal">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="mb-0">Historias</h1>
            <span class="badge bg-primary fs-6">
                Historia N°: {{ $paciente->historia }}
            </span>
        </div>

        <form action="{{ route('historia.store', $paciente->historia) }}" method="POST">
            @csrf
            <input type="hidden" name="paciente_id" value="{{ $paciente->id }}">

            <h3 id="informacion_consulta">Información Específica de la Consulta o Atención</h3>

            <div class="form-group">
                <label for="fecha_atencion_mostrar">Fecha y Hora de la Atención:</label>
                <input type="text" id="fecha_atencion_mostrar" name="fecha_atencion_mostrar" class="form-control" readonly>
                <input type="hidden" id="fecha_atencion" name="fecha_atencion" required>
            </div>

            <div class="form-group">
                <label for="motivo_consulta">Motivo de la Consulta:</label>
                <textarea id="motivo_consulta" name="motivo_consulta" class="form-control" rows="3" required></textarea>
            </div>

            <div class="form-group">
                <label for="diagnostico">Diagnóstico (CIE-10):</label>
                <input type="text" id="diagnostico" name="diagnostico" class="form-control">
            </div>

            <div class="form-group">
                <label for="plan_tratamiento">Plan de Tratamiento e Indicaciones:</label>
                <textarea id="plan_tratamiento" name="plan_tratamiento" class="form-control" rows="5"></textarea>
            </div>

            <div class="form-group">
                <label for="tratamiento_farmacologico">Tratamiento Farmacológico:</label>
                <textarea id="tratamiento_farmacologico" name="tratamiento_farmacologico" class="form-control" rows="3"></textarea>
            </div>

            <div class="form-group">
                <label for="ordenes_examenes">Órdenes de Exámenes Complementarios:</label>
                <textarea id="ordenes_examenes" name="ordenes_examenes" class="form-control" rows="3"></textarea>
            </div>

            <div class="form-group">
                <label for="evolucion">Evolución Clínica:</label>
                <textarea id="evolucion" name="evolucion" class="form-control" rows="4"></textarea>
            </div>

            <div class="form-group">
                <label for="interconsultas">Interconsultas Realizadas:</label>
                <textarea id="interconsultas" name="interconsultas" class="form-control" rows="3"></textarea>
            </div>

            <div class="form-group">
                <label for="observaciones">Observaciones Adicionales:</label>
                <textarea id="observaciones" name="observaciones" class="form-control" rows="3"></textarea>
            </div>

            <!-- Campos para fechas de reposo -->
            <div class="form-group mt-4">
                <label for="fecha_reposo_desde">Fecha inicio de reposo:</label>
                <input type="date" id="fecha_reposo_desde" name="fecha_reposo_desde" class="form-control" value="{{ old('fecha_reposo_desde') }}" max="{{ date('Y-m-d') }}">
            </div>

            <div class="form-group mt-3">
                <label for="fecha_reposo_hasta">Fecha fin de reposo:</label>
                <input type="date" id="fecha_reposo_hasta" name="fecha_reposo_hasta" class="form-control" value="{{ old('fecha_reposo_hasta') }}">
            </div>

            <div class="form-group mt-3">
                <label for="dias_reposo">Días de reposo:</label>
                <input type="text" id="dias_reposo" name="dias_reposo" class="form-control" readonly value="{{ old('dias_reposo') }}">
            </div>

            <div class="d-flex justify-content-end gap-2 mt-4">
                <a href="{{ route('pacientes.index') }}" class="btn btn-danger">Volver</a>
                <a href="{{ route('anamnesis.create', $paciente->historia) }}" class="btn btn-primary">Ingreso</a>
                <a href="{{ route('fisico.create', $paciente->historia) }}" class="btn btn-primary">Examen fisico</a>
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="{{ route('fisico.edit', $paciente->historia) }}" class="btn btn-primary">Ver Examen fisico</a>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Fecha y hora actuales para el campo de atención
    const now = new Date();

    let day = String(now.getDate()).padStart(2, '0');
    let month = String(now.getMonth() + 1).padStart(2, '0');
    let year = now.getFullYear();

    let hours = now.getHours();
    let minutes = String(now.getMinutes()).padStart(2, '0');
    let ampm = hours >= 12 ? 'PM' : 'AM';
    let displayHours = hours % 12;
    displayHours = displayHours ? displayHours : 12;

    let displayDate = `${day}/${month}/${year} ${displayHours}:${minutes} ${ampm}`;
    document.getElementById('fecha_atencion_mostrar').value = displayDate;

    let backendHours = String(hours).padStart(2, '0');
    let backendDate = `${year}-${month}-${day} ${backendHours}:${minutes}:00`;
    document.getElementById('fecha_atencion').value = backendDate;

    // Validaciones y cálculo de días de reposo
    const fechaDesde = document.getElementById('fecha_reposo_desde');
    const fechaHasta = document.getElementById('fecha_reposo_hasta');
    const diasReposo = document.getElementById('dias_reposo');

    // Limitar fecha inicio a hoy o antes
    const hoy = new Date().toISOString().split('T')[0];
    fechaDesde.setAttribute('max', hoy);

    function calcularDias() {
        if (fechaDesde.value && fechaHasta.value) {
            const inicio = new Date(fechaDesde.value);
            const fin = new Date(fechaHasta.value);

            // Validar que fecha fin no sea anterior a inicio
            if (fin < inicio) {
                alert('La fecha fin de reposo no puede ser anterior a la fecha inicio.');
                fechaHasta.value = '';
                diasReposo.value = '';
                return;
            }

            // Validar que fecha fin no exceda 21 días después de inicio
            const maxFin = new Date(inicio);
            maxFin.setDate(maxFin.getDate() + 21);

            if (fin > maxFin) {
                alert('La fecha fin de reposo no puede ser más de 21 días después de la fecha inicio.');
                fechaHasta.value = '';
                diasReposo.value = '';
                return;
            }

            // Calcular días incluyendo ambos extremos
            const diffTime = fin - inicio;
            const diffDays = Math.floor(diffTime / (1000 * 60 * 60 * 24)) + 1;
            diasReposo.value = diffDays;
        } else {
            diasReposo.value = '';
        }
    }

    fechaDesde.addEventListener('change', () => {
        // Al cambiar fecha inicio, limpiar fecha fin y días para evitar inconsistencias
        fechaHasta.value = '';
        diasReposo.value = '';
        calcularDias();
    });

    fechaHasta.addEventListener('change', calcularDias);
});
</script>
@endsection
</x-app-layout>
