<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Expediente extends Model
{
    protected $table = 'Tb_Expediente';

    protected $fillable = [
        'Id_Estudiante',
        'Id_SubCategoria',
        'Descripcion_documento',
        'url_documento',
        'Observacion',
        'Id_estado_documento',
        'created_by',
        'updated_by',
    ];

    public function estudiante(): BelongsTo
    {
        return $this->belongsTo(Estudiantes::class, 'Id_Estudiante');
    }

    public function subcategoria(): BelongsTo
    {
        return $this->belongsTo(SubCategoria::class, 'Id_SubCategoria');
    }

    public function estado(): BelongsTo
    {
        return $this->belongsTo(EstadoDocumento::class, 'Id_estado_documento');
    }
}
