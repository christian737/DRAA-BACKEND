<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Escuela extends Model
{
    protected $table = 'Tb_Escuela';

    protected $fillable = [
        'Escuela',
        'Id_facultad',
        'activo',
        'created_by',
        'updated_by',
    ];
}
