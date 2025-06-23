<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UsuarioSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('Tb_usuarios')->insert([
            [
                'Dni' => '70365416',
                'Apellido_paterno' => 'SALAS',
                'Apellido_materno' => 'REATEGUI',
                'nombres' => 'MAURO ALBERTO',
                'email' => 'mauro@GMAIL.com',
                'usuario' => 'MSALAS416',
                'password' => Hash::make('password123'),
                'telefono' => '999111222',
                'direccion' => 'Calle 1',
                'fecha_nacimiento' => '1990-01-01',
                'sexo' => 'Masculino',
                'Id_Tipo_Usuario' => 1, // Super Admin
                'foto' => null,
                'activo' => true,
                'created_by' => 'seeder',
                'updated_by' => 'seeder',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'Dni' => '72623049',
                'Apellido_paterno' => 'GRANDEZ',
                'Apellido_materno' => 'VILLAFUERTE',
                'nombres' => 'CHRISTIAN',
                'email' => 'christian@example.com',
                'usuario' => 'CGRANDEZ049',
                'password' => Hash::make('password123'),
                'telefono' => '988777666',
                'direccion' => 'Calle 2',
                'fecha_nacimiento' => '1992-02-02',
                'sexo' => 'Masculino',
                'Id_Tipo_Usuario' => 2, // Supervisor
                'foto' => null,
                'activo' => true,
                'created_by' => 'seeder',
                'updated_by' => 'seeder',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'Dni' => '11223344',
                'Apellido_paterno' => 'KALIWARMA',
                'Apellido_materno' => 'COVARUBAS',
                'nombres' => 'JESUS',
                'email' => 'jesus@example.com',
                'usuario' => 'JKALIWARMA',
                'password' => Hash::make('password123'),
                'telefono' => '977333444',
                'direccion' => 'Calle 3',
                'fecha_nacimiento' => '1995-03-03',
                'sexo' => 'Masculino',
                'Id_Tipo_Usuario' => 3, // Registrador
                'foto' => null,
                'activo' => true,
                'created_by' => 'seeder',
                'updated_by' => 'seeder',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
