<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class SedeSeeder extends Seeder
{
    public function run()
    {
        $sedes = [
            ['id' => 1, 'Sede' => 'IQUITOS', 'activo' => true, 'created_by' => null, 'updated_by' => null],
            ['id' => 10, 'Sede' => 'EL ESTRECHO', 'activo' => true, 'created_by' => null, 'updated_by' => null],
            ['id' => 11, 'Sede' => 'SAN LORENZO', 'activo' => true, 'created_by' => null, 'updated_by' => null],
            ['id' => 12, 'Sede' => 'LIMA', 'activo' => true, 'created_by' => null, 'updated_by' => null],
            ['id' => 13, 'Sede' => 'DATEM DEL MARAÑON', 'activo' => true, 'created_by' => null, 'updated_by' => null],
            ['id' => 14, 'Sede' => 'CABALLO COCHA', 'activo' => true, 'created_by' => null, 'updated_by' => null],
            ['id' => 2, 'Sede' => 'PUNCHANA', 'activo' => true, 'created_by' => null, 'updated_by' => null],
            ['id' => 3, 'Sede' => 'SAN JUAN', 'activo' => true, 'created_by' => null, 'updated_by' => null],
            ['id' => 4, 'Sede' => 'BELEN', 'activo' => true, 'created_by' => null, 'updated_by' => null],
            ['id' => 5, 'Sede' => 'YURIMAGUAS', 'activo' => true, 'created_by' => null, 'updated_by' => null],
            ['id' => 6, 'Sede' => 'NAUTA', 'activo' => true, 'created_by' => null, 'updated_by' => null],
            ['id' => 7, 'Sede' => 'CONTAMANA', 'activo' => true, 'created_by' => null, 'updated_by' => null],
            ['id' => 8, 'Sede' => 'REQUENA', 'activo' => true, 'created_by' => null, 'updated_by' => null],
            ['id' => 9, 'Sede' => 'ORELLANA', 'activo' => true, 'created_by' => null, 'updated_by' => null],
        ];

        DB::table('Tb_Sedes')->insert($sedes);
    }
}