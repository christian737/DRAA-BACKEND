<?php

namespace App\Http\Controllers;

use App\Models\Expediente;
use App\Models\Estudiantes;
use App\Models\SubCategoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ExpedienteController extends Controller
{
    public function index()
    {
        $expedientes = Expediente::with(['estudiante', 'subcategoria', 'estado'])->get();
        return response()->json($expedientes);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'Id_Estudiante' => 'required|exists:Tb_Estudiantes,id',
            'Id_SubCategoria' => 'required|exists:Tb_SubCategorias,id',
            'Descripcion_documento' => 'required|string|max:255',
            'Id_estado_documento' => 'required|exists:Tb_Estado_Documento,id',
            'archivo' => 'required|file|mimes:pdf|max:5120', // Máx 5MB
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $estudiante = Estudiantes::findOrFail($request->Id_Estudiante);
        $subcategoria = SubCategoria::with('categoria')->findOrFail($request->Id_SubCategoria);

        $archivo = $request->file('archivo');
        $extension = $archivo->getClientOriginalExtension();

        $categoriaNombre = Str::slug($subcategoria->categoria->Categoria, '_');
        $subcategoriaNombre = Str::slug($subcategoria->SubCategoria, '_');
        $descripcion = Str::slug($request->Descripcion_documento, '_');

        $ruta = "documentos/{$estudiante->Dni}/{$categoriaNombre}/{$subcategoriaNombre}";
        $nombreArchivo = "{$descripcion}.{$extension}";

        // Guardar el archivo
        $archivo->move(public_path($ruta), $nombreArchivo);

        $urlDocumento = "{$ruta}/{$nombreArchivo}";

        $expediente = Expediente::create([
            'Id_Estudiante' => $request->Id_Estudiante,
            'Id_SubCategoria' => $request->Id_SubCategoria,
            'Descripcion_documento' => $request->Descripcion_documento,
            'url_documento' => $urlDocumento,
            'Observacion' => $request->Observacion,
            'Id_estado_documento' => $request->Id_estado_documento,
            'created_by' => auth()->user()->usuario ?? 'Seeder',
            'updated_by' => auth()->user()->usuario ?? 'Seeder',
        ]);

        return response()->json($expediente, 201);
    }

    public function show($id)
    {
        $expediente = Expediente::with(['estudiante', 'subcategoria', 'estado'])->find($id);
        if (!$expediente) {
            return response()->json(['message' => 'No encontrado'], 404);
        }
        return response()->json($expediente);
    }

    public function update(Request $request, $id)
    {
        $expediente = Expediente::findOrFail($id);

        $data = $request->only([
            'Descripcion_documento', 'Observacion', 'Id_estado_documento', 'Id_SubCategoria'
        ]);

        if ($request->hasFile('archivo')) {
            $archivo = $request->file('archivo');
            $extension = $archivo->getClientOriginalExtension();
            $subcategoria = SubCategoria::with('categoria')->findOrFail($request->Id_SubCategoria);
            $categoriaNombre = Str::slug($subcategoria->categoria->Categoria, '_');
            $subcategoriaNombre = Str::slug($subcategoria->SubCategoria, '_');
            $descripcion = Str::slug($request->Descripcion_documento, '_');
            $ruta = "documentos/{$expediente->estudiante->Dni}/{$categoriaNombre}/{$subcategoriaNombre}";
            $nombreArchivo = "{$descripcion}.{$extension}";

            $archivo->move(public_path($ruta), $nombreArchivo);
            $data['url_documento'] = "{$ruta}/{$nombreArchivo}";
        }

        $data['updated_by'] = auth()->user()->usuario ?? 'Seeder';

        $expediente->update($data);
        return response()->json($expediente);
    }

    public function destroy($id)
    {
        $expediente = Expediente::findOrFail($id);

        // Eliminar archivo si existe
        if ($expediente->url_documento && file_exists(public_path($expediente->url_documento))) {
            unlink(public_path($expediente->url_documento));
        }

        $expediente->delete();

        return response()->json(['message' => 'Expediente eliminado correctamente']);
    }
}
