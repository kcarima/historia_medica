<?php
// app/Http/Controllers/FisicoController.php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Models\Fisico;
use Illuminate\Http\Request;

class FisicoController extends Controller
{
    public function index()
    {
        $fisicos = Fisico::paginate(10);
        return view('fisico.index', compact('fisico'));
    }

    public function create($historia)
    {
        $paciente = Paciente::where('historia', $historia)->firstOrFail();
        return view('pacientes.fisico.create', compact('paciente'));
    }

    public function store(Request $request, $historia)
{
    // $validated = $request->validate([...]);

    $data = $request->all(); // Sin validar para probar

    $examenFisico = new Fisico();
    $examenFisico->historia = $historia;
    $examenFisico->presion_arterial = $data['presion_arterial'];
    $examenFisico->frecuencia_cardiaca = $data['frecuencia_cardiaca'];
    $examenFisico->frecuencia_respiratoria = $data['frecuencia_respiratoria'];
    $examenFisico->temperatura = $data['temperatura'];
    $examenFisico->saturacion_oxigeno = $data['saturacion_oxigeno'];
    $examenFisico->peso = $data['peso'];
    $examenFisico->talla = $data['talla'];
    $examenFisico->examen_general = $data['examen_general'] ?? null;
    $examenFisico->examen_por_sistemas = $data['examen_por_sistemas'] ?? null;

    $examenFisico->save();

    return redirect()->route('pacientes.index')
                     ->with('success', 'Examen físico registrado correctamente.');
}

    public function edit(Fisico $fisico)
    {
        return view('pacientes.fisico.edit', compact('fisico'));
    }

    public function update(Request $request, Fisico $fisico)
    {
        $validated = $request->validate([
            'historia' => 'required|string',
            'presion_arterial' => 'nullable|string',
            'frecuencia_cardiaca' => 'nullable|integer',
            'frecuencia_respiratoria' => 'nullable|integer',
            'temperatura' => 'nullable|numeric',
            'saturacion_oxigeno' => 'nullable|integer',
            'peso' => 'nullable|numeric',
            'talla' => 'nullable|numeric',
            'examen_general' => 'nullable|string',
            'examen_por_sistemas' => 'nullable|string',
        ]);

        $fisico->update($validated);

        return redirect()->route('fisico.index')->with('success', 'Registro físico actualizado correctamente.');
    }

    public function destroy(Fisico $fisico)
    {
        $fisico->delete();
        return redirect()->route('fisico.index')->with('success', 'Registro físico eliminado correctamente.');
    }
}
