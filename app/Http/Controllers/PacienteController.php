<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Models\Historia;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class PacienteController extends Controller
{
    // Listar pacientes
    public function index(Request $request)
    {
        $query = Paciente::query();

        if ($request->filled('buscar')) {
            $buscar = $request->input('buscar');
            $query->where(function($q) use ($buscar) {
                $q->where('cedula', 'like', "%{$buscar}%")
                  ->orWhere('nombre', 'like', "%{$buscar}%")
                  ->orWhere('historia', 'like', "%{$buscar}%");
            });
        }

        $pacientes = $query->get();
        return view('pacientes.index', compact('pacientes'));
    }

    // Formulario de creación
    public function create()
    {
        return view('pacientes.create');
    }

    // Guardar paciente nuevo
    public function store(Request $request)
    {
        $hoy = date('Y-m-d');
        $minDate = date('Y-m-d', strtotime('-120 years'));

        $request->validate([
            'primer_apellido' => ['required', 'string', 'max:255', 'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/'],
            'segundo_apellido' => ['nullable', 'string', 'max:255', 'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/'],
            'nombre' => ['required', 'string', 'max:255', 'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/'],
            'cedula' => ['nullable', 'digits_between:5,15', 'unique:pacientes,cedula'],
            'fecha_nacimiento' => ['required', 'date', "before_or_equal:$hoy", "after_or_equal:$minDate"],
            'telefono_local' => 'nullable|string|max:20',
            'celular' => 'nullable|string|max:20',
            'direccion' => 'nullable|string|max:255',
        ], [
            'nombre.regex' => 'El nombre solo puede contener letras y espacios.',
            'primer_apellido.regex' => 'El primer apellido solo puede contener letras y espacios.',
            'segundo_apellido.regex' => 'El segundo apellido solo puede contener letras y espacios.',
            'cedula.digits_between' => 'La cédula debe contener solo números.',
            'cedula.unique' => 'Ya existe un paciente con esa cédula.',
            'fecha_nacimiento.before_or_equal' => 'La fecha de nacimiento no puede ser futura.',
            'fecha_nacimiento.after_or_equal' => 'La fecha de nacimiento no puede ser mayor a 120 años atrás.',
        ]);

        // Generar número de historia
        $ultimoPaciente = Paciente::orderBy('historia', 'desc')->first();
        $nuevoNumeroHistoria = ($ultimoPaciente && is_numeric($ultimoPaciente->historia))
            ? intval($ultimoPaciente->historia) + 1
            : 1;

        $paciente = Paciente::create(array_merge(
            $request->all(),
            ['historia' => str_pad($nuevoNumeroHistoria, 6, '0', STR_PAD_LEFT)]
        ));

        return redirect()->route('pacientes.edit', $paciente->historia)
            ->with('success', 'Paciente guardado correctamente con historia #' . $paciente->historia);
    }

    // Mostrar detalle de paciente
    public function show($id)
    {
        $paciente = Paciente::findOrFail($id);
        return view('pacientes.show', compact('paciente'));
    }

    // Formulario de edición
    public function edit($historia)
    {
        $paciente = Paciente::where('historia', $historia)->firstOrFail();
        return view('pacientes.edit', compact('paciente'));
    }

    // Actualizar paciente
    public function update(Request $request, $id)
    {
        $paciente = Paciente::findOrFail($id);

        $validatedData = $request->validate([
            'genero' => 'required|string|max:20',
            'primer_apellido' => ['required', 'string', 'max:255', 'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/'],
            'segundo_apellido' => ['nullable', 'string', 'max:255', 'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/'],
            'nombre' => ['required', 'string', 'max:255', 'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/'],
            'historia' => 'required|string|max:255',
            'cedula' => ['nullable', 'digits_between:5,15', 'unique:pacientes,cedula,'.$paciente->id],
            'telefono_local' => 'nullable|string|max:50',
            'grupo_sanguineo' => 'nullable|string|max:10',
            'estado_civil' => 'nullable|string|max:50',
            'fecha_nacimiento' => ['required', 'date', "before_or_equal:".date('Y-m-d'), "after_or_equal:".date('Y-m-d', strtotime('-120 years'))],
            'correo_electronico' => 'nullable|email|max:255',
            'celular' => 'nullable|string|max:50',
            'edad' => 'nullable|integer',
            'direccion' => 'nullable|string|max:255',
            'municipio' => 'nullable|string|max:100',
            'parroquia' => 'nullable|string|max:100',
        ], [
            'nombre.regex' => 'El nombre solo puede contener letras y espacios.',
            'primer_apellido.regex' => 'El primer apellido solo puede contener letras y espacios.',
            'segundo_apellido.regex' => 'El segundo apellido solo puede contener letras y espacios.',
            'cedula.digits_between' => 'La cédula debe contener solo números.',
            'cedula.unique' => 'Ya existe un paciente con esa cédula.',
            'fecha_nacimiento.before_or_equal' => 'La fecha de nacimiento no puede ser futura.',
            'fecha_nacimiento.after_or_equal' => 'La fecha de nacimiento no puede ser mayor a 120 años atrás.',
        ]);

        $paciente->update($validatedData);

        return redirect()->route('pacientes.index')->with('success', 'Paciente actualizado correctamente.');
    }

    // Eliminar paciente
    public function destroy(Paciente $paciente)
    {
        $paciente->delete();
        return redirect()->route('pacientes.index')->with('success', 'Paciente eliminado correctamente.');
    }

    // Vistas adicionales
    public function historia()
    {
        return view('pacientes.historia');
    }

    public function editPorHistoria($historia)
    {
        $paciente = Paciente::where('historia', $historia)->firstOrFail();
        return view('pacientes.edit', compact('paciente'));
    }

    public function guardarHistoriaMedica(Request $request)
    {
        return response()->json(['success' => true]);
    }

    // Exportar PDF de listado de pacientes
    public function exportPdf()
    {
        $pacientes = Paciente::all();

        $data = [
            'title' => 'Listado de Pacientes',
            'date' => date('d/m/Y'),
            'pacientes' => $pacientes
        ];

        $pdf = Pdf::loadView('pacientes.pdf_template', $data);

        return $pdf->download('listado_pacientes.pdf');
    }

    // Búsqueda de pacientes
    public function buscar()
    {
        return view('pacientes.historia.buscar');
    }

    public function buscarpaciente(Request $request)
    {
        $request->validate([
            'busqueda' => 'required|string',
        ]);

        $paciente = Paciente::where('cedula', $request->busqueda)
                            ->orWhere('historia', $request->busqueda)
                            ->first();

        if (!$paciente) {
            return back()->with('error', 'No se encontró ningún paciente con ese número de cédula o historia');
        }

        $historias = $paciente->historias()->with('medico')->orderBy('fecha_atencion', 'desc')->get();

        return view('historial.buscar', [
            'paciente' => $paciente,
            'historias' => $historias,
            'busqueda' => $request->busqueda
        ]);
    }

    public function buscarHistorial(Request $request)
    {
        if ($request->isMethod('get')) {
            return view('pacientes.historia.buscar');
        }

        $request->validate([
            'busqueda' => 'required|string|min:3',
            'tipo_busqueda' => 'required|in:historia,cedula'
        ]);

        $paciente = Paciente::where($request->tipo_busqueda, $request->busqueda)->first();

        if (!$paciente) {
            $tipo = $request->tipo_busqueda == 'historia' ? 'historia clínica' : 'cédula';
            return back()
                ->withInput()
                ->with('error', 'No se encontró paciente con el número de '.$tipo.' proporcionado');
        }

        $historias = $paciente->historias()
                            ->with('medico')
                            ->orderByDesc('fecha_atencion')
                            ->paginate(10);

        return view('pacientes.historia.completo', [
            'paciente' => $paciente,
            'historias' => $historias,
            'request' => $request
        ]);
    }

    // PDF de historia clínica
    public function generarPDF(Historia $historia)
    {
        $historia->load(['paciente', 'medico']);
        $pdf = Pdf::loadView('historial.pdf', compact('historia'));
        return $pdf->stream("historia-{$historia->id}.pdf");
    }

    // Crear historia clínica
    public function crearHistoria(Paciente $paciente)
    {
        return view('historia.create', compact('paciente'));
    }

    // Guardar historia clínica
    public function guardarHistoria(Request $request, Paciente $paciente)
    {
        $validated = $request->validate([
            'motivo_consulta' => 'required|string|max:500',
            'diagnostico' => 'nullable|string|max:255',
            'plan_tratamiento' => 'nullable|string|max:1000',
            'tratamiento_farmacologico' => 'nullable|string|max:500',
            'ordenes_examenes' => 'nullable|string|max:500',
            'evolucion' => 'nullable|string|max:1000',
            'interconsultas' => 'nullable|string|max:500',
            'observaciones' => 'nullable|string|max:1000',
            'fecha_atencion' => 'required|date',
        ]);

        $validated['medico_id'] = auth()->id();
        $validated['paciente_id'] = $paciente->id;

        Historia::create($validated);

        return redirect()
            ->route('pacientes.historial', $paciente->id)
            ->with('success', 'Historia clínica registrada exitosamente');
    }

    // Mostrar formulario para reposo médico (opcional, si quieres un formulario)
  public function mostrarFormularioBusqueda()
{
    return view('pacientes.reposo_buscar');
}


public function generarReposoPDF($historia)
{
    $paciente = \App\Models\Paciente::where('historia', $historia)->firstOrFail();

    $medico = 'Nombre del Médico';
    $fechaInicio = now()->format('Y-m-d');
    $fechaFin = now()->addDays(3)->format('Y-m-d');
    $diagnostico = 'Diagnóstico de ejemplo';
    $fecha = now()->format('d/m/Y');

    $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pacientes.reposoPDF', [
        'medico' => $medico,
        'paciente' => $paciente->nombre . ' ' . $paciente->primer_apellido,
        'fechaInicio' => $fechaInicio,
        'fechaFin' => $fechaFin,
        'diagnostico' => $diagnostico,
        'fecha' => $fecha,
    ]);

    return $pdf->download('reposo_medico_'.$paciente->historia.'.pdf');
}
    // Solicitud de laboratorio
    public function solicitud_laboratorio()
    {
        return view('pacientes.solicitud_laboratorio');
    }

    public function generarInformeMedicoPDF($historia)
    {
        $paciente = Paciente::where('historia', $historia)->firstOrFail();
        $historia_medica = Historia::where('paciente_id', $paciente->id)
            ->latest('created_at')
            ->first();

        $motivo_resumido = $historia_medica ? $historia_medica->motivo_consulta : '';
        $diagnostico = $historia_medica ? $historia_medica->diagnostico : '';
        $fecha = now()->format('d/m/Y');
        $medico = auth()->user()->name ?? 'Nombre del Médico';
        $cmp = auth()->user()->crm ?? '';
        $especialidad = auth()->user()->especialidad ?? '';

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pacientes.historia.informeMedico', [
            'paciente' => $paciente,
            'motivo_resumido' => $motivo_resumido,
            'diagnostico' => $diagnostico,
            'fecha' => $fecha,
            'medico' => $medico,
            'cmp' => $cmp,
            'especialidad' => $especialidad,
        ]);

        return $pdf->stream('informe_medico_'.$paciente->historia.'.pdf');
    }

    // Solicitud de imagenología (vista)
    public function solicitud_imagenologia()
    {
        return view('pacientes.solicitud_imagenologia');
    }

    // Generar PDF de solicitud de imagenología
    public function generarSolicitudImagenologiaPDF(Request $request)
    {
        $validated = $request->validate([
            'cedula' => 'required_without:historia_id|string|max:10',
            'historia_id' => 'required_without:cedula|string|max:6',
            'estudios' => 'required|json',
            'observaciones' => 'nullable|string|max:500'
        ]);

        // Buscar paciente
        $paciente = $request->filled('historia_id')
            ? Paciente::where('historia', $request->historia_id)->first()
            : Paciente::where('cedula', $request->cedula)->first();

        if (!$paciente) {
            return back()->with('error', 'No se encontró paciente con esos datos.');
        }

        // Decodificar estudios
        $estudios = json_decode($request->estudios, true);

        // Validar estudios
        if (json_last_error() !== JSON_ERROR_NONE || !is_array($estudios) || empty($estudios)) {
            return back()->with('error', 'Formato de estudios inválido.');
        }

        // Generar PDF
        $pdf = Pdf::loadView('pacientes.solicitud_imagenologia_pdf', [
            'paciente' => $paciente,
            'estudios' => $estudios,
            'observaciones' => $request->observaciones ?? 'Ninguna'
        ]);

        return $pdf->download("solicitud_imagenologia_{$paciente->historia}.pdf");
    }

    // Búsqueda AJAX para solicitud de laboratorio
    public function buscarPacienteAjax(Request $request)
    {
        $cedula = $request->input('cedula');
        $historia_id = $request->input('historia_id');

        $query = Paciente::query();
        if ($cedula) {
            $query->where('cedula', $cedula);
        }
        if ($historia_id) {
            $query->orWhere('historia', $historia_id);
        }
        $paciente = $query->first();

        if (!$paciente) {
            return response()->json(['error' => 'No se encontró ningún paciente con esos datos.'], 404);
        }

        $historia = Historia::where('paciente_id', $paciente->id)->latest('created_at')->first();

        return response()->json([
            'paciente' => $paciente,
            'historia' => $historia
        ]);
    }

    public function imagenologiaBuscar(Request $request)
    {
        $cedula = $request->get('cedula');
        $historia_id = $request->get('historia_id');

        $paciente = null;
        if ($cedula || $historia_id) {
            $query = \App\Models\Paciente::query();
            if ($historia_id) {
                $query->where('historia', $historia_id);
            } elseif ($cedula) {
                $query->where('cedula', $cedula);
            }
            $paciente = $query->first();
        }

        return view('pacientes.imagenologia_buscar', compact('paciente'));
    }

    public function imagenologia(Request $request)
    {
        $cedula = $request->get('cedula');
        $historia = $request->get('historia');
        $paciente = null;
        if ($cedula || $historia) {
            $query = \App\Models\Paciente::query();
            if ($historia) {
                $query->where('historia', $historia);
            } elseif ($cedula) {
                $query->where('cedula', $cedula);
            }
            $paciente = $query->first();
        }
        return view('pacientes.imagenologia', compact('paciente'));
    }

    public function imagenologiaUpload(Request $request)
    {
        // Validar datos
        $request->validate([
            'historia' => 'required|string',
            'imagenes.*' => 'required|file|mimes:jpeg,png,jpg,pdf|max:5120'
        ]);

        $historia = $request->input('historia');
        $files = $request->file('imagenes', []);
        $ruta = 'uploads/imagenologia/' . $historia;

        foreach ($files as $file) {
            $nombre = uniqid('img_') . '.' . $file->getClientOriginalExtension();
            $file->storeAs($ruta, $nombre, 'public');
            // Guardar referencia en la base de datos
            DB::table('imagenologias')->insert([
                'historia' => $historia,
                'archivo' => $ruta . '/' . $nombre,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return back()->with('success', 'Imágenes guardadas correctamente para la historia ' . $historia);
    }

    public function foraneas(Request $request)
    {
        $cedula = $request->get('cedula');
        $historia = $request->get('historia');
        $paciente = null;
        if ($cedula || $historia) {
            $query = \App\Models\Paciente::query();
            if ($historia) {
                $query->where('historia', $historia);
            } elseif ($cedula) {
                $query->where('cedula', $cedula);
            }
            $paciente = $query->first();
        }
        return view('pacientes.foraneas', compact('paciente'));
    }

    // Dar de alta a un paciente (ocultarlo de la vista de reportes de enfermería)
    public function darAlta(Paciente $paciente)
    {
        $paciente->de_alta = true;
        $paciente->save();
        return back()->with('success', 'Paciente dado de alta correctamente.');
    }
}
