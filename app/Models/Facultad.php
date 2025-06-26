<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facultad extends Model
{
    protected $table = 'Tb_Facultad';

    protected $fillable = [
        'Facultad',
        'activo',
        'created_by',
        'updated_by',
    ];
}
