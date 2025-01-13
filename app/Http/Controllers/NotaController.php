<?php

namespace App\Http\Controllers;

use App\Models\Nota;
use Illuminate\Http\Request;

class NotaController extends Controller
{
    // GET /api/notas -> Devuelve todas las notas
    public function index()
    {
        return Nota::all();
    }

    // GET /api/notas/{id} -> Devuelve una nota específica
    public function show(string $id)
    {
        $nota = Nota::find($id);

        if (!$nota) {
            return response()->json(['error' => 'Nota no encontrada'], 404);
        }

        return $nota;
    }

    // POST /api/notas -> Crea una nueva nota
    public function store(Request $request)
    {
        $request->validate([
            'alumno_id' => 'required|exists:alumnos,id',
            'asignatura_id' => 'required|exists:asignaturas,id',
            'nota' => 'required|numeric|min:0|max:10',
        ]);

        $nota = Nota::create($request->all());

        return response()->json($nota, 201);
    }

    // PUT /api/notas/{id} -> Actualiza una nota específica
    public function update(Request $request, string $id)
    {
        $nota = Nota::find($id);

        if (!$nota) {
            return response()->json(['error' => 'Nota no encontrada'], 404);
        }

        $request->validate([
            'alumno_id' => 'sometimes|exists:alumnos,id',
            'asignatura_id' => 'sometimes|exists:asignaturas,id',
            'nota' => 'sometimes|numeric|min:0|max:10',
        ]);

        $nota->update($request->all());

        return response()->json($nota);
    }

    // DELETE /api/notas/{id} -> Borra una nota específica
    public function destroy(string $id)
    {
        $nota = Nota::find($id);

        if (!$nota) {
            return response()->json(['error' => 'Nota no encontrada'], 404);
        }

        $nota->delete();

        return response()->json(['message' => 'Nota eliminada correctamente']);
    }
}
