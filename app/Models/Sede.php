<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sede extends Model
{
    protected $table = 'Tb_Sedes';

    protected $fillable = [
        'Sede',
        'activo',
        'created_by',
        'updated_by',
    ];
}
