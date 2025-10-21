<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BARÚ Food Lounge - Panel de Administrador</title>
    <link rel="stylesheet" href="{{ asset('assets/styles.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <div class="container">
        <h1>BARÚ - Panel de Administrador</h1>
        <p>Bienvenido, {{ Auth::user()->name }}!</p>
        <p>Esta es la vista del administrador.</p>
        <form action="{{ route('logout') }}" method="POST" class="inline">
            @csrf
            <button type="submit" class="btn-logout">Cerrar Sesión</button>
    </div>
</body>
</html>