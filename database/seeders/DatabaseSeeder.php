<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'José Rea',
            'codigo_estudiante' => '2023240089',
            'email' => null,
            'password' => \Illuminate\Support\Facades\Hash::make('123456789'),
        ]);
    }
}