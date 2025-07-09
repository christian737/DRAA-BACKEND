<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstadoEstudiante extends Model
{
    protected $table = 'Tb_Estado_estudiante';

    protected $fillable = [
        'Estado',
        'created_by',
        'updated_by',
    ];
}
