<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function index()
    {
        return Usuario::with('tipoUsuario')->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'Dni' => 'required|string',
            'Apellido_paterno' => 'required|string',
            'Apellido_materno' => 'required|string',
            'nombres' => 'required|string',
            'email' => 'required|email|unique:Tb_usuarios,email',
            'usuario' => 'required|string',
            'password' => 'required|string|min:6',
            'Id_Tipo_Usuario' => 'required|exists:Tb_Tipo_usuarios,id',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        return Usuario::create($validated);
    }

    public function show($id)
    {
        return Usuario::with('tipoUsuario')->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $usuario = Usuario::findOrFail($id);

        $data = $request->all();

        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        $usuario->update($data);

        return $usuario;
    }

    public function destroy($id)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->delete();
        return response()->json(['message' => 'Usuario eliminado']);
    }
}

