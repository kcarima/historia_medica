<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Models\Nota_operatoria;
use Illuminate\Http\Request;

class Nota_operatoriaController extends Controller
{
    // Listar notas operatorias
    public function index()
    {
        $notas = Nota_operatoria::with('paciente')->paginate(10);
        return view('nota_operatoria.index', compact('notas'));
    }

    // Formulario para crear una nota operatoria
    public function create($historia)
    {
        $paciente = Paciente::where('historia', $historia)->firstOrFail();
        return view('pacientes.nota_operatoria.create', compact('paciente'));
    }

    // Guardar nota operatoria
    public function store(Request $request, $historia)
    {
        $request->validate([
            'nota' => 'required|string',
        ]);

        $paciente = Paciente::where('historia', $historia)->firstOrFail();

        // Buscar la historia clínica más reciente del paciente
        $historiaClinica = $paciente->historias()->latest()->first();

        if (!$historiaClinica) {
            return back()->with('error', 'El paciente no tiene historia clínica registrada.');
        }

        $notaOperatoria = new Nota_operatoria();
        $notaOperatoria->historia = $paciente->historia;
        $notaOperatoria->historia_id = $historiaClinica->id; // Relación correcta con la tabla historias
        $notaOperatoria->nota = $request->nota;
        $notaOperatoria->save();

        // Redirige pasando el parámetro historia
        return redirect()->route('nota_operatoria.create', ['historia' => $paciente->historia])
            ->with('success', 'Nota operatoria guardada correctamente.');
    }

    // Formulario para editar una nota operatoria
    public function edit($id)
    {
        $nota = Nota_operatoria::findOrFail($id);
        return view('nota_operatoria.edit', compact('nota'));
    }

    // Actualizar nota operatoria
    public function update(Request $request, $id)
    {
        $request->validate([
            'nota' => 'required|string',
        ]);

        $nota = Nota_operatoria::findOrFail($id);
        $nota->nota = $request->nota;
        $nota->save();

        return redirect()->route('nota_operatoria.index')->with('success', 'Nota operatoria actualizada correctamente.');
    }

    // Eliminar nota operatoria
    public function destroy($id)
    {
        $nota = Nota_operatoria::findOrFail($id);
        $nota->delete();

        return redirect()->route('nota_operatoria.index')->with('success', 'Nota operatoria eliminada correctamente.');
    }
}

