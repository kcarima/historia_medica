<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SolicitudLaboratorio extends Model
{
    protected $fillable = [
        'cedula', 'nombre', 'edad', 'historia', 'fecha', 'examenes', 'otros'
    ];
    public $timestamps = false;
}
