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
            Curso::create($curso);
        }

        User::create([
            'name' => 'Profesor Admin',
            'email' => 'docente@mail.com',
            'password' => bcrypt('password'),
            'rol' => 'docente',
        ]);

        $this->command->info('Cursos y docente creados exitosamente.');
    }
}
