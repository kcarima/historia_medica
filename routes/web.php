<?php
use App\Http\Controllers\DiagnosticoController;
use App\Http\Controllers\PacientePdfController;
use App\Http\Controllers\AnamnesisController;
use App\Http\Controllers\EgresoController;
use App\Http\Controllers\FisicoController;
use App\Http\Controllers\HistoriaController;
use App\Http\Controllers\Nota_operatoriaController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\ReporteMedicosController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RespaldoController;
use App\Http\Controllers\ImagenologiaController;
use App\Http\Controllers\SolicitudLaboratorioController;
use App\Http\Controllers\ForaneasController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\ReporteEnfermeriaController;
use App\Models\ReporteEnfermeria;
use Illuminate\Support\Facades\Route;


Route::get('/login', function () {
return view('auth.login');
});

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/pacientes/historia', [PacienteController::class, 'historia'])->name('pacientes.historia');
    Route::get('/pacientes/nota_operatoria', [PacienteController::class, 'nota_operatoria'])->name('pacientes.nota_operatoria');
    Route::get('/pacientes/imagenologia-buscar', [PacienteController::class, 'imagenologiaBuscar'])->name('pacientes.imagenologia_buscar');
    Route::get('/pacientes/imagenologia', [PacienteController::class, 'imagenologia'])->name('pacientes.imagenologia');
    Route::get('/pacientes/foraneas', [PacienteController::class, 'foraneas'])->name('pacientes.foraneas');
    Route::post('/pacientes/imagenologia/upload', [PacienteController::class, 'imagenologiaUpload'])->name('pacientes.imagenologia_upload');
    Route::post('/pacientes/imagenologia/guardar', [ImagenologiaController::class, 'guardar'])->name('imagenologia.guardar');
    Route::get('/pacientes/imagenologia/tipo/{tipo}', [ImagenologiaController::class, 'porTipo'])->name('imagenologia.porTipo');
    Route::delete('/pacientes/imagenologia/eliminar/{id}', [ImagenologiaController::class, 'eliminar'])->name('imagenologia.eliminar');
    Route::get('/pacientes/solicitud_laboratorio', [PacienteController::class, 'solicitud_laboratorio'])->name('pacientes.solicitud_laboratorio');
    Route::get('/pacientes/anamnesis', [PacienteController::class, 'anamnesis'])->name('pacientes.anamnesis');
    Route::get('/pacientes/antecedentes_personales', [PacienteController::class, 'antecedentes_personales'])->name('pacientes.antecedentes_personales');
    Route::get('/pacientes/antecedentes_familiares', [PacienteController::class, 'antecedentes_familiares'])->name('pacientes.antecedentes_familiares');
    Route::get('/pacientes/antecedentes_ginecologicos', [PacienteController::class, 'antecedentes_ginecologicos'])->name('pacientes.antecedentes_ginecologicos');
    Route::get('/pacientes/examen_fisico', [PacienteController::class, 'examen_fisico'])->name('pacientes.examen_fisico');
    Route::get('/pacientes/diagnostico_tratamiento', [PacienteController::class, 'diagnostico_tratamiento'])->name('pacientes.diagnostico_tratamiento');
    Route::get('/pacientes/egreso', [PacienteController::class, 'egreso'])->name('pacientes.egreso');
    Route::get('/pacientes/consideraciones_menor', [PacienteController::class, 'consideraciones_menor'])->name('pacientes.consideraciones_menor');
    Route::get('/pacientes/informe', [PacienteController::class, 'informe'])->name('pacientes.informe');
    Route::post('/pacientes/solicitud_laboratorio', [PacienteController::class, 'guardar_solicitud_laboratorio'])->name('pacientes.guardar_solicitud_laboratorio');
    Route::get('/pacientes/pre_anestesia', [PacienteController::class, 'pre_anestesia'])->name('pacientes.pre_anestesia');
    Route::get('/pacientes/solicitud_banco_sangre', [PacienteController::class, 'solicitud_banco_sangre'])->name('pacientes.solicitud_banco_sangre');
    Route::get('/pacientes/solicitud_imagenes', [PacienteController::class, 'solicitud_imagenes'])->name('pacientes.solicitud_imagenes');
    Route::get('/pacientes/solicitud_imagenologia', [PacienteController::class, 'solicitud_imagenologia'])->name('pacientes.solicitud_imagenologia');
    Route::post('/pacientes/solicitud_imagenologia/pdf', [PacienteController::class, 'generarSolicitudImagenologiaPDF'])->name('pacientes.solicitud_imagenologia_pdf');

// route de paciente

