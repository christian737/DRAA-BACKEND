<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Departamento;

class DepartamentoController extends Controller
{
    public function index()
    {
        return Departamento::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'Departamento' => 'required|string|max:255',
            'created_by' => 'nullable|string|max:50',
        ]);

        return Departamento::create([
            'Departamento' => $request->Departamento,
            'activo' => $request->activo ?? false,
            'created_by' => $request->created_by,
        ]);
    }

    public function show($id)
    {
        return Departamento::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $departamento = Departamento::findOrFail($id);
        $departamento->update([
            'Departamento' => $request->Departamento,
            'activo' => $request->activo ?? $departamento->activo,
            'updated_by' => $request->updated_by,
        ]);
        return $departamento;
    }

    public function toggleActivo($id)
    {
        $departamento = Departamento::findOrFail($id);
        $departamento->activo = !$departamento->activo;
        $departamento->save();
        return response()->json(['message' => 'Estado actualizado', 'activo' => $departamento->activo]);
    }

    public function destroy($id)
    {
        Departamento::findOrFail($id)->delete();
        return response()->json(['message' => 'Departamento eliminado']);
    }
}
