<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class RespaldoController extends Controller
{
    public function descargar()
    {
        $db = config('database.connections.mysql.database');
        $user = config('database.connections.mysql.username');
        $pass = config('database.connections.mysql.password');
        $host = config('database.connections.mysql.host');
        $filename = "respaldo_{$db}_" . date('Ymd_His') . ".sql";

        $command = "mysqldump --user={$user} --password={$pass} --host={$host} {$db} --single-transaction --quick --lock-tables=false 2>&1";

        $dump = null;
        try {
            $dump = shell_exec($command);
        } catch (\Exception $e) {
            return back()->with('error', 'No se pudo generar el respaldo: ' . $e->getMessage());
        }

        if (!$dump) {
            return back()->with('error', 'No se pudo generar el respaldo. Verifica las credenciales y permisos.');
        }

        return Response::make($dump, 200, [
            'Content-Type' => 'application/sql',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ]);
    }
}
