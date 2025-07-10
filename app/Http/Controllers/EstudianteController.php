<?php

namespace App\Http\Controllers;

use App\Models\Estudiantes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EstudianteController extends Controller
{
    public function index()
    {
        $estudiantes = Estudiantes::with([
            'estado',
            'sede',
            'distrito',
            'escuela',
            'periodoIngreso',
            'periodoEgreso',
            'curriculum',
            'modalidadIngreso'
        ])->get()->map(function ($e) {
            $e->foto_url = $this->buildPhotoUrl($e->Dni);
            return $e;
        });

        return response()->json($estudiantes, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'Cod_uni' => 'required|unique:Tb_Estudiantes',
            'Dni' => 'required|unique:Tb_Estudiantes',
            'email' => 'required|email',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $data = $request->except('foto');

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $extension = $file->getClientOriginalExtension();
            $filename = $request->Dni . '.' . $extension;
            $file->move(public_path('uploads/estudiantes'), $filename);
            $data['foto'] = $filename;
        }

        $estudiante = Estudiantes::create($data);
        $estudiante->foto_url = $this->buildPhotoUrl($estudiante->Dni);

        return response()->json($estudiante, 201);
    }

    public function show($id)
    {
        $estudiante = Estudiantes::with([
            'estado',
            'sede',
            'distrito',
            'escuela',
            'periodoIngreso',
            'periodoEgreso',
            'curriculum',
            'modalidadIngreso'
        ])->find($id);

        if (!$estudiante) {
            return response()->json(['message' => 'Estudiante no encontrado'], 404);
        }

        $estudiante->foto_url = $this->buildPhotoUrl($estudiante->Dni);
        return response()->json($estudiante);
    }

    public function update(Request $request, $id)
    {
        $estudiante = Estudiantes::find($id);
        if (!$estudiante) {
            return response()->json(['message' => 'Estudiante no encontrado'], 404);
        }

        $data = $request->except('foto');

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $extension = $file->getClientOriginalExtension();
            $filename = $estudiante->Dni . '.' . $extension;
            $file->move(public_path('uploads/estudiantes'), $filename);
            $data['foto'] = $filename;
        }

        $estudiante->update($data);
        $estudiante->foto_url = $this->buildPhotoUrl($estudiante->Dni);

        return response()->json($estudiante);
    }

    public function destroy($id)
    {
        $estudiante = Estudiantes::find($id);
        if (!$estudiante) {
            return response()->json(['message' => 'Estudiante no encontrado'], 404);
        }

        $ruta = public_path('uploads/estudiantes/' . $estudiante->foto);
        if ($estudiante->foto && file_exists($ruta)) {
            unlink($ruta);
        }

        $estudiante->delete();
        return response()->json(['message' => 'Estudiante eliminado correctamente']);
    }

    private function buildPhotoUrl($dni)
    {
        $path = public_path('uploads/estudiantes');
        $files = glob($path . '/' . $dni . '.*');

        if (count($files) > 0) {
            $file = basename($files[0]);
            return url('uploads/estudiantes/' . $file);
        }

        return null;
    }
}
