<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class FacultadSeeder extends Seeder
{
    public function run()
    {
        $facultades = [
            [
                'Facultad' => 'CIENCIAS AGRONOMICAS',
                'activo' => true,
                'created_by' => null,
                'updated_by' => '71314450',
                'created_at' => '2025-06-26 23:29:03',
                'updated_at' => '2025-06-26 23:29:03',
            ],
            [
                'Facultad' => 'CIENCIAS BIOLOGICAS',
                'activo' => true,
                'created_by' => null,
                'updated_by' => 'superadmin',
                'created_at' => '2025-06-26 23:29:03',
                'updated_at' => '2025-06-26 23:29:03',
            ],
            [
                'Facultad' => 'CIENCIAS DE LA EDUCACIÓN Y HUMANIDADES',
                'activo' => true,
                'created_by' => null,
                'updated_by' => 'superadmin',
                'created_at' => '2025-06-26 23:29:03',
                'updated_at' => '2025-06-26 23:29:03',
            ],
            [
                'Facultad' => 'CIENC. ECONOMICAS Y DE NEGOCIOS',
                'activo' => true,
                'created_by' => null,
                'updated_by' => '71314450',
                'created_at' => '2025-06-26 23:29:03',
                'updated_at' => '2025-06-26 23:29:03',
            ],
            [
                'Facultad' => 'CIENCIAS FORESTALES',
                'activo' => true,
                'created_by' => null,
                'updated_by' => '71314450',
                'created_at' => '2025-06-26 23:29:03',
                'updated_at' => '2025-06-26 23:29:03',
            ],
            [
                'Facultad' => 'DERECHO Y CIENCIAS POLITICAS',
                'activo' => true,
                'created_by' => null,
                'updated_by' => null,
                'created_at' => '2025-06-26 23:29:03',
                'updated_at' => '2025-06-26 23:29:03',
            ],
            [
                'Facultad' => 'ENFERMERIA',
                'activo' => true,
                'created_by' => null,
                'updated_by' => '71314450',
                'created_at' => '2025-06-26 23:29:03',
                'updated_at' => '2025-06-26 23:29:03',
            ],
            [
                'Facultad' => 'FARMACIA Y BIOQUIMICA',
                'activo' => true,
                'created_by' => null,
                'updated_by' => '71314450',
                'created_at' => '2025-06-26 23:29:03',
                'updated_at' => '2025-06-26 23:29:03',
            ],
            [
                'Facultad' => 'INDUSTRIAS ALIMENTARIAS',
                'activo' => true,
                'created_by' => null,
                'updated_by' => '71314450',
                'created_at' => '2025-06-26 23:29:03',
                'updated_at' => '2025-06-26 23:29:03',
            ],
            [
                'Facultad' => 'ING. DE SISTEMAS E INFORMATICA',
                'activo' => true,
                'created_by' => null,
                'updated_by' => null,
                'created_at' => '2025-06-26 23:29:03',
                'updated_at' => '2025-06-26 23:29:03',
            ],
            [
                'Facultad' => 'INGENIERIA QUIMICA',
                'activo' => true,
                'created_by' => null,
                'updated_by' => null,
                'created_at' => '2025-06-26 23:29:03',
                'updated_at' => '2025-06-26 23:29:03',
            ],
            [
                'Facultad' => 'MEDICINA HUMANA',
                'activo' => true,
                'created_by' => null,
                'updated_by' => '71314450',
                'created_at' => '2025-06-26 23:29:03',
                'updated_at' => '2025-06-26 23:29:03',
            ],
            [
                'Facultad' => 'ODONTOLOGIA',
                'activo' => true,
                'created_by' => null,
                'updated_by' => '71314450',
                'created_at' => '2025-06-26 23:29:03',
                'updated_at' => '2025-06-26 23:29:03',
            ],
            [
                'Facultad' => 'ZOOTECNIA',
                'activo' => true,
                'created_by' => null,
                'updated_by' => 'superadmin',
                'created_at' => '2025-06-26 23:29:03',
                'updated_at' => '2025-06-26 23:29:03',
            ],
        ];

        DB::table('Tb_Facultad')->insert($facultades);
    }
}