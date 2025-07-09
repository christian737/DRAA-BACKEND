<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    protected $table = 'tb_departamentos';

    protected $fillable = [
        'Departamento',
        'activo',
        'created_by',
        'updated_by',
    ];
}
