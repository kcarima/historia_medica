<x-app-layout>
    @section('contenido')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Historial Médico Completo</h1>
            <div>
                <span class="badge bg-primary fs-5">
                    Historia N°: {{ $paciente->historia }}
                </span>
                <span class="badge bg-secondary fs-5 ms-2">
                    Cédula: {{ $paciente->cedula }}
                </span>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h3 class="mb-0">Datos del Paciente</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Nombre:</strong>
                            {{ $paciente->primer_apellido }}
                            {{ $paciente->segundo_apellido }}
                            {{ $paciente->nombre }}
                        </p>
                        <p><strong>Fecha Nacimiento:</strong>
                            {{ \Carbon\Carbon::parse($paciente->fecha_nacimiento)->format('d/m/Y') }}
                            ({{ \Carbon\Carbon::parse($paciente->fecha_nacimiento)->age }} años)
                        </p>
                    </div>

                </div>
            </div>
        </div>

        <h3 class="mb-3">Registros de Historias Clínicas</h3>

        @if($historias->count() > 0)
            @foreach($historias as $historia)
            <div class="card mb-4">
                <div class="card-header bg-light d-flex justify-content-between">
                    <h4 class="mb-0">Atención del {{ \Carbon\Carbon::parse($historia->fecha_atencion)->format('d/m/Y H:i') }}</h4>
                    <span class="badge bg-info">
                        Médico: {{ $historia->medico->name ?? 'No especificado' }}
                    </span>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <h5>Motivo de Consulta:</h5>
                                <p>{{ $historia->motivo_consulta ?? 'No registrado' }}</p>
                            </div>

                            <div class="mb-3">
                                <h5>Diagnóstico:</h5>
                                <p>{{ $historia->diagnostico ?? 'No registrado' }}</p>
                            </div>

                            <div class="mb-3">
                                <h5>Plan de Tratamiento:</h5>
                                <p>{{ $historia->plan_tratamiento ?? 'No registrado' }}</p>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <h5>Tratamiento Farmacológico:</h5>
                                <p>{{ $historia->tratamiento_farmacologico ?? 'No registrado' }}</p>
                            </div>

                            <div class="mb-3">
                                <h5>Exámenes Complementarios:</h5>
                                <p>{{ $historia->ordenes_examenes ?? 'No registrados' }}</p>
                            </div>

                            <div class="mb-3">
                                <h5>Interconsultas:</h5>
                                <p>{{ $historia->interconsultas ?? 'No registradas' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <h5>Evolución:</h5>
                                <p>{{ $historia->evolucion ?? 'No registrada' }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <h5>Observaciones:</h5>
                                <p>{{ $historia->observaciones ?? 'No hay observaciones' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <a href="{{ route('historia.pdf', $historia->historia) }}" class="btn btn-sm btn-primary" target="_blank">
                        <i class="fas fa-file-pdf"></i> Descargar PDF
                    </a>
                </div>
            </div>
            @endforeach
        @else
            <div class="alert alert-info">
                No se encontraron registros de historias clínicas para este paciente.
            </div>
        @endif

        <div class="d-flex justify-content-end mt-4">
            <a href="{{ route('historia.buscar') }}" class="btn btn-secondary me-2">
                <i class="fas fa-search"></i> Nueva Búsqueda
            </a>
            <a href="{{ route('pacientes.index') }}" class="btn btn-primary">
                <i class="fas fa-list"></i> Volver al Listado
            </a>
        </div>
    </div>
    @endsection
</x-app-layout>
