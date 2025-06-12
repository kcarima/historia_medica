<x-app-layout>
    @section('contenido')

    <head>
        <title>Registro de Historia Médica</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="{{ asset('css/index.css') }}" rel="stylesheet">
        <!-- Bootstrap Icons para el ícono de editar -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    </head>

    <div class="container mt-4">

        <div class="top-bar mb-3">
            <a href="{{ route('pacientes.create') }}" class="btn btn-primary">
                <span class="icon">+</span> Nuevo Paciente
            </a>
            <button class="btn btn-secondary btn-refresh" title="Recargar">⟳</button>
            <button class="btn btn-secondary btn-search" title="Buscar">🔍</button>
            <button class="btn btn-secondary btn-print" title="Imprimir">🖨️</button>
        </div>

        <div class="filters mb-3">
            <div class="filter-group">
                <input type="text" class="form-control" placeholder="Hist. Clínic..." />
                <button class="btn btn-outline-primary filter-search">Buscar</button>
            </div>
        </div>

        <div class="table-container">
            <div class="table-header mb-2">
                Visibilidad <a href="#">todos los pacientes</a> | {{ $pacientes->count() }} de {{ $pacientes->count() }}
            </div>
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Editar</th>
                        <th>Apellidos y Nombre</th>
                        <th>Nacimiento</th>
                        <th>Hist. Clín.</th>
                        <th>Teléfono</th>
                        <th>Móvil</th>
                        <th>Dirección</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pacientes as $paciente)
                    <tr>
                        <td>
                            <a href="{{ route('pacientes.editPorHistoria', $paciente->historia) }}" class="edit-icon" title="Editar paciente">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                        </td>
                        <td>{{ $paciente->primer_apellido }} {{ $paciente->segundo_apellido }} {{ $paciente->nombre }}</td>
                        <td>{{ \Carbon\Carbon::parse($paciente->fecha_nacimiento)->format('d/m/Y') }}</td>
                        <td>{{ $paciente->historia }}</td>
                        <td>{{ $paciente->telefono_local }}</td>
                        <td>{{ $paciente->celular }}</td>
                        <td>{{ $paciente->direccion }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

    @endsection
</x-app-layout>
