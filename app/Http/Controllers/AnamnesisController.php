<?php

namespace App\Http\Controllers;

use App\Models\Anamnesis;
use App\Models\Paciente;
use Illuminate\Http\Request;

class AnamnesisController extends Controller
{
    public function create($historia)
    {
        $paciente = Paciente::where('historia', $historia)->firstOrFail();
        return view('pacientes.anamnesis.create', compact('paciente'));
    }

    public function store(Request $request, $historia)
    {
        // Validación de datos
        $validated = $request->validate([
            'enfermedad_actual' => 'nullable|string',
            'desarrollo_psicomotor' => 'nullable|string',
            'alimentacion' => 'nullable|string',
            'sueno' => 'nullable|string',
            'eliminacion' => 'nullable|string',
            'vacunacion' => 'nullable|string',
            'alergias' => 'nullable|string',
            'habitos' => 'nullable|string',
            'enfermedades_previas' => 'nullable|string',
            'cirugias' => 'nullable|string',
            'hospitalizaciones' => 'nullable|string',
            'traumatismos' => 'nullable|string',
            'congénitas_perinatales' => 'nullable|string',
            'enfermedades_padres' => 'nullable|array',
            'otra_enfermedad_padres' => 'nullable|string',
            'hermanos' => 'nullable|string',
            'detalle_hermanos' => 'nullable|string',
            'observaciones' => 'nullable|string',
            'menarquia' => 'nullable|string',
            'ciclo_menstrual' => 'nullable|string',
            'duracion_menstrual' => 'nullable|string',
            'dolor_menstrual' => 'nullable|string',
            'embarazos' => 'nullable|integer',
            'partos' => 'nullable|integer',
            'abortos' => 'nullable|integer',
            'cesareas' => 'nullable|integer',
            'metodo_anticonceptivo' => 'nullable|string',
            'fecha_ultima_menstruacion' => 'nullable|date',
            'fecha_ultimo_parto' => 'nullable|date',
            'complicaciones_embarazo' => 'nullable|string',
        ]);

        // Aseguramos que el campo historia esté presente
        $validated['historia'] = $historia;

        // Convertir enfermedades_padres a JSON si existe
        if ($request->has('enfermedades_padres')) {
            $validated['enfermedades_padres'] = json_encode($request->enfermedades_padres);
        }

        try {
            Anamnesis::create($validated);

            return redirect()->route('fisico.create', $historia)
                ->with('success', 'Anamnesis guardada correctamente');
        } catch (\Exception $e) {
            return back()
                ->withErrors('Error al guardar: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function show($id)
    {
        $anamnesis = Anamnesis::findOrFail($id);
        return view('anamnesis.show', compact('anamnesis'));
    }

    public function edit($id)
    {
        $anamnesis = Anamnesis::findOrFail($id);
        $paciente = Paciente::where('historia', $anamnesis->historia)->first();
        return view('anamnesis.edit', compact('anamnesis', 'paciente'));
    }

    public function update(Request $request, $id)
    {
        $anamnesis = Anamnesis::findOrFail($id);

        $validated = $request->validate([
            'enfermedad_actual' => 'nullable|string',
            'desarrollo_psicomotor' => 'nullable|string',
            'alimentacion' => 'nullable|string',
            'sueno' => 'nullable|string',
            'eliminacion' => 'nullable|string',
            'vacunacion' => 'nullable|string',
            'alergias' => 'nullable|string',
            'habitos' => 'nullable|string',
            'enfermedades_previas' => 'nullable|string',
            'cirugias' => 'nullable|string',
            'hospitalizaciones' => 'nullable|string',
            'traumatismos' => 'nullable|string',
            'congénitas_perinatales' => 'nullable|string',
            'enfermedades_padres' => 'nullable|array',
            'otra_enfermedad_padres' => 'nullable|string',
            'hermanos' => 'nullable|string',
            'detalle_hermanos' => 'nullable|string',
            'observaciones' => 'nullable|string',
            'menarquia' => 'nullable|string',
            'ciclo_menstrual' => 'nullable|string',
            'duracion_menstrual' => 'nullable|string',
            'dolor_menstrual' => 'nullable|string',
            'embarazos' => 'nullable|integer',
            'partos' => 'nullable|integer',
            'abortos' => 'nullable|integer',
            'cesareas' => 'nullable|integer',
            'metodo_anticonceptivo' => 'nullable|string',
            'fecha_ultima_menstruacion' => 'nullable|date',
            'fecha_ultimo_parto' => 'nullable|date',
            'complicaciones_embarazo' => 'nullable|string',
        ]);

        if ($request->has('enfermedades_padres')) {
            $validated['enfermedades_padres'] = json_encode($request->enfermedades_padres);
        }

        $anamnesis->update($validated);

        return redirect()->route('anamnesis.show', $anamnesis->id)
            ->with('success', 'Anamnesis actualizada correctamente');
    }

    public function destroy($id)
    {
        $anamnesis = Anamnesis::findOrFail($id);
        $historia = $anamnesis->historia;
        $anamnesis->delete();

        return redirect()->route('pacientes.show', $historia)
            ->with('success', 'Anamnesis eliminada correctamente');
    }
}
