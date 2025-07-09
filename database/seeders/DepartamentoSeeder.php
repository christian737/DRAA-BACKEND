<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class DepartamentoSeeder extends Seeder
{
    public function run()
    {
        $departamentos = [
            ['id' => 1, 'Departamento' => 'AMAZONAS', 'activo' => true, 'created_by' => null, 'updated_by' => null],
            ['id' => 2, 'Departamento' => 'ANCASH', 'activo' => true, 'created_by' => null, 'updated_by' => null],
            ['id' => 3, 'Departamento' => 'APURIMAC', 'activo' => true, 'created_by' => null, 'updated_by' => null],
            ['id' => 4, 'Departamento' => 'AREQUIPA', 'activo' => true, 'created_by' => null, 'updated_by' => null],
            ['id' => 5, 'Departamento' => 'AYACUCHO', 'activo' => true, 'created_by' => null, 'updated_by' => null],
            ['id' => 6, 'Departamento' => 'CAJAMARCA', 'activo' => true, 'created_by' => null, 'updated_by' => null],
            ['id' => 7, 'Departamento' => 'CALLAO', 'activo' => true, 'created_by' => null, 'updated_by' => null],
            ['id' => 8, 'Departamento' => 'CUSCO', 'activo' => true, 'created_by' => null, 'updated_by' => null],
            ['id' => 9, 'Departamento' => 'HUANCAVELICA', 'activo' => true, 'created_by' => null, 'updated_by' => null],
            ['id' => 10, 'Departamento' => 'HUANUCO', 'activo' => true, 'created_by' => null, 'updated_by' => null],
            ['id' => 11, 'Departamento' => 'ICA', 'activo' => true, 'created_by' => null, 'updated_by' => null],
            ['id' => 12, 'Departamento' => 'JUNIN', 'activo' => true, 'created_by' => null, 'updated_by' => null],
            ['id' => 13, 'Departamento' => 'LA LIBERTAD', 'activo' => true, 'created_by' => null, 'updated_by' => null],
            ['id' => 14, 'Departamento' => 'LAMBAYEQUE', 'activo' => true, 'created_by' => null, 'updated_by' => null],
            ['id' => 15, 'Departamento' => 'LIMA', 'activo' => true, 'created_by' => null, 'updated_by' => null],
            ['id' => 16, 'Departamento' => 'LORETO', 'activo' => true, 'created_by' => null, 'updated_by' => null],
            ['id' => 17, 'Departamento' => 'MADRE DE DIOS', 'activo' => true, 'created_by' => null, 'updated_by' => null],
            ['id' => 18, 'Departamento' => 'MOQUEGUA', 'activo' => true, 'created_by' => null, 'updated_by' => null],
            ['id' => 19, 'Departamento' => 'PASCO', 'activo' => true, 'created_by' => null, 'updated_by' => null],
            ['id' => 20, 'Departamento' => 'PIURA', 'activo' => true, 'created_by' => null, 'updated_by' => null],
            ['id' => 21, 'Departamento' => 'PUNO', 'activo' => true, 'created_by' => null, 'updated_by' => null],
            ['id' => 22, 'Departamento' => 'SAN MARTIN', 'activo' => true, 'created_by' => null, 'updated_by' => null],
            ['id' => 23, 'Departamento' => 'TACNA', 'activo' => true, 'created_by' => null, 'updated_by' => null],
            ['id' => 24, 'Departamento' => 'TUMBES', 'activo' => true, 'created_by' => null, 'updated_by' => null],
            ['id' => 25, 'Departamento' => 'UCAYALI', 'activo' => true, 'created_by' => null, 'updated_by' => null],
        ];

        DB::table('tb_departamentos')->insert($departamentos);
    }
}