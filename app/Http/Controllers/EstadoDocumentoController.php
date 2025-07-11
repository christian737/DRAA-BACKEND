<?php

namespace App\Http\Controllers;

use App\Models\EstadoDocumento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EstadoDocumentoController extends Controller
{
    public function index()
    {
        return EstadoDocumento::all();
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'Estado' => 'required|unique:Tb_Estado_Documento,Estado',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $estado = EstadoDocumento::create([
            'Estado' => $request->Estado,
            'created_by' => $request->created_by ?? 'admin',
            'updated_by' => $request->updated_by ?? 'admin',
        ]);

        return response()->json($estado, 201);
    }

    public function show($id)
    {
        $estado = EstadoDocumento::find($id);
        if (!$estado) {
            return response()->json(['message' => 'Estado no encontrado'], 404);
        }
        return response()->json($estado);
    }

    public function update(Request $request, $id)
    {
        $estado = EstadoDocumento::find($id);
        if (!$estado) {
            return response()->json(['message' => 'Estado no encontrado'], 404);
        }

        $estado->update([
            'Estado' => $request->Estado ?? $estado->Estado,
            'updated_by' => $request->updated_by ?? 'admin',
        ]);

        return response()->json($estado);
    }

    public function destroy($id)
    {
        $estado = EstadoDocumento::find($id);
        if (!$estado) {
            return response()->json(['message' => 'Estado no encontrado'], 404);
        }

        $estado->delete();
        return response()->json(['message' => 'Estado eliminado correctamente']);
    }
}