// Generar PDF

Route::get('/pacientes/reposobuscar', [PacienteController::class, 'mostrarFormularioBusqueda'])->name('pacientes.reposobuscar');
Route::get('/pacientes/reposobuscar/resultado', [PacienteController::class, 'buscarPaciente'])->name('pacientes.buscarResultado');
 Route::get('pacientes/historia/buscar', [PacienteController::class, 'buscar'])->name('historia.buscar');
Route::match(['get', 'post'], 'pacientes/historia/buscar', [PacienteController::class, 'buscarHistorial'])->name('historia.buscar');
Route::get('/pacientes/export-pdf', [PacienteController::class, 'exportPdf'])->name('pacientes.pdf');});
    Route::get('/pacientes', [PacienteController::class, 'index'])->name('pacientes.index');
    Route::post('/pacientes', [PacienteController::class, 'store'])->name('pacientes.store');
    Route::get('/pacientes/create', [PacienteController::class, 'create'])->name('pacientes.create');
    Route::get('/pacientes/{historia}', [PacienteController::class, 'show'])->name('pacientes.show');
    Route::get('/pacientes/edit/{historia}', [PacienteController::class, 'edit'])->name('pacientes.edit');
    Route::put('/pacientes/{historia}', [PacienteController::class, 'update'])->name('pacientes.update');
    Route::delete('/pacientes/{historia}', [PacienteController::class, 'destroy'])->name('pacientes.destroy');

// Ruta para mostrar el historial completo
/* Route::get('/pacientes/{historia}/historia/buscar', [PacienteController::class, 'buscarHistorial'])->name('pacientes.historial.completo'); */
// route de historia
Route::get('/pacientes/historia/informeMedico{historia}', [HistoriaController::class, 'generarInformeMedicoPDF'])->name('historia.informeMedico');

Route::get('/pacientes/historia/reposo{historia}', [HistoriaController::class, 'generarReposoPDF'])->name('historia.reposo');
Route::get('/pacientes/historia/pdf{historia}', [HistoriaController::class, 'generarPdf'])->name('historia.pdf');
Route::get('/pacientes/historia/{historia}', [HistoriaController::class, 'create'])->name('historia.create');
    Route::get('/pacientes/historia/editar/{historia}', [HistoriaController::class, 'edit'])->name('historia.edit');
    Route::put('/historias/actualizar/{historia}', [HistoriaController::class, 'update'])->name('historia.update');
   Route::post('/pacientes/historia/{historia}', [HistoriaController::class, 'store'])->name('historia.store');
   Route::delete('/pacientes/historia/{historia}', [HistoriaController::class, 'destroy'])->name('historia.destroy');

    // Rutas de usuarios, roles y permisos
    Route::resource('users', UserController::class)->names('users');
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);


// route Anamnesis
    Route::get('/pacientes/anamnesis/{historia}', [AnamnesisController::class, 'create'])->name('anamnesis.create');
    Route::get('/pacientes/anamnesis/editar/{historia}', [AnamnesisController::class, 'edit'])->name('anamnesis.edit');
    Route::put('/historias/actualizar/{historia}', [AnamnesisController::class, 'update'])->name('anamnesis.update');
    Route::post('/pacientes/anamnesis/{historia}', [AnamnesisController::class, 'store'])->name('anamnesis.store');
    Route::delete('/pacientes/anamnesis/{historia}', [AnamnesisController::class, 'destroy'])->name('anamnesis.destroy');
// route examen fisico
    Route::get('/pacientes/fisico/{historia}', [FisicoController::class, 'create'])->name('fisico.create');
    Route::get('/pacientes/fisico/editar/{historia}', [FisicoController::class, 'edit'])->name('fisico.edit');
    Route::put('/historias/actualizar/{historia}', [FisicoController::class, 'update'])->name('fisico.update');
    Route::post('/pacientes/fisico/{historia}', [FisicoController::class, 'store'])->name('fisico.store');
    Route::delete('/pacientes/fisico/{historia}', [FisicoController::class, 'destroy'])->name('fisico.destroy');
// route Nota Operatoria
    Route::get('/pacientes/nota_operatoria/{historia}', [Nota_operatoriaController::class, 'index'])->name('nota_operatoria.index');
    Route::get('/pacientes/nota_operatoria/{historia}', [Nota_operatoriaController::class, 'create'])->name('nota_operatoria.create');
    Route::get('/pacientes/nota_operatoria/editar/{historia}', [Nota_operatoriaController::class, 'edit'])->name('nota_operatoria.edit');
    Route::put('/historias/actualizar/{historia}', [Nota_operatoriaController::class, 'update'])->name('nota_operatoria.update');
    Route::post('/pacientes/nota_operatoria/{historia}', [Nota_operatoriaController::class, 'store'])->name('nota_operatoria.store');
    Route::delete('/pacientes/nota_operatoria/{historia}', [Nota_operatoriaController::class, 'destroy'])->name('nota_operatoria.destroy');

