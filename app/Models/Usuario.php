<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Usuario extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;

    protected $table = 'Tb_usuarios';

    protected $fillable = [
        'Dni',
        'Apellido_paterno',
        'Apellido_materno',
        'nombres',
        'email',
        'usuario',
        'password',
        'telefono',
        'direccion',
        'fecha_nacimiento',
        'sexo',
        'Id_Tipo_Usuario',
        'foto',
        'activo',
        'created_by',
        'updated_by'
    ];

    protected $hidden = ['password', 'remember_token'];
    public function getAuthIdentifierName()
{
    return 'usuario';
}
    public function tipoUsuario()
    {
        return $this->belongsTo(TipoUsuario::class, 'Id_Tipo_Usuario');
    }

}
