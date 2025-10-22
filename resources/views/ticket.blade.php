<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>BARÚ Food Lounge - Ticket</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body { 
            font-family: 'Inter', sans-serif; 
            background: linear-gradient(135deg, #001F3F 0%, #003366 100%);
            min-height: 100vh;
        }
        .ticket-card {
            max-width: 500px;
            margin: 2rem auto;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            padding: 2rem;
        }
        .status-badge {
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 500;
        }
        .status-pending {
            background: #FEF3C7;
            color: #D97706;
        }
        .status-confirmed {
            background: #D1FAE5;
            color: #059669;
        }
        .status-cancelled {
            background: #FEE2E2;
            color: #DC2626;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-navy-900 via-navy-800 to-navy-700">
    <div class="ticket-card">
        <div class="text-center mb-6">
            <h1 class="text-3xl font-bold font-serif text-navy-900">BARÚ Food Lounge</h1>
            <p class="text-sm text-navy-500">Ticket de Reserva</p>
        </div>
        <div class="border-t border-b border-navy-100 py-4 mb-4">
            <div class="flex justify-between items-center mb-2">
                <h5 class="text-lg font-medium text-navy-900">Reserva #{{ $pedido->reservation_code }}</h5>
                <span class="status-badge status-{{ $pedido->estado }}">{{ ucfirst($pedido->estado) }}</span>
            </div>
            <p class="text-sm text-navy-500 mb-2">Fecha de entrega: {{ \Carbon\Carbon::parse($pedido->fecha_reserva)->format('d/m/Y') }}</p>
            <p class="text-sm text-navy-500 mb-2">Cliente: {{ $pedido->user->name }}</p>
            @if($pedido->comentarios)
                <p class="text-sm text-navy-600 mb-3"><strong>Comentarios:</strong> {{ $pedido->comentarios }}</p>
            @endif
        </div>
        <div class="mb-4">
            <h6 class="text-sm font-medium text-navy-900 mb-2">Productos:</h6>
            <ul class="text-sm text-navy-600">
                @php
                    $productos = is_string($pedido->productos) ? json_decode($pedido->productos, true) : $pedido->productos;
                    $totalCantidad = $productos ? array_sum(array_column($productos, 'cantidad')) : 0;
                    $precioPorUnidadFallback = $totalCantidad > 0 ? $pedido->total / $totalCantidad : 0;
                @endphp
                @if($productos)
                    @foreach ($productos as $producto)
                        @php
                            $productoModel = \App\Models\Producto::find($producto['id']);
                            $precioUnitario = $productoModel ? $productoModel->precio : (isset($producto['precio']) ? $producto['precio'] : $precioPorUnidadFallback);
                            $subtotal = $producto['cantidad'] * $precioUnitario;
                        @endphp
                        <li class="flex justify-between mb-1">
                            <span>{{ $productoModel ? $productoModel->nombre : 'Producto #' . ($producto['id'] ?? 'Desconocido') }} (x{{ $producto['cantidad'] }})</span>
                            <span>${{ number_format($subtotal, 2) }}</span>
                        </li>
                    @endforeach
                @else
                    <li class="text-navy-500">No se encontraron productos.</li>
                @endif
            </ul>
        </div>
        <div class="border-t border-navy-100 pt-4">
            <div class="flex justify-between text-lg font-semibold text-navy-900">
                <span>Total</span>
                <span>${{ number_format($pedido->total, 2) }}</span>
            </div>
        </div>
        <div class="mt-6 text-center">
            <a href="{{ route('reservas') }}" class="inline-flex items-center px-4 py-2 text-navy-600 hover:text-navy-800 font-medium">
                <i class="fas fa-arrow-left mr-2"></i>Volver a Reservas
            </a>
        </div>
    </div>
</body>
</html>