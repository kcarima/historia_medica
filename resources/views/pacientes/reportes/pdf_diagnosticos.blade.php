<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Diagnósticos - Clínica ANFE</title>
    <style>
        /* Estilos profesionales */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 10pt;
            line-height: 1.5;
            color: #333;
            margin: 0;
            padding: 1cm;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #0056b3;
        }

        .logo {
            height: 50px;
        }

        .clinic-info {
            text-align: center;
        }

        .clinic-name {
            font-size: 14pt;
            font-weight: bold;
            color: #0056b3;
            margin: 0;
        }

        .report-title {
            font-size: 16pt;
            color: #0056b3;
            text-align: center;
            margin: 1rem 0;
        }

        .report-meta {
            text-align: right;
            font-size: 9pt;
            color: #666;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }

        th {
            background-color: #0056b3;
            color: white;
            padding: 0.5rem;
            text-align: left;
            font-weight: bold;
        }

        td {
            padding: 0.5rem;
            border-bottom: 1px solid #ddd;
        }

        tr:nth-child(even) {
            background-color: #f5f9ff;
        }

        .total-row {
            font-weight: bold;
            background-color: #e6f0ff;
        }

        .footer {
            margin-top: 1rem;
            padding-top: 0.5rem;
            border-top: 1px solid #ddd;
            font-size: 8pt;
            text-align: center;
            color: #666;
        }
    </style>
</head>
<body>
    <!-- Encabezado profesional -->
    <div class="header">
        <div>
            @if(file_exists(public_path('storage/logo_anfe.png')))
                <img src="{{ public_path('storage/logo_anfe.png') }}" class="logo" alt="Logo ANFE">
            @endif
        </div>
        <div class="clinic-info">
            <h1 class="clinic-name">CLÍNICA ANFE</h1>
            <div>Especialistas en Salud Integral</div>
        </div>
        <div class="report-meta">
            <div>Generado: {{ $fecha }}</div>
            <div>Usuario: {{ Auth::user()->name ?? 'Sistema' }}</div>
        </div>
    </div>

    <!-- Título del reporte -->
    <h2 class="report-title">REPORTE DE DIAGNÓSTICOS</h2>

    <!-- Tabla de diagnósticos -->
    <table>
        <thead>
            <tr>
                <th width="80%">Diagnóstico</th>
                <th width="20%">Casos</th>
            </tr>
        </thead>
        <tbody>
            @forelse($diagnosticos as $diagnostico)
            <tr>
                <td>{{ $diagnostico->diagnostico ?: 'Sin diagnóstico registrado' }}</td>
                <td>{{ $diagnostico->total }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="2">No se encontraron diagnósticos registrados</td>
            </tr>
            @endforelse

            <!-- Totales -->
            <tr class="total-row">
                <td>Total de historias con diagnóstico</td>
                <td>{{ $totalConDiagnostico }}</td>
            </tr>
            <tr class="total-row">
                <td>Total de historias clínicas</td>
                <td>{{ $totalHistorias }}</td>
            </tr>
            <tr class="total-row">
                <td>Porcentaje con diagnóstico</td>
                <td>{{ round(($totalConDiagnostico/$totalHistorias)*100, 2) }}%</td>
            </tr>
        </tbody>
    </table>

    <!-- Pie de página -->
    <div class="footer">
        Sistema de Historias Clínicas ANFE - {{ date('Y') }} | Confidencial
    </div>
</body>
</html>
