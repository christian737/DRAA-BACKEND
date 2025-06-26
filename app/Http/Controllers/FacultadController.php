<?php

namespace App\Http\Controllers;

use App\Models\Facultad;
use Illuminate\Http\Request;

class FacultadController extends Controller
{
    public function index()
    {
        return response()->json(Facultad::all());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'Facultad' => 'required|string|max:255',
            'activo' => 'boolean',
            'created_by' => 'nullable|string|max:50',
            'updated_by' => 'nullable|string|max:50',
        ]);

        $facultad = Facultad::create($data);
        return response()->json($facultad, 201);
    }

    public function show($id)
    {
        $facultad = Facultad::findOrFail($id);
        return response()->json($facultad);
    }

    public function update(Request $request, $id)
    {
        $facultad = Facultad::findOrFail($id);
        $data = $request->validate([
            'Facultad' => 'sometimes|required|string|max:255',
            'activo' => 'boolean',
            'created_by' => 'nullable|string|max:50',
            'updated_by' => 'nullable|string|max:50',
        ]);

        $facultad->update($data);
        return response()->json($facultad);
    }

    public function destroy($id)
    {
        $facultad = Facultad::findOrFail($id);
        $facultad->delete();
        return response()->json(['message' => 'Eliminado correctamente.']);
    }
}
