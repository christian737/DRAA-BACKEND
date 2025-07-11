<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstadoDocumentoSeeder extends Seeder
{
    public function run(): void
    {
        $estados = [
            'ACEPTADO',
            'DENEGADO',
            'OBSERVADO',
        ];

        foreach ($estados as $estado) {
            DB::table('Tb_Estado_Documento')->updateOrInsert(
                ['Estado' => $estado],
                [
                    'created_by' => 'Seeder',
                    'updated_by' => 'Seeder',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
