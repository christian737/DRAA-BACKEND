<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModalidadIngreso extends Model
{
    protected $table = 'Tb_Modalidad_Ingreso';

    protected $fillable = [
        'Modalidad',
        'activo',
        'created_by',
        'updated_by',
    ];
}
