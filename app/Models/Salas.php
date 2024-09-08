<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salas extends Model
{
    use HasFactory;

    // Define los campos que se pueden asignar masivamente en Salas
    protected $fillable = [
        'nom_sala',
        'capacidad',
        'id_sede'
    ];
    public function sede()
    {
        return $this->belongsTo(Sedes::class, 'id_sede');
    }
// la llave primaria para la tabla Salas
    protected $primaryKey = 'id_sala';
    
}