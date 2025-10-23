<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BARÚ Food Lounge - Login</title>
    <link rel="stylesheet" href="{{ asset('assets/styles.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        /* ===== ESTILO BASADO EN LA IMAGEN ORIGINAL ===== */
        .container-admin {
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            padding: 40px;
            max-width: 420px;
            margin: 20px auto;
            position: relative;
            text-align: center;
        }

        h1 {
            font-family: 'Playfair Display', serif;
            font-size: 2.8rem;
            margin: 0;
        }

        .admin-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            background: #2f3832;
            color: white;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 0 4px 15px rgba(47, 56, 50, 0.4);
            margin-top: 6px; /* espacio entre el título y la insignia */
        }

        .admin-badge i {
            font-size: 13px;
        }

        .subtitle {
            font-family: 'Pacifico', cursive;
            font-size: 1.2rem;
            margin-top: 12px;
            margin-bottom: 25px;
            color: #1f2421;
        }

        .input-group input {
            background-color: #e8edf0 !important;
            border: 1px solid #cbd1d3 !important;
            color: #1f2421 !important;
        }

        .input-group input:focus {
            border-color: #4a5a52 !important;
            box-shadow: 0 0 0 3px rgba(74, 90, 82, 0.2) !important;
        }

        .input-group i {
            color: #4a5a52 !important;
        }

        button {
            background: #2f3832 !important;
            border: none !important;
            color: #fff !important;
            font-weight: 600;
        }

        button:hover {
            background: #1e2320 !important;
            transform: translateY(-2px) !important;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.4) !important;
        }

        .error-message {
            background: #fef2f2 !important;
            border: 1px solid #f5c2c2 !important;
            color: #a32a2a !important;
        }
    </style>
</head>
<body>
    <div class="container-admin">
        <h1>BARÚ</h1>
        <div class="admin-badge"><i class="fas fa-shield-alt"></i> ADMIN</div>
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