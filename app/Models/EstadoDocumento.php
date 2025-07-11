<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstadoDocumento extends Model
{
    protected $table = 'Tb_Estado_Documento';

    protected $fillable = [
        'Estado', 'created_by', 'updated_by'
    ];
}
