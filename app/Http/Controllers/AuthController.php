<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'usuario' => 'required|string',
            'password' => 'required|string'
        ]);

        $usuario = \App\Models\Usuario::where('usuario', $request->usuario)->first();

        if (!$usuario || !\Hash::check($request->password, $usuario->password)) {
            return response()->json([
                'message' => 'Usuario o contraseña incorrectos'
            ], 401);
        }

        $token = $usuario->createToken('api_token')->plainTextToken;

        return response()->json([
            'usuario' => $usuario,
            'token' => $token
        ]);
    }
}
     