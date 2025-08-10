<?php

namespace App\Http\Controllers;

use App\Models\Expediente;
use App\Models\Estudiantes;
use App\Models\SubCategoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class ExpedienteController extends Controller
{
    public function index()
    {
        $items = Expediente::with(['estudiante', 'subcategoria', 'estado'])->get();

        $items->transform(function ($exp) {
            $exp->NombreArchivo = $exp->url_documento ? basename($exp->url_documento) : null;

            // Cargar manifest de referencias si existe
            try {
                $dni = $exp->estudiante?->Dni;
                $categoriaNombre = Str::slug($exp->subcategoria?->categoria?->Categoria ?? '', '_');
                $subcategoriaNombre = Str::slug($exp->subcategoria?->SubCategoria ?? '', '_');
                if ($dni && $categoriaNombre && $subcategoriaNombre) {
                    $rutaBase = "documentos/{$dni}/{$categoriaNombre}/{$subcategoriaNombre}";
                    $exp->Referencias = $this->loadRefsManifest($rutaBase);
                } else {
                    $exp->Referencias = [];
                }
            } catch (\Throwable $e) {
                $exp->Referencias = [];
            }

            return $exp;
        });

        return response()->json($items);
    }

    public function getByEstudiante($id)
    {
        $items = Expediente::with(['subcategoria.categoria', 'estado', 'estudiante'])
            ->where('Id_Estudiante', $id)
            ->get();

        $items->transform(function ($exp) {
            $exp->NombreArchivo = $exp->url_documento ? basename($exp->url_documento) : null;

            try {
                $dni = $exp->estudiante?->Dni;
                $categoriaNombre = Str::slug($exp->subcategoria?->categoria?->Categoria ?? '', '_');
                $subcategoriaNombre = Str::slug($exp->subcategoria?->SubCategoria ?? '', '_');
                if ($dni && $categoriaNombre && $subcategoriaNombre) {
                    $rutaBase = "documentos/{$dni}/{$categoriaNombre}/{$subcategoriaNombre}";
                    $exp->Referencias = $this->loadRefsManifest($rutaBase);
                } else {
                    $exp->Referencias = [];
                }
            } catch (\Throwable $e) {
                $exp->Referencias = [];
            }

            return $exp;
        });

        return response()->json($items);
    }

    public function store(Request $request)
    {
        Log::info('📥 [store] payload', $request->all());
        Log::info('📎 [store] files', $request->allFiles());
        Log::info('🔍 [refs] Referencias(JSON)', ['Referencias' => $request->input('Referencias')]);
        Log::info('🔍 [refs] referencias[indexadas]', ['referencias' => $request->input('referencias')]);

        try {
            $validator = Validator::make($request->all(), [
                'Id_Estudiante' => 'required|exists:Tb_Estudiantes,id',
                'Id_SubCategoria' => 'required|exists:Tb_SubCategorias,id',
                'Descripcion_documento' => 'required|string|max:255',
                'Id_estado_documento' => 'required|exists:Tb_Estado_Documento,id',
                'archivo' => 'required|file|mimes:pdf|max:5120',
                'Fecha_recepcion' => 'nullable|date', // ✅ NUEVO
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $estudiante = Estudiantes::findOrFail($request->Id_Estudiante);
            $subcategoria = SubCategoria::with('categoria')->findOrFail($request->Id_SubCategoria);

            $archivo = $request->file('archivo');
            $categoriaNombre = Str::slug($subcategoria->categoria->Categoria, '_');
            $subcategoriaNombre = Str::slug($subcategoria->SubCategoria, '_');

            $rutaBase = "documentos/{$estudiante->Dni}/{$categoriaNombre}/{$subcategoriaNombre}";
            $this->ensureDir($rutaBase);

            // PDF principal del expediente
            $nombreArchivo = time() . '_' . $archivo->getClientOriginalName();
            $archivo->move(public_path($rutaBase), $nombreArchivo);
            $urlDocumento = "{$rutaBase}/{$nombreArchivo}";

            // Regla: Activo => Observacion vacía
            $observacion = ((int) $request->Id_estado_documento === 1) ? "" : ($request->Observacion ?? "");

            $expediente = Expediente::create([
                'Id_Estudiante' => $request->Id_Estudiante,
                'Id_SubCategoria' => $request->Id_SubCategoria,
                'Descripcion_documento' => $request->Descripcion_documento,
                'url_documento' => $urlDocumento,
                'Observacion' => $observacion,
                'Fecha_recepcion' => $request->Fecha_recepcion ?: null, // ✅ NUEVO
                'Id_estado_documento' => $request->Id_estado_documento,
                'created_by' => auth()->user()->usuario ?? 'Seeder',
                'updated_by' => auth()->user()->usuario ?? 'Seeder',
            ]);

            // Referencias -> subcarpeta + manifest
            $refs = $this->processReferencesToFolder($request, $rutaBase);
            $this->saveRefsManifest($rutaBase, $refs);

            // Respuesta
            $expediente->NombreArchivo = $nombreArchivo;
            $expediente->Referencias = $refs;
            Log::info('✅ [store] referencias guardadas', $refs);

            return response()->json($expediente, 201);
        } catch (\Throwable $e) {
            Log::error('💥 [store] EXCEPTION', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);
            return response()->json([
                'message' => 'Error interno en store',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    public function update(Request $request, $id)
    {
        Log::info('📥 [update] payload', $request->all());
        Log::info('📎 [update] files', $request->allFiles());
        Log::info('🔍 [refs] Referencias(JSON)', ['Referencias' => $request->input('Referencias')]);
        Log::info('🔍 [refs] referencias[indexadas]', ['referencias' => $request->input('referencias')]);

        try {
            // (Opcional) valida fecha cuando venga
            $request->validate([
                'Fecha_recepcion' => 'nullable|date', // ✅ NUEVO
            ]);

            $expediente = Expediente::with(['estudiante', 'subcategoria.categoria'])->findOrFail($id);

            $data = $request->only([
                'Descripcion_documento',
                'Observacion',
                'Id_estado_documento',
                'Id_SubCategoria',
                'Fecha_recepcion', // ✅ NUEVO
            ]);

            // Normaliza fecha vacía a null (evita string vacío en DB)
            if ($request->has('Fecha_recepcion')) {
                $data['Fecha_recepcion'] = $request->Fecha_recepcion ?: null; // ✅ NUEVO
            }

            // Regla: Activo => Observacion vacía
            if ($request->filled('Id_estado_documento') && (int) $request->Id_estado_documento === 1) {
                $data['Observacion'] = "";
            }

            // Recalcular carpeta si cambia subcategoría
            if ($request->has('Id_SubCategoria')) {
                $subcategoria = SubCategoria::with('categoria')->findOrFail($request->Id_SubCategoria);
            } else {
                $subcategoria = $expediente->subcategoria;
            }

            $categoriaNombre = Str::slug($subcategoria->categoria->Categoria, '_');
            $subcategoriaNombre = Str::slug($subcategoria->SubCategoria, '_');
            $dniEstudiante = $expediente->estudiante->Dni;

            $rutaBase = "documentos/{$dniEstudiante}/{$categoriaNombre}/{$subcategoriaNombre}";
            $this->ensureDir($rutaBase);

            // Reemplazar PDF principal si llega uno nuevo
            if ($request->hasFile('archivo')) {
                $archivo = $request->file('archivo');

                if ($expediente->url_documento && file_exists(public_path($expediente->url_documento))) {
                    @unlink(public_path($expediente->url_documento));
                }

                $nombreArchivo = time() . '_' . $archivo->getClientOriginalName();
                $archivo->move(public_path($rutaBase), $nombreArchivo);
                $data['url_documento'] = "{$rutaBase}/{$nombreArchivo}";
            }

            $data['updated_by'] = auth()->user()->usuario ?? 'Seeder';
            $expediente->update($data);

            // Referencias si llegan
            if ($request->has('Referencias') || $request->has('referencias') || count($request->allFiles()) > 0) {
                $refs = $this->processReferencesToFolder($request, $rutaBase);
                $this->saveRefsManifest($rutaBase, $refs);
                Log::info('✅ [update] referencias guardadas', $refs);
            }

            // Respuesta + manifest
            $expediente = Expediente::with(['subcategoria.categoria', 'estado', 'estudiante'])->find($id);
            $expediente->NombreArchivo = $expediente->url_documento ? basename($expediente->url_documento) : null;
            $expediente->Referencias = $this->loadRefsManifest($rutaBase);

            return response()->json($expediente);
        } catch (\Throwable $e) {
            Log::error('💥 [update] EXCEPTION', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);
            return response()->json([
                'message' => 'Error interno en update',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    public function show($id)
    {
        $expediente = Expediente::with(['estudiante', 'subcategoria.categoria', 'estado'])->find($id);
        if (!$expediente) {
            return response()->json(['message' => 'No encontrado'], 404);
        }

        $expediente->NombreArchivo = $expediente->url_documento ? basename($expediente->url_documento) : null;

        // Cargar manifest de referencias
        try {
            $dni = $expediente->estudiante?->Dni;
            $categoriaNombre = Str::slug($expediente->subcategoria?->categoria?->Categoria ?? '', '_');
            $subcategoriaNombre = Str::slug($expediente->subcategoria?->SubCategoria ?? '', '_');
            if ($dni && $categoriaNombre && $subcategoriaNombre) {
                $rutaBase = "documentos/{$dni}/{$categoriaNombre}/{$subcategoriaNombre}";
                $expediente->Referencias = $this->loadRefsManifest($rutaBase);
            } else {
                $expediente->Referencias = [];
            }
        } catch (\Throwable $e) {
            $expediente->Referencias = [];
        }

        return response()->json($expediente);
    }

    public function destroy($id)
    {
        $expediente = Expediente::findOrFail($id);

        if ($expediente->url_documento && file_exists(public_path($expediente->url_documento))) {
            @unlink(public_path($expediente->url_documento));
        }

        $expediente->delete();
        return response()->json(['message' => 'Expediente eliminado correctamente']);
    }

    /* ========================== Helpers ========================== */

    private function ensureDir(string $ruta): void
    {
        $full = public_path($ruta);
        if (!file_exists($full)) {
            mkdir($full, 0777, true);
        }
    }

    /** Lee metadata enviada y sube archivos a /referencias; devuelve el array final de refs */
    private function processReferencesToFolder(Request $request, string $rutaBase): array
    {
        $refs = $this->extractRefsMetadata($request);

        $refsDir = "{$rutaBase}/referencias";
        $this->ensureDir($refsDir);

        $max = max(
            $this->maxIndex($request->input('referencias')),
            $this->maxIndex(json_decode($request->input('Referencias', '[]'), true))
        );

        for ($i = 0; $i <= $max; $i++) {
            $file = $request->file("referencias.$i.archivo");
            if ($file) {
                $refNombre = time() . "_ref{$i}_" . $file->getClientOriginalName();
                $file->move(public_path($refsDir), $refNombre);
                $url = "{$refsDir}/{$refNombre}";

                if (!isset($refs[$i])) {
                    $refs[$i] = [
                        'texto' => '',
                        'subcategoria' => '',
                    ];
                }
                $refs[$i]['archivo'] = $refNombre;
                $refs[$i]['url'] = $url;
            }
        }

        // Reindex + normalizar
        $out = [];
        foreach ($refs as $r) {
            $out[] = [
                'texto' => $r['texto'] ?? '',
                'subcategoria' => (string) ($r['subcategoria'] ?? ''),
                'archivo' => $r['archivo'] ?? null,
                'url' => $r['url'] ?? null,
            ];
        }
        return $out;
    }

    /** Extrae metadata de refs del request (JSON/Indexados), sin subir archivos */
    private function extractRefsMetadata(Request $request): array
    {
        $out = [];

        $raw = $request->input('Referencias');
        if ($raw) {
            if (is_string($raw)) {
                $decoded = json_decode($raw, true);
                if (is_array($decoded))
                    $out = $this->normalizeRefs($decoded);
            } elseif (is_array($raw)) {
                $out = $this->normalizeRefs($raw);
            }
        }

        $indexed = $request->input('referencias');
        if (is_array($indexed)) {
            $out = $this->normalizeRefs($indexed); // prioridad a indexados
        }

        return $out;
    }

    /** Guarda referencias.json */
    private function saveRefsManifest(string $rutaBase, array $refs): void
    {
        $refsDir = public_path("{$rutaBase}/referencias");
        $this->ensureDir("{$rutaBase}/referencias");

        $manifestPath = "{$refsDir}/referencias.json";
        file_put_contents($manifestPath, json_encode($refs, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    }

    /** Carga referencias.json */
    private function loadRefsManifest(string $rutaBase): array
    {
        $manifestPath = public_path("{$rutaBase}/referencias/referencias.json");
        if (file_exists($manifestPath)) {
            $data = json_decode(file_get_contents($manifestPath), true);
            return is_array($data) ? $data : [];
        }
        return [];
    }

    /** Normaliza claves a: texto, subcategoria, archivo, url */
    private function normalizeRefs(array $arr): array
    {
        $norm = [];
        foreach ($arr as $r) {
            $norm[] = [
                'texto' => $r['texto'] ?? ($r['Texto'] ?? ($r['descripcion'] ?? ($r['Descripcion'] ?? ''))),
                'subcategoria' => (string) (
                    $r['subcategoria']
                    ?? $r['Subcategoria']
                    ?? $r['SubCategoriaId']
                    ?? $r['Id_SubCategoria']
                    ?? ''
                ),
                'archivo' => $r['archivo'] ?? ($r['file_name'] ?? ($r['nombre_archivo'] ?? ($r['NombreArchivo'] ?? null))),
                'url' => $r['url'] ?? ($r['url_documento'] ?? ($r['Url'] ?? ($r['Path'] ?? null))),
            ];
        }
        return $norm;
    }

    /** Máximo índice numérico presente en un array (para contar refs potenciales) */
    private function maxIndex($arr): int
    {
        if (!is_array($arr) || empty($arr))
            return -1;
        $max = -1;
        foreach (array_keys($arr) as $k) {
            if (is_numeric($k))
                $max = max($max, (int) $k);
        }
        return $max;
    }
}
