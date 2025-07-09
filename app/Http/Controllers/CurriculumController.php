<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curriculum;

class CurriculumController extends Controller
{
    public function index()
    {
        return Curriculum::with('escuela')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'Cod' => 'required|string|max:20',
            'Curriculum' => 'required|string|max:255',
            'Id_Escuela' => 'nullable|exists:Tb_Escuela,id',
            'created_by' => 'nullable|string|max:50',
        ]);

        return Curriculum::create([
            'Cod' => $request->Cod,
            'Curriculum' => $request->Curriculum,
            'Id_Escuela' => $request->Id_Escuela,
            'activo' => $request->activo ?? false,
            'created_by' => $request->created_by,
        ]);
    }

    public function show($id)
    {
        return Curriculum::with('escuela')->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $curriculum = Curriculum::findOrFail($id);
        $curriculum->update([
            'Cod' => $request->Cod,
            'Curriculum' => $request->Curriculum,
            'Id_Escuela' => $request->Id_Escuela ?? $curriculum->Id_Escuela,
            'activo' => $request->activo ?? $curriculum->activo,
            'updated_by' => $request->updated_by,
        ]);
        return $curriculum;
    }

    public function toggleActivo($id)
    {
        $curriculum = Curriculum::findOrFail($id);
        $curriculum->activo = !$curriculum->activo;
        $curriculum->save();
        return response()->json(['message' => 'Estado actualizado', 'activo' => $curriculum->activo]);
    }

    public function destroy($id)
    {
        Curriculum::findOrFail($id)->delete();
        return response()->json(['message' => 'Curriculum eliminado']);
    }

    public function getByEscuela($id_escuela)
    {
        return Curriculum::with('escuela')
            ->where('Id_Escuela', $id_escuela)
            ->get();
    }

    public function getActivosByEscuela($id_escuela)
    {
        return Curriculum::with('escuela')
            ->where('Id_Escuela', $id_escuela)
            ->where('activo', true)
            ->get();
    }
}
