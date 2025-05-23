<?php

use App\Http\Controllers\PacienteController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/login', function () {
    //return view('welcome');
    return view('auth.login');
});

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/paciente', [PacienteController::class, 'index'])->name('historia');
    Route::get('/pacientes/create', [PacienteController::class, 'create'])->name('pacientes.create');
    Route::get('/pacientes/historia', [PacienteController::class, 'historia'])->name('pacientes.historia');
    Route::get('/pacientes/nota_operatoria', [PacienteController::class, 'nota_operatoria'])->name('pacientes.nota_operatoria');
    Route::get('/pacientes/imagenologia', [PacienteController::class, 'imagenologia'])->name('pacientes.imagenologia');
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
});
require __DIR__.'/auth.php';