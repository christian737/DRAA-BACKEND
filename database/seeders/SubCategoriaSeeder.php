<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubCategoriaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('Tb_SubCategorias')->insert([
            [
                'SubCategoria' => 'RETIRO DE SEMESTRE',
                'Id_Categoria' => 1, 
                'activo' => true,
                'created_by' => 'Seeder',
                'updated_by' => 'Seeder',
            ],
            [
                'SubCategoria' => 'RETIRO DE ASIGNATURA',
                'Id_Categoria' => 1,
                'activo' => true,
                'created_by' => 'Seeder',
                'updated_by' => 'Seeder',
            ],
            [
                'SubCategoria' => 'RESERVA DE MATRÍCULA',
                'Id_Categoria' => 1,
                'activo' => true,
                'created_by' => 'Seeder',
                'updated_by' => 'Seeder',
            ],
            [
                'SubCategoria' => 'RECTIFICACIÓN DE MATRÍCULA',
                'Id_Categoria' => 1,
                'activo' => true,
                'created_by' => 'Seeder',
                'updated_by' => 'Seeder',
            ],
            [
                'SubCategoria' => 'AMPLIACIÓN DE MATRÍCULA',
                'Id_Categoria' => 1,
                'activo' => true,
                'created_by' => 'Seeder',
                'updated_by' => 'Seeder',
            ],
            [
                'SubCategoria' => 'CAMBIO DE ESCUELA',
                'Id_Categoria' => 1,
                'activo' => true,
                'created_by' => 'Seeder',
                'updated_by' => 'Seeder',
            ],
            [
                'SubCategoria' => 'CAMBIO DE CURRÍCULO',
                'Id_Categoria' => 1,
                'activo' => true,
                'created_by' => 'Seeder',
                'updated_by' => 'Seeder',
            ],
        ]);
    }
}
