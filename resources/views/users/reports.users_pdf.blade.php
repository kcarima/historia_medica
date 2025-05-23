use Barryvdh\DomPDF\Facade\Pdf;

public function generateUserReport()
{
    $users = User::all(); // O filtra según necesidad
    $pdf = Pdf::loadView('reports.users_pdf', compact('users'));
    return $pdf->download('reporte_usuarios.pdf');
}