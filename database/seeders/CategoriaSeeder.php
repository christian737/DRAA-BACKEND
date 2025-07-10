<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaSeeder extends Seeder
{
    public function run()
    {
        $categorias = [
            'SOLICITUD',
            'RESOLUCIÓN DECANAL',
            'RESOLUCIÓN RECTORAL',
            'RESOLUCIÓN DE CONSEJO UNIVERSITARIO',
            'OFICIO DECANAL',
            'OFICIO DE CONSEJO DE FACULTAD',
            'ACTA DE REUNIÓN',
            'CARTA DE COMPROMISO',
            'INFORME TÉCNICO',
            'MEMORÁNDUM',
            'CONSTANCIA',
            'COMUNICADO',
            'CIRCULAR',
        ];

        foreach ($categorias as $cat) {
            DB::table('Tb_Categorias')->insert([
                'Categoria' => $cat,
                'activo' => true,
                'created_by' => 'Seeder',
                'updated_by' => 'Seeder',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
