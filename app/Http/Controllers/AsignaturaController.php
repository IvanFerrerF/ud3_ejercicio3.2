<?php

namespace App\Http\Controllers;

use App\Models\Asignatura;
use Illuminate\Http\Request;

class AsignaturaController extends Controller
{
    // GET /api/asignaturas -> Devuelve todas las asignaturas
    public function index()
    {
        return Asignatura::all();
    }

    // GET /api/asignaturas/{id} -> Devuelve una asignatura específica
    public function show(string $id)
    {
        $asignatura = Asignatura::find($id);

        if (!$asignatura) {
            return response()->json(['error' => 'Asignatura no encontrada'], 404);
        }

        return $asignatura;
    }

    // POST /api/asignaturas -> Crea una nueva asignatura
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        $asignatura = Asignatura::create($request->all());

        return response()->json($asignatura, 201);
    }

    // PUT /api/asignaturas/{id} -> Actualiza una asignatura específica
    public function update(Request $request, string $id)
    {
        $asignatura = Asignatura::find($id);

        if (!$asignatura) {
            return response()->json(['error' => 'Asignatura no encontrada'], 404);
        }

        $request->validate([
            'nombre' => 'sometimes|string|max:255',
            'descripcion' => 'sometimes|string',
        ]);

        $asignatura->update($request->all());

        return response()->json($asignatura);
    }

    // DELETE /api/asignaturas/{id} -> Borra una asignatura específica
    public function destroy(string $id)
    {
        $asignatura = Asignatura::find($id);

        if (!$asignatura) {
            return response()->json(['error' => 'Asignatura no encontrada'], 404);
        }

        $asignatura->delete();

        return response()->json(['message' => 'Asignatura eliminada correctamente']);
    }
}
