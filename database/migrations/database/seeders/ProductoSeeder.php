<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Producto;
use App\Models\Categoria;

class ProductoSeeder extends Seeder
{
    public function run()
    {
        $entradas = Categoria::where('nombre', 'Entradas')->first();
        $platos = Categoria::where('nombre', 'Platos Principales')->first();
        $bebidas = Categoria::where('nombre', 'Bebidas')->first();
        $postres = Categoria::where('nombre', 'Postres')->first();
        $sanduches = Categoria::where('nombre', 'Sanduches')->first();
        $bowls = Categoria::where('nombre', 'Bowls')->first();
        $papas = Categoria::where('nombre', 'Papas')->first();
        $almuerzos = Categoria::where('nombre', 'Almuerzos Diarios')->first();

        Producto::create(['categoria_id' => $entradas->id, 'nombre' => 'Ensalada César', 'precio' => 5.00, 'descripcion' => 'Ensalada fresca con aderezo César']);
        Producto::create(['categoria_id' => $platos->id, 'nombre' => 'Hamburguesa Clásica', 'precio' => 10.00, 'descripcion' => 'Hamburguesa con lechuga, tomate y salsa']);
        Producto::create(['categoria_id' => $bebidas->id, 'nombre' => 'Refresco', 'precio' => 2.00, 'descripcion' => 'Bebida refrescante']);
        Producto::create(['categoria_id' => $postres->id, 'nombre' => 'Mac & Cheese Dulce', 'precio' => 7.95, 'descripcion' => 'Macarrones con queso derretido, versión dulce']);
        Producto::create(['categoria_id' => $sanduches->id, 'nombre' => 'Sandwich Carbonara', 'precio' => 11.25, 'descripcion' => 'Sandwich cremoso con bacon y ajo']);
        Producto::create(['categoria_id' => $bowls->id, 'nombre' => 'Fish & Chips Bowl', 'precio' => 9.75, 'descripcion' => 'Pescado empanizado con papas fritas']);
        Producto::create(['categoria_id' => $papas->id, 'nombre' => 'Papas Fritas', 'precio' => 3.50, 'descripcion' => 'Papas crujientes con salsa']);
        Producto::create(['categoria_id' => $almuerzos->id, 'nombre' => 'Black Pepper Steak', 'precio' => 15.49, 'descripcion' => 'Bife a la pimienta con guarnición']);
    }
}