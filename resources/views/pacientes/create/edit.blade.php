<x-app-layout>
@section('contenido')
<title>Editar Paciente</title>

<!-- Estilos Bootstrap y CSS personalizado -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="{{ asset('css/formulario-paciente.css') }}" rel="stylesheet">

<div class="container mt-4">

    <!-- Contenedor flex para título y etiqueta historia -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="mb-0">Editar Paciente</h1>
        <span class="badge bg-primary fs-6">
            Historia N°: {{ $paciente->historia }}
        </span>
    </div>

    <!-- Mensaje de éxito -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Mostrar errores de validación -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Formulario para editar paciente -->
    <form action="{{ route('pacientes.update', $paciente->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Campo oculto para enviar historia y validar -->
        <input type="hidden" name="historia" value="{{ old('historia', $paciente->historia) }}">

        <div class="row mb-3">
            <div class="col-md-2">
                <label for="genero" class="form-label">Género</label>
                <select class="form-select form-select-sm" id="genero" name="genero">
                    <option value="">Seleccione...</option>
                    <option value="Masculino" {{ old('genero', $paciente->genero) == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                    <option value="Femenino" {{ old('genero', $paciente->genero) == 'Femenino' ? 'selected' : '' }}>Femenino</option>
                    <option value="Otro" {{ old('genero', $paciente->genero) == 'Otro' ? 'selected' : '' }}>Otro</option>
                </select>
            </div>

            <div class="col-md-2">
                <label for="primer_apellido" class="form-label">Primer Apellido</label>
                <input type="text" class="form-control form-control-sm" id="primer_apellido" name="primer_apellido" value="{{ old('primer_apellido', $paciente->primer_apellido) }}" required>
            </div>

            <div class="col-md-2">
                <label for="segundo_apellido" class="form-label">Segundo Apellido</label>
                <input type="text" class="form-control form-control-sm" id="segundo_apellido" name="segundo_apellido" value="{{ old('segundo_apellido', $paciente->segundo_apellido) }}">
            </div>

            <div class="col-md-2">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control form-control-sm" id="nombre" name="nombre" value="{{ old('nombre', $paciente->nombre) }}" required>
            </div>

            <div class="col-md-2">
                <label for="cedula" class="form-label">Cédula</label>
                <input type="text" class="form-control form-control-sm" id="cedula" name="cedula" value="{{ old('cedula', $paciente->cedula) }}">
            </div>

            <div class="col-md-2">
                <label for="telefono_local" class="form-label">Teléfono Local</label>
                <input type="text" class="form-control form-control-sm" id="telefono_local" name="telefono_local" value="{{ old('telefono_local', $paciente->telefono_local) }}">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-2">
                <label for="grupo_sanguineo" class="form-label">Grupo Sanguíneo</label>
                <select class="form-select form-select-sm" id="grupo_sanguineo" name="grupo_sanguineo">
                    <option value="">Seleccione...</option>
                    <option value="A+" {{ old('grupo_sanguineo', $paciente->grupo_sanguineo) == 'A+' ? 'selected' : '' }}>A+</option>
                    <option value="A-" {{ old('grupo_sanguineo', $paciente->grupo_sanguineo) == 'A-' ? 'selected' : '' }}>A-</option>
                    <option value="B+" {{ old('grupo_sanguineo', $paciente->grupo_sanguineo) == 'B+' ? 'selected' : '' }}>B+</option>
                    <option value="B-" {{ old('grupo_sanguineo', $paciente->grupo_sanguineo) == 'B-' ? 'selected' : '' }}>B-</option>
                    <option value="AB+" {{ old('grupo_sanguineo', $paciente->grupo_sanguineo) == 'AB+' ? 'selected' : '' }}>AB+</option>
                    <option value="AB-" {{ old('grupo_sanguineo', $paciente->grupo_sanguineo) == 'AB-' ? 'selected' : '' }}>AB-</option>
                    <option value="O+" {{ old('grupo_sanguineo', $paciente->grupo_sanguineo) == 'O+' ? 'selected' : '' }}>O+</option>
                    <option value="O-" {{ old('grupo_sanguineo', $paciente->grupo_sanguineo) == 'O-' ? 'selected' : '' }}>O-</option>
                </select>
            </div>

            <div class="col-md-2">
                <label for="estado_civil" class="form-label">Estado Civil</label>
                <select class="form-select form-select-sm" id="estado_civil" name="estado_civil">
                    <option value="">Seleccione...</option>
                    <option value="Soltero" {{ old('estado_civil', $paciente->estado_civil) == 'Soltero' ? 'selected' : '' }}>Soltero</option>
                    <option value="Casado" {{ old('estado_civil', $paciente->estado_civil) == 'Casado' ? 'selected' : '' }}>Casado</option>
                    <option value="Divorciado" {{ old('estado_civil', $paciente->estado_civil) == 'Divorciado' ? 'selected' : '' }}>Divorciado</option>
                    <option value="Viudo" {{ old('estado_civil', $paciente->estado_civil) == 'Viudo' ? 'selected' : '' }}>Viudo</option>
                    <option value="Concubinato" {{ old('estado_civil', $paciente->estado_civil) == 'Concubinato' ? 'selected' : '' }}>Concubinato</option>
                </select>
            </div>

            <div class="col-md-2">
                <label for="fecha_nacimiento" class="form-label">Fecha Nacimiento</label>
                <input type="date" class="form-control form-control-sm" id="fecha_nacimiento" name="fecha_nacimiento" value="{{ old('fecha_nacimiento', $paciente->fecha_nacimiento) }}" required
                    max="{{ date('Y-m-d') }}" min="{{ date('Y-m-d', strtotime('-120 years')) }}">
            </div>

            <div class="col-md-1">
                <label for="edad" class="form-label">Edad</label>
                <input type="text" class="form-control form-control-sm" id="edad" name="edad" value="{{ old('edad', $paciente->edad) }}" readonly>
            </div>

            <div class="col-md-3">
                <label for="correo_electronico" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control form-control-sm" id="correo_electronico" name="correo_electronico" value="{{ old('correo_electronico', $paciente->correo_electronico) }}">
            </div>

            <div class="col-md-3">
                <label for="celular" class="form-label">Celular</label>
                <input type="text" class="form-control form-control-sm" id="celular" name="celular" value="{{ old('celular', $paciente->celular) }}">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-5">
                <label for="direccion" class="form-label">Dirección</label>
                <input type="text" class="form-control form-control-sm" id="direccion" name="direccion" value="{{ old('direccion', $paciente->direccion) }}">
            </div>

            <div class="col-md-3">
                <label for="municipio" class="form-label">Municipio</label>
                <input type="text" class="form-control form-control-sm" id="municipio" name="municipio" value="{{ old('municipio', $paciente->municipio) }}">
            </div>

            <div class="col-md-3">
                <label for="parroquia" class="form-label">Parroquia</label>
                <input type="text" class="form-control form-control-sm" id="parroquia" name="parroquia" value="{{ old('parroquia', $paciente->parroquia) }}">
            </div>
        </div>

        <div class="d-flex justify-content-end gap-2">
            <a href="{{ route('pacientes.index') }}" class="btn btn-danger">Volver</a>
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </div>
    </form>
</div>

<!-- Scripts Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Script para calcular edad automáticamente -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const fechaNacimientoInput = document.getElementById('fecha_nacimiento');
        const edadInput = document.getElementById('edad');

        function calcularEdad(fechaNacimiento) {
            if (!fechaNacimiento) return '';
            const hoy = new Date();
            const nacimiento = new Date(fechaNacimiento);
            let edad = hoy.getFullYear() - nacimiento.getFullYear();
            const mes = hoy.getMonth() - nacimiento.getMonth();
            if (mes < 0 || (mes === 0 && hoy.getDate() < nacimiento.getDate())) {
                edad--;
            }
            return edad >= 0 ? edad : '';
        }

        // Calcular edad al cargar la página si ya hay fecha
        if (fechaNacimientoInput.value) {
            edadInput.value = calcularEdad(fechaNacimientoInput.value);
        }

        // Actualizar edad al cambiar la fecha de nacimiento
        fechaNacimientoInput.addEventListener('change', function() {
            edadInput.value = calcularEdad(this.value);
        });
    });
</script>

@endsection
</x-app-layout>
