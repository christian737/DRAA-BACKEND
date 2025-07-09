<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Departamento;

class Provincia extends Model
{
    protected $table = 'tb_provincia';

    protected $fillable = [
        'Provincia',
        'activo',
        'id_departamento',
        'created_by',
        'updated_by',
    ];

    public function departamento()
    {
        return $this->belongsTo(Departamento::class, 'id_departamento');
    }
}
