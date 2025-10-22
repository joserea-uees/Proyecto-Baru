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
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
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
            box-shadow: 0 20px 60px rgba(0, 31, 63, 0.3);
            padding: 2rem;
        }
        h1 {
            font-family: 'Playfair Display', serif;
            color: #001F3F;
            text-align: center;
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
            font-weight: 700;
            position: relative;
        }
        h1::after {
            content: '';
            display: block;
            width: 60px;
            height: 3px;
            background: linear-gradient(90deg, #10B981, #059669);
            margin: 0.5rem auto;
            border-radius: 2px;
        }
        h3 {
            font-family: 'Inter', sans-serif;
            color: #001F3F;
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 1rem;
            margin-top: 2rem;
            display: flex;
            align-items: center;
        }
        h3 i {
            margin-right: 0.5rem;
            color: #10B981;
        }
        h3:first-of-type {
            margin-top: 0;
        }
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        .stat-card {
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.1) 0%, rgba(5, 150, 105, 0.1) 100%);
            border: 1px solid rgba(16, 185, 129, 0.2);
            border-radius: 1rem;
            padding: 1.5rem;
            text-align: center;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #10B981, #059669);
        }
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(16, 185, 129, 0.15);
        }
        .stat-icon {
            font-size: 2.5rem;
            color: #10B981;
            margin-bottom: 0.5rem;
        }
        .stat-value {
            font-size: 2rem;
            font-weight: 700;
            color: #001F3F;
            display: block;
        }
        .stat-label {
            color: #4B5563;
            font-size: 0.875rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        .welcome-text {
            color: #4B5563;
            font-size: 1.125rem;
            font-weight: 400;
            text-align: center;
            margin-bottom: 2rem;
            animation: fadeInUp 0.8s ease-out;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 2rem;
            background: white;
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid #E5E7EB;
        }
        th {
            background: linear-gradient(135deg, #001F3F 0%, #003366 100%);
            color: white;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
        }
        tr:last-child td {
            border-bottom: none;
        }
        tr:hover {
            background: #F0FDF4;
            transform: scale(1.01);
            transition: all 0.2s ease;
        }
        .btn {
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            font-weight: 500;
            font-size: 0.875rem;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            border: none;
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }
        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }
        .btn:hover::before {
            left: 100%;
        }
        .btn-delete {
            background: #EF4444;
            color: white;
        }
        .btn-delete:hover {
            background: #DC2626;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
        }
        .btn-view {
            background: #10B981;
            color: white;
        }
        .btn-view:hover {
            background: #059669;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        }
        .btn-logout {
            background: linear-gradient(135deg, #6B7280 0%, #4B5568 100%);
            color: white;
            width: 100%;
            max-width: 200px;
            margin: 2rem auto 0;
            display: block;
            padding: 0.75rem;
            border-radius: 0.75rem;
            font-weight: 600;
        }
        .btn-logout:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(107, 114, 128, 0.3);
        }
        .no-applicable {
            color: #6B7280;
            font-style: italic;
        }
        .fade-in {
            animation: fadeIn 0.6s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .section-card {
            background: white;
            border-radius: 1rem;
            padding: 1.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            border: 1px solid #E5E7EB;
        }
        .section-card:hover {
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            transform: translateY(-2px);
        }
        .search-input {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #D1D5DB;
            border-radius: 0.5rem;
            margin-bottom: 1rem;
            transition: all 0.2s ease;
        }
        .search-input:focus {
            outline: none;
            border-color: #10B981;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
            backdrop-filter: blur(5px);
        }
        .modal-content {
            background-color: white;
            margin: 15% auto;
            padding: 2rem;
            border-radius: 1rem;
            width: 80%;
            max-width: 500px;
            text-align: center;
            animation: modalSlideIn 0.3s ease;
        }
        @keyframes modalSlideIn {
            from { opacity: 0; transform: translateY(-50px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }
        .close:hover {
            color: #000;
        }
        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 1rem 1.5rem;
            border-radius: 0.5rem;
            color: white;
            font-weight: 500;
            z-index: 1001;
            transform: translateX(100%);
            transition: transform 0.3s ease;
        }
        .notification.show {
            transform: translateX(0);
        }
        .notification.success {
            background: #10B981;
        }
        .notification.error {
            background: #EF4444;
        }
    </style>
</head>
<body>
    <div class="container fade-in">
        <h1>BARÚ Food Lounge - Panel de Administrador</h1>
        <p class="welcome-text" x-data="{ showWelcome: true }" x-show="showWelcome" x-transition>
            ¡Bienvenido, Admin! Gestiona tu lounge con facilidad.
        </p>

        <!-- Estadísticas -->
        <div class="stats-grid">
            <div class="stat-card">
                <i class="fas fa-shopping-cart stat-icon"></i>
                <span class="stat-value">25</span>
                <span class="stat-label">Pedidos Totales</span>
            </div>
            <div class="stat-card">
                <i class="fas fa-users stat-icon"></i>
                <span class="stat-value">3</span>
                <span class="stat-label">Usuarios Activos</span>
            </div>
            <div class="stat-card">
                <i class="fas fa-clock stat-icon"></i>
                <span class="stat-value">2</span>
                <span class="stat-label">Pendientes Hoy</span>
            </div>
        </div>

        <!-- Lista de usuarios -->
        <div class="section-card">
            <h3><i class="fas fa-users"></i>Usuarios Registrados</h3>
            <input type="text" class="search-input" placeholder="Buscar usuarios..." x-data="{ search: '', users: [
                {name: 'Juan Pérez', code: 'EST001', role: 'user'},
                {name: 'María López', code: 'EST002', role: 'user'},
                {name: 'Admin', code: 'ADMIN001', role: 'admin'}
            ], filteredUsers() { return this.users.filter(u => u.name.toLowerCase().includes(this.search.toLowerCase()) || u.code.toLowerCase().includes(this.search.toLowerCase())); } }" x-model="search" @input.debounce="search">
            <div class="overflow-x-auto">
                <table>
                    <thead>
                        <tr>
                            <th><i class="fas fa-user mr-2"></i>Nombre</th>
                            <th><i class="fas fa-id-badge mr-2"></i>Código Estudiante</th>
                            <th><i class="fas fa-user-tag mr-2"></i>Rol</th>
                            <th><i class="fas fa-cogs mr-2"></i>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <template x-for="user in filteredUsers()" :key="user.code">
                            <tr>
                                <td class="font-medium" x-text="user.name"></td>
                                <td x-text="user.code"></td>
                                <td class="text-gray-600" x-text="user.role"></td>
                                <td>
                                    <template x-if="user.role !== 'admin'">
                                        <button class="btn btn-delete" @click="if(confirm('¿Estás seguro de eliminar a ' + user.name + '?')) { showNotification('Usuario eliminado exitosamente', 'success'); } else { showNotification('Acción cancelada', 'error'); }">
                                            <i class="fas fa-trash mr-1"></i>Eliminar
                                        </button>
                                    </template>
                                    <template x-if="user.role === 'admin'">
                                        <span class="no-applicable">No aplicable</span>
                                    </template>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Lista de pedidos -->
        <div class="section-card">
            <h3><i class="fas fa-receipt"></i>Pedidos Recientes</h3>
            <div class="overflow-x-auto">
                <table>
                    <thead>
                        <tr>
                            <th><i class="fas fa-hashtag mr-2"></i>ID Pedido</th>
                            <th><i class="fas fa-user mr-2"></i>Usuario</th>
                            <th><i class="fas fa-calendar mr-2"></i>Fecha</th>
                            <th><i class="fas fa-eye mr-2"></i>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="font-medium">#1</td>
                            <td>Juan Pérez</td>
                            <td class="text-gray-600">20/10/2025 14:30</td>
                            <td>
                                <button class="btn btn-view" onclick="openModal('Detalles del Pedido #1: Plato principal - $15.00, Bebida - $5.00. Total: $20.00. Estado: Completado.')">
                                    <i class="fas fa-eye mr-1"></i>Ver Ticket
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td class="font-medium">#2</td>
                            <td>María López</td>
                            <td class="text-gray-600">20/10/2025 15:45</td>
                            <td>
                                <button class="btn btn-view" onclick="openModal('Detalles del Pedido #2: Ensalada - $12.00, Postre - $8.00. Total: $20.00. Estado: Pendiente.')">
                                    <i class="fas fa-eye mr-1"></i>Ver Ticket
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Botón de cerrar sesión -->
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-logout">
                <i class="fas fa-sign-out-alt mr-2"></i>Cerrar Sesión
            </button>
        </form>
    </div>

    <!-- Modal para detalles -->
    <div id="modal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2 class="text-xl font-bold mb-4">Detalles del Pedido</h2>
            <p id="modal-text" class="text-gray-700"></p>
        </div>
    </div>

    <!-- Notificación -->
    <div id="notification" class="notification" x-data="{ show: false, message: '', type: '', showNotification(msg, typ) { this.message = msg; this.type = typ; this.show = true; setTimeout(() => this.show = false, 3000); } }"></div>

    <script>
        function openModal(text) {
            document.getElementById('modal-text').textContent = text;
            document.getElementById('modal').style.display = 'block';
        }
        function closeModal() {
            document.getElementById('modal').style.display = 'none';
        }
        window.onclick = function(event) {
            const modal = document.getElementById('modal');
            if (event.target == modal) {
                closeModal();
            }
        }
    </script>
</body>
</html>