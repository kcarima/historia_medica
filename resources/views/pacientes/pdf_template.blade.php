<!DOCTYPE html>
<html>
<head>
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: #f6f8fb;
            color: #222;
            margin: 0;
            padding: 0;
        }
        .header {
            background: linear-gradient(90deg, #2e7d32 0%, #1976d2 100%);
            color: #1976d2;
            padding: 30px 0 15px 0;
            text-align: center;
            border-bottom: 4px solid #1976d2;
        }
        .header h1 {
            margin: 0 0 10px 0;
            font-size: 2.2em;
            letter-spacing: 2px;
        }
        .header .clinic-name {
            font-size: 1.3em;
            font-weight: bold;
            letter-spacing: 2px;
            margin-bottom: 5px;
        }
        .header p {
            margin: 0;
            font-size: 1em;
            opacity: 0.9;
        }
        table {
            width: 95%;
            margin: 30px auto 0 auto;
            border-collapse: separate;
            border-spacing: 0;
            box-shadow: 0 2px 8px rgba(25, 118, 210, 0.08);
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
        }
        th, td {
            padding: 12px 10px;
            text-align: left;
        }
        th {
            background: #1976d2;
            color: #fff;
            font-weight: bold;
            border-bottom: 2px solid #2e7d32;
            font-size: 1.07em;
        }
        tr:nth-child(even) td {
            background: #f2f8fc;
        }
        tr:hover td {
            background: #e3f2fd;
        }
        td {
            border-bottom: 1px solid #e0e0e0;
            font-size: 0.98em;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="clinic-name">CLÍNICA ANFE</div>
        <h1>{{ $title }}</h1>
        <p>Fecha de Exportación: {{ $date }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Apellidos y Nombre</th>
                <th>Nacimiento</th>
                <th>Hist. Clín.</th>
                <th>Teléfono</th>
                <th>Móvil</th>
                <th>Dirección</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pacientes as $paciente)
            <tr>
                <td>{{ $paciente->primer_apellido }} {{ $paciente->segundo_apellido }} {{ $paciente->nombre }}</td>
                <td>{{ \Carbon\Carbon::parse($paciente->fecha_nacimiento)->format('d/m/Y') }}</td>
                <td>{{ $paciente->historia }}</td>
                <td>{{ $paciente->telefono_local }}</td>
                <td>{{ $paciente->celular }}</td>
                <td>{{ $paciente->direccion }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
