

@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="mb-0"><i class="fas fa-search me-2"></i>Buscar Paciente</h4>
                <a href="{{ url()->previous() }}" class="btn btn-light btn-sm">
                    <i class="fas fa-arrow-left me-1"></i> Regresar
                </a>
            </div>
        </div>

        <div class="card-body">
            <form id="searchForm" class="row g-3">
                @csrf
                <div class="col-md-6">
                    <label for="cedula" class="form-label">Cédula</label>
                    <input type="text" class="form-control" id="cedula" name="cedula"
                           placeholder="Ingrese número de cédula">
                </div>
                <div class="col-md-6">
                    <label for="historia" class="form-label">Historia Clínica</label>
                    <input type="text" class="form-control" id="historia" name="historia"
                           placeholder="Ingrese número de historia">
                </div>
                <div class="col-md-4">
                    <label for="apellido" class="form-label">Apellido</label>
                    <input type="text" class="form-control" id="apellido" name="apellido"
                           placeholder="Ingrese apellido">
                </div>
                <div class="col-md-4">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre"
                           placeholder="Ingrese nombre">
                </div>
                <div class="col-md-4">
                    <label class="form-label d-block">&nbsp;</label>
                    <button type="submit" class="btn btn-primary w-100" id="searchButton">
                        <i class="fas fa-search me-2"></i> Buscar
                    </button>
                </div>
            </form>

            <hr>

            <div id="searchResults" class="mt-4">
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i> Ingrese los criterios de búsqueda y presione "Buscar"
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal para detalles del paciente -->
<div class="modal fade" id="patientModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Detalles del Paciente</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="patientDetails">
                <!-- Contenido dinámico -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i> Cerrar
                </button>
                <a href="#" id="viewHistoryBtn" class="btn btn-primary">
                    <i class="fas fa-file-medical me-2"></i> Ver Historia
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Manejar el envío del formulario
    $('#searchForm').on('submit', function(e) {
        e.preventDefault();
        performSearch();
    });

    // Función para realizar la búsqueda
    function performSearch() {
        const button = $('#searchButton');
        const resultsDiv = $('#searchResults');

        // Mostrar estado de carga
        button.html('<i class="fas fa-spinner fa-spin me-2"></i> Buscando...');
        button.prop('disabled', true);

        // Obtener datos del formulario
        const formData = $('#searchForm').serialize();

        // Realizar petición AJAX
        $.ajax({
            url: '{{ route('pacientes.buscar') }}',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    if (response.pacientes.length > 0) {
                        displayResults(response.pacientes);
                    } else {
                        resultsDiv.html(`
                            <div class="alert alert-warning">
                                <i class="fas fa-exclamation-triangle me-2"></i> No se encontraron pacientes con los criterios especificados
                            </div>
                        `);
                    }
                } else {
                    showError(response.message || 'Error en la búsqueda');
                }
            },
            error: function(xhr) {
                let errorMsg = 'Error en la conexión con el servidor';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMsg = xhr.responseJSON.message;
                }
                showError(errorMsg);
            },
            complete: function() {
                button.html('<i class="fas fa-search me-2"></i> Buscar');
                button.prop('disabled', false);
            }
        });
    }

    // Mostrar resultados en tabla
    function displayResults(pacientes) {
        let html = `
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead class="table-primary">
                        <tr>
                            <th>Cédula</th>
                            <th>Apellidos</th>
                            <th>Nombres</th>
                            <th>Historia</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
        `;

        pacientes.forEach(paciente => {
            html += `
                <tr>
                    <td>${paciente.cedula || 'N/A'}</td>
                    <td>${paciente.primer_apellido} ${paciente.segundo_apellido || ''}</td>
                    <td>${paciente.nombre}</td>
                    <td>${paciente.historia_id || 'N/A'}</td>
                    <td>
                        <button class="btn btn-sm btn-primary view-patient"
                                data-id="${paciente.id}"
                                data-bs-toggle="modal"
                                data-bs-target="#patientModal">
                            <i class="fas fa-eye"></i>
                        </button>
                        <a href="{{ route('pacientes.historia', '') }}/${paciente.id}"
                           class="btn btn-sm btn-success">
                            <i class="fas fa-file-medical"></i>
                        </a>
                    </td>
                </tr>
            `;
        });

        html += `
                    </tbody>
                </table>
            </div>
        `;

        $('#searchResults').html(html);

        // Configurar eventos para los botones de ver detalles
        $('.view-patient').on('click', function() {
            loadPatientDetails($(this).data('id'));
        });
    }

    // Cargar detalles del paciente en el modal
    function loadPatientDetails(pacienteId) {
        $.ajax({
            url: `/pacientes/${pacienteId}/detalles`,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    displayPatientDetails(response.paciente);
                    $('#viewHistoryBtn').attr('href', `/pacientes/${pacienteId}/historia`);
                } else {
                    $('#patientDetails').html(`
                        <div class="alert alert-danger">
                            ${response.message || 'Error al cargar detalles'}
                        </div>
                    `);
                }
            },
            error: function() {
                $('#patientDetails').html(`
                    <div class="alert alert-danger">
                        Error al cargar los detalles del paciente
                    </div>
                `);
            }
        });
    }

    // Mostrar detalles del paciente
    function displayPatientDetails(paciente) {
        const fechaNac = paciente.fecha_nacimiento ? new Date(paciente.fecha_nacimiento).toLocaleDateString() : 'N/A';
        const edad = paciente.fecha_nacimiento ? calcularEdad(paciente.fecha_nacimiento) : 'N/A';

        let html = `
            <div class="row">
                <div class="col-md-4">
                    <p><strong>Cédula:</strong> ${paciente.cedula || 'N/A'}</p>
                    <p><strong>Nombre Completo:</strong> ${paciente.primer_apellido} ${paciente.segundo_apellido || ''} ${paciente.nombre}</p>
                </div>
                <div class="col-md-4">
                    <p><strong>Fecha Nacimiento:</strong> ${fechaNac}</p>
                    <p><strong>Edad:</strong> ${edad}</p>
                </div>
                <div class="col-md-4">
                    <p><strong>Género:</strong> ${paciente.sexo || 'N/A'}</p>
                    <p><strong>Teléfono:</strong> ${paciente.telefono || 'N/A'}</p>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-12">
                    <p><strong>Dirección:</strong> ${paciente.direccion || 'N/A'}</p>
                    <p><strong>Email:</strong> ${paciente.email || 'N/A'}</p>
                    <p><strong>Historia Clínica:</strong> ${paciente.historia_id || 'N/A'}</p>
                </div>
            </div>
        `;

        $('#patientDetails').html(html);
    }

    // Función para calcular edad
    function calcularEdad(fechaNacimiento) {
        const nacimiento = new Date(fechaNacimiento);
        const hoy = new Date();
        let edad = hoy.getFullYear() - nacimiento.getFullYear();
        const m = hoy.getMonth() - nacimiento.getMonth();

        if (m < 0 || (m === 0 && hoy.getDate() < nacimiento.getDate())) {
            edad--;
        }

        return `${edad} años`;
    }

    // Mostrar mensaje de error
    function showError(message) {
        $('#searchResults').html(`
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle me-2"></i> ${message}
            </div>
        `);
    }
});
</script>
@endsection
