<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Alumno;
use App\Models\Nota;
use App\Models\Asignatura;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\NotaController;
use App\Http\Controllers\AsignaturaController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Ruta para obtener todos los alumnos
Route::get('/alumnos', function () {
    return Alumno::all();
});

// Ruta para obtener todas las notas
Route::get('/notas', function () {
    return Nota::all();
});

// Ruta para obtener todas las asignaturas
Route::get('/asignaturas', function () {
    return Asignatura::all();
});

// Registra las rutas para el controlador
Route::apiResource('alumnos', AlumnoController::class);
Route::apiResource('notas', NotaController::class);
Route::apiResource('asignaturas', AsignaturaController::class);
