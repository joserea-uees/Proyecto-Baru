<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crear un usuario de prueba específico
        User::factory()->create([
            'name' => 'José Rea',
            'codigo_estudiante' => '2023240089',
            'email' => null,
            'password' => \Illuminate\Support\Facades\Hash::make('123456789'),
        ]);

        User::factory()->create([
            'name' => 'Mattias Garces',
            'codigo_estudiante' => '2023240057',
            'email' => null,
            'password' => \Illuminate\Support\Facades\Hash::make('Mattygarces2005'),
        ]);
        // Opcional: Crear varios usuarios con datos aleatorios
        // User::factory(9)->create();
    }
}