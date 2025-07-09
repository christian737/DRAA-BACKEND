<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Provincia;

class Distrito extends Model
{
    protected $table = 'Tb_Distrito';

    protected $fillable = [
        'Distrito',
        'activo',
        'id_provincia',
        'created_by',
        'updated_by',
    ];

    public function provincia()
    {
        return $this->belongsTo(Provincia::class, 'id_provincia');
    }
}
