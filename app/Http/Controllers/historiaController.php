<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\Historia;
use App\Models\Paciente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Importación necesaria
use Illuminate\Support\Facades\Log; // Para el logging de errores
use Barryvdh\DomPDF\Facade\Pdf; // Importación correcta
use Illuminate\Support\Facades\Auth;

class HistoriaController extends Controller
{
    /**
     * Mostrar listado paginado de historias con su paciente relacionado.
     */
    public function index()
    {
        $historias = Historia::with('paciente')->latest()->paginate(10);
        return view('historia.index', compact('historias'));
    }

    /**
     * Mostrar formulario para crear una nueva historia para un paciente dado.
     */
    public function create($historia)
    {
        $paciente = Paciente::where('historia', $historia)->firstOrFail();
        return view('pacientes.historia.create', compact('paciente'));
    }

    /**
     * Guardar una nueva historia médica en la base de datos.
     */
public function store(Request $request)
{
    // Validación robusta de todos los campos, incluyendo reposo
    $validated = $request->validate([
        'paciente_id' => 'required|exists:pacientes,id',
        'fecha_atencion' => 'required|date',
        'motivo_consulta' => 'required|string|max:2000',
        'diagnostico' => 'nullable|string|max:2000',
        'plan_tratamiento' => 'nullable|string|max:2000',
        'tratamiento_farmacologico' => 'nullable|string|max:2000',
        'ordenes_examenes' => 'nullable|string|max:2000',
        'evolucion' => 'nullable|string|max:2000',
        'interconsultas' => 'nullable|string|max:2000',
        'observaciones' => 'nullable|string|max:2000',
        'fecha_reposo_desde' => 'nullable|date',
        'fecha_reposo_hasta' => 'nullable|date|after_or_equal:fecha_reposo_desde',
        'dias_reposo' => 'nullable|integer|min:1|max:21',
    ]);

    try {
        DB::beginTransaction();

        // Obtener el paciente para tomar su número de historia
        $paciente = Paciente::findOrFail($validated['paciente_id']);

        // Creación de la historia clínica con todos los campos, incluyendo reposo
        $historia = Historia::create([
            'paciente_id' => $validated['paciente_id'],
            'fecha_atencion' => $validated['fecha_atencion'],
            'motivo_consulta' => $validated['motivo_consulta'],
            'diagnostico' => $validated['diagnostico'] ?? null,
            'plan_tratamiento' => $validated['plan_tratamiento'] ?? null,
            'tratamiento_farmacologico' => $validated['tratamiento_farmacologico'] ?? null,
            'ordenes_examenes' => $validated['ordenes_examenes'] ?? null,
            'evolucion' => $validated['evolucion'] ?? null,
            'interconsultas' => $validated['interconsultas'] ?? null,
            'observaciones' => $validated['observaciones'] ?? null,
            'historia' => $paciente->historia,
            'medico_id' => auth()->id(),
            'estado' => 'activa',
            'fecha_reposo_desde' => $validated['fecha_reposo_desde'] ?? null,
            'fecha_reposo_hasta' => $validated['fecha_reposo_hasta'] ?? null,
            'dias_reposo' => $validated['dias_reposo'] ?? null,
        ]);

        DB::commit();

        return redirect()
               ->route('historias.show', $historia->id)
               ->with('success', 'Historia clínica creada correctamente');

    } catch (\Exception $e) {
        DB::rollBack();
        Log::error('Error al crear historia clínica: '.$e->getMessage(), [
            'request' => $request->all(),
            'user_id' => auth()->id()
        ]);

        return back()
               ->withInput()
               ->with('error', 'Error al crear la historia clínica. Por favor intente nuevamente.');
    }
}
    public function show($id)
    {
        $historia = Historia::with('paciente')->findOrFail($id);
        return view('historias.show', compact('historia'));
    }

    /**
     * Mostrar formulario para editar una historia médica.
     */
    public function edit($id)
    {
        $historia = Historia::with('paciente')->findOrFail($id);
        return view('historia.edit', compact('historia'));
    }

    /**
     * Actualizar una historia médica existente.
     */
    public function update(Request $request, $historia)
    {
        $historia = Historia::findOrFail($historia);

        $validated = $request->validate([
            'fecha_atencion' => 'required|date',
            'motivo_consulta' => 'required|string|max:1000',
            'diagnostico' => 'nullable|string|max:255',
            'plan_tratamiento' => 'nullable|string|max:2000',
            'tratamiento_farmacologico' => 'nullable|string|max:1000',
            'ordenes_examenes' => 'nullable|string|max:1000',
            'evolucion' => 'nullable|string|max:1000',
            'interconsultas' => 'nullable|string|max:1000',
            'observaciones' => 'nullable|string|max:1000',
        ]);

        $historia->update($validated);

        return redirect()->route('historia.show', $historia->id)
            ->with('success', 'Historia médica actualizada exitosamente.');
    }

