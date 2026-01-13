<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebhookController extends Controller
{
    //    public function handle(Request $request)
    public function handle(Request $request)
    {
        // Obtener los datos enviados
        $data = $request->all();

        // Guardar log para pruebas
        Log::info('Webhook recibido', $data);

        // Validar algún dato si quieres
        if (!isset($data['event'])) {
            return response()->json(['error' => 'Evento no encontrado'], 400);
        }

        

        return response()->json(['status' => 'ok'], 200);
    }
}