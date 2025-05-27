<x-app-layout>
@section('contenido')
<div class="container mt-4">
    <h2>Editar Historia</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('historias.update', $historia->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">N° Historia</label>
            <span class="badge bg-info">{{ $historia->historia }}</span>
            <input type="hidden" name="historia" value="{{ $historia->historia }}">
        </div>

        <div class="mb-3">
            <label for="fecha_atencion" class="form-label">Fecha y Hora de la Atención</label>
            <input type="datetime-local" id="fecha_atencion" name="fecha_atencion" class="form-control" value="{{ \Carbon\Carbon::parse($historia->fecha_atencion)->format('Y-m-d\TH:i') }}" required>
        </div>

        <div class="mb-3">
            <label for="motivo_consulta" class="form-label">Motivo de la Consulta</label>
            <textarea id="motivo_consulta" name="motivo_consulta" rows="3" class="form-control" required>{{ $historia->motivo_consulta }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('historias.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
</x-app-layout>
