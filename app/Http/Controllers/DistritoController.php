<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Distrito;

class DistritoController extends Controller
{
    public function index()
    {
        return Distrito::with('provincia')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'Distrito' => 'required|string|max:255',
            'id_provincia' => 'required|exists:Tb_Provincia,id',
            'created_by' => 'nullable|string|max:50',
        ]);

        return Distrito::create([
            'Distrito' => $request->Distrito,
            'id_provincia' => $request->id_provincia,
            'activo' => $request->activo ?? false,
            'created_by' => $request->created_by,
        ]);
    }

    public function show($id)
    {
        return Distrito::with('provincia')->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $distrito = Distrito::findOrFail($id);
        $distrito->update([
            'Distrito' => $request->Distrito,
            'id_provincia' => $request->id_provincia ?? $distrito->id_provincia,
            'activo' => $request->activo ?? $distrito->activo,
            'updated_by' => $request->updated_by,
        ]);
        return $distrito;
    }

    public function toggleActivo($id)
    {
        $distrito = Distrito::findOrFail($id);
        $distrito->activo = !$distrito->activo;
        $distrito->save();
        return response()->json(['message' => 'Estado actualizado', 'activo' => $distrito->activo]);
    }

    public function destroy($id)
    {
        Distrito::findOrFail($id)->delete();
        return response()->json(['message' => 'Distrito eliminado']);
    }

    public function getByProvincia($id_provincia)
    {
        return Distrito::with('provincia')
            ->where('id_provincia', $id_provincia)
            ->get();
    }

    public function getActivosByProvincia($id_provincia)
    {
        return Distrito::with('provincia')
            ->where('id_provincia', $id_provincia)
            ->where('activo', true)
            ->get();
    }
}
