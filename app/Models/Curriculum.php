<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Escuela;

class Curriculum extends Model
{
    protected $table = 'Tb_Curriculum';

    protected $fillable = [
        'Cod',
        'Curriculum',
        'Id_Escuela',
        'activo',
        'created_by',
        'updated_by',
    ];

    public function escuela()
    {
        return $this->belongsTo(Escuela::class, 'Id_Escuela');
    }
}
