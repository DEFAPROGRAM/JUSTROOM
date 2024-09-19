<?php

namespace App\Http\Controllers;

use App\Models\Audiencias;
use Illuminate\Http\Request;

class AudienciasController extends Controller
{
    // Método para obtener todas las audiencias (GET)
    public function index()
    {
        // Obtener todas las audiencias con sus relaciones (sala y juzgado)
        $audiencia = Audiencias::with(['sala', 'juzgado'])->get();

        return response()->json($audiencia);
    }

    // Método para obtener una audiencia específica por ID (GET)
    public function show($id_audiencia)
    {
        // Obtener la audiencia por ID con las relaciones (sala y juzgado)
        $audiencia = Audiencias::with(['sala', 'juzgado'])->findOrFail($id_audiencia);

        return response()->json($audiencia);
    }

    // Método para crear una nueva audiencia (POST)
    public function store(Request $request)
    {
        // Validación de los campos requeridos
        $request->validate([
            'descripcion' => 'required|string',
            'fecha' => 'required|date',
            'hora_inicio' => 'required|date_format:H:i:s',
            'hora_fin' => 'required|date_format:H:i:s|after:hora_inicio', // Valida que la hora de fin sea después de la de inicio
            'id_sala' => 'required|exists:salas,id_sala', // Verifica que la sala exista
            'id_juzgado' => 'required|exists:juzgados,id_juzgado', // Verifica que el juzgado exista
        ]);

        // Creación de la nueva audiencia
        $audiencia = Audiencias::create($request->all());

        return response()->json(['message' => 'Audiencia creada con éxito', 'data' => $audiencia], 201);
    }

    // Método para actualizar una audiencia existente (PUT)
    public function update(Request $request, $id_audiencia)
    {
        // Validación de los campos que se pueden actualizar
        $request->validate([
            'descripcion' => 'sometimes|required|string',
            'fecha' => 'sometimes|required|date',
            'hora_inicio' => 'sometimes|required|date_format:H:i',
            'hora_fin' => 'sometimes|required|date_format:H:i|after:hora_inicio',
            'id_sala' => 'sometimes|required|exists:salas,id_sala',
            'id_juzgado' => 'sometimes|required|exists:juzgados,id_juzgado',
        ]);

        // Buscar la audiencia por ID o devolver un error 404
        $audiencia = Audiencias::findOrFail($id_audiencia);

        // Actualizar los campos de la audiencia
        $audiencia->update($request->all());

        return response()->json(['message' => 'Audiencia actualizada con éxito', 'data' => $audiencia]);
    }

    // Método para eliminar una audiencia (DELETE)
    public function destroy($id_audiencia)
    {
        // Buscar la audiencia por ID o devolver un error 404
        $audiencia = Audiencias::findOrFail($id_audiencia);

        // Eliminar la audiencia
        $audiencia->delete();

        return response()->json(['message' => 'Audiencia eliminada con éxito']);
    }
}
