<x-app-layout>
    @section('contenido')

    <head>
        <title>Registro de Historia Médica</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="{{ asset('css/index.css') }}" rel="stylesheet">
        <!-- Bootstrap Icons para el ícono de editar -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    </head>
@if(auth()->check() && auth()->user()->role === 'medico')
    <a href="{{ route('pacientes.pdf') }}" class="btn btn-danger ms-2">
        <i class="bi bi-file-earmark-pdf"></i> Exportar PDF
    </a>
@endif
    <div class="container mt-4">

        <div class="top-bar mb-3">
            <a href="{{ route('pacientes.create') }}" class="btn btn-primary">
                <span class="icon">+</span> Nuevo Paciente
            </a>

        </div>

      <form method="GET" action="{{ route('pacientes.index') }}">
    <input type="text"
           name="buscar"
           placeholder="Buscar por cédula, nombre o historia"
           value="{{ request('buscar') }}"
           pattern="\d{6,10}"
           title="Ingrese entre 6 y 10 dígitos numéricos"
           maxlength="10"
           minlength="6"
           inputmode="numeric"
           required>
    <button type="submit">Buscar</button>
</form>

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
                            <a href="{{ route('pacientes.edit', $paciente->historia) }}" class="edit-icon" title="Editar paciente">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <a href="{{ route('historia.create', $paciente->historia) }}" class="edit-icon" title="Editar información">
                                <i class="bi bi-card-text"></i>
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
<script>
document.querySelector('form').addEventListener('submit', function(e) {
    const input = this.buscar;
    const regex = /^\d{6,10}$/;
    if (!regex.test(input.value)) {
        alert('Por favor ingrese solo números entre 6 y 10 dígitos.');
        input.focus();
        e.preventDefault();
    }
});
</script>
    @endsection
</x-app-layout>
