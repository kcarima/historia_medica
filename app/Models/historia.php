<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importación correcta

class Historia extends Model
{
    protected $fillable = [
        'paciente_id',
        'fecha_atencion',
        'motivo_consulta',
        'diagnostico',
        'plan_tratamiento',
        'tratamiento_farmacologico',
        'ordenes_examenes',
        'evolucion',
        'interconsultas',
        'observaciones',
        'historia',
        'medico_id',
        'fecha_reposo_desde',
        'fecha_reposo_hasta',
        'dias_reposo'
    ];

    public static function generarNumeroHistoria()
    {
        $ultimoNumero = DB::table('historias')->max('historia'); // Ahora funcionará
        return str_pad((int)$ultimoNumero + 1, 6, '0', STR_PAD_LEFT);
    }

    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }


public function medico()
{
    return $this->belongsTo(User::class, 'medico_id');
}

}
