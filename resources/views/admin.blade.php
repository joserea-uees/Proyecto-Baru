<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BARÚ Food Lounge - Panel de Administrador</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #001F3F 0%, #003366 100%);
            min-height: 100vh;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 1200px;
            margin: 2rem auto;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 1rem;
            box-shadow: 0 10px 30px rgba(0, 31, 63, 0.2);
            padding: 2rem;
        }
        h1 {
            font-family: 'Playfair Display', serif;
            color: #001F3F;
            text-align: center;
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }
        h3 {
            font-family: 'Playfair Display', serif;
            color: #001F3F;
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }
        .stats {
            background: rgba(0, 31, 63, 0.1);
            border-radius: 0.5rem;
            padding: 1.5rem;
            text-align: center;
            margin-bottom: 2rem;
            transition: all 0.3s ease;
        }
        .stats:hover {
            transform: translateY(-4px);
            box-shadow: 0 4px 12px rgba(0, 31, 63, 0.15);
        }
        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin-bottom: 2rem;
        }
        th, td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid rgba(0, 31, 63, 0.1);
        }
        th {
            background: #001F3F;
            color: white;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.875rem;
            letter-spacing: 0.05em;
        }
        tr {
            transition: all 0.3s ease;
        }
        tr:hover {
            background: rgba(0, 31, 63, 0.05);
            transform: translateY(-2px);
        }
        .btn {
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            font-weight: 500;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        .btn-delete {
            background: #dc3545;
            color: white;
        }
        .btn-delete:hover {
            background: #c82333;
            transform: scale(1.05);
        }
        .btn-view {
            background: #28a745;
            color: white;
        }
        .btn-view:hover {
            background: #218838;
            transform: scale(1.05);
        }
        .btn-logout {
            background: #6c757d;
            color: white;
            width: 100%;
            max-width: 200px;
            margin: 1rem auto;
            display: block;
        }
        .btn-logout:hover {
            background: #5a6268;
            transform: scale(1.05);
        }
        .fade-in {
            animation: fadeIn 0.6s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .welcome-text {
            color: #001F3F;
            font-size: 1.125rem;
            font-weight: 500;
            text-align: center;
            margin-bottom: 1.5rem;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-navy-900 via-navy-800 to-navy-700">
    <div class="container fade-in">
        <h1>BARÚ Food Lounge - Panel de Administrador</h1>
        <p class="welcome-text">Bienvenido, Admin!</p>

        <!-- Estadísticas -->
        <div class="stats">
            <h3>Estadísticas</h3>
            <p class="text-navy-600">Total de pedidos: <span class="font-semibold">25</span></p>
        </div>

        <!-- Lista de usuarios -->
        <h3>Usuarios Registrados</h3>
        <div class="overflow-x-auto">
            <table>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Código Estudiante</th>
                        <th>Rol</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Juan Pérez</td>
                        <td>EST001</td>
                        <td>user</td>
                        <td>
                            <button class="btn btn-delete">
                                <i class="fas fa-trash mr-2"></i>Eliminar
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>María López</td>
                        <td>EST002</td>
                        <td>user</td>
                        <td>
                            <button class="btn btn-delete">
                                <i class="fas fa-trash mr-2"></i>Eliminar
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>Admin</td>
                        <td>ADMIN001</td>
                        <td>admin</td>
                        <td>
                            <span class="text-navy-500">No aplicable</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Lista de pedidos -->
        <h3>Pedidos Recientes</h3>
        <div class="overflow-x-auto">
            <table>
                <thead>
                    <tr>
                        <th>ID Pedido</th>
                        <th>Usuario</th>
                        <th>Fecha</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Juan Pérez</td>
                        <td>20/10/2025 14:30</td>
                        <td>
                            <a href="#" class="btn btn-view">
                                <i class="fas fa-ticket-alt mr-2"></i>Ver Ticket
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>María López</td>
                        <td>20/10/2025 15:45</td>
                        <td>
                            <a href="#" class="btn btn-view">
                                <i class="fas fa-ticket-alt mr-2"></i>Ver Ticket
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Botón de cerrar sesión -->
        <!-- Botón de cerrar sesión -->
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-logout">
                <i class="fas fa-sign-out-alt mr-2"></i>Cerrar Sesión
            </button>
        </form>

    </div>
</body>
</html>