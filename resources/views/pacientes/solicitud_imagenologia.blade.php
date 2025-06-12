<x-app-layout>
    @section('contenido')
    <head>
        <title>Solicitud de Imagenología</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <style>
            .contenedor-laboratorio {
                max-width: 800px;
                margin: 0 auto;
                padding: 20px;
                background-color: #f8f9fa;
                border-radius: 8px;
                box-shadow: 0 0 10px rgba(0,0,0,0.1);
            }
            .lab-group {
                margin-bottom: 20px;
            }
            #listaEstudios {
                max-height: 200px;
                overflow-y: auto;
            }
        </style>
    </head>
    <div class="container-fluid">
        <button type="button" class="btn btn-secondary mb-3" onclick="history.back()">
            <i class="fas fa-arrow-left"></i> Atrás
        </button>

        <!-- Card de búsqueda -->
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="fas fa-search me-2"></i>Buscar Paciente</h5>
            </div>
            <div class="card-body">
                <form id="formBusquedaPaciente" class="row g-3">
                    @csrf
                    <div class="col-md-6">
                        <label for="cedula" class="form-label">Cédula:</label>
                        <input type="text" class="form-control" id="cedula" name="cedula"
                               placeholder="Ej: 123456789" autocomplete="off"
                               maxlength="10" pattern="\d{7,10}" inputmode="numeric"
                               oninput="this.value=this.value.replace(/[^0-9]/g,'').slice(0,10)">
                    </div>
                    <div class="col-md-6">
                        <label for="historia_id" class="form-label">N° Historia:</label>
                        <input type="text" class="form-control" id="historia_id" name="historia_id"
                               placeholder="Ej: 100001" autocomplete="off"
                               maxlength="6" pattern="\d{6}" inputmode="numeric"
                               oninput="this.value=this.value.replace(/[^0-9]/g,'').slice(0,6)">
                    </div>
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary" id="btnBuscar">
                            <i class="fas fa-search me-2"></i>Buscar Paciente
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Resultados y formulario (inicialmente oculto) -->
        <div id="resultadoBusqueda" class="card mb-4 shadow-sm" style="display: none;">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0"><i class="fas fa-user me-2"></i>Datos del Paciente</h5>
            </div>
            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="container border rounded p-3 bg-light">
                            <div class="row mb-2">
                                <div class="col-6"><strong>Cédula:</strong> <span id="pacienteCedula"></span></div>
                                <div class="col-6"><strong>Historia Clínica:</strong> <span id="pacienteHistoria"></span></div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-6"><strong>Nombre:</strong> <span id="pacienteNombre"></span></div>
                                <div class="col-6"><strong>Edad:</strong> <span id="pacienteEdad"></span></div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-6"><strong>Teléfono:</strong> <span id="pacienteTelefono"></span></div>
                                <div class="col-6"><strong>Sexo:</strong> <span id="pacienteSexo"></span></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Formulario de solicitud -->
                <form id="formSolicitudImagenologia" class="mt-4" method="POST" action="{{ route('pacientes.solicitud_imagenologia_pdf') }}" target="_blank">
                    @csrf
                    <input type="hidden" name="cedula" id="inputCedula">
                    <input type="hidden" name="historia_id" id="inputHistoria">
                    <input type="hidden" name="estudios" id="inputEstudiosHidden">

                    <div class="contenedor-laboratorio">
                        <h3 class="text-center mb-4">Solicitud de Imagenología</h3>

                        <div class="lab-group">
                            <label for="tipo_estudio" class="form-label">Tipo de Estudio:</label>
                            <select id="tipo_estudio" class="form-select">
                                <option value="">Seleccione...</option>
                                <option value="Rayos X">Rayos X</option>
                                <option value="Ecografía">Ecografía</option>
                                <option value="Tomografía">Tomografía</option>
                                <option value="Resonancia Magnética">Resonancia Magnética</option>
                                <option value="Mamografía">Mamografía</option>
                                <option value="Otros">Otros</option>
                            </select>
                        </div>

                        <div class="lab-group" id="grupoDetalle" style="display: none;">
                            <label for="detalle_estudio" class="form-label">Detalle del Estudio:</label>
                            <select id="detalle_estudio" class="form-select"></select>
                            <button type="button" class="btn btn-success mt-2" id="agregarEstudio">
                                <i class="fas fa-plus me-1"></i> Agregar Estudio
                            </button>
                        </div>

                        <div class="lab-group">
                            <label class="form-label">Estudios Seleccionados:</label>
                            <ul id="listaEstudios" class="list-group mb-2"></ul>
                        </div>

                        <div class="lab-group">
                            <label for="observaciones" class="form-label">Observaciones:</label>
                            <textarea class="form-control" id="observaciones" name="observaciones" rows="3" placeholder="Ingrese cualquier observación relevante"></textarea>
                        </div>

                        <div class="text-end mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-file-pdf me-1"></i> Generar PDF
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
    // Configuración inicial
    const estudiosPorTipo = {
        'Rayos X': ['Tórax PA', 'Tórax lateral', 'Columna cervical', 'Columna lumbar', 'Pelvis', 'Miembro superior', 'Miembro inferior', 'Cráneo', 'Senos paranasales', 'Abdomen simple', 'Otros RX'],
        'Ecografía': ['Abdominal', 'Renal', 'Obstétrica', 'Pélvica', 'Mamaria', 'Partes blandas', 'Tiroides', 'Próstata', 'Transvaginal', 'Doppler', 'Otros Eco'],
        'Tomografía': ['Cerebral', 'Tórax', 'Abdomen', 'Pelvis', 'Columna', 'Otros TAC'],
        'Resonancia Magnética': ['Cerebral', 'Columna', 'Articular', 'Abdomen', 'Pelvis', 'Otros RMN'],
        'Mamografía': ['Mamografía bilateral', 'Mamografía unilateral', 'Otros Mamografía'],
        'Otros': ['Otro estudio (especifique)']
    };

    let estudiosSeleccionados = [];

    // Elementos del DOM
    const tipoEstudio = document.getElementById('tipo_estudio');
    const grupoDetalle = document.getElementById('grupoDetalle');
    const detalleEstudio = document.getElementById('detalle_estudio');
    const agregarEstudio = document.getElementById('agregarEstudio');
    const listaEstudios = document.getElementById('listaEstudios');
    const inputEstudiosHidden = document.getElementById('inputEstudiosHidden');
    const formBusqueda = document.getElementById('formBusquedaPaciente');
    const formSolicitud = document.getElementById('formSolicitudImagenologia');

    // Evento para cambiar tipo de estudio
    tipoEstudio.addEventListener('change', function() {
        const tipo = this.value;
        detalleEstudio.innerHTML = '<option value="">Seleccione detalle</option>';

        if (tipo && estudiosPorTipo[tipo]) {
            estudiosPorTipo[tipo].forEach(estudio => {
                const option = document.createElement('option');
                option.value = estudio;
                option.textContent = estudio;
                detalleEstudio.appendChild(option);
            });
            grupoDetalle.style.display = 'block';
        } else {
            grupoDetalle.style.display = 'none';
        }
    });

    // Agregar estudio a la lista
    agregarEstudio.addEventListener('click', function() {
        const tipo = tipoEstudio.value;
        const detalle = detalleEstudio.value;

        if (!tipo || !detalle) {
            alert('Por favor seleccione un tipo y detalle de estudio');
            return;
        }

        const estudioCompleto = `${tipo}: ${detalle}`;
        estudiosSeleccionados.push(estudioCompleto);
        actualizarListaEstudios();
    });

    // Actualizar lista de estudios
    function actualizarListaEstudios() {
        listaEstudios.innerHTML = '';

        estudiosSeleccionados.forEach((estudio, index) => {
            const li = document.createElement('li');
            li.className = 'list-group-item d-flex justify-content-between align-items-center';
            li.textContent = estudio;

            const btnEliminar = document.createElement('button');
            btnEliminar.className = 'btn btn-danger btn-sm';
            btnEliminar.innerHTML = '<i class="fas fa-trash"></i>';
            btnEliminar.onclick = () => {
                estudiosSeleccionados.splice(index, 1);
                actualizarListaEstudios();
            };

            li.appendChild(btnEliminar);
            listaEstudios.appendChild(li);
        });

        // Actualizar campo oculto con JSON
        inputEstudiosHidden.value = JSON.stringify(estudiosSeleccionados);
    }

    // Buscar paciente
    formBusqueda.addEventListener('submit', function(e) {
        e.preventDefault();
        buscarPaciente();
    });

    function buscarPaciente() {
        const cedula = document.getElementById('cedula').value.trim();
        const historiaId = document.getElementById('historia_id').value.trim();
        const btnBuscar = document.getElementById('btnBuscar');
        const resultadoDiv = document.getElementById('resultadoBusqueda');

        if (!cedula && !historiaId) {
            alert('Por favor ingrese al menos un criterio de búsqueda');
            return;
        }

        btnBuscar.disabled = true;
        btnBuscar.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Buscando...';

        fetch('/buscar-paciente', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                cedula: cedula || null,
                historia_id: historiaId || null
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                throw new Error(data.error);
            }

            // Mostrar datos del paciente
            document.getElementById('pacienteCedula').textContent = data.paciente.cedula || 'N/A';
            document.getElementById('pacienteHistoria').textContent = data.paciente.historia || 'N/A';
            document.getElementById('pacienteNombre').textContent =
                `${data.paciente.primer_apellido} ${data.paciente.segundo_apellido || ''} ${data.paciente.nombre}`.trim();
            document.getElementById('pacienteEdad').textContent = calcularEdad(data.paciente.fecha_nacimiento);
            document.getElementById('pacienteTelefono').textContent = data.paciente.celular || data.paciente.telefono_local || 'N/A';
            document.getElementById('pacienteSexo').textContent = data.paciente.genero || 'N/A';

            // Llenar campos ocultos
            document.getElementById('inputCedula').value = data.paciente.cedula || '';
            document.getElementById('inputHistoria').value = data.paciente.historia || '';

            // Mostrar resultados
            resultadoDiv.style.display = 'block';
        })
        .catch(error => {
            alert(error.message);
            resultadoDiv.style.display = 'none';
        })
        .finally(() => {
            btnBuscar.disabled = false;
            btnBuscar.innerHTML = '<i class="fas fa-search me-2"></i> Buscar Paciente';
        });
    }

    function calcularEdad(fechaNacimiento) {
        if (!fechaNacimiento) return 'N/A';

        const nacimiento = new Date(fechaNacimiento);
        const hoy = new Date();
        let edad = hoy.getFullYear() - nacimiento.getFullYear();
        const m = hoy.getMonth() - nacimiento.getMonth();

        if (m < 0 || (m === 0 && hoy.getDate() < nacimiento.getDate())) {
            edad--;
        }

        return `${edad} años`;
    }

    // Validar formulario antes de enviar
    formSolicitud.addEventListener('submit', function(e) {
        if (estudiosSeleccionados.length === 0) {
            e.preventDefault();
            alert('Debe agregar al menos un estudio de imagenología');
            return false;
        }

        // Asegurar que los estudios estén actualizados
        inputEstudiosHidden.value = JSON.stringify(estudiosSeleccionados);
    });
    </script>
    @endsection
</x-app-layout>
