<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TipoUsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('Tb_Tipo_usuarios')->insert([
            [
                'descripcion' => 'Super Admin',
                'activo' => true,
                'created_by' => 'seeder',
                'updated_by' => 'seeder',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'descripcion' => 'Supervisor',
                'activo' => true,
                'created_by' => 'seeder',
                'updated_by' => 'seeder',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'descripcion' => 'Registrador',
                'activo' => true,
                'created_by' => 'seeder',
                'updated_by' => 'seeder',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
