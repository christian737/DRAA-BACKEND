<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EstadoEstudiante;

class EstadoEstudianteController extends Controller
{
    public function index()
    {
        return EstadoEstudiante::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'Estado' => 'required|string|max:255|unique:Tb_Estado_estudiante,Estado',
            'created_by' => 'nullable|string|max:50',
        ]);

        return EstadoEstudiante::create([
            'Estado' => $request->Estado,
            'created_by' => $request->created_by,
        ]);
    }

    public function show($id)
    {
        return EstadoEstudiante::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $estado = EstadoEstudiante::findOrFail($id);
        $request->validate([
            'Estado' => 'required|string|max:255|unique:Tb_Estado_estudiante,Estado,' . $id,
        ]);

        $estado->update([
            'Estado' => $request->Estado,
            'updated_by' => $request->updated_by,
        ]);
        return $estado;
    }

    public function destroy($id)
    {
        EstadoEstudiante::findOrFail($id)->delete();
        return response()->json(['message' => 'Estado eliminado']);
    }
}
