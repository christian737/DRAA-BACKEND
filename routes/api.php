<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\TipoUsuarioController;

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
