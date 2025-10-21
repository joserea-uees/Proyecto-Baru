<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = \App\Models\User::class;

    public function definition()
    {
        return [
            'name' => 'Tester User',
            'codigo_estudiante' => $this->faker->unique()->numerify('2023240011'), // e.g., EST-123456
            'email' => null, // Nullable, as per your requirement
            'password' => Hash::make('123456789'),
             'rol' => 'user',
            'remember_token' => Str::random(10),
        ];
    }
}