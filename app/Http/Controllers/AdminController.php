<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Producto;
use App\Models\Pedido;
use App\Models\User;

class AdminController extends Controller
{
    public function dashboard()
    {
        $categorias = Categoria::all();
        $productos = Producto::with('categoria')->get();
        $pedidos = Pedido::with('user')->get();
        $usuarios = User::where('role', 'student')->get();
        return view('dashboard', compact('categorias', 'productos', 'pedidos', 'usuarios'));
    }
    
    public function filterProductos(Request $request)
    {
        $productos = Producto::with('categoria')->get(); // TODO: agregar filtros
        $categorias = Categoria::all();
        $pedidos = Pedido::with('user')->get();
        $usuarios = User::where('role', 'student')->get();
        return view('dashboard', compact('categorias', 'productos', 'pedidos', 'usuarios'));
    }
    
    public function filterVentas(Request $request)
    {
        $pedidos = Pedido::with('user')->get(); // TODO: agregar filtros
        $categorias = Categoria::all();
        $productos = Producto::with('categoria')->get();
        $usuarios = User::where('role', 'student')->get();
        return view('dashboard', compact('categorias', 'productos', 'pedidos', 'usuarios'));
    }
    
    public function filterUsuarios(Request $request)
    {
        $usuarios = User::where('role', 'student')->get(); // TODO: agregar filtros
        $categorias = Categoria::all();
        $productos = Producto::with('categoria')->get();
        $pedidos = Pedido::with('user')->get();
        return view('dashboard', compact('categorias', 'productos', 'pedidos', 'usuarios'));
    }
}