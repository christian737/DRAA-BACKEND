<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EstadoEstudianteSeeder extends Seeder
{
    public function run()
    {
        $estados = [
            ['id' => 1, 'Estado' => 'INGRESANTE', 'created_by' => null, 'updated_by' => null],
            ['id' => 2, 'Estado' => 'REGULAR', 'created_by' => null, 'updated_by' => null],
            ['id' => 3, 'Estado' => 'TRASLADO', 'created_by' => null, 'updated_by' => null],
            ['id' => 4, 'Estado' => 'IRREGULAR', 'created_by' => null, 'updated_by' => null],
            ['id' => 5, 'Estado' => 'REPITENTE', 'created_by' => null, 'updated_by' => null],
            ['id' => 6, 'Estado' => 'EGRESADO', 'created_by' => null, 'updated_by' => null],
            ['id' => 7, 'Estado' => 'RESERVADO', 'created_by' => null, 'updated_by' => null],
            ['id' => 8, 'Estado' => 'INVICTO', 'created_by' => null, 'updated_by' => null],
            ['id' => 9, 'Estado' => 'SANCIONADO', 'created_by' => null, 'updated_by' => null],
            ['id' => 10, 'Estado' => 'ABANDONO', 'created_by' => null, 'updated_by' => null],
            ['id' => 11, 'Estado' => 'RETIRADO', 'created_by' => null, 'updated_by' => null],
            ['id' => 12, 'Estado' => 'OBSERVADO', 'created_by' => null, 'updated_by' => null],
            ['id' => 13, 'Estado' => 'SIN MATRÍCULA', 'created_by' => null, 'updated_by' => null],
            ['id' => 14, 'Estado' => 'BACHILLER', 'created_by' => null, 'updated_by' => null],
            ['id' => 15, 'Estado' => 'TITULADO', 'created_by' => null, 'updated_by' => null],
            ['id' => 16, 'Estado' => 'EXPULSADO', 'created_by' => null, 'updated_by' => null],
            ['id' => 17, 'Estado' => 'NO SE PRESENTÓ', 'created_by' => null, 'updated_by' => null],
            ['id' => 18, 'Estado' => 'RENUNCIA', 'created_by' => null, 'updated_by' => null],
            ['id' => 19, 'Estado' => 'INGRESO ANULADO', 'created_by' => null, 'updated_by' => null],
            ['id' => 20, 'Estado' => 'ALTO RENDIMIENTO', 'created_by' => null, 'updated_by' => null],
        ];

        DB::table('Tb_Estado_estudiante')->insert($estados);
    }
}