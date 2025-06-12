@extends('layouts.app')

@section('contenido')
<div class="container mt-4">
    <h3>Reportes de Enfermería del Paciente: {{ $paciente->nombre }}</h3>
    <p><strong>Cédula:</strong> {{ $paciente->cedula }}</p>

    @if($reportes->isEmpty())
        <div class="alert alert-info">No hay reportes de enfermería para este paciente.</div>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Historia Clínica</th>
                    <th>Reporte</th>
                    <th>Enfermera</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reportes as $reporte)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($reporte->fecha)->format('d/m/Y') }}</td>
                        <td>{{ $reporte->historia }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($reporte->reporte, 100) }}</td>
                        <td>{{ $reporte->enfermera->name ?? 'N/A' }}</td>
                        <td>
                            <a href="{{ route('reporte_enfermeria.edit', $reporte->id) }}" class="btn btn-sm btn-primary">
                                Editar
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <a href="{{ route('reporte_enfermeria.index') }}" class="btn btn-secondary mt-3">Volver a Reportes</a>
</div>
@endsection
