<?php

namespace App\Http\Controllers;

use App\Models\anamnesis;
use Illuminate\Http\Request;

class AnamnesisController extends Controller
{
    public function index()
    {
        $anamnesis = Anamnesis::all();
        return view('pacientes.anamnesis.index', compact('anamnesis'));
    }

    public function create()
    {
        return view('pacientes.anamnesis.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'enfermedad_actual' => 'required|string',
        ]);

        Anamnesis::create($request->all());

        return redirect()->route('pacientes.anamnesis.index')->with('success', 'Anamnesis creada correctamente.');
    }

    public function show(Anamnesis $anamnesi)
    {
        return view('pacientes.anamnesis.show', compact('anamnesi'));
    }

    public function edit(Anamnesis $anamnesi)
    {
        return view('pacientes.anamnesis.edit', compact('anamnesi'));
    }

    public function update(Request $request, Anamnesis $anamnesi)
    {
        $request->validate([
            'enfermedad_actual' => 'required|string',
        ]);

        $anamnesi->update($request->all());

        return redirect()->route('pacientes.anamnesis.index')->with('success', 'Anamnesis actualizada correctamente.');
    }

    public function destroy(Anamnesis $anamnesi)
    {
        $anamnesi->delete();

        return redirect()->route('pacientes.anamnesis.index')->with('success', 'Anamnesis eliminada correctamente.');
    }
}
