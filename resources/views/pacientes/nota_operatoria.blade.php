<x-app-layout>

<!DOCTYPE html>
<html>
<head>
    <title>Listado de Pacientes</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 4px; font-size: 12px; }
        th { background: #eee; }
    </style>
</head>
<body>
    <h2>Listado de Pacientes</h2>
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

@endsection
</x-app-layout>
