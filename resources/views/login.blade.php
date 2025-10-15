<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BARÚ Food Lounge - Login</title>
    <link rel="stylesheet" href="{{ asset('assets/styles.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <div class="container">
        <h1>BARÚ</h1>
        <p class="subtitle">Food Lounge</p>
        <form action="{{ route('login.submit') }}" method="POST">
            @csrf
            <div class="input-group">
                <i class="fas fa-id-card"></i>
                <input type="text" name="codigo_estudiante" placeholder="Código de Estudiante" required>
            </div>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="contrasena" placeholder="Contraseña" required>
            </div>
            <button type="submit">Login</button>
            <div class="remember">
                <input type="checkbox" id="remember" name="remember">
                <label for="remember">Remember me</label>
            </div>
        </form>
        <a href="{{ route('register') }}" class="register-link">Registrarse</a>
    </div>
</body>
</html>