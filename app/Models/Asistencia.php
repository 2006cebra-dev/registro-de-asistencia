<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    protected $fillable = ['estudiante_id', 'fecha', 'hora_entrada', 'hora_salida'];

    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class);
    }
}
