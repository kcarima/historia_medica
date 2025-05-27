<x-app-layout>
@section('contenido')
<title>Detalle del Paciente</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="{{ asset('css/formulario-paciente.css') }}" rel="stylesheet">

<div class="container mt-4">
    <h1>Detalle del Paciente</h1>
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title mb-3">
                {{ $paciente->primer_apellido }} {{ $paciente->segundo_apellido }} {{ $paciente->nombre }}
            </h5>
            <p class="mb-1"><strong>Historia N°:</strong> {{ $paciente->historia }}</p>
            <p class="mb-1"><strong>Género:</strong> {{ $paciente->genero }}</p>
            <p class="mb-1"><strong>Fecha de Nacimiento:</strong> {{ $paciente->fecha_nacimiento }}</p>
            <p class="mb-1"><strong>Edad:</strong> {{ $paciente->edad }}</p>
            <p class="mb-1"><strong>Cédula:</strong> {{ $paciente->cedula }}</p>
            <p class="mb-1"><strong>Teléfono Local:</strong> {{ $paciente->telefono_local }}</p>
            <p class="mb-1"><strong>Celular:</strong> {{ $paciente->celular }}</p>
            <p class="mb-1"><strong>Correo Electrónico:</strong> {{ $paciente->correo_electronico }}</p>
            <p class="mb-1"><strong>Dirección:</strong> {{ $paciente->direccion }}</p>
            <p class="mb-1"><strong>Municipio:</strong> {{ $paciente->municipio }}</p>
            <p class="mb-1"><strong>Parroquia:</strong> {{ $paciente->parroquia }}</p>
            <p class="mb-1"><strong>Grupo Sanguíneo:</strong> {{ $paciente->grupo_sanguineo }}</p>
            <p class="mb-1"><strong>Estado Civil:</strong> {{ $paciente->estado_civil }}</p>
        </div>
    </div>

    <div class="d-flex justify-content-end gap-2">
        <a href="{{ route('pacientes.index') }}" class="btn btn-secondary">Volver al listado</a>
        <a href="{{ route('pacientes.edit', $paciente) }}" class="btn btn-primary">Editar Paciente</a>
        <a href="{{ route('historias.edit', $paciente->historia) }}" class="btn btn-success">
            Editar Historia
        </a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
</x-app-layout>
