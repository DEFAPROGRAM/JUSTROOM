<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Juzgados extends Model
{
    use HasFactory;

    // Define los campos que se pueden asignar masivamente en Juzgados
    protected $fillable = [
        'nom_juzgado',
        'id_sede'
    ];
    public function sede()
    {
        return $this->belongsTo(Sedes::class, 'id_sede');
    }
// la llave primaria para la tabla Juzgados
    protected $primaryKey = 'id_juzgado';
    
}