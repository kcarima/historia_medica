
<x-app-layout>
@section('contenido')
<title>Registro de Paciente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/formulario-paciente.css') }}" rel="stylesheet">
</head>

   <body>
  <div class="container mt-4">
    <div class="contenedor-principal">
      <div class="linea-decorativa"></div>
      <div class="titulo-formulario mb-4 fs-4 fw-bold">Registro de Paciente</div>
      <form>
        <!-- Contenedor con scroll horizontal -->
        <div class="form-section">
          <!-- Primera fila de campos: Género, Primer Apellido, Segundo Apellido, Nombre, Cédula, Teléfono Local -->
          <div>
            <label class="form-label">Género</label>
            <div>
              <input type="radio" class="btn-check" name="genero" id="hombre" autocomplete="off" checked />
              <label class="btn btn-outline-primary btn-sm" for="hombre">Masculino</label>
              <input type="radio" class="btn-check" name="genero" id="mujer" autocomplete="off" />
              <label class="btn btn-outline-primary btn-sm" for="mujer">Femenino</label>
            </div>
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
          <!-- Segunda fila de campos: Grupo Sanguíneo, Estado Civil, Fecha Nacimiento, Correo Electrónico, Celular -->
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
          <!-- Espacio vacío para alinear con la fila anterior -->
          <div style="min-width: 200px;"></div>
        </div>

        <div class="form-section">
          <!-- Tercera fila de campos: Edad, Dirección, Municipio, Parroquia -->
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
          <!-- Espacio vacío para alinear -->
          <div style="min-width: 250px;"></div>
          <div style="min-width: 250px;"></div>
        </div>
      </form>
    </div>
  </div>
          <div class="col-12 text-end">
            <button type="submit" class="btn btn-primary">Guardar</button>
            <button type="button" class="btn btn-primary me-2" onclick="window.location.href='{{ route('pacientes.historia') }}'">
                Crear Historia
            </button>

                    </div>

                     /div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

        </div>


@endsection
</x-app-layout>
