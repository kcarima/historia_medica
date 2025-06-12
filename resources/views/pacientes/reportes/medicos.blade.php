<!DOCTYPE html>
<html>
<head>
    <title>{{ $title }}</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .header { text-align: center; margin-bottom: 5px; }
        .header h1 { color: #2b6cb0; margin: 0; font-size: 18px; }
        .subheader { display: flex; justify-content: space-between; margin-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; font-size: 11px; }
        th { background-color: #2b6cb0; color: white; padding: 6px; text-align: left; }
        td { padding: 5px; border-bottom: 1px solid #e2e8f0; }
        tr:nth-child(even) { background-color: #f8fafc; }
        .footer { margin-top: 10px; font-size: 10px; text-align: right; color: #718096; }
        .text-center { text-align: center; }
    </style>
</head>
<body>
    <div class="header">
        <h1>{{ $title }}</h1>
    </div>

    <div class="subheader">
        <span>Fecha: {{ $date }}</span>
        <span>Total: {{ $total }} médicos</span>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Usuario</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Registro</th>

            </tr>
        </thead>
        <tbody>
            @forelse($medicos as $medico)
            <tr>
                <td>{{ $medico->id }}</td>
                <td>{{ $medico->username }}</td>
                <td>{{ $medico->name ?? 'N/A' }}</td>
                <td>{{ $medico->email }}</td>
                <td>{{ $medico->created_at->format('d/m/Y') }}</td>

            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">No se encontraron médicos registrados</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        {{ config('app.name') }} | Página {PAGE_NUM} de {PAGE
