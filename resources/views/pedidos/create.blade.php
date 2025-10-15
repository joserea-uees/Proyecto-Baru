<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BARÚ Food Lounge - Nueva Reserva</title>
    <link rel="stylesheet" href="{{ asset('assets/styles.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <div class="container">
        <h1>BARÚ</h1>
        <p class="subtitle">Food Lounge</p>
        <form action="{{ route('pedidos.store') }}" method="POST">
            @csrf
            <div class="input-group">
                <i class="fas fa-calendar-alt"></i>
                <input type="datetime-local" name="fecha_reserva" placeholder="Fecha y hora" required>
            </div>
            <div class="input-group">
                <i class="fas fa-users"></i>
                <input type="number" name="numero_personas" placeholder="Número de personas" min="1" required>
            </div>
            <h2>Seleccionar Productos</h2>
            @foreach ($categorias as $categoria)
                <h3>{{ $categoria->nombre }}</h3>
                @foreach ($categoria->productos as $producto)
                    <div class="input-group">
                        <label>
                            <input type="checkbox" name="productos[{{ $producto->id }}][id]" value="{{ $producto->id }}">
                            {{ $producto->nombre }} ({{ $producto->precio }})
                        </label>
                        <input type="number" name="productos[{{ $producto->id }}][cantidad]" placeholder="Cantidad" min="1" style="width: 100%; padding: 12px; border: none; background-color: #4a595a; border-radius: 30px; color: #fff; font-size: 16px;">
                    </div>
                @endforeach
            @endforeach
            <div class="input-group">
                <i class="fas fa-comment"></i>
                <textarea name="comentarios" placeholder="Comentarios (opcional)" rows="4" style="width: 100%; padding: 12px; border: none; background-color: #4a595a; border-radius: 30px; box-sizing: border-box; color: #fff; font-size: 16px;"></textarea>
            </div>
            <button type="submit">Hacer Reserva</button>
        </form>
        <a href="{{ route('login') }}" class="register-link">Volver al Login</a>
    </div>
</body>
</html>