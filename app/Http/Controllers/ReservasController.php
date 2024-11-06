<?php

namespace App\Http\Controllers;

use App\Models\Reservas;
use Illuminate\Http\Request;

class ReservasController extends Controller
{
    // Método para obtener todas las reservas (GET)
    public function index()
    {
        $reservas = Reservas::with(['sala', 'juzgado', 'usuario'])->get();
        return response()->json($reservas);
    }

    // Método para obtener una reserva específica por ID (GET)
    public function show($id_reserva)
    {
        $reserva = Reservas::with(['sala', 'juzgado', 'usuario'])->findOrFail($id_reserva);
        return response()->json($reserva);
    }

    // Método para crear una nueva reserva (POST)
    public function store(Request $request)
    {
        $request->validate([
            'id_sala' => 'required|exists:salas,id_sala',
            'id_juzgado' => 'required|exists:juzgados,id_juzgado',
            'id_usuario' => 'required|exists:users,id',
            'descripcion' => 'nullable|string',
            'fecha' => 'required|date',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
            'observaciones' => 'nullable|string',
            'estado' => 'required|string|max:50',
        ]);

        $reserva = Reservas::create($request->all());
        return response()->json(['message' => 'Reserva creada con éxito', 'data' => $reserva], 201);
    }

    // Método para actualizar una reserva existente (PUT)
    public function update(Request $request, $id_reserva)
    {
        $request->validate([
            'id_sala' => 'sometimes|required|exists:salas,id_sala',
            'id_juzgado' => 'sometimes|required|exists:juzgados,id_juzgado',
            'id_usuario' => 'sometimes|required|exists:users,id',
            'descripcion' => 'sometimes|nullable|string',
            'fecha' => 'sometimes|required|date',
            'hora_inicio' => 'sometimes|required|date_format:H:i',
            'hora_fin' => 'sometimes|required|date_format:H:i|after:hora_inicio',
            'observaciones' => 'sometimes|nullable|string',
            'estado' => 'sometimes|required|string|max:50',
        ]);

        $reserva = Reservas::findOrFail($id_reserva);
        $reserva->update($request->all());

        return response()->json(['message' => 'Reserva actualizada con éxito', 'data' => $reserva]);
    }

    // Método para eliminar una reserva (DELETE)
    public function destroy($id_reserva)
    {
        $reserva = Reservas::findOrFail($id_reserva);
        $reserva->delete();
        return response()->json(['message' => 'Reserva eliminada con éxito']);
    }
}