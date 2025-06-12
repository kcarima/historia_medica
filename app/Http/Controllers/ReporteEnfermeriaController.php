<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReporteEnfermeria;
use App\Models\Paciente;
use App\Models\Historia;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ReporteEnfermeriaController extends Controller
{
    public function index(Request $request)
    {
        $highlight = $request->input('highlight');

        $subquery = ReporteEnfermeria::selectRaw('MAX(id) as max_id')
            ->groupBy('historia_id');

        $reportes = ReporteEnfermeria::with(['paciente', 'enfermera', 'historia'])
            ->whereIn('id', $subquery->pluck('max_id'))
            ->whereHas('paciente', function($q) {
                $q->where('de_alta', false);
            });

        if ($request->filled('buscar')) {
            $buscar = $request->input('buscar');
            $reportes = $reportes->where(function($q) use ($buscar) {
                $q->whereHas('paciente', function($q2) use ($buscar) {
                    $q2->where('nombre', 'like', "%$buscar%")
                       ->orWhere('cedula', 'like', "%$buscar%");
                })->orWhere('reporte', 'like', "%$buscar%");
            });
        }

        $reportes = $reportes->orderBy('fecha', 'desc')->get();

        return view('reporte_enfermeria.index', compact('reportes', 'highlight'));
    }

    public function create(Request $request)
    {
        $pacientes = collect();
        $busqueda = $request->input('buscar');
        $error = null;

        if ($busqueda) {
            $pacientes = Paciente::where('cedula', $busqueda)
                ->orWhere('historia', $busqueda)
                ->with('historias')
                ->get();

            if ($pacientes->isEmpty()) {
                $error = 'Paciente no existe.';
            }
        }

        return view('reporte_enfermeria.create', compact('pacientes', 'busqueda', 'error'));
    }

    public function store(Request $request)
    {
        $messages = [
            'paciente_id.required' => 'El paciente es obligatorio.',
            'paciente_id.exists' => 'El paciente seleccionado no existe.',
            'enfermera_id.required' => 'La enfermera es obligatoria.',
            'enfermera_id.exists' => 'La enfermera seleccionada no existe.',
            'historia_id.required' => 'La historia clínica es obligatoria.',
            'historia_id.exists' => 'La historia clínica seleccionada no existe.',
            'fecha.required' => 'La fecha es obligatoria.',
            'fecha.date' => 'La fecha no es una fecha válida.',
            'reporte.required' => 'El reporte es obligatorio.',
            'reporte.string' => 'El reporte debe ser un texto válido.',
            'reporte.min' => 'El reporte debe tener al menos :min caracteres.',
        ];

        $validator = Validator::make($request->all(), [
            'paciente_id' => 'required|exists:pacientes,id',
            'enfermera_id' => 'required|exists:users,id',
            'historia_id' => 'required|exists:historias,id',
            'fecha' => 'required|date',
            'reporte' => 'required|string|min:10',
        ], $messages);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        DB::beginTransaction();

        try {
            $paciente = Paciente::findOrFail($request->paciente_id);

            if ($paciente->de_alta) {
                $paciente->de_alta = false;
                $paciente->save();
            }

            $historia = Historia::findOrFail($request->historia_id);

            $reporte = ReporteEnfermeria::create([
                'paciente_id' => $paciente->id,
                'enfermera_id' => $request->enfermera_id,
                'historia_id' => $request->historia_id,
                'historia' => $historia->historia,
                'fecha' => $request->fecha,
                'reporte' => $request->reporte,
            ]);

            DB::commit();

            return redirect()
                ->route('reporte_enfermeria.index', ['highlight' => $reporte->id])
                ->with('success', 'Reporte guardado correctamente.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()
                ->withInput()
                ->with('error', 'Error al guardar: '.$e->getMessage());
        }
    }
public function edit($id)
{
    // Cargar el reporte original con paciente e historias
    $reporte = ReporteEnfermeria::with(['paciente.historias'])->findOrFail($id);

$reportesMismaHistoria = ReporteEnfermeria::where('historia_id', $reporte->historia_id)
    ->orderBy('id', 'desc')  // Último reporte creado primero
    ->get();
    return view('reporte_enfermeria.edit', [
        'reporte' => $reporte,
        'historias' => $reporte->paciente->historias ?? collect(),
        'reportesMismaHistoria' => $reportesMismaHistoria,
    ]);
}

public function update(Request $request, $id)
{
    $request->validate([
        'historia_id' => 'required|exists:historias,id',
        'fecha' => 'required|date',
        'reporte' => 'required|string|min:10',
    ]);

    // Obtener el reporte original para mantener paciente y enfermera
    $reporteOriginal = ReporteEnfermeria::findOrFail($id);
    $historia = Historia::findOrFail($request->historia_id);

    // Crear un nuevo reporte en lugar de actualizar el existente
    ReporteEnfermeria::create([
        'paciente_id' => $reporteOriginal->paciente_id,
        'enfermera_id' => $reporteOriginal->enfermera_id,
        'historia_id' => $request->historia_id,
        'historia' => $historia->historia,
        'fecha' => $request->fecha,
        'reporte' => $request->reporte,
    ]);

    return redirect()->route('reporte_enfermeria.index')->with('success', 'Nuevo reporte creado correctamente');
}




}
