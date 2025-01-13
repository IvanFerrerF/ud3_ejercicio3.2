<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use Illuminate\Http\Request;

class AlumnoController extends Controller
{
    /**
     * Display a listing of the resource.
     * GET /api/alumnos
     */
    public function index()
    {
        // Devuelve todos los alumnos
        return Alumno::all();
    }

    /**
     * Store a newly created resource in storage.
     * POST /api/alumnos
     */
    public function store(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:alumnos,email',
        ]);

        // Crear el nuevo alumno
        $alumno = Alumno::create($request->all());

        // Devolver la respuesta con el nuevo alumno creado
        return response()->json($alumno, 201);
    }

    /**
     * Display the specified resource.
     * GET /api/alumnos/{id}
     */
    public function show(string $id)
    {
        // Buscar el alumno por su ID
        $alumno = Alumno::find($id);

        // Verificar si el alumno existe
        if (!$alumno) {
            return response()->json(['error' => 'Alumno no encontrado'], 404);
        }

        return $alumno;
    }

    /**
     * Update the specified resource in storage.
     * PUT /api/alumnos/{id}
     */
    public function update(Request $request, string $id)
    {
        // Buscar el alumno por su ID
        $alumno = Alumno::find($id);

        if (!$alumno) {
            return response()->json(['error' => 'Alumno no encontrado'], 404);
        }

        // Validar los datos de entrada
        $request->validate([
            'nombre' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:alumnos,email,' . $id,
        ]);

        // Actualizar los datos del alumno
        $alumno->update($request->all());

        // Devolver el alumno actualizado
        return response()->json($alumno);
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /api/alumnos/{id}
     */
    public function destroy(string $id)
    {
        // Buscar el alumno por su ID
        $alumno = Alumno::find($id);

        if (!$alumno) {
            return response()->json(['error' => 'Alumno no encontrado'], 404);
        }

        // Eliminar el alumno
        $alumno->delete();

        return response()->json(['message' => 'Alumno eliminado correctamente']);
    }
}