    /**
     * Eliminar una historia médica.
     */
    public function destroy($id)
    {
        $historia = Historia::findOrFail($id);
        $pacienteId = $historia->paciente_id;
        $historia->delete();

        return redirect()->route('pacientes.show', $pacienteId)
            ->with('success', 'Historia médica eliminada exitosamente.');
    }
public function generarPDF($historia = null)
{
    try {
        // Validación del parámetro de entrada
        if (empty($historia)) {
            abort(400, 'Número de historia no proporcionado');
        }

        // Limpiar el parámetro para obtener solo dígitos
        $historia = preg_replace('/[^0-9]/', '', $historia);

        // Validar que el número de historia no esté vacío después de limpieza
        if (empty($historia)) {
            abort(400, 'Número de historia no válido');
        }

        // Buscar al paciente (coincidencia exacta)
        $paciente = Paciente::where('historia', $historia)->first();

        // Si no se encuentra con coincidencia exacta, buscar por LIKE como fallback
        if (!$paciente) {
            $paciente = Paciente::where('historia', 'like', '%'.$historia.'%')->first();

            if (!$paciente) {
                abort(404, 'Paciente no encontrado');
            }
        }

        // Obtener la historia médica más reciente
        $historia_medica = Historia::where('paciente_id', $paciente->id)
                                 ->latest('created_at')
                                 ->first();

        // Preparar datos para la vista
        $data = [
            'paciente' => $paciente,
            'historia' => $historia_medica,
            'fecha' => now()->format('d/m/Y'),
            'hora' => now()->format('H:i'),
            'formatted_historia' => 'H-'.str_pad($historia, 6, '0', STR_PAD_LEFT)
        ];

        // Generar PDF
        $pdf = PDF::loadView('pacientes.historia.pdf', $data);

        return $pdf->stream('historia-clinica-'.$historia.'-'.now()->format('Ymd').'.pdf');

    } catch (\Exception $e) {
        Log::error('Error al generar PDF de historia clínica: '.$e->getMessage());
        abort(500, 'Ocurrió un error al generar el documento');
    }
}

public function mostrarParaImpresion($historia)
{
    try {
        // Validación del parámetro de entrada
        if (empty($historia)) {
            abort(400, 'Número de historia no proporcionado');
        }

        // Limpiar el parámetro para obtener solo dígitos
        $historia = preg_replace('/[^0-9]/', '', $historia);

        // Buscar la historia médica con el paciente asociado
        $historia_medica = Historia::with('paciente')
                                ->whereHas('paciente', function($query) use ($historia) {
                                    $query->where('historia', $historia);
                                })
                                ->latest('created_at')
                                ->firstOrFail();

        return view('pacientes.historia.pdf', [
            'paciente' => $historia_medica->paciente,
            'historia' => $historia_medica,
            'fecha' => now()->format('d/m/Y'),
            'hora' => now()->format('H:i'),
            'formatted_historia' => 'H-'.str_pad($historia, 6, '0', STR_PAD_LEFT)
        ]);

    } catch (\Exception $e) {
        Log::error('Error al mostrar historia para impresión: '.$e->getMessage());
        abort(404, 'Historia clínica no encontrada');
    }
}
public static function generarNumeroHistoria()
{
    $ultimoNumero = self::max('historia'); // Usando Eloquent
    return str_pad((int)$ultimoNumero + 1, 6, '0', STR_PAD_LEFT);
}


