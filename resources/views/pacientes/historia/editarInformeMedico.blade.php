@extends('layouts.app')
@section('content')
<div class="container">
    <h2>Editar Informe Médico</h2>
    <form method="POST" action="{{ route('historia.generarInformeMedicoPDFPersonalizado', $paciente->historia) }}" target="_blank">
        @csrf
        <div class="card mb-3">
            <div class="card-header">Datos del Paciente</div>
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col-md-6"><strong>Paciente:</strong> {{ $paciente->primer_apellido }} {{ $paciente->segundo_apellido ?? '' }}, {{ $paciente->nombre }}</div>
                    <div class="col-md-3"><strong>Cédula:</strong> {{ $paciente->cedula }}</div>
                    <div class="col-md-3"><strong>Edad:</strong> {{ \Carbon\Carbon::parse($paciente->fecha_nacimiento)->age }} años</div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3"><strong>Sexo:</strong> {{ $paciente->sexo }}</div>
                    <div class="col-md-3"><strong>Historia Clínica:</strong> {{ $paciente->historia }}</div>
                    <div class="col-md-3"><strong>Fecha:</strong> {{ $fecha }}</div>
                </div>
            </div>
        </div>
        <div class="mb-3">
            <label for="motivo_resumido" class="form-label"><strong>I. Motivo de Consulta</strong></label>
            <textarea class="form-control" id="motivo_resumido" name="motivo_resumido" rows="2" required>{{ old('motivo_resumido', $motivo_resumido) }}</textarea>
        </div>
        <div class="mb-3">
            <label for="hallazgos_clinicos" class="form-label"><strong>II. Hallazgos Clínicos</strong></label>
            <textarea class="form-control" id="hallazgos_clinicos" name="hallazgos_clinicos" rows="3" required>{{ old('hallazgos_clinicos', $hallazgos_clinicos ?? '') }}</textarea>
        </div>
        <div class="mb-3">
            <label for="diagnostico" class="form-label"><strong>III. Diagnóstico</strong></label>
            <textarea class="form-control" id="diagnostico" name="diagnostico" rows="2" required>{{ old('diagnostico', $diagnostico) }}</textarea>
        </div>
        <div class="mb-3">
            <label for="recomendaciones" class="form-label"><strong>IV. Recomendaciones</strong></label>
            <textarea class="form-control" id="recomendaciones" name="recomendaciones" rows="3" required>{{ old('recomendaciones', $recomendaciones ?? '') }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Generar PDF</button>
    </form>
</div>
@endsection
