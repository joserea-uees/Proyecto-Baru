<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory; // Add this trait

    protected $fillable = [
        'name',
        'codigo_estudiante',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function pedidos()
    {
        return $this->hasMany(Pedido::class);
    }

    public function getAuthIdentifierName()
    {
        return 'codigo_estudiante';
    }
}