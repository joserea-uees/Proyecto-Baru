<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categoria;

class CategoriaSeeder extends Seeder
{
    public function run()
    {
        Categoria::create(['nombre' => 'Entradas']);
        Categoria::create(['nombre' => 'Platos Principales']);
        Categoria::create(['nombre' => 'Bebidas']);
        Categoria::create(['nombre' => 'Postres']);
        Categoria::create(['nombre' => 'Sanduches']);
        Categoria::create(['nombre' => 'Bowls']);
        Categoria::create(['nombre' => 'Hamburguesas']);    
        Categoria::create(['nombre' => 'Papas']);
        Categoria::create(['nombre' => 'Almuerzos Diarios']);
    }
}