<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ModalidadIngreso;

class ModalidadIngresoController extends Controller
{
    public function index()
    {
        return ModalidadIngreso::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'Modalidad' => 'required|string|max:255',
            'created_by' => 'nullable|string|max:50',
        ]);

        return ModalidadIngreso::create([
            'Modalidad' => $request->Modalidad,
            'activo' => $request->activo ?? false,
            'created_by' => $request->created_by,
        ]);
    }

    public function show($id)
    {
        return ModalidadIngreso::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $modalidad = ModalidadIngreso::findOrFail($id);
        $modalidad->update([
            'Modalidad' => $request->Modalidad,
            'activo' => $request->activo ?? $modalidad->activo,
            'updated_by' => $request->updated_by,
        ]);
        return $modalidad;
    }

    public function toggleActivo($id)
    {
        $modalidad = ModalidadIngreso::findOrFail($id);
        $modalidad->activo = !$modalidad->activo;
        $modalidad->save();
        return response()->json(['message' => 'Estado actualizado', 'activo' => $modalidad->activo]);
    }

    public function destroy($id)
    {
        ModalidadIngreso::findOrFail($id)->delete();
        return response()->json(['message' => 'Modalidad eliminada']);
    }
}
