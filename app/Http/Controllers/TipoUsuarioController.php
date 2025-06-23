<?php

namespace App\Http\Controllers;

use App\Models\TipoUsuario;
use Illuminate\Http\Request;

class TipoUsuarioController extends Controller
{
    public function index()
    {
        return TipoUsuario::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'descripcion' => 'required|string|max:100',
            'activo' => 'boolean',
            'created_by' => 'nullable|string|max:50',
            'updated_by' => 'nullable|string|max:50',
        ]);

        return TipoUsuario::create($data);
    }

    public function show($id)
    {
        return TipoUsuario::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $tipoUsuario = TipoUsuario::findOrFail($id);

        $data = $request->validate([
            'descripcion' => 'sometimes|required|string|max:100',
            'activo' => 'sometimes|boolean',
            'created_by' => 'nullable|string|max:50',
            'updated_by' => 'nullable|string|max:50',
        ]);

        $tipoUsuario->update($data);

        return $tipoUsuario;
    }

    public function destroy($id)
    {
        $tipoUsuario = TipoUsuario::findOrFail($id);
        $tipoUsuario->delete();

        return response()->json(['message' => 'Tipo de usuario eliminado']);
    }
}
