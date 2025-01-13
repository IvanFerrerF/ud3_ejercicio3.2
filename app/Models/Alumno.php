<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    protected $table = 'alumnos'; // Especifica la tabla asociada

    protected $fillable = ['nombre', 'email']; // Campos que se pueden rellenar automáticamente

    public function notas()
    {
        return $this->hasMany(Nota::class, 'alumno_id'); // Relación de 1:N (un alumno puede tener muchas notas)
    }
}
