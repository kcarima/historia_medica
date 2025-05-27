<x-app-layout>
@section('contenido')
    <head>
        <title>Editar Historia</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <div class="container mt-4">
        <h2>Editar Historia</h2>
        <form action="{{ route('historias.update', $historia->id) }}" method="POST" class="form-container">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">N° Historia</label>
                <span class="badge bg-info">
                    {{ $paciente && $paciente->numero_historia ? $paciente->numero_historia : 'Sin asignar' }}
                </span>
                <input type="hidden" name="numero_historia" value="{{ $paciente->numero_historia ?? '' }}">
            </div>
            <div class="mb-3">
                <label for="fecha_atencion" class="form-label">Fecha y Hora de la Atención</label>
                <input type="datetime-local" class="form-control" id="fecha_atencion" name="fecha_atencion" value="{{ $historia->fecha_atencion }}" required>
            </div>
            <div class="mb-3">
                <label for="motivo_consulta" class="form-label">Motivo de la Consulta</label>
                <textarea class="form-control" id="motivo_consulta" name="motivo_consulta" rows="3" required>{{ $historia->motivo_consulta }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a href="{{ route('pacientes.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
</x-app-layout>
