<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PedidoController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'reservation_code' => 'required|string',
            'productos' => 'required|json',
            'fecha_reserva' => 'required|date|after:today',
            'comentarios' => 'nullable|string',
        ]);

        // Calculate total based on productos
        $productos = json_decode($request->productos, true);
        $total = 0;
        foreach ($productos as $producto) {
            $product = \App\Models\Producto::find($producto['id']);
            if ($product) {
                $total += $product->precio * $producto['cantidad'];
            }
        }

        // Obtener el user_id basado en el codigo_estudiante
        $user = Auth::check() ? User::where('codigo_estudiante', Auth::user()->codigo_estudiante)->first() : null;
        $userId = $user ? $user->id : null;

        $pedido = Pedido::create([
            'user_id' => $userId,
            'reservation_code' => $request->reservation_code,
            'productos' => $request->productos,
            'fecha_reserva' => $request->fecha_reserva,
            'comentarios' => $request->comentarios,
            'total' => $total,
        ]);

        return response()->json([
            'success' => true,
            'reservation_code' => $pedido->reservation_code,
            'message' => 'Reserva creada exitosamente',
        ]);
    }
}