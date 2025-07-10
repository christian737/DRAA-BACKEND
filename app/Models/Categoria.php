<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'Tb_Categorias';

    protected $fillable = [
        'Categoria',
        'activo',
        'created_by',
        'updated_by',
    ];
}
