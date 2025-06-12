<x-app-layout>
@section('contenido')
<head>
    <title>Detalle de Historia Médica</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/estilos_historia_medica.css') }}" rel="stylesheet">
</head>

<div class="contenedor-principal">
    <div class="contenido-principal">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="mb-0">Historia Médica</h1>
            <span class="badge bg-primary fs-6">
                Historia N°: {{ $paciente->historia }}
            </span>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Fecha y Hora de la Atención:</label>
            <div>{{ \Carbon\Carbon::parse($historia->fecha_atencion)->format('d/m/Y h:i A') }}</div>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Motivo de la Consulta:</label>
            <div>{{ $historia->motivo_consulta }}</div>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Diagnóstico (CIE-10):</label>
            <div>{{ $historia->diagnostico }}</div>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Plan de Tratamiento e Indicaciones:</label>
            <div>{{ $historia->plan_tratamiento }}</div>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Tratamiento Farmacológico:</label>
            <div>{{ $historia->tratamiento_farmacologico }}</div>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Órdenes de Exámenes Complementarios:</label>
            <div>{{ $historia->ordenes_examenes }}</div>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Evolución Clínica:</label>
            <div>{{ $historia->evolucion }}</div>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Interconsultas Realizadas:</label>
            <div>{{ $historia->interconsultas }}</div>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Observaciones Adicionales:</label>
            <div>{{ $historia->observaciones }}</div>
        </div>

        <div class="d-flex justify-content-end gap-2 mt-4">
            <a href="{{ route('historia.index', $paciente->historia) }}" class="btn btn-secondary">Volver</a>
        </div>
    </div>
</div>
@endsection
</x-app-layout>
