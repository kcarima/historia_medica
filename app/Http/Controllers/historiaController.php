<?php

namespace App\Http\Controllers;

use App\Models\Historia;
use App\Models\Paciente;
use Illuminate\Http\Request;

class HistoriaController extends Controller
{
    // Mostrar formulario de edición por id
    public function edit($historia)
    {
        $historia = Historia::findOrFail('historia',$historia);
        return view('pacientes.historia.edit', compact(var_name: 'historia'));
    }

    // Actualizar historia
    public function update(Request $request, $id)
    {
        $request->validate([
            'historia' => 'required|string',
            'fecha_atencion' => 'required|date',
            'motivo_consulta' => 'required|string',
        ]);

        $historia = Historia::findOrFail($id);
        $historia->update($request->only('historia', 'fecha_atencion', 'motivo_consulta'));

        return redirect()->route('historias.index')->with('success', 'Historia actualizada correctamente.');
    }

    // Mostrar formulario de creación con número de historia (pasado como parámetro)
    public function create($historia)
    {
        // Puedes pasar el número de historia por query string o por parámetro
        $paciente = Paciente::where('historia', $historia)->firstOrFail();
        return view('pacientes.historia.create', compact('paciente'));
        //return view('pacientes.historia.create'); //, compact(var_name: $historia));
    }

    // Guardar nueva historia
    public function store(Request $request)
    {
        $request->validate([
            'historia' => 'required|string',
            'fecha_atencion' => 'required|date',
            'motivo_consulta' => 'required|string',
        ]);

        Historia::create($request->only('historia', 'fecha_atencion', 'motivo_consulta'));

        return redirect()->route('historias.index')->with('success', 'Historia creada correctamente.');
    }
}
