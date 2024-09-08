<?php

namespace App\Http\Controllers;

use App\Models\Reservas;
use Illuminate\Http\Request;

class ReservasController extends Controller
{
    // Método para obtener todas las reservas (GET)
    public function index()
    {
        // Obtener todas las reservas con sus relaciones (audiencia y usuario)
        $reservas = Reservas::with(['audiencia', 'usuario'])->get();

        return response()->json($reservas);
    }

    // Método para obtener una reserva específica por ID (GET)
    public function show($id_reserva)
    {
        // Obtener la reserva por ID con las relaciones (audiencia y usuario)
        $reserva = Reservas::with(['audiencia', 'usuario'])->findOrFail($id_reserva);

        return response()->json($reserva);
    }

    // Método para crear una nueva reserva (POST)
    public function store(Request $request)
    {
        // Validación de los campos requeridos
        $request->validate([
            'fecha_reserva' => 'required|date',
            'observaciones' => 'nullable|string',
            'estado' => 'required|string|max:50',
            'id_audiencia' => 'required|exists:audiencias,id_audiencia', // Verifica que la audiencia exista
            'id_usuario' => 'required|exists:users,id', // Verifica que el usuario exista
        ]);

        // Creación de la nueva reserva
        $reserva = Reservas::create($request->all());

        return response()->json(['message' => 'Reserva creada con éxito', 'data' => $reserva], 201);
    }

    // Método para actualizar una reserva existente (PUT)
    public function update(Request $request, $id_reserva)
    {
        // Validación de los campos que se pueden actualizar
        $request->validate([
            'fecha_reserva' => 'sometimes|required|date',
            'observaciones' => 'sometimes|nullable|string',
            'estado' => 'sometimes|required|string|max:50',
            'id_audiencia' => 'sometimes|required|exists:audiencias,id_audiencia',
            'id_usuario' => 'sometimes|required|exists:users,id',
        ]);

        // Buscar la reserva por ID o devolver un error 404
        $reserva = Reservas::findOrFail($id_reserva);

        // Actualizar los campos de la reserva
        $reserva->update($request->all());

        return response()->json(['message' => 'Reserva actualizada con éxito', 'data' => $reserva]);
    }

    // Método para eliminar una reserva (DELETE)
    public function destroy($id_reserva)
    {
        // Buscar la reserva por ID o devolver un error 404
        $reserva = Reservas::findOrFail($id_reserva);

        // Eliminar la reserva
        $reserva->delete();

        return response()->json(['message' => 'Reserva eliminada con éxito']);
    }
}
