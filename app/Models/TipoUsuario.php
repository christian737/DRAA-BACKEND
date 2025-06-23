<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoUsuario extends Model
{
    use HasFactory;

    protected $table = 'Tb_Tipo_usuarios';

    protected $fillable = [
        'descripcion',
        'activo',
        'created_by',
        'updated_by',
    ];
}
