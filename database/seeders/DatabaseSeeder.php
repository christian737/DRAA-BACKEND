<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
  

   $this->call([
        TipoUsuariosSeeder::class,
        UsuarioSeeder::class, 
        PeriodoSeeder::class, 
        FacultadSeeder::class, 
        TbEscuelaSeeder::class, 
        DepartamentoSeeder::class, 
        ProvinciaSeeder::class, 
        DistritoSeeder::class, 
        ModalidadIngresoSeeder::class, 
        CurriculumSeeder::class, 
        EstadoEstudianteSeeder::class, 
        SedeSeeder::class, 
        EstudianteSeeder2025::class, 
        CategoriaSeeder::class, 
        SubCategoriaSeeder::class, 
        EstadoDocumentoSeeder::class, 
    ]);


    }
}
