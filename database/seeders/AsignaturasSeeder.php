<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class AsignaturasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('asignaturas')->insert([
            ['nombre' => 'Matemáticas', 'descripcion' => 'Curso avanzado de matemáticas', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nombre' => 'Historia', 'descripcion' => 'Historia mundial', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nombre' => 'Ciencias', 'descripcion' => 'Introducción a las ciencias naturales', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}
