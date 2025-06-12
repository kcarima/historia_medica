@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="mb-0"><i class="fas fa-file-medical me-2"></i>Reporte de Enfermería</h4>
                <a href="{{ url()->previous() }}" class="btn btn-light btn-sm">
                    <i class="fas fa-arrow-left me-1"></i> Regresar
                </a>
            </div>
        </div>

        <div class="card-body">
            <form id="searchForm" class="row g-3">
                @csrf
                <div class="col-md-6">
                    <label for="historia" class="form-label">Historia Clínica</label>
                    <input type="text" class="form-control" id="historia" name="historia"
                           placeholder="Ingrese número de historia">
                </div>
                <div class="col-md-6">
                    <label for="habitacion" class="form-label">Habitación/Cama</label>
                    <input type="text" class="form-control" id="habitacion" name="habitacion"
                           placeholder="Ingrese número de habitación o cama">
                </div>
                <div class="col-md-4">
                    <label for="fecha_inicio" class="form-label">Fecha Inicio</label>
                    <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio">
                </div>
                <div class="col-md-4">
                    <label for="fecha_fin" class="form-label">Fecha Fin</label>
                    <input type="date" class="form-control" id="fecha_fin" name="fecha_fin">
                </div>
                <div class="col-md-4">
                    <label class="form-label d-block">&nbsp;</label>
                    <button type="submit" class="btn btn-primary w-100" id="searchButton">
                        <i class="fas fa-search me-2"></i> Buscar Reportes
                    </button>
                </div>
            </form>

            <hr>

            <div id="searchResults" class="mt-4">
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i> Ingrese los criterios de búsqueda para ver los reportes de enfermería
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal para detalles del reporte -->
<div class="modal fade" id="reportModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Detalles del Reporte de Enfermería</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="reportDetails">
                <!-- Contenido dinámico -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i> Cerrar
                </button>
                <button type="button" class="btn btn-success" id="printReportBtn">
                    <i class="fas fa-print me-2"></i> Imprimir
                </button>
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
            url: '{{ route('enfermeria.reportes.buscar') }}',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    if (response.reportes.length > 0) {
                        displayResults(response.reportes);
                    } else {
                        resultsDiv.html(`
                            <div class="alert alert-warning">
                                <i class="fas fa-exclamation-triangle me-2"></i> No se encontraron reportes con los criterios especificados
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
                button.html('<i class="fas fa-search me-2"></i> Buscar Reportes');
                button.prop('disabled', false);
            }
        });
    }

    // Mostrar resultados en tabla
    function displayResults(reportes) {
        let html = `
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead class="table-primary">
                        <tr>
                            <th>Fecha/Hora</th>
                            <th>Paciente</th>
                            <th>Historia</th>
                            <th>Habitación</th>
                            <th>Turno</th>
                            <th>Enfermero/a</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
        `;

        reportes.forEach(reporte => {
            html += `
                <tr>
                    <td>${new Date(reporte.created_at).toLocaleString()}</td>
                    <td>${reporte.paciente.primer_apellido} ${reporte.paciente.nombre}</td>
                    <td>${reporte.paciente.historia_id || 'N/A'}</td>
                    <td>${reporte.habitacion || 'N/A'}</td>
                    <td>${reporte.turno}</td>
                    <td>${reporte.enfermero.nombre}</td>
                    <td>
                        <button class="btn btn-sm btn-primary view-report"
                                data-id="${reporte.id}"
                                data-bs-toggle="modal"
                                data-bs-target="#reportModal">
                            <i class="fas fa-eye"></i> Ver
                        </button>
                        <a href="/enfermeria/reportes/${reporte.id}/editar"
                           class="btn btn-sm btn-warning">
                            <i class="fas fa-edit"></i> Editar
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
        $('.view-report').on('click', function() {
            loadReportDetails($(this).data('id'));
        });
    }

    // Cargar detalles del reporte en el modal
    function loadReportDetails(reporteId) {
        $.ajax({
            url: `/enfermeria/reportes/${reporteId}/detalles`,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    displayReportDetails(response.reporte);
                } else {
                    $('#reportDetails').html(`
                        <div class="alert alert-danger">
                            ${response.message || 'Error al cargar detalles del reporte'}
                        </div>
                    `);
                }
            },
            error: function() {
                $('#reportDetails').html(`
                    <div class="alert alert-danger">
                        Error al cargar los detalles del reporte
                    </div>
                `);
            }
        });
    }

    // Mostrar detalles del reporte
    function displayReportDetails(reporte) {
        const fecha = new Date(reporte.created_at).toLocaleString();
        const signos = JSON.parse(reporte.signos_vitales);
        const cuidados = JSON.parse(reporte.cuidados_aplicados);
        const observaciones = reporte.observaciones || 'No hay observaciones registradas';

        let signosHtml = '';
        for (const [key, value] of Object.entries(signos)) {
            signosHtml += `<p><strong>${key}:</strong> ${value}</p>`;
        }

        let cuidadosHtml = '<ul>';
        cuidados.forEach(cuidado => {
            cuidadosHtml += `<li>${cuidado}</li>`;
        });
        cuidadosHtml += '</ul>';

        let html = `
            <div class="row mb-4">
                <div class="col-md-6">
                    <h5>Información Básica</h5>
                    <p><strong>Paciente:</strong> ${reporte.paciente.primer_apellido} ${reporte.paciente.nombre}</p>
                    <p><strong>Historia Clínica:</strong> ${reporte.paciente.historia_id || 'N/A'}</p>
                    <p><strong>Edad:</strong> ${calcularEdad(reporte.paciente.fecha_nacimiento)}</p>
                    <p><strong>Sexo:</strong> ${reporte.paciente.sexo}</p>
                </div>
                <div class="col-md-6">
                    <h5>Datos del Reporte</h5>
                    <p><strong>Fecha/Hora:</strong> ${fecha}</p>
                    <p><strong>Turno:</strong> ${reporte.turno}</p>
                    <p><strong>Habitación/Cama:</strong> ${reporte.habitacion || 'N/A'}</p>
                    <p><strong>Enfermero/a:</strong> ${reporte.enfermero.nombre}</p>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-light">
                            <h6 class="mb-0">Signos Vitales</h6>
                        </div>
                        <div class="card-body">
                            ${signosHtml}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-light">
                            <h6 class="mb-0">Estado General</h6>
                        </div>
                        <div class="card-body">
                            <p><strong>Nivel de conciencia:</strong> ${reporte.nivel_conciencia}</p>
                            <p><strong>Movilidad:</strong> ${reporte.movilidad}</p>
                            <p><strong>Estado de piel:</strong> ${reporte.estado_piel}</p>
                            <p><strong>Dolor:</strong> ${reporte.dolor} (Escala 0-10)</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-light">
                            <h6 class="mb-0">Cuidados Aplicados</h6>
                        </div>
                        <div class="card-body">
                            ${cuidadosHtml}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-light">
                            <h6 class="mb-0">Observaciones</h6>
                        </div>
                        <div class="card-body">
                            <p>${observaciones}</p>
                        </div>
                    </div>
                </div>
            </div>
        `;

        $('#reportDetails').html(html);
    }

    // Función para calcular edad (reutilizada)
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

    // Mostrar mensaje de error
    function showError(message) {
        $('#searchResults').html(`
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle me-2"></i> ${message}
            </div>
        `);
    }

    // Botón de imprimir
    $('#printReportBtn').on('click', function() {
        window.print();
    });
});
</script>

<style>
    @media print {
        body * {
            visibility: hidden;
        }
        #reportModal, #reportModal * {
            visibility: visible;
        }
        #reportModal {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            margin: 0;
            padding: 0;
        }
        .modal-footer {
            display: none !important;
        }
    }
</style>
@endsection
