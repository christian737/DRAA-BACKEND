<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategoria extends Model
{
    use HasFactory;

    protected $table = 'Tb_SubCategorias';

    protected $fillable = [
        'SubCategoria',
        'Id_Categoria',
        'activo',
        'created_by',
        'updated_by',
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'Id_Categoria');
    }
}
