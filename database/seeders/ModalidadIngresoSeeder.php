<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ModalidadIngresoSeeder extends Seeder
{
    public function run()
    {
        $modalidades = [
            ['id' => 1, 'Modalidad' => 'ACCESO PARA ESTUDIANTES 5° AÑO ED. SECUNDARIA', 'activo' => true, 'created_by' => null, 'updated_by' => null],
            ['id' => 2, 'Modalidad' => 'ACCESO PARA DEPORTISTAS DESTACADOS', 'activo' => true, 'created_by' => null, 'updated_by' => null],
            ['id' => 3, 'Modalidad' => 'TRASLADO EXTERNO -  UNI. CIENTÍFICA DEL PERÚ', 'activo' => true, 'created_by' => null, 'updated_by' => null],
            ['id' => 4, 'Modalidad' => 'TRASLADO INTERNO', 'activo' => true, 'created_by' => null, 'updated_by' => null],
            ['id' => 5, 'Modalidad' => 'TRASLADO EXTERNO', 'activo' => true, 'created_by' => null, 'updated_by' => null],
            ['id' => 6, 'Modalidad' => 'CEPU', 'activo' => true, 'created_by' => null, 'updated_by' => null],
            ['id' => 7, 'Modalidad' => 'PROFESIONALES', 'activo' => true, 'created_by' => null, 'updated_by' => null],
            ['id' => 8, 'Modalidad' => '1EROS PUESTOS', 'activo' => true, 'created_by' => null, 'updated_by' => null],
            ['id' => 9, 'Modalidad' => 'DEPORTISTAS CALIFICADOS', 'activo' => true, 'created_by' => null, 'updated_by' => null],
            ['id' => 10, 'Modalidad' => 'VICTIMA DEL TERRORISMO', 'activo' => true, 'created_by' => null, 'updated_by' => 'superadmin'],
            ['id' => 11, 'Modalidad' => 'HIJO TRABAJADOR', 'activo' => true, 'created_by' => null, 'updated_by' => null],
            ['id' => 12, 'Modalidad' => 'DISCAPACITADOS', 'activo' => true, 'created_by' => null, 'updated_by' => null],
            ['id' => 13, 'Modalidad' => 'MODALIDAD GENERAL', 'activo' => true, 'created_by' => 'superadmin', 'updated_by' => 'superadmin'],
            ['id' => 14, 'Modalidad' => 'MODALIDAD GENERAL - FILIALES', 'activo' => true, 'created_by' => 'jorge.puga.265', 'updated_by' => 'jorge.puga.265'],
            ['id' => 15, 'Modalidad' => 'TRASLADO EXTERNO EXTRAORDINARIO (UNIV. NO LICENCIADAS) - UNIVERSIDAD PRIVADA TELESUP', 'activo' => true, 'created_by' => 'superadmin', 'updated_by' => 'superadmin'],
            ['id' => 16, 'Modalidad' => 'PRI. Y SEG. PUESTO IQUITOS', 'activo' => true, 'created_by' => 'superadmin', 'updated_by' => 'superadmin'],
            ['id' => 17, 'Modalidad' => 'PRI. Y SEG. PUESTO FRONTERA', 'activo' => true, 'created_by' => 'superadmin', 'updated_by' => 'superadmin'],
            ['id' => 18, 'Modalidad' => 'DEPORTISTAS DESTACADOS', 'activo' => true, 'created_by' => 'superadmin', 'updated_by' => 'superadmin'],
            ['id' => 19, 'Modalidad' => 'TRASLADO EXTERNO EXTRAORDINARIO (UNIV. NO LICENCIADAS) - UNIV. PERUANA DEL ORIENTE (UPO)', 'activo' => true, 'created_by' => 'superadmin', 'updated_by' => 'superadmin'],
            ['id' => 20, 'Modalidad' => 'COLEGIO DE ALTO RENDIMIENTO', 'activo' => true, 'created_by' => 'superadmin', 'updated_by' => 'superadmin'],
            ['id' => 21, 'Modalidad' => 'TRASLADO EXTERNO', 'activo' => true, 'created_by' => 'superadmin', 'updated_by' => 'superadmin'],
            ['id' => 22, 'Modalidad' => 'VICTIMA DE TERRORISMO', 'activo' => true, 'created_by' => 'superadmin', 'updated_by' => 'superadmin'],
            ['id' => 23, 'Modalidad' => 'TRASLADO EXTERNO EXTRAORDINARIO (UNIV. NO LICENCIADAS) - UNIV. CATÓLICA LOS ÁNGELES DE CHIMBOTE', 'activo' => true, 'created_by' => 'superadmin', 'updated_by' => 'superadmin'],
            ['id' => 24, 'Modalidad' => 'TRASLADO EXTERNO EXTRAORDINARIO (UNIV. NO LICENCIADAS) - UNIVERSIDAD ALAS PERUANAS (UAP)', 'activo' => true, 'created_by' => 'superadmin', 'updated_by' => 'superadmin'],
            ['id' => 25, 'Modalidad' => 'TRASLADO EXTERNO EXTRAORDINARIO (UNIV. NO LICENCIADAS) - UNIVERSIDAD CIENTÍFICA DEL PERÚ (UCP)', 'activo' => true, 'created_by' => 'superadmin', 'updated_by' => 'superadmin'],
            ['id' => 26, 'Modalidad' => 'TRASLADO EXTERNO EXTRAORDINARIO (UNIV. NO LICENCIADAS) - UNIV. PRIV. DE LA SELVA PERUANA (UPS)', 'activo' => true, 'created_by' => 'superadmin', 'updated_by' => 'superadmin'],
            ['id' => 27, 'Modalidad' => 'CEPRE-UNAP', 'activo' => true, 'created_by' => 'superadmin', 'updated_by' => 'superadmin'],
            ['id' => 28, 'Modalidad' => 'COMPLEMENTACION ACADEMICA EDUCACION 2012', 'activo' => true, 'created_by' => 'superadmin', 'updated_by' => null],
            ['id' => 29, 'Modalidad' => 'COMPLEMENTACION ACADEMICA EDUCACION ANTIGUO', 'activo' => true, 'created_by' => 'superadmin', 'updated_by' => '72623049'],
            ['id' => 30, 'Modalidad' => 'COMPLEMENTACION PEDAGÓGICA EDUCACION ', 'activo' => true, 'created_by' => '72623049', 'updated_by' => null],
            ['id' => 31, 'Modalidad' => 'COMPLEMENTACION ACADEMICA EDUCACION 2015', 'activo' => true, 'created_by' => '72623049', 'updated_by' => null],
            ['id' => 32, 'Modalidad' => 'ACCESO PARA VICTIMAS DE TERRORISMO', 'activo' => true, 'created_by' => null, 'updated_by' => null],
            ['id' => 33, 'Modalidad' => 'BECA EXCELENCIA ACADEMICA HIJO DE DOCENTE', 'activo' => true, 'created_by' => null, 'updated_by' => null],
            ['id' => 34, 'Modalidad' => 'MOVILIDAD ESTUDIANTIL', 'activo' => true, 'created_by' => null, 'updated_by' => null],
            ['id' => 35, 'Modalidad' => 'OTRAS BECAS', 'activo' => true, 'created_by' => null, 'updated_by' => null],
            ['id' => 36, 'Modalidad' => 'ACCESO POR APOYO AL DISCAPACITADO', 'activo' => true, 'created_by' => null, 'updated_by' => null],
            ['id' => 37, 'Modalidad' => 'BECA PERU', 'activo' => true, 'created_by' => null, 'updated_by' => null],
            ['id' => 38, 'Modalidad' => 'MOVILIDAD ESTUDIANTIL RPU', 'activo' => true, 'created_by' => null, 'updated_by' => null],
            ['id' => 39, 'Modalidad' => 'ACCESO POR TRASLADO EXTERNO COMPLEMENTARIO', 'activo' => true, 'created_by' => null, 'updated_by' => null],
            ['id' => 40, 'Modalidad' => 'LIBRE', 'activo' => true, 'created_by' => null, 'updated_by' => null],
            ['id' => 41, 'Modalidad' => 'ACCESO NUEVO OTRO PROGRAMA', 'activo' => true, 'created_by' => null, 'updated_by' => null],
            ['id' => 42, 'Modalidad' => 'ACCESO PARA PRIMEROS PUESTOS DE ED. SECUNDARIA', 'activo' => true, 'created_by' => null, 'updated_by' => null],
            ['id' => 43, 'Modalidad' => 'BECA PERMANENCIA', 'activo' => true, 'created_by' => null, 'updated_by' => null],
            ['id' => 44, 'Modalidad' => 'ACCESO POR TRASLADO INTERNO', 'activo' => true, 'created_by' => null, 'updated_by' => null],
            ['id' => 45, 'Modalidad' => 'ACCESO POR CONVENIO IPAE', 'activo' => true, 'created_by' => null, 'updated_by' => null],
            ['id' => 46, 'Modalidad' => 'BECA CONTINUIDAD', 'activo' => true, 'created_by' => null, 'updated_by' => null],
            ['id' => 47, 'Modalidad' => 'ACCESO POR TRASLADO EXTERNO', 'activo' => true, 'created_by' => null, 'updated_by' => null],
            ['id' => 48, 'Modalidad' => 'ACCESO PARA EGRESADOS DE ED. SECUNDARIA', 'activo' => true, 'created_by' => null, 'updated_by' => null],
            ['id' => 49, 'Modalidad' => 'ACCESO PARA ESTUDIANTES POR PERMUTA', 'activo' => true, 'created_by' => null, 'updated_by' => null],
            ['id' => 50, 'Modalidad' => 'ACCESO PARA TITULADOS O GRADUADOS', 'activo' => true, 'created_by' => null, 'updated_by' => null],
            ['id' => 51, 'Modalidad' => 'COLEGIO DE ALTO RENDIMIENTO', 'activo' => true, 'created_by' => null, 'updated_by' => null],
            ['id' => 52, 'Modalidad' => 'MODALIDAD CONVENIO AIDESEP', 'activo' => true, 'created_by' => null, 'updated_by' => null],
            ['id' => 53, 'Modalidad' => 'BECA DEPORTE ESCOLAR', 'activo' => true, 'created_by' => null, 'updated_by' => null],
            ['id' => 54, 'Modalidad' => 'PROGRAMA DE BECA 18', 'activo' => true, 'created_by' => null, 'updated_by' => null],
            ['id' => 55, 'Modalidad' => 'ACCESO POR CENTRO PRE UNIVERSITARIO', 'activo' => true, 'created_by' => null, 'updated_by' => null],
            ['id' => 56, 'Modalidad' => 'ACCESO POR CONVENIO PADAH', 'activo' => true, 'created_by' => null, 'updated_by' => null],
            ['id' => 57, 'Modalidad' => 'ACCESO A PROGRAMA DE PROFESIONALIZACION', 'activo' => true, 'created_by' => null, 'updated_by' => null],
            ['id' => 58, 'Modalidad' => 'MOVILIDAD ACADÉMICA', 'activo' => true, 'created_by' => null, 'updated_by' => null],
        ];

        DB::table('Tb_Modalidad_Ingreso')->insert($modalidades);
    }
}