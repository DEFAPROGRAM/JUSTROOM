<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservas extends Model
{
    use HasFactory;

    protected $fillable = 
    ['fecha_reserva', 
    'observaciones', 
    'estado', 
    'id_audiencia', 
    'id_usuario'
];

    // Relación con la tabla Audiencias
    public function audiencia()
    {
        return $this->belongsTo(Audiencias::class, 'id_audiencia');
    }

    // Relación con la tabla Users
    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }
    // la llave primaria para la tabla Reservas
    protected $primaryKey = 'id_reserva';
}
