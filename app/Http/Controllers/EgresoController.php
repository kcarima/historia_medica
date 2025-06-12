<?php

namespace App\Http\Controllers;
use App\Models\Egreso;
use App\Models\Paciente;
use Illuminate\Http\Request;

class EgresoController extends Controller
{
    // Listar egresos
    public function index()
    {
        $egresos = Egreso::all();
        return view('pacientes.egreso.index', compact('egresos'));
    }

    // Formulario para crear egreso
    public function create($historia)
    {
        $paciente = Paciente::where('historia', $historia)->firstOrFail();
        return view('pacientes.egreso.create', compact('paciente'));
    }

    // Guardar egreso (crea o actualiza si ya existe)
    public function store(Request $request, $historia)
    {
        $data = $request->validate([
            'diagnostico_egreso' => 'required|string',
            'recomendaciones_seguimiento' => 'nullable|string',
        ]);

        // Si ya existe un egreso para esa historia, lo actualiza
        $egreso = Egreso::updateOrCreate(
            ['historia' => $historia],
            [
                'diagnostico_egreso' => $data['diagnostico_egreso'],
                'recomendaciones_seguimiento' => $data['recomendaciones_seguimiento'] ?? null,
            ]
        );

        return redirect()->route('pacientes.index')->with('success', 'Egreso registrado correctamente.');
    }

    // Mostrar egreso
    public function show($historia)
    {
        $egreso = Egreso::where('historia', $historia)->firstOrFail();
        return view('pacientes.egreso.show', compact('egreso'));
    }

    // Formulario para editar egreso
    public function edit($historia)
    {
        $egreso = Egreso::where('historia', $historia)->firstOrFail();
        return view('pacientes.egreso.edit', compact('egreso'));
    }

    // Actualizar egreso
    public function update(Request $request, $historia)
    {
        $egreso = Egreso::where('historia', $historia)->firstOrFail();

        $data = $request->validate([
            'diagnostico_egreso' => 'required|string',
            'recomendaciones_seguimiento' => 'nullable|string',
        ]);

        $egreso->update($data);

        return redirect()->route('pacientes.egreso.index')->with('success', 'Egreso actualizado correctamente.');
    }

    // Eliminar egreso
    public function destroy($historia)
    {
        $egreso = Egreso::where('historia', $historia)->firstOrFail();
        $egreso->delete();

        return redirect()->route('pacientes.egreso.index')->with('success', 'Egreso eliminado correctamente.');
    }
}
