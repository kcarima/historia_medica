<x-app-layout>
@section('contenido')
<head>
    <title>Listado de Historias Médicas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/estilos_historia_medica.css') }}" rel="stylesheet">
</head>

<div class="contenedor-principal">
    <div class="contenido-principal">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="mb-0">Historias Médicas</h1>
            <a href="{{ route('historia.create', $paciente->historia) }}" class="btn btn-success">Nueva Historia</a>
        </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Fecha de Atención</th>
                    <th>Motivo de Consulta</th>
                    <th>Diagnóstico</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($historias as $historia)
                <tr>
                    <td>{{ $historia->id }}</td>
                    <td>{{ \Carbon\Carbon::parse($historia->fecha_atencion)->format('d/m/Y H:i') }}</td>
                    <td>{{ Str::limit($historia->motivo_consulta, 30) }}</td>
                    <td>{{ $historia->diagnostico }}</td>
                    <td>
                        <a href="{{ route('historia.show', [$paciente->historia, $historia->id]) }}" class="btn btn-primary btn-sm">Ver</a>
                        {{-- Aquí puedes agregar más acciones como editar o eliminar --}}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div>
            {{ $historias->links() }}
        </div>
    </div>
</div>
@endsection
</x-app-layout>
