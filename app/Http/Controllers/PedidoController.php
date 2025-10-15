<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\Producto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PedidoController extends Controller
{
    public function create()
    {
        $categorias = \App\Models\Categoria::with('productos')->get();
        return view('pedidos.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'fecha_reserva' => 'required|date|after:now',
            'numero_personas' => 'required|integer|min:1',
            'productos' => 'required|array',
            'productos.*.id' => 'required|exists:productos,id',
            'productos.*.cantidad' => 'required|integer|min:1',
            'comentarios' => 'nullable|string|max:500',
        ]);

        $pedido = Pedido::create([
            'user_id' => Auth::id(),
            'fecha_reserva' => $request->fecha_reserva,
            'numero_personas' => $request->numero_personas,
            'estado' => 'pendiente',
            'codigo_ticket' => 'RES-' . Str::random(8),
            'comentarios' => $request->comentarios,
        ]);

        foreach ($request->productos as $producto) {
            $pedido->detalles()->create([
                'producto_id' => $producto['id'],
                'cantidad' => $producto['cantidad'],
            ]);
        }

        return redirect()->route('pedidos.ticket', $pedido->id)->with('success', 'Reserva creada exitosamente.');
    }

    public function ticket(Pedido $pedido)
    {
        return view('pedidos.ticket', compact('pedido'));
    }
}