<x-app-layout>
@section('contenido')
    <head>
        <title>Ver Historia</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <div class="container mt-4">
        <h2>Historia Médica</h2>
        <div class="mb-3">
            <label class="form-label">N° Historia</label>
            <span class="badge bg-info">{{ $historia->numero_historia }}</span>
        </div>
        <div class="mb-3">
            <label class="form-label">Fecha y Hora de la Atención</label>
            <input type="text" class="form-control" value="{{ $historia->fecha_atencion }}" readonly>
        </div>
        <div class="mb-3">
            <label class="form-label">Motivo de la Consulta</label>
            <textarea class="form-control" rows="3" readonly>{{ $historia->motivo_consulta }}</textarea>
        </div>
        <a href="{{ route('historias.index') }}" class="btn btn-secondary">Volver</a>
    </div>
@endsection
</x-app-layout>
