<?php

namespace App\Http\Controllers;

use App\Models\Periodo;
use Illuminate\Http\Request;

class PeriodoController extends Controller
{
    public function index()
    {
        return response()->json(Periodo::all());
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'periodo' => 'required|string|max:50',
                'anio' => 'required|integer',
                'fecha_inicio' => 'required|date',
                'fecha_fin' => 'required|date',
                'activo' => 'boolean',
                'created_by' => 'nullable|string|max:50',
                'updated_by' => 'nullable|string|max:50',
            ]);

            $periodo = Periodo::create($validated);

            return response()->json($periodo, 201);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al crear el periodo',
                'mensaje' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        $periodo = Periodo::findOrFail($id);
        return response()->json($periodo);
    }

    public function update(Request $request, $id)
    {
        $periodo = Periodo::findOrFail($id);

        $validated = $request->validate([
            'periodo' => 'required|string|max:50',
            'anio' => 'required|integer',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
            'activo' => 'boolean',
            'created_by' => 'nullable|string|max:50',
            'updated_by' => 'nullable|string|max:50',
        ]);

        $periodo->update($validated);

        return response()->json([
            'success' => true,
            'periodo' => $periodo
        ]);
    }

    public function destroy($id)
    {
        $periodo = Periodo::findOrFail($id);
        $periodo->delete();

        return response()->json(['message' => 'Periodo eliminado con éxito']);
    }
}