    public function generarReposoPDF($historia = null)
{
    try {
        // Validación de entrada
        throw_if(empty($historia), \Exception::class, 'Historia no proporcionada', 400);

        $historia = preg_replace('/[^0-9]/', '', $historia);
        throw_if(empty($historia), \Exception::class, 'Historia inválida', 400);

        // Búsqueda del paciente
        $paciente = Paciente::where('historia', $historia)
                          ->orWhere('historia', 'LIKE', "%$historia%")
                          ->firstOrFail();

        // Obtener historia médica
        $historia_medica = Historia::with('paciente')
                                 ->where('paciente_id', $paciente->id)
                                 ->latest()
                                 ->firstOrFail();

        // Preparar datos
        $data = [
            'paciente' => $paciente,
            'historia' => $historia_medica,
            'fecha' => now()->format('d/m/Y'),
            'medico' => auth()->user()->name,
            'cmp' => auth()->user()->crm ?? 'N/A',
            'especialidad' => auth()->user()->especialidad ?? 'General',
            'fecha_reposo_desde' => Carbon::parse($historia_medica->fecha_reposo_desde ?? now())->format('d/m/Y'),
            'fecha_reposo_hasta' => Carbon::parse($historia_medica->fecha_reposo_hasta ?? now()->addDays(5))->format('d/m/Y')
        ];

        // Debug: Ver datos (descomentar temporalmente)
        // dd($data);

        // Generar PDF
        return PDF::loadView('pacientes.historia.reposo', $data)
               ->setPaper('letter')
               ->setOption('enable_php', true)
               ->stream("reposo_{$paciente->cedula}.pdf");

    } catch (ModelNotFoundException $e) {
        Log::error("Recurso no encontrado: ".$e->getMessage());
        return response()->json(['error' => 'Recurso no encontrado'], 404);
    } catch (\Exception $e) {
        Log::error("Error PDF: ".$e->getMessage());
        return response()->json([
            'error' => 'Error al generar PDF',
            'debug' => env('APP_DEBUG') ? $e->getMessage() : null
        ], 500);
    }
}

public function generarInformeMedicoPDFPersonalizado(Request $request, $historia)
{
    $paciente = Paciente::where('historia', $historia)->firstOrFail();
    $fecha = now()->format('d/m/Y');
    $medico = Auth::user()->name ?? 'Nombre del Médico';
    $cmp = Auth::user()->crm ?? '';
    $especialidad = Auth::user()->especialidad ?? '';

    // Buscar el examen físico relacionado a la historia
    $fisico = \App\Models\Fisico::where('historia', $historia)->latest()->first();

    $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pacientes.historia.informeMedico', [
        'paciente' => $paciente,
        'fecha' => $fecha,
        'motivo_resumido' => $request->motivo_resumido,
        'hallazgos_clinicos' => $request->hallazgos_clinicos,
        'diagnostico' => $request->diagnostico,
        'recomendaciones' => $request->recomendaciones,
        'medico' => $medico,
        'cmp' => $cmp,
        'especialidad' => $especialidad,
        'fisico' => $fisico,
    ]);
    return $pdf->stream('informe_medico_'.$paciente->historia.'.pdf');
}

public function generarInformeMedicoPDF($historia = null)
{
    try {
        if (empty($historia)) {
            abort(400, 'Número de historia no proporcionado');
        }
        $historia = preg_replace('/[^0-9]/', '', $historia);
        if (empty($historia)) {
            abort(400, 'Número de historia no válido');
        }
        $paciente = Paciente::where('historia', $historia)->first();
        if (!$paciente) {
            $paciente = Paciente::where('historia', 'like', '%'.$historia.'%')->first();
            if (!$paciente) {
                abort(404, 'Paciente no encontrado');
            }
        }
        $historia_medica = Historia::where('paciente_id', $paciente->id)
            ->latest('created_at')
            ->first();
        if (!$historia_medica) {
            abort(404, 'Historia médica no encontrada para este paciente');
        }
        $motivo_resumido = $historia_medica->motivo_consulta;
        $diagnostico = $historia_medica->diagnostico;
        $hallazgos_clinicos = $historia_medica->hallazgos_clinicos ?? '';
        $recomendaciones = $historia_medica->recomendaciones ?? '';
        $fecha = now()->format('d/m/Y');
        $medico = Auth::user()->name ?? 'Nombre del Médico';
        $cmp = Auth::user()->crm ?? '';
        $especialidad = Auth::user()->especialidad ?? '';
        // Buscar el examen físico relacionado a la historia
        $fisico = \App\Models\Fisico::where('historia', $historia)->latest()->first();
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pacientes.historia.informeMedico', [
            'paciente' => $paciente,
            'motivo_resumido' => $motivo_resumido,
            'diagnostico' => $diagnostico,
            'hallazgos_clinicos' => $hallazgos_clinicos,
            'recomendaciones' => $recomendaciones,
            'fecha' => $fecha,
            'medico' => $medico,
            'cmp' => $cmp,
            'especialidad' => $especialidad,
            'fisico' => $fisico,
        ]);
        return $pdf->stream('informe_medico_'.$paciente->historia.'.pdf');
    } catch (\Exception $e) {
        \Log::error('Error al generar informe médico PDF: '.$e->getMessage());
        abort(500, 'Ocurrió un error al generar el informe médico');
    }
}
// Cierre de la clase HistoriaController
}
