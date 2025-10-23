<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Producto;
use App\Models\Pedido;
use App\Models\User;
use App\Models\Configuracion;

class AdminController extends Controller
{
    public function panel()
    {
        $categorias = Categoria::all();
        $productos = Producto::with('categoria')->get();
        $pedidos = Pedido::with(['user', 'producto'])->latest()->get();
        $usuarios = User::where('role', 'student')->get();
        $config = Configuracion::first();

        return view('admin', compact('categorias', 'productos', 'pedidos', 'usuarios', 'config'));
    }

    public function updateConfig(Request $request)
    {
        $request->validate([
            'nombre_restaurante' => 'required|string|max:255',
            'email_contacto' => 'required|email|max:255'
        ]);

        $config = Configuracion::first();
        $config->update([
            'nombre_restaurante' => $request->nombre_restaurante,
            'email_contacto' => $request->email_contacto
        ]);

        return redirect()->route('admin.panel')->with('success', 'Configuración actualizada correctamente.');
    }
}
