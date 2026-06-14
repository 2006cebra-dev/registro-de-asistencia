<?php

namespace Database\Seeders;

use App\Models\Curso;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $cursos = [
            ['nombre' => '1er Semestre - Ingeniería en Sistemas', 'codigo_registro' => 'SIS101', 'descripcion' => 'Primer semestre de Ingeniería en Sistemas', 'activo' => true],
            ['nombre' => '2do Semestre - Ingeniería en Sistemas', 'codigo_registro' => 'SIS102', 'descripcion' => 'Segundo semestre de Ingeniería en Sistemas', 'activo' => true],
            ['nombre' => '3er Semestre - Ingeniería en Sistemas', 'codigo_registro' => 'SIS103', 'descripcion' => 'Tercer semestre de Ingeniería en Sistemas', 'activo' => true],
            ['nombre' => '4to Semestre - Ingeniería en Sistemas', 'codigo_registro' => 'SIS104', 'descripcion' => 'Cuarto semestre de Ingeniería en Sistemas', 'activo' => true],
            ['nombre' => '5to Semestre - Ingeniería en Sistemas', 'codigo_registro' => 'SIS105', 'descripcion' => 'Quinto semestre de Ingeniería en Sistemas', 'activo' => true],
            ['nombre' => '6to Semestre - Ingeniería en Sistemas', 'codigo_registro' => 'SIS106', 'descripcion' => 'Sexto semestre de Ingeniería en Sistemas', 'activo' => true],
            ['nombre' => '1er Semestre - Administración', 'codigo_registro' => 'ADM101', 'descripcion' => 'Primer semestre de Administración', 'activo' => true],
            ['nombre' => '2do Semestre - Administración', 'codigo_registro' => 'ADM102', 'descripcion' => 'Segundo semestre de Administración', 'activo' => true],
            ['nombre' => '3er Semestre - Administración', 'codigo_registro' => 'ADM103', 'descripcion' => 'Tercer semestre de Administración', 'activo' => true],
            ['nombre' => '4to Semestre - Administración', 'codigo_registro' => 'ADM104', 'descripcion' => 'Cuarto semestre de Administración', 'activo' => true],
        ];

        foreach ($cursos as $curso) {
            Curso::firstOrCreate(['codigo_registro' => $curso['codigo_registro']], $curso);
        }

        User::firstOrCreate(
            ['email' => 'docente@mail.com'],
            ['name' => 'Profesor Admin', 'password' => bcrypt('password'), 'rol' => 'docente']
        );

        User::firstOrCreate(
            ['email' => 'supervisor@mail.com'],
            ['name' => 'Supervisor Admin', 'password' => bcrypt('password'), 'rol' => 'supervisor']
        );

        $this->command->info('Cursos, docente y supervisor creados exitosamente.');
    }
}
