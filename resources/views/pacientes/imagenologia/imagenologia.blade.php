<x-app-layout>
@section('contenido')
<head>
    <meta charset="UTF-8">
    <title>Resultados Radioimagenológicos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/imagenologia.css') }}" rel="stylesheet" />
</head>
<button type="button" class="btn btn-atras" onclick="history.back()">← Atrás</button>
<body>
    <div class="contenedor-imagenologia">
        <h1>Resultados Radioimagenológicos</h1>
        <!-- Formulario para seleccionar tipo y subir imágenes -->
        <form action="{{ route('imagenologia.guardar') }}" method="POST" enctype="multipart/form-data" class="mb-4">
            @csrf
            <label for="tipoResultado" class="label-tipo">Tipo de Resultado</label>
            <select name="tipo_resultado" id="tipoResultado" required onchange="if(this.value) window.location='{{ url('pacientes/imagenologia/tipo') }}/'+this.value;">
                <option value="" disabled {{ !$tipoSeleccionado ? 'selected' : '' }}>Selecciona un tipo</option>
                <option value="radiografia" {{ $tipoSeleccionado == 'radiografia' ? 'selected' : '' }}>Radiografía</option>
                <option value="tomografia" {{ $tipoSeleccionado == 'tomografia' ? 'selected' : '' }}>Tomografía</option>
                <option value="resonancia" {{ $tipoSeleccionado == 'resonancia' ? 'selected' : '' }}>Resonancia Magnética</option>
                <option value="ecografia" {{ $tipoSeleccionado == 'ecografia' ? 'selected' : '' }}>Ecografía</option>
                <option value="otros" {{ $tipoSeleccionado == 'otros' ? 'selected' : '' }}>Otros</option>
            </select>
            <label class="label-imagenes">Adjuntar Imagen o Documento</label>
            <input type="file" name="imagenes[]" accept="image/*,application/pdf" multiple required style="display:block;">
            <button type="submit" class="btn btn-primary">Adjuntar</button>
        </form>

        @if($tipoSeleccionado)
            <h4 class="mt-4">{{ ucfirst($tipoSeleccionado) }}</h4>
            <div class="preview-container row">
                @forelse($imagenes as $img)
                    <div class="col-md-3 mb-3">
                        <div class="card">
                            @if(!$img->es_documento)
                                <a href="{{ asset('storage/' . $img->ruta) }}" target="_blank">
                                    <img src="{{ asset('storage/' . $img->ruta) }}" class="card-img-top preview-img" alt="Imagen" style="max-height:150px;object-fit:contain;cursor:pointer;">
                                </a>
                            @else
                                <a href="{{ asset('storage/' . $img->ruta) }}" target="_blank" class="btn btn-outline-secondary w-100 mt-4 mb-4">Ver Documento PDF</a>
                            @endif
                            <div class="card-body text-center">
                                <form action="{{ route('imagenologia.eliminar', $img->id) }}" method="POST" onsubmit="return confirm('¿Eliminar este archivo?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-muted">No hay archivos para este tipo.</p>
                @endforelse
            </div>
        @endif
    </div>
</body>
@endsection
</x-app-layout>
