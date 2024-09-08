<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Audiencias extends Model
{
    use HasFactory;
    
    // Define los campos que se pueden asignar masivamente en Audiencias
    protected $fillable = [
        'descripcion',
        'fecha',
        'hora_inicio',
        'hora_fin',
        'id_sala',
        'id_juzgado'
    ];
    public function sala()
    {
        return $this->belongsTo(Salas::class, 'id_sala');
    }
    public function juzgado()
    {
        return $this->belongsTo(Juzgados::class, 'id_juzgado');
    }
// la llave primaria para la tabla Audiencias
    protected $primaryKey = 'id_audiencia';
    
}
