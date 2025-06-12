<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;
use PDF; // Barryvdh DomPDF

class ReporteController extends Controller
{
    public function pacientesAtendidos(Request $request)
    {
        $tipo = $request->input('tipo_reporte');
        $pacientes = collect();

        if ($tipo) {
            $query = Paciente::query();

            if ($tipo === 'diario' && $request->filled('fecha')) {
                $query->whereDate('created_at', $request->fecha);
            }
            if ($tipo === 'mensual' && $request->filled('mes')) {
                [$anio, $mes] = explode('-', $request->mes);
                $query->whereYear('created_at', $anio)->whereMonth('created_at', $mes);
            }
            if ($tipo === 'trimestral' && $request->filled('trimestre') && $request->filled('anio_trimestre')) {
                $anio = $request->anio_trimestre;
                $trimestre = $request->trimestre;
                $mesInicio = 1 + ($trimestre - 1) * 3;
                $mesFin = $mesInicio + 2;
                $query->whereYear('created_at', $anio)
                      ->whereMonth('created_at', '>=', $mesInicio)
                      ->whereMonth('created_at', '<=', $mesFin);
            }

            $pacientes = $query->orderBy('created_at', 'desc')->get();
        }

        return view('reportes.pacientes_atendidos', compact('pacientes', 'tipo'));
    }

    public function pacientesAtendidosPdf(Request $request)
    {
        $tipo = $request->input('tipo_reporte');
        $pacientes = collect();

        if ($tipo) {
            $query = Paciente::query();

            if ($tipo === 'diario' && $request->filled('fecha')) {
                $query->whereDate('created_at', $request->fecha);
            }
            if ($tipo === 'mensual' && $request->filled('mes')) {
                [$anio, $mes] = explode('-', $request->mes);
                $query->whereYear('created_at', $anio)->whereMonth('created_at', $mes);
            }
            if ($tipo === 'trimestral' && $request->filled('trimestre') && $request->filled('anio_trimestre')) {
                $anio = $request->anio_trimestre;
                $trimestre = $request->trimestre;
                $mesInicio = 1 + ($trimestre - 1) * 3;
                $mesFin = $mesInicio + 2;
                $query->whereYear('created_at', $anio)
                      ->whereMonth('created_at', '>=', $mesInicio)
                      ->whereMonth('created_at', '<=', $mesFin);
            }

            $pacientes = $query->orderBy('created_at', 'desc')->get();
        }

        $pdf = PDF::loadView('reportes.pacientes_atendidos_pdf', compact('pacientes', 'tipo'));
        return $pdf->download('reporte_pacientes_atendidos.pdf');
    }
}
