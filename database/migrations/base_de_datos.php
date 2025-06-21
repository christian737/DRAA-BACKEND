<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
            Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();

            
        });

            Schema::create('Tb_Tipo_usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion', 100)->nullable();
            $table->boolean('activo')->default(false);
            $table->string('created_by', 50)->nullable();
            $table->string('updated_by', 50)->nullable();
            $table->timestamps();
        });

            Schema::create('Tb_usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('Dni');
            $table->string('Apellido_paterno');
            $table->string('Apellido_materno');
            $table->string('nombres');
            $table->string('email');
            $table->timestamp('usuario');
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->string('telefono', 15)->nullable();
            $table->string('direccion', 255)->nullable();
            $table->string('fecha_nacimiento', 10)->nullable();
            $table->string('sexo', 10)->nullable();
            $table->foreignId('Id_Tipo_Usuario')->references('id')->on('Tb_Tipo_usuarios')->onDelete('cascade');
            $table->string('foto')->nullable();
            $table->boolean('activo')->default(false);
            $table->string('created_by', 50)->nullable();
            $table->string('updated_by', 50)->nullable();
        });

            Schema::create('Tb_periodos', function (Blueprint $table) {
            $table->id();
            $table->string('periodo', 50);
            $table->Integer('anio')->unsigned();
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->boolean('activo')->default(false);
            $table->string('created_by', 50)->nullable();
            $table->rememberToken();
            $table->string('updated_by', 50)->nullable();
            $table->timestamps();
        });

            Schema::create('tb_departamentos', function (Blueprint $table) {
            $table->id();
            $table->string('Departamento');
            $table->boolean('activo')->default(false);
            $table->string('created_by', 50)->nullable();
            $table->string('updated_by', 50)->nullable();
            $table->timestamps();
        });

            Schema::create('Tb_Provincia', function (Blueprint $table) {
            $table->id();
            $table->string('Provincia');
            $table->boolean('activo')->default(false);
            $table->foreignId('id_departamento')->constrained('tb_departamentos')->onDelete('cascade');
            $table->string('created_by', 50)->nullable();
            $table->string('updated_by', 50)->nullable();
            $table->timestamps();
        });

            Schema::create('Tb_Distrito', function (Blueprint $table) {
            $table->id();
            $table->string('Distrito');
            $table->boolean('activo')->default(false);
            $table->string('created_by', 50)->nullable();
            $table->string('updated_by', 50)->nullable();
            $table->foreignId('id_provincia')->constrained('Tb_Provincia')->onDelete('cascade');
            $table->timestamps();
        });

            Schema::create('Tb_Facultad', function (Blueprint $table) {
            $table->id();
            $table->string('Facultad');
            $table->boolean('activo')->default(false);
            $table->string('created_by', 50)->nullable();
            $table->string('updated_by', 50)->nullable();
            $table->timestamps();
        });
               
            Schema::create('Tb_Escuela', function (Blueprint $table) {
            $table->id();
            $table->string('Escuela');
            $table->foreignId('Id_facultad')->nulleable()->index()->constrained('Tb_Facultad')->onDelete('cascade');
            $table->boolean('activo')->default(false);
            $table->string('created_by', 50)->nullable();
            $table->string('updated_by', 50)->nullable();
            $table->timestamps();
        });
                  
            Schema::create('Tb_Curriculum', function (Blueprint $table) {
            $table->id();
            $table->string('Cod');
            $table->string('Curriculum');
            $table->foreignId('Id_Escuela')->nullable()->index()->constrained('Tb_Escuela')->onDelete('cascade');
            $table->boolean('activo')->default(false);
            $table->string('created_by', 50)->nullable();
            $table->string('updated_by', 50)->nullable();
            $table->timestamps();
       });

            Schema::create('Tb_Modalidad_Ingreso', function (Blueprint $table) {
            $table->id();
            $table->string('Cod');
            $table->string('Modalidad');
            $table->boolean('activo')->default(false);
            $table->string('created_by', 50)->nullable();
            $table->string('updated_by', 50)->nullable();
            $table->timestamps();

        });

            Schema::create('Tb_Estado_estudiante', function (Blueprint $table) {
            $table->id();
            $table->string('Estado')->unique();
            $table->string('created_by', 50)->nullable();
            $table->string('updated_by', 50)->nullable();
            $table->timestamps();
      });

            Schema::create('Tb_Estudiantes', function (Blueprint $table) {
            $table->id();
            $table->string('Cod_uni')->unique();
            $table->string('Dni');
            $table->string('Apellido_paterno');
            $table->string('Apellido_materno');
            $table->string('nombres');
            $table->foreignId('Id_Tipo_Estado')->nullable()->index()->constrained('Tb_Estado_estudiante')->onDelete('cascade'); 
            $table->string('email');
            $table->string('Celular');
            $table->string('Direccion');
            $table->string('sexo');
            $table->date('Fecha_nacimiento');
            $table->foreignId('Id_distrito')->nullable()->index()->constrained('Tb_Distrito')->onDelete('cascade');
            $table->foreignId('Id_Escuela')->nullable()->index()->constrained('Tb_Escuela')->onDelete('cascade');
            $table->foreignId('Id_Periodo_Ingreso')->nullable()->index()->constrained('Tb_periodos')->onDelete('cascade');
            $table->foreignId('Id_Periodo_Egreso')->nullable()->index()->constrained('Tb_periodos')->onDelete('cascade');
            $table->foreignId('Id_Curriculum')->nullable()->index()->constrained('Tb_Curriculum')->onDelete('cascade');
            $table->foreignId('Id_modalidad_ingreso')->nullable()->index()->constrained('Tb_Modalidad_Ingreso')->onDelete('cascade'); ;
            $table->Integer('Es_discapasitado')->unsigned();
            $table->string('Discapacidad');
            $table->Integer('Es_etnia')->unsigned();
            $table->string('etnia');
            $table->string('foto')->nullable();

        });

            Schema::create('Tb_Categorias', function (Blueprint $table) {
            $table->id();
            $table->string('Categoria')->unique();
            $table->boolean('activo')->default(false);
            $table->string('created_by', 50)->nullable();
            $table->string('updated_by', 50)->nullable();
            $table->timestamps();
      });
            Schema::create('Tb_SubCategorias', function (Blueprint $table) {
            $table->id();
            $table->string('SubCategoria')->unique();
            $table->foreignId('Id_Categoria')->nullable()->index()->constrained('Tb_Categorias')->onDelete('cascade');
            $table->boolean('activo')->default(false);
            $table->string('created_by', 50)->nullable();
            $table->string('updated_by', 50)->nullable();
            $table->timestamps();


      });

            Schema::create('Tb_Estado_Documento', function (Blueprint $table) {
            $table->id();
            $table->string('Estado')->unique();
            $table->string('created_by', 50)->nullable();
            $table->string('updated_by', 50)->nullable();
            $table->timestamps();
      });

            Schema::create('Tb_Expediente', function (Blueprint $table) {
            $table->id();
            $table->foreignId('Id_Estudiante')->nullable()->index()->constrained('Tb_Estudiantes')->onDelete('cascade');
            $table->foreignId('Id_SubCategoria')->nullable()->index()->constrained('Tb_SubCategorias')->onDelete('cascade');
            $table->string('Descripcion_documento')->nullable();
            $table->string('url_documento')->nullable();
            $table->string('Observacion')->nullable();
            $table->foreignId('Id_estado_documento')->nullable()->index()->constrained('Tb_Estado_Documento')->onDelete('cascade');
            $table->string('created_by', 50)->nullable();
            $table->string('updated_by', 50)->nullable();
            $table->timestamps();
      });


            Schema::create('Tb_Concepto_Deuda', function (Blueprint $table) {
            $table->id();
            $table->string('Descripcion')->nullable();
            $table->boolean('activo')->default(false);
            $table->string('created_by', 50)->nullable();
            $table->string('updated_by', 50)->nullable();
            $table->timestamps();
      });
            Schema::create('Tb_Deuda_Estudiante', function (Blueprint $table) {
            $table->id();
            $table->foreignId('Id_Estudiante')->nullable()->index()->constrained('Tb_Estudiantes')->onDelete('cascade');
            $table->foreignId('Id_Concepto_Deuda')->nullable()->index()->constrained('Tb_Concepto_Deuda')->onDelete('cascade');
            $table->decimal('Monto', 10, 2)->default(0.00);
            $table->date('Fecha')->nullable();
            $table->string('Observacion')->nullable();
            $table->boolean('Estado')->default(false);
            $table->foreignId('Id_Periodo')->nullable()->index()->constrained('Tb_periodos')->onDelete('cascade');
            $table->foreignId('Id_Escuela')->nullable()->index()->constrained('Tb_Escuela')->onDelete('cascade');
            $table->string('created_by', 50)->nullable();
            $table->string('updated_by', 50)->nullable();
            $table->timestamps();
      });




    }
   

    public function down(): void
    {
        Schema::dropIfExists('Tb_Deuda_Estudiante');   // Depende de: Tb_Estudiantes, Tb_Concepto_Deuda, Tb_periodos, Tb_Escuela
        Schema::dropIfExists('Tb_Concepto_Deuda');     // No depende de ninguna tabla
        Schema::dropIfExists('Tb_Expediente');          // Depende de: Tb_Estudiantes, Tb_SubCategorias, Tb_Estado_Documento
        Schema::dropIfExists('Tb_Estudiantes');         // Depende de: Tb_Distrito, Tb_Escuela, Tb_Curriculum, Tb_Modalidad_Ingreso, Tb_Estado_estudiante, Tb_periodos
        Schema::dropIfExists('Tb_Curriculum');          // Depende de: Tb_Escuela
        Schema::dropIfExists('Tb_Escuela');             // Depende de: Tb_Facultad
        Schema::dropIfExists('Tb_Facultad');
        Schema::dropIfExists('Tb_Distrito');            // Depende de: Tb_Provincia
        Schema::dropIfExists('Tb_Provincia');           // Depende de: Tb_Departamento
        Schema::dropIfExists('tb_departamentos');
        Schema::dropIfExists('Tb_Modalidad_Ingreso');
        Schema::dropIfExists('Tb_Estado_estudiante');
        Schema::dropIfExists('Tb_usuarios');            // Depende de: Tb_Tipo_usuarios
        Schema::dropIfExists('Tb_Tipo_usuarios');
        Schema::dropIfExists('Tb_periodos');
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('Tb_SubCategorias');       // Depende de: Tb_Categorias
        Schema::dropIfExists('Tb_Categorias');          // Depende de: Tb_SubCategorias
        Schema::dropIfExists('Tb_Estado_Documento');   // No depende de ninguna tabla

    }
};
