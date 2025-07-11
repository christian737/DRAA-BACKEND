<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\TipoUsuarioController;
use App\Http\Controllers\PeriodoController;
use App\Http\Controllers\FacultadController;
use App\Http\Controllers\EscuelaController;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\ProvinciaController;
use App\Http\Controllers\DistritoController;
use App\Http\Controllers\ModalidadIngresoController;
use App\Http\Controllers\CurriculumController;
use App\Http\Controllers\EstadoEstudianteController;
use App\Http\Controllers\SedeController;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\SubCategoriaController;
use App\Http\Controllers\ExpedienteController;
use App\Http\Controllers\EstadoDocumentoController;

Route::prefix('estado-documentos')->group(function () {
    Route::get('/', [EstadoDocumentoController::class, 'index']);
    Route::post('/', [EstadoDocumentoController::class, 'store']);
    Route::get('/{id}', [EstadoDocumentoController::class, 'show']);
    Route::put('/{id}', [EstadoDocumentoController::class, 'update']);
    Route::delete('/{id}', [EstadoDocumentoController::class, 'destroy']);
});


Route::prefix('expedientes')->group(function () {

    Route::get('/', [ExpedienteController::class, 'index']);
    Route::get('/{id}', [ExpedienteController::class, 'show']);
    Route::post('/', [ExpedienteController::class, 'store']);
    Route::delete('/{id}', [ExpedienteController::class, 'destroy']);
});

Route::prefix('subcategorias')->group(function () {
    Route::get('/', [SubCategoriaController::class, 'index']);
    Route::post('/', [SubCategoriaController::class, 'store']);
    Route::get('/{id}', [SubCategoriaController::class, 'show']);
    Route::put('/{id}', [SubCategoriaController::class, 'update']);
    Route::delete('/{id}', [SubCategoriaController::class, 'destroy']);
});


Route::prefix('categorias')->group(function () {
    Route::get('/', [CategoriaController::class, 'index'])->name('categorias.index');
    Route::post('/', [CategoriaController::class, 'store'])->name('categorias.store');
    Route::get('/{id}', [CategoriaController::class, 'show'])->name('categorias.show');
    Route::put('/{id}', [CategoriaController::class, 'update'])->name('categorias.update');
    Route::delete('/{id}', [CategoriaController::class, 'destroy'])->name('categorias.destroy');
});

Route::prefix('estudiantes')->group(function () {
    

    Route::post('/', [EstudianteController::class, 'store']);
    Route::get('/', [EstudianteController::class, 'index']);
    Route::get('/{id}', [EstudianteController::class, 'show']);
    Route::put('/{id}', [EstudianteController::class, 'update']);
    Route::delete('/{id}', [EstudianteController::class, 'destroy']);
});
Route::prefix('sedes')->group(function () {
    Route::get('/', [SedeController::class, 'index']);
    Route::post('/', [SedeController::class, 'store']);
    Route::get('{id}', [SedeController::class, 'show']);
    Route::put('{id}', [SedeController::class, 'update']);
    Route::patch('{id}/toggle', [SedeController::class, 'toggleActivo']);
    Route::delete('{id}', [SedeController::class, 'destroy']);
});

Route::prefix('estado-estudiante')->group(function () {
    Route::get('/', [EstadoEstudianteController::class, 'index']);
    Route::post('/', [EstadoEstudianteController::class, 'store']);
    Route::get('{id}', [EstadoEstudianteController::class, 'show']);
    Route::put('{id}', [EstadoEstudianteController::class, 'update']);
    Route::delete('{id}', [EstadoEstudianteController::class, 'destroy']);
});

Route::prefix('curriculums')->group(function () {
    Route::get('/', [CurriculumController::class, 'index']);
    Route::post('/', [CurriculumController::class, 'store']);
    Route::get('{id}', [CurriculumController::class, 'show']);
    Route::put('{id}', [CurriculumController::class, 'update']);
    Route::patch('{id}/toggle', [CurriculumController::class, 'toggleActivo']);
    Route::delete('{id}', [CurriculumController::class, 'destroy']);
    Route::get('/escuela/{id_escuela}', [CurriculumController::class, 'getByEscuela']);
    Route::get('/escuela/{id_escuela}/activos', [CurriculumController::class, 'getActivosByEscuela']);
});

Route::prefix('modalidades')->group(function () {
    Route::get('/', [ModalidadIngresoController::class, 'index']);
    Route::post('/', [ModalidadIngresoController::class, 'store']);
    Route::get('{id}', [ModalidadIngresoController::class, 'show']);
    Route::put('{id}', [ModalidadIngresoController::class, 'update']);
    Route::patch('{id}/toggle', [ModalidadIngresoController::class, 'toggleActivo']);
    Route::delete('{id}', [ModalidadIngresoController::class, 'destroy']);
});

Route::prefix('distritos')->group(function () {
    Route::get('/', [DistritoController::class, 'index']);
    Route::post('/', [DistritoController::class, 'store']);
    Route::get('{id}', [DistritoController::class, 'show']);
    Route::put('{id}', [DistritoController::class, 'update']);
    Route::patch('{id}/toggle', [DistritoController::class, 'toggleActivo']);
    Route::delete('{id}', [DistritoController::class, 'destroy']);
    Route::get('/provincia/{id_provincia}', [DistritoController::class, 'getByProvincia']);
    Route::get('/provincia/{id_provincia}/activos', [DistritoController::class, 'getActivosByProvincia']);
});

Route::prefix('provincias')->group(function () {
    Route::get('/', [ProvinciaController::class, 'index']);
    Route::post('/', [ProvinciaController::class, 'store']);
    Route::get('{id}', [ProvinciaController::class, 'show']);
    Route::put('{id}', [ProvinciaController::class, 'update']);
    Route::patch('{id}/toggle', [ProvinciaController::class, 'toggleActivo']);
    Route::delete('{id}', [ProvinciaController::class, 'destroy']);
});
Route::prefix('departamentos')->group(function () {
    Route::get('/', [DepartamentoController::class, 'index']);
    Route::post('/', [DepartamentoController::class, 'store']);
    Route::get('{id}', [DepartamentoController::class, 'show']);
    Route::put('{id}', [DepartamentoController::class, 'update']);
    Route::patch('{id}/toggle', [DepartamentoController::class, 'toggleActivo']);
    Route::delete('{id}', [DepartamentoController::class, 'destroy']);
});
Route::apiResource('escuelas', EscuelaController::class);
Route::apiResource('facultades', FacultadController::class);

Route::apiResource('periodos', PeriodoController::class);
/*
|--------------------------------------------------------------------------
| Rutas públicas (sin autenticación)
|--------------------------------------------------------------------------
*/
Route::post('/login', [AuthController::class, 'login']);

/*
|--------------------------------------------------------------------------
| Rutas protegidas con Sanctum
|--------------------------------------------------------------------------
*/
Route::middleware('auth:sanctum')->group(function () {

    // Cerrar sesión
    Route::post('/logout', [AuthController::class, 'logout']);

    // Obtener datos del usuario autenticado
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Gestión de usuarios y tipos
    Route::apiResource('usuarios', UsuarioController::class);
    Route::put('/usuarios/{id}/cambiar-password', [UsuarioController::class, 'cambiarPassword']);
    Route::apiResource('tipo-usuarios', TipoUsuarioController::class);
});
