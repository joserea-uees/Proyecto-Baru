<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Producto;

class HomeController extends Controller
{
    public function index()
    {
        $categorias = Categoria::with('productos')->get();
        $totalProductos = Producto::count();
        return view('home', compact('categorias', 'totalProductos'));
        
    }
    
}