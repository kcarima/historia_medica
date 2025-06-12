<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reporte de Pacientes Atendidos</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px;}
        th, td { border: 1px solid #333; padding: 4px; text-align: left;}
        th { background: #eee; }
    </style>
</head>
<body>
    <h3>Reporte de Pacientes Atendidos</h3>
    <p>
        Tipo de reporte: <strong>{{ ucfirst($tipo) }}</strong><br>
        Fecha de generación: {{ \Carbon\Carbon::now()->format('d/m/Y H:i') }}
    </p>
    <table>
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
</body>
</html>
