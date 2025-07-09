<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sede;

class SedeController extends Controller
{
    public function index()
    {
        return Sede::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'Sede' => 'required|string|max:100',
            'created_by' => 'nullable|string|max:50',
        ]);

        return Sede::create([
            'Sede' => $request->Sede,
            'activo' => $request->activo ?? false,
            'created_by' => $request->created_by,
        ]);
    }

    public function show($id)
    {
        return Sede::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $sede = Sede::findOrFail($id);

        $sede->update([
            'Sede' => $request->Sede,
            'activo' => $request->activo ?? $sede->activo,
            'updated_by' => $request->updated_by,
        ]);

        return $sede;
    }

    public function toggleActivo($id)
    {
        $sede = Sede::findOrFail($id);
        $sede->activo = !$sede->activo;
        $sede->save();

        return response()->json(['message' => 'Estado actualizado', 'activo' => $sede->activo]);
    }

    public function destroy($id)
    {
        Sede::findOrFail($id)->delete();
        return response()->json(['message' => 'Sede eliminada']);
    }
}
