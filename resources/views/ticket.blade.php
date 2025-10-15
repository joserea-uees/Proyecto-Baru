<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BARÚ Food Lounge - Ticket de Reserva</title>
    <link rel="stylesheet" href="{{ asset('assets/styles.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <div class="container">
        <h1>BARÚ</h1>
        <p class="subtitle">Food Lounge</p>
        <h2>Ticket de Reserva</h2>
        <p><strong>Código del Ticket:</strong> {{ $pedido->codigo_ticket }}</p>
        <p><strong>Nombre:</strong> {{ $pedido->user->name }}</p>
        <p><strong>Código de Estudiante:</strong> {{ $pedido->user->codigo_estudiante }}</p>
        <p><strong>Fecha y Hora:</strong> {{ $pedido->fecha_reserva }}</p>
        <p><strong>Número de Personas:</strong> {{ $pedido->numero_personas }}</p>
        <p><strong>Estado:</strong> {{ ucfirst($pedido->estado) }}</p>
        <h3>Productos Reservados</h3>
        <ul>
            @foreach ($pedido->detalles as $detalle)
                <li>{{ $detalle->producto->nombre }} (Cantidad: {{ $detalle->cantidad }})</li>
            @endforeach
        </ul>
        @if($pedido->comentarios)
            <p><strong>Comentarios:</strong> {{ $pedido->comentarios }}</p>
        @endif
        <a href="{{ route('pedidos.create') }}" class="register-link">Hacer otra reserva</a>
        <a href="{{ route('login') }}" class="register-link">Volver al Login</a>
    </div>
</body>
</html>