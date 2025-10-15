<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\Producto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PedidoController extends Controller
{
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'fecha_reserva' => 'required|date|after:now',
            'numero_personas' => 'required|integer|min:1',
            'productos' => 'required|json',
            'comentarios' => 'nullable|string|max:500',
        ]);

        // Decodificar productos del carrito
        $productos = json_decode($request->productos, true);
        if (empty($productos)) {
            return redirect()->route('home')->withErrors(['productos' => 'El carrito está vacío']);
        }

        // Crear el pedido
        $pedido = Pedido::create([
            'user_id' => Auth::id(),
            'fecha_reserva' => $request->fecha_reserva,
            'numero_personas' => $request->numero_personas,
            'estado' => 'pendiente',
            'codigo_ticket' => 'RES-' . Str::random(8),
            'comentarios' => $request->comentarios,
        ]);

        // Guardar los detalles del pedido
        foreach ($productos as $producto) {
            $pedido->detalles()->create([
                'producto_id' => $producto['id'],
                'cantidad' => $producto['cantidad'],
            ]);
        }

        // Redirigir al ticket con mensaje de éxito
        return redirect()->route('pedidos.ticket', $pedido->id)->with('success', 'Reserva creada exitosamente. Código: ' . $pedido->codigo_ticket);
    }

    public function ticket(Pedido $pedido)
    {
        // Asegurarse de que el usuario solo vea sus propios pedidos
        if ($pedido->user_id !== Auth::id()) {
            abort(403, 'No autorizado');
        }

        return view('pedidos.ticket', compact('pedido'));
    }
}