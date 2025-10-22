<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PedidoController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'reservation_code' => 'required|string|unique:pedidos,reservation_code',
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

        $user = Auth::user();
        $userRecord = $user ? User::where('codigo_estudiante', $user->codigo_estudiante)->first() : null;
        if (!$userRecord) {
            return response()->json(['success' => false, 'message' => 'Usuario no encontrado'], 403);
        }

        $pedido = Pedido::create([
            'user_id' => $userRecord->id,
            'reservation_code' => $request->reservation_code,
            'productos' => $request->productos,
            'fecha_reserva' => $request->fecha_reserva,
            'comentarios' => $request->comentarios,
            'total' => $total,
            'estado' => 'pendiente',
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
            'reservation_code' => 'required|string|exists:pedidos,reservation_code',
        ]);

        $user = Auth::user();
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'No autenticado'], 401);
        }

        $query = Pedido::where('reservation_code', $request->reservation_code);
        if (!$user->isAdmin()) {
            $query->where('user_id', $user->id);
        }

        $pedido = $query->first();

        if (!$pedido) {
            \Log::warning('Intento de cancelación fallido', [
                'reservation_code' => $request->reservation_code,
                'user_id' => $user->id,
                'is_admin' => $user->isAdmin(),
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Reserva no encontrada' . ($user->isAdmin() ? '' : ' o no pertenece al usuario'),
            ], 404);
        }

        if ($pedido->estado !== 'pendiente') {
            return response()->json([
                'success' => false,
                'message' => 'Solo las reservas pendientes pueden ser canceladas',
            ], 400);
        }

        $pedido->update(['estado' => 'cancelado']);
        return response()->json([
            'success' => true,
            'message' => 'Reserva cancelada exitosamente',
        ]);
    }

    public function ticket(Request $request, $id)
    {
        $user = Auth::user();
        $userRecord = $user ? User::where('codigo_estudiante', $user->codigo_estudiante)->first() : null;
        if (!$userRecord) {
            abort(403, 'Usuario no encontrado');
        }

        $pedido = Pedido::with('user')
            ->where('user_id', $userRecord->id)
            ->findOrFail($id);
        return view('ticket', compact('pedido'));
    }

    public function index()
    {
        $user = Auth::user();
        $userRecord = $user ? User::where('codigo_estudiante', $user->codigo_estudiante)->first() : null;
        if (!$userRecord) {
            return view('reservas', ['reservas' => collect()]);
        }

        $reservas = Pedido::where('user_id', $userRecord->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('reservas', compact('reservas'));
    }
}