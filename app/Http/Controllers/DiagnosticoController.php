<?php
// app/Http/Controllers/ReporteDiagnosticoController.php
namespace App\Http\Controllers;

use App\Models\Historia;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class DiagnosticoController extends Controller
{
    public function generarReporte()
    {
        // Obtener diagnósticos agrupados y contados
        $diagnosticos = Historia::selectRaw('diagnostico, COUNT(*) as total')
            ->whereNotNull('diagnostico')
            ->groupBy('diagnostico')
            ->orderBy('total', 'desc')
            ->get();

        // Obtener el total de historias con diagnóstico
        $totalConDiagnostico = Historia::whereNotNull('diagnostico')->count();
        $totalHistorias = Historia::count();

        $pdf = Pdf::loadView('pacientes.reportes.pdf_diagnosticos', [
            'diagnosticos' => $diagnosticos,
            'totalConDiagnostico' => $totalConDiagnostico,
            'totalHistorias' => $totalHistorias,
            'fecha' => Carbon::now()->format('d/m/Y H:i'),
        ]);

        return $pdf->stream('reporte_diagnosticos_'.now()->format('Ymd_His').'.pdf');
    }
}
