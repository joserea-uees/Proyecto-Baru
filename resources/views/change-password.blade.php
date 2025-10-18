<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuración de Cuenta - BARÚ Food Lounge</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: white;
            min-height: 100vh;
        }
        .main-bg {
            background-color: #001F3F;
        }
        .form-container {
            background: rgba(255, 255, 255, 0.98);
            border-radius: 12px;
            box-shadow: 0 6px 24px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
            animation: fadeIn 0.4s ease-in-out;
        }
        .input-field {
            background: #F9FAFB;
            border: 1px solid #D1D5DB;
            border-radius: 8px;
            padding: 12px;
            transition: all 0.3s ease;
        }
        .input-field:focus {
            border-color: #001F3F;
            box-shadow: 0 0 0 3px rgba(0, 31, 63, 0.1);
            background: white;
            outline: none;
        }
        .submit-btn {
            background: #001F3F;
            color: white;
            border-radius: 8px;
            padding: 12px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        .submit-btn:hover {
            background: #003366;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0, 31, 63, 0.2);
        }
        .tab-btn {
            background: #F3F4F6;
            border-radius: 8px;
            padding: 10px 16px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .tab-btn:hover {
            background: #E5E7EB;
        }
        .tab-btn.active {
            background: #001F3F;
            color: white;
        }
        .hidden {
            display: none;
        }
        .error-message {
            color: #DC2626;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
        .success-message {
            color: #10B981;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-16 bg-white backdrop-blur-md shadow-lg flex flex-col items-center pt-24 pb-6 z-10">
            <div class="mb-8">
                <i class="fas fa-utensils text-2xl text-navy-900 sidebar-icon"></i>
            </div>
            <nav class="flex flex-col space-y-6">
                <a href="{{ route('home') }}" class="sidebar-icon text-navy-700 hover:text-navy-900"><i class="fas fa-home text-xl"></i></a>
                <a href="{{ route('password.change') }}" class="sidebar-icon text-navy-900"><i class="fas fa-cog text-xl"></i></a>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col main-bg">
            <!-- Header -->
            <header class="bg-transparent p-4 flex justify-between items-center">
                <div class="flex items-center space-x-3">
                    <i class="fas fa-user-cog text-xl text-white"></i>
                    <h1 class="text-xl font-semibold text-white font-serif">Configuración de Cuenta</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-white/90 font-medium hidden md:block">¡Hola, {{ auth()->user()->name }}!</span>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-white/80 hover:text-white transition-colors">
                            <i class="fas fa-sign-out-alt text-lg"></i>
                        </button>
                    </form>
                </div>
            </header>

            <!-- Tabs -->
            <main class="flex-1 p-6 overflow-auto">
                <div class="max-w-md mx-auto">
                    <div class="flex justify-between mb-6 space-x-2">
                        <button class="tab-btn active" onclick="showTab(event, 'nombre')">Cambiar Nombre</button>
                        <button class="tab-btn" onclick="showTab(event, 'password')">Cambiar Contraseña</button>
                        <button class="tab-btn" onclick="showTab(event, 'eliminar')">Eliminar Cuenta</button>
                    </div>

                    <!-- Cambiar Nombre -->
                    <div id="tab-nombre" class="form-container p-6">
                        <h2 class="text-xl font-semibold text-navy-900 mb-4 text-center">Cambiar Nombre</h2>
                        <form action="{{ route('user.update.name') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-4">
                                <label for="name" class="block text-sm font-medium text-navy-700 mb-2">Nuevo Nombre</label>
                                <div class="relative">
                                    <input type="text" name="name" id="name" value="{{ old('name', auth()->user()->name) }}" class="input-field w-full">
                                    <i class="fas fa-user absolute right-3 top-1/2 transform -translate-y-1/2 text-navy-400"></i>
                                </div>
                                @error('name')
                                    <p class="error-message">{{ $message }}</p>
                                @enderror
                            </div>
                            <button type="submit" class="submit-btn w-full">Guardar Nombre</button>
                        </form>
                    </div>

                    <!-- Cambiar Contraseña -->
<div id="tab-password" class="form-container p-6 hidden">
    <h2 class="text-xl font-semibold text-navy-900 mb-4 text-center">Cambiar Contraseña</h2>
    <form action="{{ route('password.update') }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="current_password" class="block text-sm font-medium text-navy-700 mb-2">Contraseña Actual</label>
            <div class="relative">
                <input type="password" name="current_password" id="current_password" class="input-field w-full" required>
                <i class="fas fa-lock absolute right-3 top-1/2 transform -translate-y-1/2 text-navy-400"></i>
            </div>
            @error('current_password')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-navy-700 mb-2">Nueva Contraseña</label>
            <div class="relative">
                <input type="password" name="password" id="password" class="input-field w-full" required>
                <i class="fas fa-lock absolute right-3 top-1/2 transform -translate-y-1/2 text-navy-400"></i>
            </div>
            @error('password')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-6">
            <label for="password_confirmation" class="block text-sm font-medium text-navy-700 mb-2">Confirmar Nueva Contraseña</label>
            <div class="relative">
                <input type="password" name="password_confirmation" id="password_confirmation" class="input-field w-full" required>
                <i class="fas fa-lock absolute right-3 top-1/2 transform -translate-y-1/2 text-navy-400"></i>
            </div>
        </div>
        <button type="submit" class="submit-btn w-full">Actualizar Contraseña</button>
    </form>
</div>

<!-- Eliminar Cuenta -->
<div id="tab-eliminar" class="form-container p-6 hidden">
    <h2 class="text-xl font-semibold text-red-700 mb-4 text-center">Eliminar Cuenta</h2>
    <form action="{{ route('user.delete') }}" method="POST">
        @csrf
        @method('DELETE')
        <div class="mb-6">
            <label class="block text-sm font-medium text-red-700 mb-2">Confirmación</label>
            <div class="flex items-center space-x-2">
                <input type="checkbox" name="delete_account" id="delete_account" class="form-checkbox text-red-600">
                <label for="delete_account" class="text-sm text-red-600">Sí, deseo eliminar mi cuenta</label>
            </div>
        </div>
        <button type="submit" class="submit-btn w-full bg-red-600 hover:bg-red-700">Eliminar Cuenta</button>
    </form>
</div>
</div>
</main>
</div>
</div>

<!-- Script para cambiar de pestaña -->
<script>
    function showTab(event, tabId) {
        // Ocultar todos los formularios
        document.querySelectorAll('.form-container').forEach(form => {
            form.classList.add('hidden');
        });

        // Mostrar el formulario seleccionado
        const selectedForm = document.getElementById('tab-' + tabId);
        if (selectedForm) {
            selectedForm.classList.remove('hidden');
        }

        // Quitar clase 'active' de todos los botones
        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.classList.remove('active');
        });

        // Agregar clase 'active' al botón clickeado
        event.currentTarget.classList.add('active');
    }
</script>
</body>
</html>

