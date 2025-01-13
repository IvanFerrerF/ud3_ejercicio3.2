<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    protected $table = 'notas'; // Tabla asociada a este modelo

    protected $fillable = ['alumno_id', 'asignatura_id', 'nota']; // Campos rellenables

    // Relación con la tabla Alumno (N:1)
    public function alumno()
    {
        return $this->belongsTo(Alumno::class, 'alumno_id');
    }

    // Relación con la tabla Asignatura (N:1)
    public function asignatura()
    {
        return $this->belongsTo(Asignatura::class, 'asignatura_id');
    }
}
