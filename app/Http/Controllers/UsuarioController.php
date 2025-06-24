<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function index()
    {
        return Usuario::with('tipoUsuario')
            ->get()
            ->map(function ($user) {
                $user->tienePassword = true;
                unset($user->password); // importante: nunca devuelvas la real
                return $user;
            });
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'Dni' => 'required|unique:Tb_usuarios,Dni',
                'Apellido_paterno' => 'required',
                'Apellido_materno' => 'required',
                'nombres' => 'required',
                'email' => 'required|email|unique:Tb_usuarios,email',
                'usuario' => 'required|unique:Tb_usuarios,usuario',
                'password' => 'required|min:6',
                'Id_Tipo_Usuario' => 'required|exists:Tb_tipo_usuarios,id',
            ]);


            $validated['password'] = bcrypt($validated['password']);

            $usuario = Usuario::create($validated);

            return response()->json($usuario, 201);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al crear el usuario',
                'mensaje' => $e->getMessage()
            ], 500);
        }
    }


    public function show($id)
    {
        return Usuario::with('tipoUsuario')->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $usuario = Usuario::findOrFail($id);

        $data = $request->except(['password', 'foto']); // excluimos primero

        // Solo actualiza la password si viene una nueva
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->input('password'));
        }

        // Solo actualiza la foto si viene una nueva
        if ($request->filled('foto')) {
            $data['foto'] = $request->input('foto');
        }

        $usuario->update($data);

        return response()->json([
            'success' => true,
            'usuario' => $usuario
        ]);
    }


    public function destroy($id)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->delete();
        return response()->json(['message' => 'Usuario eliminado']);
    }

    public function cambiarPassword(Request $request, $id)
    {
        $request->validate([
            'actual' => 'required|string',
            'nueva' => 'required|string|min:6',
        ]);

        $usuario = Usuario::findOrFail($id);

        if (!Hash::check($request->actual, $usuario->password)) {
            return response()->json(['error' => 'Contraseña actual incorrecta'], 400);
        }

        $usuario->password = Hash::make($request->nueva);
        $usuario->save();

        return response()->json(['message' => 'Contraseña actualizada con éxito']);
    }

}

