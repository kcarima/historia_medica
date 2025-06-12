<x-app-layout>
    @section('contenido')
<head>
    <title>Buscar Paciente - Imagenología</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<div class="container-fluid">
    <!-- Card de Búsqueda -->
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="fas fa-search me-2"></i>Buscar Paciente para Imagenología</h5>
        </div>
        <div class="card-body">
            <form id="formBusquedaImagenologia" class="row g-3" method="GET" action="{{ route('pacientes.imagenologia_buscar') }}">
                <div class="col-md-6">
                    <label for="cedula" class="form-label">Cédula:</label>
                    <input type="text" class="form-control" id="cedula" name="cedula"
                        placeholder="Ej: 1234567890" autocomplete="off"
                        maxlength="10" pattern="\d{10}" inputmode="numeric"
                        oninput="this.value=this.value.replace(/[^0-9]/g,'').slice(0,10)">
                </div>
                <div class="col-md-6">
                    <label for="historia_id" class="form-label">N° Historia (clave primaria):</label>
                    <input type="text" class="form-control" id="historia_id" name="historia_id"
                        placeholder="Ej: 100001" autocomplete="off"
                        maxlength="6" pattern="\d{6}" inputmode="numeric"
                        oninput="this.value=this.value.replace(/[^0-9]/g,'').slice(0,6)">
                </div>
                <div class="col-12 text-center">
                    <button type="submit" class="btn btn-primary btn-sm" id="btnBuscarImg" style="width:auto; min-width:90px;">
                        <i class="fas fa-search me-2"></i>Buscar Paciente
                    </button>
                </div>
            </form>
        </div>
    </div>

    @if(isset($paciente))
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0"><i class="fas fa-user me-2"></i>Datos del Paciente</h5>
        </div>
        <div class="card-body">
            <div class="row mb-2">
                <div class="col-6"><strong>Cédula:</strong> {{ $paciente->cedula }}</div>
                <div class="col-6"><strong>Historia Clínica:</strong> {{ $paciente->historia }}</div>
            </div>
            <div class="row mb-2">
                <div class="col-6"><strong>Nombre:</strong> {{ $paciente->primer_apellido }} {{ $paciente->segundo_apellido }} {{ $paciente->nombre }}</div>
                <div class="col-6"><strong>Edad:</strong> {{ \Carbon\Carbon::parse($paciente->fecha_nacimiento)->age }} años</div>
            </div>
            <div class="row mb-2">
                <div class="col-12"><strong>Historia (para guardar imágenes):</strong> <span class="badge bg-primary">{{ $paciente->historia }}</span></div>
            </div>
            <div class="text-end">
                <a href="{{ route('pacientes.imagenologia', ['historia_id' => $paciente->historia]) }}" class="btn btn-success btn-sm">
                    Ir a Imagenología
                </a>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
</x-app-layout>
