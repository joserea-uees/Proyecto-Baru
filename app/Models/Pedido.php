<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pedido extends Model
{
    protected $fillable = [
        'user_id', 'reservation_code', 'productos', 'fecha_reserva', 'comentarios', 'total', 'estado'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);   
    }

    public function producto()
    {
    return $this->belongsTo(Producto::class);
    }

    public function detallePedidos(): HasMany
    {
        return $this->hasMany(DetallePedido::class, 'pedido_id');
    }

    public function getProductosAttribute($value): array
    {
        return json_decode($value, true) ?? [];
    }

    public function getEstadoColorAttribute(): string
    {
        return match($this->estado) {
            'Completado' => 'green-500',
            'Pendiente' => 'yellow-400',
            'Cancelado' => 'red-500',
            default => 'gray-500'
        };
    }
}