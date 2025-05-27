<x-app-layout>
@section('contenido')
<title>Registro de Paciente</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="{{ asset('css/formulario-paciente.css') }}" rel="stylesheet">

<body>
  <div class="container mt-4">
    <div class="contenedor-principal">
      <div class="linea-decorativa"></div>
      <div class="titulo-formulario mb-4 fs-4 fw-bold">Registro de Paciente</div>
      <form>
        <!-- Contenedor con scroll horizontal -->
        <div class="form-section">
          <!-- Primera fila de campos -->
          <div class="mb-3">
            <label for="genero" class="form-label">Género</label>
            <select class="form-select form-select-sm" id="genero" name="genero">
              <option value="Masculino" selected>Masculino</option>
              <option value="Femenino">Femenino</option>
            </select>
          </div>
          <div>
            <label class="form-label">Primer Apellido</label>
            <input type="text" class="form-control form-control-sm" value="" />
          </div>
          <div>
            <label class="form-label">Segundo Apellido</label>
            <input type="text" class="form-control form-control-sm" value="" />
          </div>
          <div>
            <label class="form-label">Nombre</label>
            <input type="text" class="form-control form-control-sm" value="" />
          </div>
          <div>
            <label class="form-label">Cédula</label>
            <input type="text" class="form-control form-control-sm" value="" />
          </div>
          <div>
            <label class="form-label">Teléfono Local</label>
            <input type="text" class="form-control form-control-sm" value="" />
          </div>
        </div>

        <div class="form-section">
          <!-- Segunda fila de campos -->
          <div>
            <label class="form-label">Grupo Sanguíneo</label>
            <input type="text" class="form-control form-control-sm" value="" />
          </div>
          <div>
            <label class="form-label">Estado Civil</label>
            <input type="text" class="form-control form-control-sm" value="" />
          </div>
          <div>
            <label class="form-label">Fecha Nacimiento</label>
            <input type="date" class="form-control form-control-sm" value="" />
          </div>
          <div>
            <label class="form-label">Correo Electrónico</label>
            <input type="email" class="form-control form-control-sm" value="" />
          </div>
          <div>
            <label class="form-label">Celular</label>
            <input type="text" class="form-control form-control-sm" value="" />
          </div>
          <div style="min-width: 200px;"></div>
        </div>

        <div class="form-section">
          <!-- Tercera fila de campos -->
          <div>
            <label class="form-label">Edad</label>
            <input type="text" class="form-control form-control-sm" value="" />
          </div>
          <div style="min-width: 400px;">
            <label class="form-label">Dirección</label>
            <input type="text" class="form-control form-control-sm" value="" />
          </div>
          <div>
            <label class="form-label">Municipio</label>
            <input type="text" class="form-control form-control-sm" value="" />
          </div>
          <div>
            <label class="form-label">Parroquia</label>
            <input type="text" class="form-control form-control-sm" value="" />
          </div>
        </div>

        <div class="col-12 text-end mt-3">
          <button type="submit" class="btn btn-danger">Volver</button>
          <button type="submit" class="btn btn-primary">Guardar</button>
          <button type="button" class="btn btn-primary me-2" onclick="window.location.href='{{ route('paciente.historias.create') }}'">
            Crear Historia
          </button>
        </div>
      </form>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
@endsection
</x-app-layout>
