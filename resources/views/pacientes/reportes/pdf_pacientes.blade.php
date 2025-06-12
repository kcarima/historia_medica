<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Pacientes | ANFE</title>
    <style>
        /* Reset y estilos base */
        @page {
            margin: 1cm 1.5cm;
            size: A4 portrait;
        }
        body {
            font-family: 'Segoe UI', 'Helvetica Neue', Arial, sans-serif;
            font-size: 9pt;
            line-height: 1.5;
            color: #333;
            margin: 0;
            padding: 0;
        }

        /* Encabezado compacto y profesional */
        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 0.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #0056b3;
        }
        .logo-title {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .logo {
            height: 50px;
            max-width: 50px;
        }
        .clinic-info {
            line-height: 1.3;
        }
        .clinic-name {
            font-size: 12pt;
            font-weight: 700;
            color: #0056b3;
            margin: 0;
        }
        .clinic-meta {
            font-size: 8pt;
            color: #555;
        }
        .report-meta {
            text-align: right;
            font-size: 8pt;
            line-height: 1.4;
        }
        .report-title {
            font-size: 11pt;
            font-weight: 600;
            color: #0056b3;
            margin: 0 0 3px 0;
        }

        /* Filtros compactos */
        .filters-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.8rem;
            font-size: 8pt;
        }
        .filters {
            background-color: #f5f9ff;
            padding: 0.4rem 0.8rem;
            border-radius: 3px;
            border-left: 3px solid #0056b3;
        }
        .filters strong {
            color: #0056b3;
        }
        .summary {
            text-align: right;
            font-weight: 600;
            color: #444;
        }

        /* Tabla profesional compacta */
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 0.5rem 0;
            font-size: 8.5pt;
        }
        th {
            background-color: #0056b3;
            color: white;
            padding: 0.4rem 0.6rem;
            font-weight: 600;
            text-align: left;
            font-size: 8pt;
        }
        td {
            padding: 0.4rem 0.6rem;
            border-bottom: 1px solid #e0e6ed;
        }
        tr:nth-child(even) {
            background-color: #f8faff;
        }

        /* Pie de página minimalista */
        .footer {
            margin-top: 0.5rem;
            padding-top: 0.5rem;
            border-top: 1px solid #e0e6ed;
            font-size: 7pt;
            color: #666;
            display: flex;
            justify-content: space-between;
        }
    </style>
</head>
<body>
    <!-- Encabezado compacto -->
    <div class="header-container">
        <div class="logo-title">
            @if(file_exists(public_path('storage/logo_anfe.png')))
                <img src="{{ public_path('assets/img/logo.png') }}" class="logo" alt="Logo ANFE">
            @endif
            <div class="clinic-info">
                <div class="clinic-name">CLÍNICA ANFE</div>
                <div class="clinic-meta">
             </div>
            </div>
        </div>

        <div class="report-meta">
            <div class="report-title">REPORTE DE PACIENTES</div>
            <div>Generado: {{ now()->format('d/m/Y H:i') }}</div>
            <div>Usuario: {{ Auth::user()->name ?? 'Sistema' }}</div>
        </div>
    </div>

    <!-- Filtros y resumen en línea -->
    <div class="filters-container">
        @if(!empty(array_filter($filters)))
        <div class="filters">
            <strong>Filtros:</strong>
            @if($filters['historia']) N° HC: {{ $filters['historia'] }} @endif
            @if($filters['apellido']) | Apellido: {{ $filters['apellido'] }} @endif
            @if($filters['fecha_inicio'] && $filters['fecha_fin']) | Período: {{ Carbon\Carbon::parse($filters['fecha_inicio'])->format('d/m/Y') }} - {{ Carbon\Carbon::parse($filters['fecha_fin'])->format('d/m/Y') }} @endif
        </div>
        @endif
        <div class="summary">
            Total registros: {{ $pacientes->count() }}
        </div>
    </div>

    <!-- Tabla compacta y profesional -->
    <table>
        <thead>
            <tr>
                <th width="12%">Historia</th>
                <th width="25%">Apellidos</th>
                <th width="20%">Nombres</th>
                <th width="12%">Nacimiento</th>
                <th width="8%">Edad</th>
                <th width="15%">Registro</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pacientes as $paciente)
            <tr>
                <td style="font-weight: 600;">{{ $paciente->historia ?? 'N/A' }}</td>
                <td>{{ $paciente->primer_apellido }} {{ $paciente->segundo_apellido ?? '' }}</td>
                <td>{{ $paciente->nombre }}</td>
                <td>
                    @if($paciente->fecha_nacimiento)
                        {{ $paciente->fecha_nacimiento->format('d/m/Y') }}
                    @else
                        N/A
                    @endif
                </td>
                <td>{{ $paciente->edad ?? 'N/A' }}</td>
                <td>{{ $paciente->created_at->format('d/m/Y H:i') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align: center; padding: 1rem; color: #666;">
                    No se encontraron pacientes con los criterios actuales
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pie de página minimalista -->
    <div class="footer">
        <div>CLINICA ANFE - Sistema de Historias </div>

        <div>{{ now()->format('d/m/Y H:i:s') }}</div>
    </div>
</body>
</html>
