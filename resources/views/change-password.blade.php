<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar Contraseña - BARÚ Food Lounge</title>
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
        .form-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 31, 63, 0.15);
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
        .fade-in {
            animation: fadeIn 0.6s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .sidebar-icon {
            transition: all 0.3s ease;
            padding: 8px;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
        }
        .sidebar-icon:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: scale(1.05);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-navy-900 via-navy-800 to-navy-700">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-16 bg-white/90 backdrop-blur-md shadow-lg flex flex-col items-center pt-24 pb-6 z-10">
            <div class="mb-8">
                <i class="fas fa-utensils text-2xl text-navy-900 sidebar-icon"></i>
            </div>
            <nav class="flex flex-col space-y-6">
                <a href="{{ route('home') }}" class="sidebar-icon text-navy-700 hover:text-navy-900"><i class="fas fa-home text-xl"></i></a>
                <a href="#" class="sidebar-icon text-navy-700 hover:text-navy-900"><i class="fas fa-calendar-alt text-xl"></i></a>
                <a href="{{ route('password.change') }}" class="sidebar-icon text-navy-900"><i class="fas fa-cog text-xl"></i></a>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col bg-white/80 backdrop-blur-sm">
            <!-- Header -->
            <header class="bg-transparent p-4 flex justify-between items-center sticky top-0 z-20">
                <div class="flex items-center space-x-3">
                    <i class="fas fa-key text-xl text-white"></i>
                    <h1 class="text-xl font-semibold text-white font-serif">Cambiar Contraseña</h1>
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

            <!-- Password Change Form -->
            <main class="flex-1 p-6 overflow-auto fade-in">
                <div class="max-w-md mx-auto form-container p-6">
                    <h2 class="text-2xl font-semibold text-navy-900 mb-6 text-center">Actualizar Contraseña</h2>
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
                        @if (session('status'))
                            <p class="success-message">{{ session('status') }}</p>
                        @endif
                        <button type="submit" class="submit-btn w-full">Actualizar Contraseña</button>
                    </form>
                </div>
            </main>
        </div>
    </div>
</body>
</html>
