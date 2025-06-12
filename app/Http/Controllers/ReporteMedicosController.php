<?php

namespace App\Http\Controllers;

use App\Models\User;
use PDF;

class ReporteMedicosController extends Controller
{
    public function generarPDF()
    {
        // Consulta exacta para role = 'medico' (case sensitive)
        $medicos = User::where('role', 'medico')
                     ->orderBy('created_at', 'desc')
                     ->get();

        // Si necesitas case insensitive (por si hay variaciones como 'Médico')
        // $medicos = User::where('role', 'like', '%medico%')
        //              ->orderBy('created_at', 'desc')
        //              ->get();

        $data = [
            'title' => 'Reporte Completo de Médicos Registrados',
            'date' => now()->format('d/m/Y H:i:s'),
            'medicos' => $medicos,
            'total' => $medicos->count()
        ];

        return PDF::loadView('pacientes.reportes.medicos', $data)
                ->setPaper('a4', 'landscape')
                ->setOption('defaultFont', 'Arial')
                ->download('reporte_medicos_'.now()->format('Ymd_His').'.pdf');
    }
}
