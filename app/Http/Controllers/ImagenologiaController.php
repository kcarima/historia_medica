<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Imagenologia;
use Illuminate\Support\Facades\Storage;

class ImagenologiaController extends Controller
{
    public function index()
    {
        // Muestra el formulario y las imágenes del tipo seleccionado (por defecto ninguno)
        return view('pacientes.imagenologia.imagenologia', ['imagenes' => collect(), 'tipoSeleccionado' => null]);
    }

    public function guardar(Request $request)
    {
        $request->validate([
            'historia' => 'required|string',
            'imagenes' => 'required',
            'imagenes.*' => 'image|max:5120',
        ]);

        $historia = $request->input('historia');
        if ($request->hasFile('imagenes')) {
            foreach ($request->file('imagenes') as $img) {
                $ruta = 'uploads/imagenologia/' . $historia;
                $nombre = uniqid('img_') . '.' . $img->getClientOriginalExtension();
                $img->storeAs($ruta, $nombre, 'public');
                \DB::table('imagenologias')->insert([
                    'historia' => $historia,
                    'archivo' => $ruta . '/' . $nombre,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
        // Redirigir a la vista de búsqueda de paciente con el mensaje y el parámetro de historia
        return redirect()->route('pacientes.imagenologia', ['historia' => $historia])
            ->with('success', 'Imágenes guardadas correctamente para la historia ' . $historia);
    }

    public function porTipo($tipo)
    {
        $imagenes = Imagenologia::where('tipo', $tipo)->get();
        return view('pacientes.imagenologia.imagenologia', [
            'imagenes' => $imagenes,
            'tipoSeleccionado' => $tipo
        ]);
    }

    public function eliminar($id)
    {
        $imagen = \DB::table('imagenologias')->where('id', $id)->first();
        if ($imagen && !empty($imagen->archivo)) {
            \Storage::disk('public')->delete($imagen->archivo);
            \DB::table('imagenologias')->where('id', $id)->delete();
            return back()->with('success', 'Imagen eliminada correctamente.');
        }
        return back()->with('error', 'Imagen no encontrada o ruta inválida.');
    }
}
