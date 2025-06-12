<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class SolicitudLaboratorioController extends Controller
{
    public function generarPDF(Request $request)
    {
        $request->validate([
            'cedula' => 'nullable|string',
            'nombre' => 'nullable|string',
            'edad' => 'nullable|string',
            'historia' => 'nullable|string',
            'fecha' => 'nullable|string',
            'lab' => 'required|array',
            'otrosLab' => 'nullable|string',
        ]);

        $data = $request->only(['cedula', 'nombre', 'edad', 'historia', 'fecha', 'lab', 'otrosLab']);
        $data['medico'] = Auth::user()->name ?? 'No disponible';

        return Pdf::loadView('pacientes.solicitud_laboratorio_pdf', $data)
            ->setPaper('a5', 'landscape')
            ->stream('solicitud_laboratorio.pdf');
    }
}
