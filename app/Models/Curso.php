<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    protected $fillable = ['nombre', 'codigo_registro', 'descripcion', 'activo'];

    public function estudiantes()
    {
        return $this->hasMany(Estudiante::class);
    }
}
