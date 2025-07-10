<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estudiantes extends Model
{
    protected $table = 'Tb_Estudiantes';

    protected $fillable = [
        'Cod_uni', 'Tipo_documento_identidad', 'Dni', 'Apellido_paterno', 'Apellido_materno', 'nombres',
        'Id_Tipo_Estado', 'email', 'Celular', 'Direccion', 'sexo', 'Fecha_nacimiento',
        'Id_Sede', 'Id_distrito', 'Id_Escuela', 'Id_Periodo_Ingreso', 'Id_Periodo_Egreso',
        'Id_Curriculum', 'Id_modalidad_ingreso', 'Es_discapasitado', 'Discapacidad',
        'Es_etnia', 'etnia', 'foto', 'created_by', 'updated_by'
    ];

   

    public function estado()
    {
        return $this->belongsTo(EstadoEstudiante::class, 'Id_Tipo_Estado');
    }

    public function sede()
    {
        return $this->belongsTo(Sede::class, 'Id_Sede');
    }

    public function distrito()
    {
        return $this->belongsTo(Distrito::class, 'Id_distrito');
    }

    public function escuela()
    {
        return $this->belongsTo(Escuela::class, 'Id_Escuela');
    }

    public function periodoIngreso()
    {
        return $this->belongsTo(Periodo::class, 'Id_Periodo_Ingreso');
    }

    public function periodoEgreso()
    {
        return $this->belongsTo(Periodo::class, 'Id_Periodo_Egreso');
    }

    public function curriculum()
    {
        return $this->belongsTo(Curriculum::class, 'Id_Curriculum');
    }

    public function modalidadIngreso()
    {
        return $this->belongsTo(ModalidadIngreso::class, 'Id_modalidad_ingreso');
    }
}
