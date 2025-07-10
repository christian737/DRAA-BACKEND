<?php

namespace App\Http\Controllers;

use App\Models\Expediente;
use App\Models\Estudiantes;
use App\Models\SubCategoria;
use Illuminate\Http\Request;

class ExpedienteController extends Controller
{
    public function index()
    {
        return response()->json(
            Expediente::with('estudiante', 'subcategoria')->get()
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'Id_Estudiante' => 'required|exists:Tb_Estudiantes,id',
            'Id_SubCategoria' => 'required|exists:Tb_SubCategorias,id',
            'Descripcion_documento' => 'nullable|string',
            'Observacion' => 'nullable|string',
            'Id_estado_documento' => 'required|exists:Tb_Estado_Documento,id',
            'documento' => 'required|file|mimes:pdf,jpeg,png,jpg,docx|max:5120',
        ]);

        $estudiante = Estudiantes::find($request->Id_Estudiante);
        $subcategoria = SubCategoria::with('categoria')->find($request->Id_SubCategoria);

        $dni = $estudiante->Dni;
        $categoria = str_replace([' ', 'Á', 'É', 'Í', 'Ó', 'Ú'], ['_', 'A', 'E', 'I', 'O', 'U'], strtoupper($subcategoria->categoria->Categoria));
        $subcategoriaStr = str_replace([' ', 'Á', 'É', 'Í', 'Ó', 'Ú'], ['_', 'A', 'E', 'I', 'O', 'U'], strtoupper($subcategoria->SubCategoria));

        $ruta = "documentos/$dni/$categoria/$subcategoriaStr";

        $archivo = $request->file('documento');
        $nombreArchivo = time() . '_' . $archivo->getClientOriginalName();
        $archivo->move(public_path($ruta), $nombreArchivo);

        $expediente = Expediente::create([
            'Id_Estudiante' => $request->Id_Estudiante,
            'Id_SubCategoria' => $request->Id_SubCategoria,
            'Descripcion_documento' => $request->Descripcion_documento,
            'Observacion' => $request->Observacion,
            'Id_estado_documento' => $request->Id_estado_documento,
            'url_documento' => "$ruta/$nombreArchivo",
            'created_by' => auth()->user()->usuario ?? 'Seeder',
            'updated_by' => auth()->user()->usuario ?? 'Seeder',
        ]);

        return response()->json($expediente, 201);
    }

    public function show($id)
    {
        $expediente = Expediente::with('estudiante', 'subcategoria')->find($id);
        return $expediente ? response()->json($expediente) : response()->json(['message' => 'No encontrado'], 404);
    }

    public function destroy($id)
    {
        $expediente = Expediente::find($id);
        if (!$expediente) return response()->json(['message' => 'No encontrado'], 404);

        $ruta = public_path($expediente->url_documento);
        if (file_exists($ruta)) unlink($ruta);

        $expediente->delete();
        return response()->json(['message' => 'Expediente eliminado correctamente']);
    }
}
