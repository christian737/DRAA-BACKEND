<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\TipoUsuarioController;

Route::apiResource('tipo-usuarios', TipoUsuarioController::class);

Route::apiResource('usuarios', UsuarioController::class);


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
