<?php

namespace App\Http\Controllers;

use App\Models\SubCategoria;
use Illuminate\Http\Request;

class SubCategoriaController extends Controller
{
    public function index()
    {
        return SubCategoria::with('categoria')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'SubCategoria' => 'required|unique:Tb_SubCategorias,SubCategoria',
            'Id_Categoria' => 'required|exists:Tb_Categorias,id',
            'activo' => 'required|boolean',
        ]);

        $data = $request->all();
        $data['created_by'] = 'Seeder';
        $data['updated_by'] = 'Seeder';

        $subcategoria = SubCategoria::create($data);
        return response()->json($subcategoria, 201);
    }

    public function show($id)
    {
        return SubCategoria::with('categoria')->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $subcategoria = SubCategoria::findOrFail($id);

        $request->validate([
            'SubCategoria' => 'required|unique:Tb_SubCategorias,SubCategoria,' . $id,
            'Id_Categoria' => 'required|exists:Tb_Categorias,id',
            'activo' => 'required|boolean',
        ]);

        $data = $request->all();
        $data['updated_by'] = 'Seeder';

        $subcategoria->update($data);

        return response()->json($subcategoria);
    }

    public function destroy($id)
    {
        $subcategoria = SubCategoria::findOrFail($id);
        $subcategoria->delete();

        return response()->json(['message' => 'Subcategoría eliminada correctamente']);
    }
}
