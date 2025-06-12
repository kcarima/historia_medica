<x-app-layout>
    @section('contenido')
    <div class="container py-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h3 class="mb-0">Buscar Historial Médico</h3>
            </div>
            <div class="card-body">
                <!-- Formulario de Búsqueda -->
               <form action="{{ route('historia.buscar') }}" method="POST">
    @csrf
    <div class="row g-3 align-items-center mb-4">
        <div class="col-md-3">
            <label for="tipo_busqueda" class="form-label">Buscar por:</label>
            <select class="form-select" id="tipo_busqueda" name="tipo_busqueda" required>
                <option value="historia" {{ old('tipo_busqueda') == 'historia' ? 'selected' : '' }}>N° Historia</option>
                <option value="cedula" {{ old('tipo_busqueda') == 'cedula' ? 'selected' : '' }}>Cédula</option>
            </select>
        </div>
        <div class="col-md-6">
            <label for="busqueda" class="form-label">Número:</label>
            <input type="text" class="form-control" id="busqueda" name="busqueda"
                   value="{{ old('busqueda') }}"
                   placeholder="Ingrese el número correspondiente"
                   required
                   inputmode="numeric"
                   pattern="\d+"
                   maxlength="10"
            >
        </div>
        <div class="col-md-3 d-flex align-items-end">
            <button class="btn btn-primary me-2" type="submit">
                <i class="fas fa-search me-1"></i> Buscar
            </button>
            <a href="{{ route('historia.buscar') }}" class="btn btn-secondary">
                <i class="fas fa-undo me-1"></i> Limpiar
            </a>
        </div>
    </div>
</form>

                <!-- Resultados -->
                @if(isset($paciente))
                    <div class="mt-4">
                        <!-- Datos del Paciente -->
                        <div class="card mb-4 border-primary">
                            <div class="card-header bg-primary text-white">
                                <h4 class="mb-0">Datos del Paciente</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p><strong>Nombre completo:</strong>
                                            {{ $paciente->primer_apellido }}
                                            {{ $paciente->segundo_apellido }}
                                            {{ $paciente->nombre }}
                                        </p>
                                        <p><strong>Edad:</strong>
                                            {{ \Carbon\Carbon::parse($paciente->fecha_nacimiento)->age }} años
                                            <small class="text-muted">({{ \Carbon\Carbon::parse($paciente->fecha_nacimiento)->format('d/m/Y') }})</small>
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Historia clínica:</strong> {{ $paciente->historia }}</p>
                                        <p><strong>Cédula:</strong> {{ $paciente->cedula }}</p>
                                        <p><strong>Teléfono:</strong> {{ $paciente->telefono ?? 'No registrado' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Historias Clínicas -->
                        <h4 class="mb-3">Registros de atención</h4>

                        @forelse($historias as $historia)
                        <div class="card mb-3">
                            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">
                                    <i class="fas fa-calendar-alt me-2"></i>
                                    {{ $historia->fecha_atencion->format('d/m/Y H:i') }}
                                </h5>
                                <span class="badge bg-info">
                                    <i class="fas fa-user-md me-1"></i>
                                    {{ $historia->medico->name ?? 'Médico no especificado' }}
                                </span>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <h6><i class="fas fa-comment-medical me-2"></i>Motivo de consulta:</h6>
                                            <p class="ps-4">{{ $historia->motivo_consulta ?? 'No registrado' }}</p>
                                        </div>
                                        <div class="mb-3">
                                            <h6><i class="fas fa-diagnoses me-2"></i>Diagnóstico:</h6>
                                            <p class="ps-4">{{ $historia->diagnostico ?? 'No registrado' }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <h6><i class="fas fa-prescription-bottle-alt me-2"></i>Tratamiento:</h6>
                                            <p class="ps-4">{{ $historia->tratamiento_farmacologico ?? 'No registrado' }}</p>
                                        </div>
                                        <div class="mb-3">
                                            <h6><i class="fas fa-flask me-2"></i>Exámenes:</h6>
                                            <p class="ps-4">{{ $historia->ordenes_examenes ?? 'No registrados' }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <a href="{{ route('historia.pdf', $historia->id) }}"
                                       class="btn btn-sm btn-outline-primary"
                                       target="_blank">
                                        <i class="fas fa-file-pdf me-1"></i> Generar PDF
                                    </a>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>
                            No se encontraron registros de atención para este paciente.
                        </div>
                        @endforelse

                        <!-- Paginación -->
                        @if($historias->hasPages())
                        <div class="mt-3">
                            {{ $historias->links() }}
                        </div>
                        @endif
                    </div>
                @endif

                <!-- Mensajes de error -->
                @if(session('error'))
                <div class="alert alert-danger mt-4">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    {{ session('error') }}
                </div>
                @endif
            </div>
        </div>
    </div>
    @endsection

    @section('styles')
    <style>
        .card-header {
            font-weight: 600;
        }
        h4, h5, h6 {
            color: #2c3e50;
        }
        .badge {
            font-size: 0.9rem;
            padding: 0.5em 0.75em;
        }
        .ps-4 {
            padding-left: 1.5rem;
        }
    </style>
    <script>
document.addEventListener('DOMContentLoaded', function () {
    const tipoBusqueda = document.getElementById('tipo_busqueda');
    const busqueda = document.getElementById('busqueda');

    function ajustarValidacion() {
        if (tipoBusqueda.value === 'cedula') {
            busqueda.minLength = 7;
            busqueda.maxLength = 10;
            busqueda.pattern = "\\d{7,10}";
            busqueda.placeholder = "Ingrese la cédula (7-10 dígitos)";
        } else {
            busqueda.minLength = 6;
            busqueda.maxLength = 6;
            busqueda.pattern = "\\d{6}";
            busqueda.placeholder = "Ingrese el N° de historia (6 dígitos)";
        }
        busqueda.value = '';
    }

    tipoBusqueda.addEventListener('change', ajustarValidacion);
    ajustarValidacion();
});
</script>
    @endsection
</x-app-layout>
