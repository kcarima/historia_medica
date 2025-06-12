@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Notas operatorias</h3>

    {{-- Enlace para crear una nueva nota operatoria (ajusta el número de historia según tu flujo) --}}
    <a href="{{ route('nota_operatoria.create', ['historia' => request('historia') ?? ($notas->first()->historia ?? '')]) }}" class="btn btn-success mb-3">
        Nueva Nota Operatoria
    </a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Historia</th>
                <th>Nota</th>
                <th>Fecha</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($notas as $nota)
                <tr>
                    <td>{{ $nota->id }}</td>
                    <td>{{ $nota->historia }}</td>
                    <td>{{ Str::limit($nota->nota, 50) }}</td>
                    <td>{{ $nota->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <a href="{{ route('nota_operatoria.edit', $nota->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('nota_operatoria.destroy', $nota->id) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No hay notas operatorias registradas.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $notas->links() }}
</div>
@endsection
