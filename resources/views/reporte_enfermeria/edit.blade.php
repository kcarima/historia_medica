@extends('layouts.app')

@section('contenido')
<div class="container mt-4">
    <h3>Editar Reporte de Enfermería</h3>

    {{-- Mostrar errores de validación --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Formulario de edición --}}
    <form action="{{ route('reporte_enfermeria.update', $reporte->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Número de historia clínica (solo lectura) --}}
        <div class="mb-3">
            <label for="historia_id" class="form-label">Número de Historia Clínica</label>
            <input type="text" class="form-control" value="{{ $reporte->historia }}" disabled>
            <input type="hidden" name="historia_id" value="{{ $reporte->historia_id }}">
        </div>



        {{-- Nuevo reporte (campo para agregar información) --}}
        <div class="mb-3">
            <label for="reporte" class="form-label">Nuevo Reporte</label>
            <textarea name="reporte" id="reporte" class="form-control" rows="5" required>{{ old('reporte') }}</textarea>
        </div>

        {{-- Fecha y hora (no editable) --}}
        <div class="mb-3">
            <label for="fecha" class="form-label">Fecha y Hora (no editable)</label>
            <input type="datetime-local" id="fecha" class="form-control"
                value="{{ \Carbon\Carbon::parse($reporte->fecha)->format('Y-m-d\TH:i') }}" disabled>
            <input type="hidden" name="fecha" value="{{ $reporte->fecha }}">
        </div>

        {{-- Botones --}}
        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('reporte_enfermeria.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>

    {{-- Sección para mostrar todos los reportes de la misma historia clínica --}}
    <hr>
    <h4>Reportes para esta historia clínica</h4>

   @if(isset($reportesMismaHistoria) && $reportesMismaHistoria->count() > 0)
    @foreach($reportesMismaHistoria as $r)
        <div class="mb-3 p-3 border rounded" style="background-color: #f8f9fa; color: #000; white-space: pre-wrap;">
            <strong>Fecha:</strong> {{ \Carbon\Carbon::parse($r->fecha)->format('d/m/Y H:i') }}<br>
            <strong>Paciente:</strong> {{ $r->paciente->nombre ?? 'N/A' }}<br>
            <strong>Reporte:</strong><br>
            {{ $r->reporte }}
        </div>
    @endforeach


    @else
        <div class="alert alert-info">No hay reportes para esta historia clínica.</div>
    @endif
</div>
@endsection
