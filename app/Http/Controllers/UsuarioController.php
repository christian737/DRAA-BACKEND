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

                if ($user->foto) {
                    $user->foto_url = asset('uploads/usuarios/' . $user->foto);
                }

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
                'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
            ]);

            $validated['password'] = bcrypt($validated['password']);

            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                $filename = $validated['Dni'] . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/usuarios'), $filename);
                $validated['foto'] = $filename;
            }

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
        $usuario = Usuario::with('tipoUsuario')->findOrFail($id);

        if ($usuario->foto) {
            $usuario->foto_url = asset('uploads/usuarios/' . $usuario->foto);
        }

        return $usuario;
    }

    public function update(Request $request, $id)
    {
        $usuario = Usuario::findOrFail($id);

        $data = $request->except(['password', 'foto']);

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->input('password'));
        }

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = $usuario->Dni . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/usuarios'), $filename);
            $data['foto'] = $filename;
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
