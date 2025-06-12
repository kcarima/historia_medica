<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ForaneasController extends Controller
{
    public function guardar(Request $request)
    {
        $request->validate([
            'historia' => 'required|string',
            'archivos' => 'required',
            'archivos.*' => 'file|mimes:jpeg,png,jpg,pdf|max:5120',
        ]);

        $historia = $request->input('historia');
        $files = $request->file('archivos', []);
        $ruta = 'uploads/foraneas/' . $historia;

        foreach ($files as $file) {
            $nombre = uniqid('for_', true) . '.' . $file->getClientOriginalExtension();
            $file->storeAs($ruta, $nombre, 'public');
            DB::table('foraneas')->insert([
                'historia' => $historia,
                'archivo' => $ruta . '/' . $nombre,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        return redirect()->route('pacientes.foraneas', ['historia' => $historia])
            ->with('success', 'Archivos guardados correctamente para la historia ' . $historia);
    }

    public function eliminar($id)
    {
        $file = DB::table('foraneas')->where('id', $id)->first();
        if ($file && !empty($file->archivo)) {
            Storage::disk('public')->delete($file->archivo);
            DB::table('foraneas')->where('id', $id)->delete();
            return back()->with('success', 'Archivo eliminado correctamente.');
        }
        return back()->with('error', 'Archivo no encontrado o ruta inválida.');
    }
}
