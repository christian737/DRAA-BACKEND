<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Provincia;

class ProvinciaController extends Controller
{
    public function index()
    {
        return Provincia::with('departamento')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'Provincia' => 'required|string|max:255',
            'id_departamento' => 'required|exists:tb_departamentos,id',
            'created_by' => 'nullable|string|max:50',
        ]);

        return Provincia::create([
            'Provincia' => $request->Provincia,
            'id_departamento' => $request->id_departamento,
            'activo' => $request->activo ?? false,
            'created_by' => $request->created_by,
        ]);
    }

    public function show($id)
    {
        return Provincia::with('departamento')->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $provincia = Provincia::findOrFail($id);
        $provincia->update([
            'Provincia' => $request->Provincia,
            'id_departamento' => $request->id_departamento ?? $provincia->id_departamento,
            'activo' => $request->activo ?? $provincia->activo,
            'updated_by' => $request->updated_by,
        ]);
        return $provincia;
    }

    public function toggleActivo($id)
    {
        $provincia = Provincia::findOrFail($id);
        $provincia->activo = !$provincia->activo;
        $provincia->save();
        return response()->json(['message' => 'Estado actualizado', 'activo' => $provincia->activo]);
    }

    public function destroy($id)
    {
        Provincia::findOrFail($id)->delete();
        return response()->json(['message' => 'Provincia eliminada']);
    }
}

