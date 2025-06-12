<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nota_Operatoria extends Model
{
    use HasFactory;
public function paciente()
{
    return $this->belongsTo(Paciente::class, 'paciente_id');
}
    protected $table = 'nota_operatoria';

    protected $fillable = [
        'historia_id',
        'nota',
    ];
}
