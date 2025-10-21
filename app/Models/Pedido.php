<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $fillable = [
        'user_id', 'reservation_code', 'productos', 'fecha_reserva', 'comentarios', 'total', 'estado'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Método para acceder al campo JSON productos
    public function getProductosAttribute($value)
    {
        return json_decode($value, true);
    }
}