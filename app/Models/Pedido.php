<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'reservation_code',
        'productos',
        'fecha_reserva',
        'comentarios',
        'total',
    ];

    protected $casts = [
        'productos' => 'array',
        'fecha_reserva' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}