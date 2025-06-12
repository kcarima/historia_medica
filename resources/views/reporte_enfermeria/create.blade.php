@extends('layouts.app')

@section('contenido')
<div class="container mt-4">
    <h3>Nuevo Reporte de Enfermería</h3>

    {{-- Formulario de búsqueda --}}
    <form method="GET" action="{{ route('reporte_enfermeria.create') }}" class="mb-3">
        <div class="input-group">
            <input type="text" name="buscar" class="form-control" placeholder="Buscar por cédula o número de ficha..." value="{{ old('buscar', $busqueda ?? '') }}">
            <button class="btn btn-primary" type="submit">Buscar</button>
        </div>
    </form>

    {{-- Mostrar errores --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(isset($error))
        <div class="alert alert-danger">{{ $error }}</div>
    @endif

    {{-- Mostrar pacientes encontrados --}}
    @if($pacientes->count() > 0)
        @foreach($pacientes as $paciente)
            <div class="alert alert-info">
                <strong>Paciente encontrado:</strong><br>
                <b>Nombre:</b> {{ $paciente->nombre_completo ?? $paciente->nombre }}<br>
                <b>Cédula:</b> {{ $paciente->cedula }}<br>
                <b>N° Ficha:</b> {{ $paciente->historias->first()->historia ?? $paciente->historia }}<br>
            </div>

            @if($paciente->historias->count() > 0)
                <form action="{{ route('reporte_enfermeria.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="paciente_id" value="{{ $paciente->id }}">
                    <input type="hidden" name="enfermera_id" value="{{ Auth::id() }}">
                    <input type="hidden" name="historia_id" value="{{ $paciente->historias->first()->id }}">

                    <div class="mb-3">
                        <label for="fecha" class="form-label">Fecha</label>
                        <input type="date" name="fecha" id="fecha" class="form-control" required value="{{ old('fecha', date('Y-m-d')) }}">
                    </div>

                    <div class="mb-3">
                        <label for="reporte" class="form-label">Reporte</label>
                        <textarea name="reporte" id="reporte" class="form-control" rows="5" required>{{ old('reporte') }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-success">Guardar</button>
                    <a href="{{ route('reporte_enfermeria.index') }}" class="btn btn-secondary">Cancelar</a>
                </form>
            @else
                <div class="alert alert-warning">
                    Este paciente no tiene historia clínica asociada. No se puede crear el reporte.
                </div>
            @endif
        @endforeach
    @endif
</div>
@endsection
