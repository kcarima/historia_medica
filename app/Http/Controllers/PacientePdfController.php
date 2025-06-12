<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PacientePdfController extends Controller
{
    // Mostrar vista con formulario de búsqueda
    public function index(Request $request)
    {
        $search = $this->validateSearch($request);

        $query = $this->buildSearchQuery($search);
        $pacientes = $query->paginate(15);

        return view('pacientes.reportes.index', compact('pacientes', 'search'));
    }

    // Generar PDF
    public function generatePdf(Request $request)
    {
        try {
            $filters = $this->validateSearch($request);

            $query = $this->buildSearchQuery($filters);
            $pacientes = $query->get();

            $this->processPatients($pacientes);

            $pdf = $this->generatePDFDocument($pacientes, $filters);

            Log::info('PDF generado exitosamente', [
                'user' => auth()->id(),
                'filters' => $filters,
                'count' => $pacientes->count()
            ]);

            return $pdf->stream($this->generateFilename());

        } catch (\Exception $e) {
            Log::error('Error al generar PDF: ' . $e->getMessage());
            return back()->with('error', 'Error al generar el PDF: ' . $e->getMessage());
        }
    }

    // Métodos protegidos para modularización

    protected function validateSearch(Request $request): array
    {
        return $request->validate([
            'historia' => 'nullable|string|max:20',
            'primer_apellido' => 'nullable|string|max:50',
            'fecha_inicio' => 'nullable|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio'
        ]);
    }

    protected function buildSearchQuery(array $filters)
    {
        $query = Paciente::query()->orderBy('created_at', 'desc');

        if (!empty($filters['historia'])) {
            $query->where('numero_historia', 'like', '%'.$filters['historia'].'%');
        }

        if (!empty($filters['apellido'])) {
            $query->where('apellido', 'like', '%'.$filters['apellido'].'%');
        }

        if (!empty($filters['fecha_inicio']) && !empty($filters['fecha_fin'])) {
            $query->whereBetween('created_at', [
                Carbon::parse($filters['fecha_inicio'])->startOfDay(),
                Carbon::parse($filters['fecha_fin'])->endOfDay()
            ]);
        }

        return $query;
    }

    protected function processPatients($pacientes)
    {
        $pacientes->each(function ($paciente) {
            // Convertir fecha_nacimiento a Carbon si es necesario
            if ($paciente->fecha_nacimiento && !$paciente->fecha_nacimiento instanceof Carbon) {
                $paciente->fecha_nacimiento = Carbon::parse($paciente->fecha_nacimiento);
            }

            // Calcular edad si no existe
            if (empty($paciente->edad) && $paciente->fecha_nacimiento) {
                $paciente->edad = $paciente->fecha_nacimiento->age;
            }
        });
    }

    protected function generatePDFDocument($pacientes, $filters)
    {
        $pdf = Pdf::loadView('pacientes.reportes.pdf_pacientes', [
            'pacientes' => $pacientes,
            'filters' => $filters
        ]);

        $pdf->setPaper('a4', 'portrait');
        $pdf->setOptions([
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true,
            'defaultFont' => 'helvetica',
            'dpi' => 150,
            'isPhpEnabled' => true
        ]);

        return $pdf;
    }

    protected function generateFilename(): string
    {
        return 'reporte_pacientes_'.now()->format('Ymd_His').'.pdf';
    }
}
