@extends('layouts.app')

@section('contenido')
<div class="container mt-4">
    <h3>Últimos Reportes por Historia</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" name="buscar" class="form-control" placeholder="Buscar..." value="{{ request('buscar') }}">
            <button class="btn btn-primary" type="submit">Buscar</button>
            <a href="{{ route('reporte_enfermeria.create') }}" class="btn btn-success ms-2">Nuevo Reporte</a>
        </div>
    </form>

    @php $highlightId = $highlight ?? null; @endphp

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Paciente</th>
                <th>Historia</th>
                <th>Enfermera</th>
                <th>Reporte</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($reportes as $reporte)
                <tr @if($reporte->id == $highlightId) style="background-color: #d1e7dd; font-weight: bold;" @endif>
                    <td>{{ $reporte->fecha->format('Y-m-d') }}</td>
                    <td>{{ $reporte->paciente->nombre ?? '-' }}</td>
                    <td>{{ $reporte->historia ?? '-' }}</td>
                    <td>{{ $reporte->enfermera->name ?? '-' }}</td>
                    <td>{{ $reporte->reporte }}</td>
                    <td>
                        <a href="{{ route('reporte_enfermeria.edit', $reporte->id) }}" class="btn btn-sm btn-primary">Editar</a>
                        <form method="POST" action="{{ route('pacientes.dar_alta', $reporte->paciente->id) }}" style="display:inline;">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de dar de alta a este paciente?')">Dar de Alta</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center">No hay reportes.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
