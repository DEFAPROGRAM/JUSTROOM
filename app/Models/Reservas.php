<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservas extends Model
{
    use HasFactory;

    protected $table = 'reservas';
    protected $primaryKey = 'id_reserva';

    protected $fillable = [
        'id_sala',
        'id_juzgado',
        'id_usuario',
        'descripcion',
        'fecha',
        'hora_inicio',
        'hora_fin',
        'observaciones',
        'estado'
    ];

    protected $casts = [
        'fecha' => 'date',
        'hora_inicio' => 'datetime',
        'hora_fin' => 'datetime',
    ];

    // Relación con la tabla Salas
    public function sala()
    {
        return $this->belongsTo(Sala::class, 'id_sala');
    }

    // Relación con la tabla Juzgados
    public function juzgado()
    {
        return $this->belongsTo(Juzgado::class, 'id_juzgado');
    }

    // Relación con la tabla Users
    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }
}