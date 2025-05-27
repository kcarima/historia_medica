
@extends('layouts.app')

@section('content')
    <h1>Listado de Pacientes</h1>

    @if(session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif

    <a href="{{ route('pacientes.create') }}">Crear nuevo paciente</a>

    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>Apellidos y Nombre</th>
                <th>Fecha Nacimiento</th>
                <th>Historia</th>
                <th>Teléfono Local</th>
                <th>Celular</th>
                <th>Dirección</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pacientes as $paciente)
                <tr>
                    <td>{{ $paciente->primer_apellido }} {{ $paciente->segundo_apellido }} {{ $paciente->nombre }}</td>
                    <td>{{ $paciente->fecha_nacimiento }}</td>
                    <td>{{ $paciente->historia }}</td>
                    <td>{{ $paciente->telefono_local }}</td>
                    <td>{{ $paciente->celular }}</td>
                    <td>{{ $paciente->direccion }}</td>
                    <td>
                        <a href="{{ route('pacientes.show', $paciente) }}">Ver</a> |
                        <a href="{{ route('pacientes.edit', $paciente) }}">Editar</a>

                        <form action="{{ route('pacientes.destroy', $paciente) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('¿Estás seguro de eliminar?')" type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
