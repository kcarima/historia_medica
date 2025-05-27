<x-app-layout>
@section('contenido')
    <head>
        <title>Listado de Historias</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <div class="container mt-4">
        <h2>Historias</h2>
        <a href="{{ route('historias.create') }}" class="btn btn-primary mb-3">Nueva Historia</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>N° Historia</th>
                    <th>Fecha Atención</th>
                    <th>Motivo Consulta</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($historias as $historia)
                    <tr>
                        <td>
                            <span class="badge bg-info">{{ $historia->numero_historia }}</span>
                        </td>
                        <td>{{ $historia->fecha_atencion }}</td>
                        <td>{{ $historia->motivo_consulta }}</td>
                        <td>
                            <a href="{{ route('historias.show', $historia->id) }}" class="btn btn-sm btn-success">Ver</a>
                            <a href="{{ route('historias.edit', $historia->id) }}" class="btn btn-sm btn-warning">Editar</a>
                            <form action="{{ route('historias.destroy', $historia->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar historia?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
</x-app-layout>
