<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class LedController extends Controller
{
    public function estado()
    {
        $estado = Cache::get('led_state', 'off'); // valor por defecto: apagado
        return response()->json(['state' => $estado]);
    }

    public function cambiar(Request $request)
    {
        $nuevoEstado = $request->input('state');

        if (!in_array($nuevoEstado, ['on', 'off'])) {
            return response()->json(['error' => 'Estado inválido'], 400);
        }

        Cache::put('led_state', $nuevoEstado);
        return response()->json(['state' => $nuevoEstado]);
    }
}
