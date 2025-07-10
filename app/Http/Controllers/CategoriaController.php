<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index()
    {
        return Categoria::all();
        
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'Categoria' => 'required|unique:Tb_Categorias,Categoria',
            'activo' => 'boolean',
            'created_by' => 'nullable|string|max:50',
            'updated_by' => 'nullable|string|max:50',
        ]);

        $categoria = Categoria::create($validated);

        return response()->json($categoria, 201);
    }

    public function show($id)
    {
        return Categoria::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $categoria = Categoria::findOrFail($id);

        $validated = $request->validate([
            'Categoria' => 'sometimes|required|unique:Tb_Categorias,Categoria,' . $id,
            'activo' => 'boolean',
            'created_by' => 'nullable|string|max:50',
            'updated_by' => 'nullable|string|max:50',
        ]);

        $categoria->update($validated);

        return response()->json($categoria);
    }

    public function destroy($id)
    {
        $categoria = Categoria::findOrFail($id);
        $categoria->delete();

        return response()->json(['message' => 'Categoría eliminada']);
    }
}
