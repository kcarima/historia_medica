<x-app-layout>
    @section('contenido')
    <head>
        <title>Editar Examen Físico</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="{{ asset('css/examen_fisico.css') }}" rel="stylesheet">
    </head>

    <div class="contenedor-principal">
        <div class="contenido-principal">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h1 class="mb-0">Editar Examen Físico</h1>
                <span class="badge bg-primary fs-6">
                    Historia N°:
                    @php
                        // Definir $paciente si no está definido, usando $fisico
                        if (!isset($paciente) && isset($fisico->historia)) {
                            $paciente = (object)['historia' => $fisico->historia];
                        }
                    @endphp
                    {{ $paciente->historia ?? '' }}
                </span>
            </div>

            <form action="{{ route('fisico.update', $fisico->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="container">
                    <h3 id="examen_fisico">Examen Físico</h3>
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="presion_arterial">Presión Arterial:</label>
                            <input type="text" id="presion_arterial" name="presion_arterial" value="{{ old('presion_arterial', $fisico->presion_arterial) }}">
                        </div>
                        <div class="form-group">
                            <label for="frecuencia_cardiaca">Frecuencia Cardíaca:</label>
                            <input type="number" id="frecuencia_cardiaca" name="frecuencia_cardiaca" value="{{ old('frecuencia_cardiaca', $fisico->frecuencia_cardiaca) }}">
                        </div>
                        <div class="form-group">
                            <label for="frecuencia_respiratoria">Frecuencia Respiratoria:</label>
                            <input type="number" id="frecuencia_respiratoria" name="frecuencia_respiratoria" value="{{ old('frecuencia_respiratoria', $fisico->frecuencia_respiratoria) }}">
                        </div>
                        <div class="form-group">
                            <label for="temperatura">Temperatura (°C):</label>
                            <input type="number" step="0.1" id="temperatura" name="temperatura" value="{{ old('temperatura', $fisico->temperatura) }}">
                        </div>
                        <div class="form-group">
                            <label for="saturacion_oxigeno">Saturación de Oxígeno (%):</label>
                            <input type="number" id="saturacion_oxigeno" name="saturacion_oxigeno" value="{{ old('saturacion_oxigeno', $fisico->saturacion_oxigeno) }}">
                        </div>
                        <div class="form-group">
                            <label for="peso">Peso (kg):</label>
                            <input type="number" step="0.01" id="peso" name="peso" value="{{ old('peso', $fisico->peso) }}">
                        </div>
                        <div class="form-group">
                            <label for="talla">Talla (cm):</label>
                            <input type="number" step="0.1" id="talla" name="talla" value="{{ old('talla', $fisico->talla) }}">
                        </div>
                        <div class="form-group full-width">
                            <label for="examen_general">Examen General:</label>
                            <textarea id="examen_general" name="examen_general" rows="3">{{ old('examen_general', $fisico->examen_general) }}</textarea>
                        </div>
                        <div class="form-group full-width">
                            <label for="examen_por_sistemas">Exploración Física por Sistemas:</label>
                            <textarea id="examen_por_sistemas" name="examen_por_sistemas" rows="5">{{ old('examen_por_sistemas', $fisico->examen_por_sistemas) }}</textarea>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <a href="{{ route('pacientes.index') }}" class="btn btn-danger">Volver</a>
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                        <a href="{{ route('nota_operatoria.create', $paciente->historia) }}" class="btn btn-secondary">Nota Operatoria</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @endsection
</x-app-layout>
