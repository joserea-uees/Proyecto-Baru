<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name',
        'codigo_estudiante',
        'password',
        'rol',
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

    public function isAdmin()
    {
        return $this->rol === 'admin';
    }
}