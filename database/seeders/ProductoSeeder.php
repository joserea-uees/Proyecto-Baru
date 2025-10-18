<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Producto;
use App\Models\Categoria;

class ProductoSeeder extends Seeder
{
    public function run()
    {
        $desayunos = Categoria::where('nombre', 'Desayunos')->first();
        $platos = Categoria::where('nombre', 'Platos Principales')->first();
        $bebidas = Categoria::where('nombre', 'Bebidas')->first();
        $postres = Categoria::where('nombre', 'Postres')->first();
        $sanduches = Categoria::where('nombre', 'Sanduches')->first();
        $bowls = Categoria::where('nombre', 'Bowls')->first();
        $papas = Categoria::where('nombre', 'Papas')->first();
        $almuerzos = Categoria::where('nombre', 'Almuerzos Diarios')->first();
        $hamburguesas = Categoria::where('nombre', 'Hamburguesas')->first();

        Producto::create([
            'categoria_id' => $platos->id, 
            'nombre' => 'Ensalada César', 
            'precio' => 5.00, 
            'descripcion' => 'Ensalada fresca con aderezo César',
            'imagen' => 'img/CaesarSalad.jpeg'
        ]);
        
        Producto::create([
            'categoria_id' => $hamburguesas->id, 
            'nombre' => 'Hamburguesa Clásica', 
            'precio' => 4.00, 
            'descripcion' => 'Hamburguesa con lechuga, tomate y salsa',
            'imagen' => 'img/Hamburguesa.jpeg'
        ]);
        
        Producto::create([
            'categoria_id' => $bebidas->id, 
            'nombre' => 'Refresco', 
            'precio' => 1.50, 
            'descripcion' => 'Bebida refrescante',
            'imagen' => 'img/CocaCola.jpeg'
        ]);
        
        Producto::create([
            'categoria_id' => $platos->id, 
            'nombre' => 'Mac & Cheese', 
            'precio' => 3.95, 
            'descripcion' => 'Macarrones con queso derretido, versión dulce',
            'imagen' => 'img/Mac&Cheese.jpeg'
        ]);
        
        Producto::create([
            'categoria_id' => $sanduches->id, 
            'nombre' => 'Club Sandwich', 
            'precio' => 4.25, 
            'descripcion' => 'Sandwich cremoso con pollo, lechuga y tocino',
            'imagen' => 'img/SanducheClub.jpeg'
        ]);
        
        Producto::create([
            'categoria_id' => $bowls->id, 
            'nombre' => 'Bowl', 
            'precio' => 5.75, 
            'descripcion' => 'Bowl saludable con pollo, arroz integral y vegetales',
            'imagen' => 'img/Bowl.jpeg'
        ]);
        
        Producto::create([
            'categoria_id' => $papas->id, 
            'nombre' => 'Papas Fritas', 
            'precio' => 2.50, 
            'descripcion' => 'Papas crujientes con salsa',
            'imagen' => 'img/PapasFritas.jpeg'
        ]);
        
        Producto::create([
            'categoria_id' => $almuerzos->id, 
            'nombre' => 'Almuerzo Diario', 
            'precio' => 3.50, 
            'descripcion' => 'Carne a la plancha con guarnición de arroz y ensalada',
            'imagen' => 'img/Almuerzos.jpeg'
        ]);
    }
}