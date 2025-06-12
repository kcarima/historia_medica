@extends('layouts.app')
@section('contenido')
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="fas fa-file-alt me-2"></i>Reporte de Pacientes Atendidos</h5>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('reportes.pacientes_atendidos') }}">
                <div class="mb-3">
                    <label for="tipo_reporte" class="form-label">Tipo de Reporte:</label>
                    <select id="tipo_reporte" name="tipo_reporte" class="form-select" style="max-width:200px;display:inline-block;" required onchange="mostrarCampos()">
                        <option value="">Seleccione...</option>
                        <option value="diario" {{ request('tipo_reporte')=='diario' ? 'selected' : '' }}>Diario</option>
                        <option value="mensual" {{ request('tipo_reporte')=='mensual' ? 'selected' : '' }}>Mensual</option>
                        <option value="trimestral" {{ request('tipo_reporte')=='trimestral' ? 'selected' : '' }}>Trimestral</option>
                    </select>
                </div>
                <div id="campo_diario" class="mb-3" style="display:none;">
                    <label for="fecha" class="form-label">Fecha:</label>
                    <input type="date" id="fecha" name="fecha" class="form-control" style="max-width:170px;display:inline-block;" value="{{ request('fecha') }}">
                </div>
                <div id="campo_mensual" class="mb-3" style="display:none;">
                    <label for="mes" class="form-label">Mes:</label>
                    <input type="month" id="mes" name="mes" class="form-control" style="max-width:170px;display:inline-block;" value="{{ request('mes') }}">
                </div>
                <div id="campo_trimestral" class="mb-3" style="display:none;">
                    <label for="trimestre" class="form-label">Trimestre:</label>
                    <select id="trimestre" name="trimestre" class="form-select" style="max-width:170px;display:inline-block;">
                        <option value="">Seleccione...</option>
                        <option value="1" {{ request('trimestre')=='1' ? 'selected' : '' }}>Enero - Marzo</option>
                        <option value="2" {{ request('trimestre')=='2' ? 'selected' : '' }}>Abril - Junio</option>
                        <option value="3" {{ request('trimestre')=='3' ? 'selected' : '' }}>Julio - Septiembre</option>
                        <option value="4" {{ request('trimestre')=='4' ? 'selected' : '' }}>Octubre - Diciembre</option>
                    </select>
                    <label for="anio_trimestre" class="form-label mt-2">Año:</label>
                    <input type="number" id="anio_trimestre" name="anio_trimestre" class="form-control" style="max-width:120px;display:inline-block;" min="1900" max="{{ date('Y') }}" value="{{ request('anio_trimestre', date('Y')) }}">
                </div>
                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Ver Reporte</button>
                    @if(isset($tipo) && $tipo)
                    <a href="{{ route('reportes.pacientes_atendidos.pdf', request()->all()) }}" class="btn btn-danger ms-2" target="_blank">
                        <i class="fas fa-file-pdf"></i> Descargar PDF
                    </a>
                    @endif
                </div>
            </form>

            @if(isset($tipo) && $tipo && $pacientes->count())
                <hr>
                <h5>Pacientes Atendidos ({{ $pacientes->count() }})</h5>
                <div class="table-responsive">
                    <table class="table table-bordered table-sm">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Historia</th>
                                <th>Cédula</th>
                                <th>Nombre</th>
                                <th>Fecha de Atención</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pacientes as $i => $p)
                                <tr>
                                    <td>{{ $i+1 }}</td>
                                    <td>{{ $p->historia }}</td>
                                    <td>{{ $p->cedula }}</td>
                                    <td>{{ $p->primer_apellido }} {{ $p->segundo_apellido }} {{ $p->nombre }}</td>
                                    <td>{{ $p->created_at ? \Carbon\Carbon::parse($p->created_at)->format('d/m/Y H:i') : '' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @elseif(isset($tipo) && $tipo)
                <div class="alert alert-warning mt-3">No hay pacientes atendidos en el rango seleccionado.</div>
            @endif
        </div>
    </div>
</div>
<script>
function mostrarCampos() {
    let tipo = document.getElementById('tipo_reporte').value;
    document.getElementById('campo_diario').style.display = (tipo === 'diario') ? 'block' : 'none';
    document.getElementById('campo_mensual').style.display = (tipo === 'mensual') ? 'block' : 'none';
    document.getElementById('campo_trimestral').style.display = (tipo === 'trimestral') ? 'block' : 'none';
}
document.addEventListener('DOMContentLoaded', mostrarCampos);
</script>
@endsection