// route Egreso
    Route::get('/pacientes/egreso/{historia}', [EgresoController::class, 'create'])->name('egreso.create');
    Route::get('/pacientes/nota_opegreso/{historia}', [EgresoController::class, 'edit'])->name('egreso.edit');
    Route::put('/historias/actualizar/{historia}', [EgresoController::class, 'update'])->name('egreso.update');
    Route::post('/pacientes/egreso/{historia}', [EgresoController::class, 'store'])->name('egreso.store');
    Route::delete('/pacientes/egreso/{historia}', [EgresoController::class, 'destroy'])->name('egreso.destroy');
//Pdf

Route::prefix('pacientes/reportes/pdf_pacientes')->group(function () {
    Route::get('pacientes/reportes/pdf_pacientes', [PacientePdfController::class, 'pdf_pacientes'])->name('pacientes.reportes.pdf_pacientes');
    Route::get('/generar', [PacientePdfController::class, 'generatePdf'])->name('pacientes.reportes.pdf_pacientes');

Route::middleware(['auth'])->group(function () {
Route::get('/pacientes/reportes/pdf_diagnosticos', [DiagnosticoController::class, 'generarReporte']) ->name('pacientes.reportes.pdf_diagnosticos');
Route::get('pacientes/reportes/medicos', [ReporteMedicosController::class, 'generarPDF'])->name('pacientes.reportes.medicos');;
});
});
// Rutas para informe médico editable y PDF personalizado

Route::get('/pacientes/reposo', function () {
    return view('reposo');
})->name('pacientes.reportes.reposo');

Route::get('/respaldo-bdd', [RespaldoController::class, 'descargar'])->name('respaldo.bdd');
Route::post('/pacientes/solicitud_laboratorio_pdf', [SolicitudLaboratorioController::class, 'generarPDF'])->name('pacientes.solicitud_laboratorio_pdf');

// Buscar paciente por cédula o historia clínica (para AJAX desde solicitud laboratorio)
Route::post('/buscar-paciente', [PacienteController::class, 'buscarPacienteAjax'])->name('pacientes.buscar_paciente_ajax');

// Rutas para imágenes y documentos foráneos
Route::get('/pacientes/foraneas', [PacienteController::class, 'foraneas'])->name('pacientes.foraneas');
Route::post('/pacientes/foraneas/guardar', [ForaneasController::class, 'guardar'])->name('foraneas.guardar');
Route::delete('/pacientes/foraneas/eliminar/{id}', [ForaneasController::class, 'eliminar'])->name('foraneas.eliminar');

// Reporte avanzado de pacientes atendidos
Route::get('/reportes/pacientes-atendidos', [ReporteController::class, 'pacientesAtendidos'])->name('reportes.pacientes_atendidos');
Route::get('/reportes/pacientes-atendidos/pdf', [ReporteController::class, 'pacientesAtendidosPdf'])->name('reportes.pacientes_atendidos.pdf');

// Rutas para Reporte de Enfermería
Route::middleware('auth')->group(function () {
     Route::get('reporte-enfermeria/buscar', [ReporteEnfermeriaController::class, 'buscar'])->name('reporte_enfermeria.buscar');
    Route::get('/reporte-enfermeria', [App\Http\Controllers\ReporteEnfermeriaController::class, 'index'])->name('reporte_enfermeria.index');
    Route::get('/reporte-enfermeria/crear', [ReporteEnfermeriaController::class, 'create'])->name('reporte_enfermeria.create');
    Route::post('/reporte-enfermeria', [ReporteEnfermeriaController::class, 'store'])->name('reporte_enfermeria.store');
});

// Rutas para CRUD de reportes de enfermería
Route::resource('reporte_enfermeria', App\Http\Controllers\ReporteEnfermeriaController::class);
Route::get('pacientes/{paciente}/reportes', [ReporteEnfermeriaController::class, 'reportesPorPaciente'])    ->name('pacientes.reporte');

// Ruta para dar de alta a un paciente desde la vista de reporte de enfermería
Route::patch('/pacientes/{paciente}/dar-alta', [App\Http\Controllers\PacienteController::class, 'darAlta'])->name('pacientes.dar_alta');

require __DIR__.'/auth.php';