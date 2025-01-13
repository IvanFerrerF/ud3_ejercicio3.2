<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asignatura extends Model
{
    protected $table = 'asignaturas'; // Tabla asociada al modelo

    protected $fillable = ['nombre', 'descripcion']; // Campos rellenables en la tabla asignaturas

    // Relación con la tabla Notas (1:N)
    public function notas()
    {
        return $this->hasMany(Nota::class, 'asignatura_id'); // Una asignatura tiene muchas notas
    }
}
