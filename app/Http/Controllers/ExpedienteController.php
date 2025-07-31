<?php

namespace App\Http\Controllers;

use App\Models\Expediente;
use App\Models\Estudiantes;
use App\Models\SubCategoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ExpedienteController extends Controller
{
    public function index()
    {
        return response()->json(
            Expediente::with(['estudiante', 'subcategoria', 'estado'])->get()
        );
    }

    public function getByEstudiante($id)
    {
        return response()->json(
            Expediente::with(['subcategoria', 'estado'])
                ->where('Id_Estudiante', $id)
                ->get()
        );
    }

    public function store(Request $request)
    {
        // ✅ Si viene un ID, es actualización
        if ($request->has('id')) {
            return $this->update($request, $request->id);
        }

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
        $categoriaNombre = Str::slug($subcategoria->categoria->Categoria, '_');
        $subcategoriaNombre = Str::slug($subcategoria->SubCategoria, '_');

        $ruta = "documentos/{$estudiante->Dni}/{$categoriaNombre}/{$subcategoriaNombre}";
        if (!file_exists(public_path($ruta))) {
            mkdir(public_path($ruta), 0777, true);
        }

        // ✅ Guardar con nombre único
        $nombreArchivo = time() . '_' . $archivo->getClientOriginalName();
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

        $expediente->NombreArchivo = $nombreArchivo;
        return response()->json($expediente, 201);
    }

    public function show($id)
    {
        $expediente = Expediente::with(['estudiante', 'subcategoria', 'estado'])->find($id);
        if (!$expediente) {
            return response()->json(['message' => 'No encontrado'], 404);
        }

        $expediente->NombreArchivo = basename($expediente->url_documento);
        return response()->json($expediente);
    }
    public function update(Request $request, $id)
    {
        // 🔹 Cargar expediente con todas sus relaciones necesarias
        $expediente = Expediente::with(['estudiante', 'subcategoria.categoria'])->findOrFail($id);

        // 🔹 Datos actualizables
        $data = $request->only([
            'Descripcion_documento',
            'Observacion',
            'Id_estado_documento',
            'Id_SubCategoria'
        ]);

        // 🔹 Si cambia la subcategoría, recalcular carpeta
        if ($request->has('Id_SubCategoria')) {
            $subcategoria = SubCategoria::with('categoria')->findOrFail($request->Id_SubCategoria);
        } else {
            $subcategoria = $expediente->subcategoria;
        }

        $categoriaNombre = Str::slug($subcategoria->categoria->Categoria, '_');
        $subcategoriaNombre = Str::slug($subcategoria->SubCategoria, '_');
        $dniEstudiante = $expediente->estudiante->Dni;

        // 🔹 Si hay nuevo archivo, reemplazar
        if ($request->hasFile('archivo')) {
            $archivo = $request->file('archivo');

            $ruta = "documentos/{$dniEstudiante}/{$categoriaNombre}/{$subcategoriaNombre}";
            if (!file_exists(public_path($ruta))) {
                mkdir(public_path($ruta), 0777, true);
            }

            // 🔹 Borrar archivo anterior si existe
            if ($expediente->url_documento && file_exists(public_path($expediente->url_documento))) {
                unlink(public_path($expediente->url_documento));
            }

            $nombreArchivo = time() . '_' . $archivo->getClientOriginalName();
            $archivo->move(public_path($ruta), $nombreArchivo);
            $data['url_documento'] = "{$ruta}/{$nombreArchivo}";
        }

        // 🔹 Actualizar registro
        $data['updated_by'] = auth()->user()->usuario ?? 'Seeder';
        $expediente->update($data);

        // 🔹 Recargar expediente con TODAS las relaciones (subcategoria + categoria)
        $expediente = Expediente::with(['subcategoria.categoria', 'estado', 'estudiante'])->find($id);
        $expediente->NombreArchivo = basename($expediente->url_documento);

        return response()->json($expediente);
    }

    public function destroy($id)
    {
        $expediente = Expediente::findOrFail($id);

        if ($expediente->url_documento && file_exists(public_path($expediente->url_documento))) {
            unlink(public_path($expediente->url_documento));
        }

        $expediente->delete();
        return response()->json(['message' => 'Expediente eliminado correctamente']);
    }
}
