<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Configuración de Cuenta</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet" />
  <style>
    body {
      font-family: 'Inter', sans-serif;
      background-color: #F9FAFB;
    }
    .tab-btn {
      padding: 0.75rem 1rem;
      font-weight: 500;
      text-align: left;
      border-left: 4px solid transparent;
      transition: all 0.3s ease;
      background-color: #F3F4F6;
      border-radius: 6px;
    }
    .tab-btn:hover {
      background-color: #E5E7EB;
    }
    .tab-btn.active {
      border-left-color: #1E3A8A;
      color: #1E3A8A;
      background-color: #E5E7EB;
    }
    .form-container {
      background: white;
      border-radius: 8px;
      padding: 2rem;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      animation: fadeIn 0.3s ease-in-out;
      margin-top: 2rem;
    }
    .input-field {
      width: 100%;
      padding: 0.75rem;
      border: 1px solid #D1D5DB;
      border-radius: 6px;
      background-color: #F3F4F6;
      transition: border-color 0.2s ease;
    }
    .input-field:focus {
      border-color: #1E3A8A;
      outline: none;
      background-color: white;
    }
    .submit-btn {
      background-color: #1E3A8A;
      color: white;
      padding: 0.75rem;
      border-radius: 6px;
      font-weight: 500;
      transition: background-color 0.2s ease;
    }
    .submit-btn:hover {
      background-color: #3749A0;
    }
    .hidden {
      display: none;
    }
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(10px); }
      to { opacity: 1; transform: translateY(0); }
    }
  </style>
</head>
<body>
  <div class="flex h-screen">
    <!-- Barra lateral -->
    <aside class="w-16 bg-white shadow-md flex flex-col items-center pt-6">
      <i class="fas fa-utensils text-2xl text-gray-700 mb-6"></i>
      <a href="{{ route('home') }}" class="text-gray-500 hover:text-gray-800 mb-6"><i class="fas fa-home text-2xl"></i></a>
      <a href="{{ route('password.change') }}" class="text-gray-800"><i class="fas fa-cog text-2xl"></i></a>
    </aside>

    <!-- Botones verticales -->
    <nav class="w-48 bg-white shadow-md flex flex-col py-10 px-4 space-y-4">
      <button class="tab-btn active" onclick="showTab(event, 'nombre')">Cambiar Nombre</button>
      <button class="tab-btn" onclick="showTab(event, 'password')">Cambiar Contraseña</button>
      <button class="tab-btn" onclick="showTab(event, 'eliminar')">Eliminar Cuenta</button>
    </nav>

    <!-- Panel derecho con estructura vertical -->
    <div class="flex-1 flex flex-col bg-[#001F3F]">
      <!-- Encabezado azul oscuro -->
      <div class="w-full px-10 py-6 shadow-md" style="background-color: #001F3F;">
        <h1 class="text-2xl font-semibold text-white">Configuración de Cuenta</h1>
      </div>

      <!-- Contenido principal debajo del encabezado -->
      <main class="flex-1 px-10 py-12 overflow-auto">
        <div class="max-w-xl mx-auto">
          <!-- Cambiar Nombre -->
          <div id="tab-nombre" class="form-container">
            <form action="{{ route('user.update.name') }}" method="POST">
              @csrf
              @method('PUT')
              <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nuevo Nombre</label>
                <input type="text" name="name" id="name" value="{{ old('name', auth()->user()->name) }}" class="input-field" />
                @error('name')
                  <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
              </div>
              <button type="submit" class="submit-btn w-full">Guardar Nombre</button>
            </form>
          </div>

          <!-- Cambiar Contraseña -->
          <div id="tab-password" class="form-container hidden">
            <form action="{{ route('password.update') }}" method="POST">
              @csrf
              @method('PUT')
              <div class="mb-4">
                <label for="current_password" class="block text-sm font-medium text-gray-700 mb-1">Contraseña Actual</label>
                <input type="password" name="current_password" id="current_password" class="input-field" required />
                @error('current_password')
                  <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
              </div>
              <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Nueva Contraseña</label>
                <input type="password" name="password" id="password" class="input-field" required />
                @error('password')
                  <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
              </div>
              <div class="mb-6">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirmar Contraseña</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="input-field" required />
              </div>
              <button type="submit" class="submit-btn w-full">Actualizar Contraseña</button>
            </form>
          </div>

          <!-- Eliminar Cuenta -->
          <div id="tab-eliminar" class="form-container hidden">
            <form action="{{ route('user.delete') }}" method="POST">
              @csrf
              @method('DELETE')
              <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Confirmación</label>
                <div class="flex items-center space-x-2">
                  <input type="checkbox" name="delete_account" id="delete_account" class="form-checkbox text-red-600" />
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

  <!-- Script funcional -->
  <script>
    function showTab(event, tabId) {
      document.querySelectorAll('.form-container').forEach(form => form.classList.add('hidden'));
      document.getElementById('tab-' + tabId).classList.remove('hidden');
      document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
      event.currentTarget.classList.add('active');
    }
  </script>
</body>
</html>
