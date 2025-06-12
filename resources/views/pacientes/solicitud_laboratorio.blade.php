<x-app-layout>
    @section('contenido')
<head>
    <title>Solicitud de Laboratorio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<div class="container-fluid">
    <!-- Botón Atrás -->
    <button type="button" class="btn btn-atras mb-3" onclick="history.back()">
        <i class="fas fa-arrow-left"></i> Atrás
    </button>

    <!-- Card de Búsqueda -->
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
                    <button type="submit" class="btn btn-primary btn-sm" id="btnBuscar" style="width:auto; min-width:90px;">
                        <i class="fas fa-search me-2"></i>Buscar Paciente
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Resultados de Búsqueda -->
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
                            <div class="col-6"><strong>Fecha última historia:</strong> <span id="pacienteFecha"></span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Formulario de Laboratorio (se muestra después de encontrar paciente) -->
    <form id="formularioLaboratorio" class="contenedor-laboratorio" style="display: none;" method="POST" action="{{ route('pacientes.solicitud_laboratorio_pdf') }}" target="_blank">
        @csrf
        <input type="hidden" name="cedula" id="inputCedula">
        <input type="hidden" name="nombre" id="inputNombre">
        <input type="hidden" name="edad" id="inputEdad">
        <input type="hidden" name="historia" id="inputHistoria">
        <input type="hidden" name="fecha" id="inputFecha">

        <div class="section-title">Seleccione los exámenes de laboratorio</div>
        <div class="container border rounded p-3 bg-white mb-3">
            <!-- Química -->
            <div class="lab-group mb-3">
                <div class="lab-group-title fw-bold">Química</div>
                <div class="lab-list row row-cols-2 row-cols-md-3 g-2">
                    <div class="col"><label><input type="checkbox" name="lab[]" value="Glucosa"> Glucosa</label></div>
                    <div class="col"><label><input type="checkbox" name="lab[]" value="Urea"> Urea</label></div>
                    <div class="col"><label><input type="checkbox" name="lab[]" value="Creatinina"> Creatinina</label></div>
                    <div class="col"><label><input type="checkbox" name="lab[]" value="Colesterol total"> Colesterol total</label></div>
                    <div class="col"><label><input type="checkbox" name="lab[]" value="Triglicéridos"> Triglicéridos</label></div>
                    <div class="col"><label><input type="checkbox" name="lab[]" value="Ácido úrico"> Ácido úrico</label></div>
                    <div class="col"><label><input type="checkbox" name="lab[]" value="Transaminasas (TGO/TGP)"> Transaminasas (TGO/TGP)</label></div>
                    <div class="col"><label><input type="checkbox" name="lab[]" value="Bilirrubinas"> Bilirrubinas</label></div>
                    <div class="col"><label><input type="checkbox" name="lab[]" value="Fosfatasa alcalina"> Fosfatasa alcalina</label></div>
                    <div class="col"><label><input type="checkbox" name="lab[]" value="GGT"> GGT</label></div>
                    <div class="col"><label><input type="checkbox" name="lab[]" value="Proteínas totales y fraccionadas"> Proteínas totales y fraccionadas</label></div>
                    <div class="col"><label><input type="checkbox" name="lab[]" value="Electrolitos (Na, K, Cl)"> Electrolitos (Na, K, Cl)</label></div>
                    <div class="col"><label><input type="checkbox" name="lab[]" value="Calcio"> Calcio</label></div>
                    <div class="col"><label><input type="checkbox" name="lab[]" value="Fósforo"> Fósforo</label></div>
                    <div class="col"><label><input type="checkbox" name="lab[]" value="Magnesio"> Magnesio</label></div>
                </div>
            </div>
            <!-- Hematología -->
            <div class="lab-group mb-3">
                <div class="lab-group-title fw-bold">Hematología</div>
                <div class="lab-list row row-cols-2 row-cols-md-3 g-2">
                    <div class="col"><label><input type="checkbox" name="lab[]" value="Hemograma completo"> Hemograma completo</label></div>
                    <div class="col"><label><input type="checkbox" name="lab[]" value="VSG"> VSG</label></div>
                    <div class="col"><label><input type="checkbox" name="lab[]" value="Pruebas de coagulación"> Pruebas de coagulación</label></div>
                    <div class="col"><label><input type="checkbox" name="lab[]" value="Grupo sanguíneo y factor RH"> Grupo sanguíneo y factor RH</label></div>
                </div>
            </div>
            <!-- Orina y Cultivos -->
            <div class="lab-group mb-3">
                <div class="lab-group-title fw-bold">Orina y Cultivos</div>
                <div class="lab-list row row-cols-2 row-cols-md-3 g-2">
                    <div class="col"><label><input type="checkbox" name="lab[]" value="Orina completa"> Orina completa</label></div>
                    <div class="col"><label><input type="checkbox" name="lab[]" value="Urocultivo"> Urocultivo</label></div>
                    <div class="col"><label><input type="checkbox" name="lab[]" value="Coprológico"> Coprológico</label></div>
                    <div class="col"><label><input type="checkbox" name="lab[]" value="Coprocultivo"> Coprocultivo</label></div>
                </div>
            </div>
            <!-- Serología -->
            <div class="lab-group mb-3">
                <div class="lab-group-title fw-bold">Serología</div>
                <div class="lab-list row row-cols-2 row-cols-md-3 g-2">
                    <div class="col"><label><input type="checkbox" name="lab[]" value="Serología (VDRL, HIV, HBsAg, HCV)"> Serología (VDRL, HIV, HBsAg, HCV)</label></div>
                    <div class="col"><label><input type="checkbox" name="lab[]" value="Test de embarazo"> Test de embarazo</label></div>
                    <div class="col"><label><input type="checkbox" name="lab[]" value="PCR"> PCR</label></div>
                </div>
            </div>
            <!-- Perfiles -->
            <div class="lab-group mb-3">
                <div class="lab-group-title fw-bold">Perfiles</div>
                <div class="lab-list row row-cols-2 row-cols-md-3 g-2">
                    <div class="col"><label><input type="checkbox" name="lab[]" value="Perfil tiroideo"> Perfil tiroideo</label></div>
                    <div class="col"><label><input type="checkbox" name="lab[]" value="Perfil lipídico"> Perfil lipídico</label></div>
                    <div class="col"><label><input type="checkbox" name="lab[]" value="Perfil hepático"> Perfil hepático</label></div>
                    <div class="col"><label><input type="checkbox" name="lab[]" value="Perfil renal"> Perfil renal</label></div>
                    <div class="col"><label><input type="checkbox" name="lab[]" value="Perfil reumático"> Perfil reumático</label></div>
                </div>
            </div>
            <!-- Otros -->
            <div class="lab-group mb-3">
                <div class="lab-group-title fw-bold">Otros</div>
                <div class="lab-list row">
                    <div class="col-12">
                        <label>
                            <input type="checkbox" name="lab[]" value="Otros" id="check-otros">
                            Otros
                        </label>
                    </div>
                </div>
                <div class="otros-lab mt-2" id="otrosLabDiv" style="display:none;">
                    <label for="otrosLab">Especifique otros exámenes:</label>
                    <textarea name="otrosLab" id="otrosLab" class="form-control" placeholder="Ingrese otros estudios de laboratorio..."></textarea>
                </div>
            </div>
        </div>

        <div class="text-end mt-3">
            <button type="submit" class="btn btn-success" id="btnImprimirSolicitud">Imprimir Solicitud PDF</button>
        </div>
    </form>

    <!-- Mensajes de estado -->
    <div id="mensajeEstado" class="alert alert-info mt-3" style="display: none;"></div>
