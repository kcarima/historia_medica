<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use Illuminate\Http\Request;

class PacienteController extends Controller
{
    // Mostrar listado de pacientes
    public function index()
    {
        $pacientes = Paciente::all(); //->orderBy('historia', 'desc');
        return view('pacientes.index', compact('pacientes'));
    }

    // Mostrar formulario para crear paciente
   public function create()
    {
      return view('pacientes.create');
    }


    // Almacenar paciente nuevo
    public function store(Request $request)
   {
    // Validar datos (sin historia porque la generaremos)
    $request->validate([
        'primer_apellido' => 'required|string|max:255',
        'segundo_apellido' => 'nullable|string|max:255',
        'nombre' => 'required|string|max:255',
        'fecha_nacimiento' => 'required|date',
        'telefono_local' => 'nullable|string|max:20',
        'celular' => 'nullable|string|max:20',
        'direccion' => 'nullable|string|max:255',
        // otros campos que tengas
    ]);

    // Obtener el último número de historia registrado
    $ultimoPaciente = Paciente::orderBy('historia', 'desc')->first();

    if ($ultimoPaciente && is_numeric($ultimoPaciente->historia)) {
        $nuevoNumeroHistoria = intval($ultimoPaciente->historia) + 1;
    } else {
        $nuevoNumeroHistoria = 1; // o el número con el que quieras empezar
    }

    // Crear nuevo paciente con el número de historia generado
    $paciente = Paciente::create(array_merge(
        $request->all(),
        ['historia' => str_pad($nuevoNumeroHistoria, 6, '0', STR_PAD_LEFT)] // ejemplo: 000001
    ));

    return redirect()->route('pacientes.edit',$paciente->historia)->with('success', 'Paciente guardado correctamente con historia #' . $paciente->historia);
}

    // Mostrar detalle del paciente
    public function show($id)
{
    $paciente = Paciente::findOrFail($id);
    return view('pacientes.show', compact('paciente'));
}

    // Mostrar formulario para editar paciente
  public function edit($historia)
{
    $paciente = Paciente::where('historia', $historia)->firstOrFail();
    return view('pacientes.edit', compact('paciente'));
}

public function update(Request $request, $id)
{
    // Buscar paciente por ID o fallar si no existe
    $paciente = Paciente::findOrFail($id);

    // Validar los datos recibidos del formulario
    $validatedData = $request->validate([
        'genero' => 'required|string|max:20',
        'primer_apellido' => 'required|string|max:255',
        'segundo_apellido' => 'nullable|string|max:255',
        'nombre' => 'required|string|max:255',
        'historia' => 'required|string|max:255',
        'cedula' => 'nullable|string|max:50',
        'telefono_local' => 'nullable|string|max:50',
        'grupo_sanguineo' => 'nullable|string|max:10',
        'estado_civil' => 'nullable|string|max:50',
        'fecha_nacimiento' => 'required|date',
        'correo_electronico' => 'nullable|email|max:255',
        'celular' => 'nullable|string|max:50',
        'edad' => 'nullable|integer',
        'direccion' => 'nullable|string|max:255',
        'municipio' => 'nullable|string|max:100',
        'parroquia' => 'nullable|string|max:100',
        // Agrega aquí otros campos que tengas en el formulario
    ]);

    // Actualizar el paciente con los datos validados
    $paciente->update($validatedData);

    // Redireccionar con mensaje de éxito
    return redirect()->route('pacientes.index')->with('success', 'Paciente actualizado correctamente.');
}




    // Eliminar paciente
    public function destroy(Paciente $paciente)
    {
        $paciente->delete();

        return redirect()->route('pacientes.index')->with('success', 'Paciente eliminado correctamente.');
    }
    public function historia()
{
    // Lógica para mostrar la historia médica o lo que necesites
    return view('pacientes.historia'); // o la vista que corresponda
}
public function editPorHistoria($historia)
{
    $paciente = Paciente::where('historia', $historia)->firstOrFail();

    // Cargar la vista ubicada en pacientes/create/edit.blade.php
    return view('pacientes.edit', compact('paciente'));
}
public function guardarHistoriaMedica(Request $request) {
    // Lógica para guardar la historia médica
    return response()->json(['success' => true]);
}

}

