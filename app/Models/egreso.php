<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Egreso extends Model
{
    // Nombre de la tabla (opcional si sigue la convención plural)
    protected $table = 'egresos';

    // Definir la llave primaria personalizada
    protected $primaryKey = 'historia';

    // Indicar que la llave primaria no es auto-incrementable
    public $incrementing = false;

    // Definir el tipo de la llave primaria
    protected $keyType = 'string';

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'historia',
        'diagnostico_egreso',
        'recomendaciones_seguimiento',
    ];

    // Si usas timestamps (created_at, updated_at)
    public $timestamps = true;

    // Si quieres, puedes definir relaciones aquí, por ejemplo:
    // public function paciente()
    // {
    //     return $this->belongsTo(Paciente::class, 'historia', 'historia');
    // }
}