</div>

<script>
    document.getElementById('formBusquedaPaciente').addEventListener('submit', function(e) {
        e.preventDefault();
        buscarPaciente();
    });

    function buscarPaciente() {
        const cedula = document.getElementById('cedula').value.trim();
        const historiaId = document.getElementById('historia_id').value.trim();
        const btnBuscar = document.getElementById('btnBuscar');
        const resultadoDiv = document.getElementById('resultadoBusqueda');
        const formularioDiv = document.getElementById('formularioLaboratorio');
        const mensajeDiv = document.getElementById('mensajeEstado');

        if (!cedula && !historiaId) {
            mostrarMensaje('Por favor ingrese al menos un criterio de búsqueda (cédula o número de historia)', 'warning');
            return;
        }

        btnBuscar.disabled = true;
        btnBuscar.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Buscando...';
        mensajeDiv.style.display = 'none';
        resultadoDiv.style.display = 'none';
        formularioDiv.style.display = 'none';

        // Permutar la búsqueda: si hay cédula, buscar solo por cédula; si no, por historia
        let bodyData = {};
        if (cedula) {
            bodyData.cedula = cedula;
        } else if (historiaId) {
            bodyData.historia_id = historiaId;
        }

        fetch('/buscar-paciente', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            },
            body: JSON.stringify(bodyData)
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Error en la respuesta del servidor');
            }
            return response.json();
        })
        .then(data => {
            if (data.error) {
                throw new Error(data.error);
            }

            // Mostrar resultados
            document.getElementById('pacienteCedula').textContent = data.paciente.cedula || 'No disponible';
            document.getElementById('pacienteNombre').textContent =
                `${data.paciente.primer_apellido} ${data.paciente.segundo_apellido || ''} ${data.paciente.nombre}`.trim();
            document.getElementById('pacienteEdad').textContent = calcularEdad(data.paciente.fecha_nacimiento);
            document.getElementById('pacienteHistoria').textContent = data.paciente.historia || 'No disponible';
            document.getElementById('pacienteFecha').textContent = data.historia ? formatFecha(data.historia.created_at) : 'No disponible';

            // Llenar los campos ocultos del formulario
            document.getElementById('inputCedula').value = data.paciente.cedula || '';
            document.getElementById('inputNombre').value = `${data.paciente.primer_apellido} ${data.paciente.segundo_apellido || ''} ${data.paciente.nombre}`.trim();
            document.getElementById('inputEdad').value = calcularEdad(data.paciente.fecha_nacimiento);
            document.getElementById('inputHistoria').value = data.paciente.historia || '';
            document.getElementById('inputFecha').value = data.historia ? formatFecha(data.historia.created_at) : '';

            resultadoDiv.style.display = 'block';
            formularioDiv.style.display = 'block';
            mostrarMensaje('Paciente encontrado exitosamente', 'success');
        })
        .catch(error => {
            console.error('Error:', error);
            mostrarMensaje(error.message, 'danger');
        })
        .finally(() => {
            btnBuscar.disabled = false;
            btnBuscar.innerHTML = '<i class="fas fa-search me-2"></i>Buscar Paciente';
        });
    }

    function calcularEdad(fechaNacimiento) {
        if (!fechaNacimiento) return 'No disponible';
        const nacimiento = new Date(fechaNacimiento);
        const hoy = new Date();
        let edad = hoy.getFullYear() - nacimiento.getFullYear();
        const m = hoy.getMonth() - nacimiento.getMonth();
        if (m < 0 || (m === 0 && hoy.getDate() < nacimiento.getDate())) {
            edad--;
        }
        return `${edad} años`;
    }

    function formatFecha(fecha) {
        if (!fecha) return 'No disponible';
        const options = { year: 'numeric', month: 'long', day: 'numeric' };
        return new Date(fecha).toLocaleDateString('es-ES', options);
    }

    function mostrarMensaje(texto, tipo) {
        const mensajeDiv = document.getElementById('mensajeEstado');
        mensajeDiv.textContent = texto;
        mensajeDiv.className = `alert alert-${tipo} mt-3`;
        mensajeDiv.style.display = 'block';
    }

    // Mostrar/ocultar campo "Otros"
    document.getElementById('check-otros').addEventListener('change', function() {
        var otrosDiv = document.getElementById('otrosLabDiv');
        if (this.checked) {
            otrosDiv.style.display = 'block';
            document.getElementById('otrosLab').focus();
        } else {
            otrosDiv.style.display = 'none';
            document.getElementById('otrosLab').value = '';
        }
    });

    // Habilitar el botón de imprimir solo cuando se muestre el formulario
    const formularioDiv = document.getElementById('formularioLaboratorio');
    const btnImprimir = document.getElementById('btnImprimirSolicitud');
    if (formularioDiv && btnImprimir) {
        const observer = new MutationObserver(function() {
            if (formularioDiv.style.display !== 'none') {
                btnImprimir.disabled = false;
            } else {
                btnImprimir.disabled = true;
            }
        });
        observer.observe(formularioDiv, { attributes: true, attributeFilter: ['style'] });
        // Habilitar por defecto si el formulario está visible
        if (formularioDiv.style.display !== 'none') {
            btnImprimir.disabled = false;
        }
    }

    // Validar al menos un examen seleccionado antes de enviar
    if (formularioDiv) {
        formularioDiv.addEventListener('submit', function(e) {
            const checks = formularioDiv.querySelectorAll('input[type="checkbox"][name="lab[]"]:checked');
            if (checks.length === 0) {
                e.preventDefault();
                mostrarMensaje('Debe seleccionar al menos un examen de laboratorio.', 'warning');
                return false;
            }
            // Si "Otros" está seleccionado, el textarea debe ser obligatorio
            const checkOtros = document.getElementById('check-otros');
            const otrosLab = document.getElementById('otrosLab');
            if (checkOtros && checkOtros.checked && otrosLab && otrosLab.value.trim() === '') {
                e.preventDefault();
                mostrarMensaje('Por favor especifique los otros exámenes.', 'warning');
                otrosLab.focus();
                return false;
            }
        });
    }
</script>
@endsection
</x-app-layout>
