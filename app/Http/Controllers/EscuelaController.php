<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Escuela;
use Illuminate\Http\Request;

class EscuelaController extends Controller
{
    public function index()
    {
        return Escuela::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'Escuela' => 'required|string',
            'Id_facultad' => 'nullable|integer',
            'activo' => 'boolean',
            'created_by' => 'nullable|string|max:50',
            'updated_by' => 'nullable|string|max:50',
        ]);

        $escuela = Escuela::create($request->all());

        return response()->json($escuela, 201);
    }

    public function show($id)
    {
        return Escuela::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $escuela = Escuela::findOrFail($id);
        $escuela->update($request->all());

        return response()->json($escuela, 200);
    }

    public function destroy($id)
    {
        $escuela = Escuela::findOrFail($id);
        $escuela->delete();

        return response()->json(null, 204);
    }
}
