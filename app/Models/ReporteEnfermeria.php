<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReporteEnfermeria extends Model
{
    protected $table = 'reporte_enfermerias';

    protected $fillable = [
        'paciente_id',
        'enfermera_id',
        'historia_id',
        'historia',
        'fecha',
        'reporte',
    ];

    protected $casts = [
        'fecha' => 'date',
    ];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }

    public function enfermera()
    {
        return $this->belongsTo(User::class, 'enfermera_id');
    }

    public function historia()
    {
        return $this->belongsTo(Historia::class);
    }

}
