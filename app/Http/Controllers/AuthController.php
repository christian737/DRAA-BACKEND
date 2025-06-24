<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        try {
            $request->validate([
                'usuario' => 'required|string',
                'password' => 'required|string'
            ]);

            $usuario = Usuario::where('usuario', $request->usuario)->first();

            if (!$usuario || !Hash::check($request->password, $usuario->password)) {
                return response()->json([
                    'message' => 'Usuario o contraseña incorrectos'
                ], 401);
            }

            // Elimina tokens anteriores (opcional, por seguridad)
            $usuario->tokens()->delete();

            $token = $usuario->createToken('api_token')->plainTextToken;

            return response()->json([
                'usuario' => $usuario,
                'token' => $token
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Error interno',
                'details' => $e->getMessage(),
            ], 500);
        }
    }

    public function logout(Request $request)
    {
        // Elimina todos los tokens del usuario autenticado
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'Sesión cerrada correctamente']);
    }
}
