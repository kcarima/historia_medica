<x-app-layout>
@section('contenido')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-search me-2"></i>Buscar Paciente para Imagenología</h5>
                </div>
                <div class="card-body">
                    <form method="GET" action="{{ route('pacientes.imagenologia') }}">
                        <div class="mb-3">
                            <label for="cedula" class="form-label">Cédula:</label>
                            <input type="text" class="form-control" id="cedula" name="cedula"
                                placeholder="Ej: 123456789" autocomplete="off"
                                maxlength="10" pattern="\d{7,10}" inputmode="numeric"
                                oninput="this.value=this.value.replace(/[^0-9]/g,'').slice(0,10)">
                        </div>
                        <div class="mb-3">
                            <label for="historia" class="form-label">N° Historia:</label>
                            <input type="text" class="form-control" id="historia" name="historia"
                                placeholder="Ej: 100001" autocomplete="off"
                                maxlength="10" pattern="\d{1,10}" inputmode="numeric"
                                oninput="this.value=this.value.replace(/[^0-9]/g,'').slice(0,10)">
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-sm" style="width:auto; min-width:90px;">
                                <i class="fas fa-search me-2"></i>Buscar Paciente
                            </button>
                        </div>
                    </form>
                    @if(request()->has('cedula') || request()->has('historia'))
                        @if(!isset($paciente) || !$paciente)
                            <div class="alert alert-danger mt-3">
                                Paciente no encontrado. Verifique la cédula o el número de historia.
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@if(isset($paciente) && $paciente)
    <div class="container mt-4">
        <button type="button" class="btn btn-secondary mb-3" onclick="history.back()">← Atrás</button>
        <div class="card">
            <div class="card-header bg-info text-white">
                <strong>Paciente:</strong> {{ $paciente->primer_apellido }} {{ $paciente->segundo_apellido }} {{ $paciente->nombre }}
                <br>
                <strong>Cédula:</strong> {{ $paciente->cedula }} &nbsp; <strong>Historia:</strong> {{ $paciente->historia }}
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('imagenologia.guardar') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="historia" value="{{ $paciente->historia }}">
                    <div class="mb-3">
                        <label for="imagenes" class="form-label">Adjuntar Imágenes</label>
                        <input type="file" class="form-control" id="imagenes" name="imagenes[]" accept="image/*" multiple required>
                    </div>
                    <div class="mb-3 text-end">
                        <button type="submit" class="btn btn-success">Guardar Imágenes</button>
                    </div>
                </form>
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @php
                    $imagenesGuardadas = \DB::table('imagenologias')
                        ->where('historia', $paciente->historia)
                        ->orderByDesc('created_at')
                        ->get();
                @endphp
                @if($imagenesGuardadas && count($imagenesGuardadas))
                    <h5 class="mt-4">Imágenes guardadas para este paciente:</h5>
                    <div class="row">
                        @foreach($imagenesGuardadas as $img)
                            <div class="col-md-3 mb-3">
                                <div class="card">
                                    <a href="{{ asset('storage/' . $img->archivo) }}" target="_blank">
                                        <img src="{{ asset('storage/' . $img->archivo) }}" class="card-img-top" alt="Imagen" style="max-height:150px;object-fit:contain;">
                                    </a>
                                    <div class="card-body p-2 text-center">
                                        <small class="text-muted">Subida: {{ $img->created_at ? \Carbon\Carbon::parse($img->created_at)->format('d/m/Y H:i') : '' }}</small>
                                    </div>
                                    <form method="POST" action="{{ route('imagenologia.eliminar', $img->id) }}" onsubmit="return confirm('¿Eliminar esta imagen?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm w-100 mt-2">Eliminar</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
@endif
@endsection
</x-app-layout>
