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
    
    public function cancel(Request $request)
    {
        $request->validate([
            'reservation_code' => 'required|string',
        ]);

        $pedido = Pedido::where('reservation_code', $request->reservation_code)
            ->where('user_id', Auth::id())
            ->first();

        if ($pedido && $pedido->estado === 'pendiente') {
            $pedido->update(['estado' => 'cancelled']);
            return response()->json([
                'success' => true,
                'message' => 'Reserva cancelada exitosamente',
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'No se pudo cancelar la reserva',
        ], 400);
    }

    public function ticket(Request $request, $id)
    {
        $pedido = Pedido::with(['detallePedidos.producto', 'user'])->where('user_id', Auth::id())->findOrFail($id);
        return view('ticket', compact('pedido'));
    }
    public function index()
{
    $user = Auth::check() ? User::where('codigo_estudiante', Auth::user()->codigo_estudiante)->first() : null;
    $userId = $user ? $user->id : null;
    $reservas = Pedido::where('user_id', $userId)
        ->where('estado', 'pendiente')
        ->orderBy('created_at', 'desc')
        ->get();

    return view('reservas', compact('reservas'));
}
}