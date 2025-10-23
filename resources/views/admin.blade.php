<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Panel Administrativo | BARÚ Food Lounge</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <!-- Fuente elegante desde Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&display=swap" rel="stylesheet">
</head>

<body class="bg-gray-100 text-gray-800 font-sans" x-data="{ section: 'dashboard' }">
  <!-- Sidebar -->
  <aside class="fixed inset-y-0 left-0 w-64 bg-white shadow-lg flex flex-col z-50">
    <div class="flex flex-col items-center justify-center h-28 bg-gray-800 text-white">
      <h2 class="text-lg mt-2" style="font-family: 'Playfair Display', serif;">Admin BARÚ</h2>
    </div>
    <nav class="flex-1 p-4 space-y-3">
  <button @click="section = 'dashboard'" class="w-full text-left block px-4 py-2 rounded-lg hover:bg-gray-200 text-gray-900 font-semibold">🏠 Dashboard</button>
  <button @click="section = 'pedidos'" class="w-full text-left block px-4 py-2 rounded-lg hover:bg-gray-200 text-gray-900">📦 Pedidos</button>
  <button @click="section = 'productos'" class="w-full text-left block px-4 py-2 rounded-lg hover:bg-gray-200 text-gray-900">🍽 Productos</button>
  <button @click="section = 'clientes'" class="w-full text-left block px-4 py-2 rounded-lg hover:bg-gray-200 text-gray-900">👥 Clientes</button>
  <button @click="section = 'configuracion'" class="w-full text-left block px-4 py-2 rounded-lg hover:bg-gray-200 text-gray-900">⚙ Configuración</button>

  <form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit" class="w-full text-left block px-4 py-2 rounded-lg hover:bg-red-500 hover:text-white text-gray-900 font-semibold mt-4">
      🚪 Cerrar Sesión
    </button>
  </form>
</nav>
  </aside>

  <!-- Contenido principal -->
  <div class="ml-64 p-6">
    <!-- Header -->
    <header class="flex justify-between items-center bg-white rounded-lg p-4 shadow-sm">
      <h1 class="text-2xl font-bold text-gray-900">Panel de Control</h1>
      <div class="flex items-center space-x-4">
        <span class="text-gray-700 font-medium">Administrador</span>
      </div>
    </header>

    <!-- Sección Dashboard -->
    <section x-show="section === 'dashboard'" x-transition>
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mt-6">
        <div class="bg-white p-5 rounded-xl shadow-md flex items-center justify-between">
          <div>
            <h2 class="text-sm font-semibold text-gray-500">Pedidos Hoy</h2>
            <p class="text-2xl font-bold text-gray-900">128</p>
          </div>
          <span class="text-gray-700 text-3xl">📦</span>
        </div>

        <div class="bg-white p-5 rounded-xl shadow-md flex items-center justify-between">
          <div>
            <h2 class="text-sm font-semibold text-gray-500">Ingresos</h2>
            <p class="text-2xl font-bold text-gray-900">$1,540</p>
          </div>
          <span class="text-gray-700 text-3xl">💰</span>
        </div>

        <div class="bg-white p-5 rounded-xl shadow-md flex items-center justify-between">
          <div>
            <h2 class="text-sm font-semibold text-gray-500">Clientes Nuevos</h2>
            <p class="text-2xl font-bold text-gray-900">42</p>
          </div>
          <span class="text-gray-700 text-3xl">👥</span>
        </div>

        <div class="bg-white p-5 rounded-xl shadow-md flex items-center justify-between">
          <div>
            <h2 class="text-sm font-semibold text-gray-500">Reseñas Positivas</h2>
            <p class="text-2xl font-bold text-gray-900">96%</p>
          </div>
          <span class="text-gray-700 text-3xl">⭐</span>
        </div>
      </div>

      <!-- Gráficas -->
      <section class="p-6 bg-white rounded-xl shadow-lg mt-10">
        <h2 class="text-2xl font-semibold text-gray-900 mb-6 text-center">📊 Estadísticas del Restaurante</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
          <div class="bg-white rounded-lg p-4 shadow-md border">
            <h3 class="text-lg font-medium text-center text-gray-700 mb-2">Ventas Semanales</h3>
            <canvas id="barChart"></canvas>
          </div>
          <div class="bg-white rounded-lg p-4 shadow-md border">
            <h3 class="text-lg font-medium text-center text-gray-700 mb-2">Productos Más Pedidos</h3>
            <canvas id="pieChart"></canvas>
          </div>
        </div>
      </section>
    </section>

    <!-- Sección Pedidos -->
    <section x-show="section === 'pedidos'" x-transition>
      <div class="mt-10 bg-white rounded-xl shadow-md p-6">
        <h2 class="text-xl font-semibold text-gray-900 mb-4">📋 Últimos Pedidos</h2>
        <div class="overflow-x-auto">
          <table class="w-full text-left border-collapse">
            <thead>
              <tr class="bg-gray-100 text-gray-700 uppercase text-sm">
                <th class="py-3 px-4">ID</th>
                <th class="py-3 px-4">Cliente</th>
                <th class="py-3 px-4">Producto</th>
                <th class="py-3 px-4">Total</th>
                <th class="py-3 px-4">Estado</th>
                <th class="py-3 px-4">Fecha</th>
              </tr>
            </thead>
            <tbody>
              <tr class="border-b hover:bg-gray-50">
                <td class="py-3 px-4">#001</td>
                <td class="py-3 px-4">Carlos Ruiz</td>
                <td class="py-3 px-4">Pizza Hawaiana</td>
                <td class="py-3 px-4">$14.00</td>
                <td class="py-3 px-4 text-green-500 font-semibold">Completado</td>
                <td class="py-3 px-4">22/10/2025</td>
              </tr>
              <tr class="border-b hover:bg-gray-50">
                <td class="py-3 px-4">#002</td>
                <td class="py-3 px-4">María López</td>
                <td class="py-3 px-4">Hamburguesa Doble</td>
                <td class="py-3 px-4">$10.50</td>
                <td class="py-3 px-4 text-yellow-400 font-semibold">Pendiente</td>
                <td class="py-3 px-4">22/10/2025</td>
              </tr>
              <tr class="border-b hover:bg-gray-50">
                <td class="py-3 px-4">#003</td>
                <td class="py-3 px-4">Ana Torres</td>
                <td class="py-3 px-4">Taco Especial</td>
                <td class="py-3 px-4">$12.00</td>
                <td class="py-3 px-4 text-red-500 font-semibold">Cancelado</td>
                <td class="py-3 px-4">21/10/2025</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </section>

    <!-- Secciones vacías -->
 <section x-show="section === 'productos'" class="mt-10 space-y-6" x-transition>
  <!-- Encabezado -->
  <div class="bg-white p-6 rounded-xl shadow-md">
    <h2 class="text-xl font-semibold text-gray-900">🍽 Gestión de Productos</h2>
    <p class="text-gray-600 mt-2">Aquí podrás añadir, editar o eliminar productos del menú.</p>
  </div>

  <!-- Tabla de productos -->
  <div class="bg-white p-6 rounded-xl shadow-md">
    <h3 class="text-lg font-semibold text-gray-800 mb-4">📋 Platos del Menú</h3>
    <div class="overflow-x-auto">
      <table class="w-full text-left border-collapse">
        <thead>
          <tr class="bg-gray-100 text-gray-700 uppercase text-sm">
            <th class="py-3 px-4">Nombre</th>
            <th class="py-3 px-4">Descripción</th>
            <th class="py-3 px-4">Precio</th>
            <th class="py-3 px-4">Acciones</th>
          </tr>
        </thead>
        <tbody>
          @foreach($productos as $producto)
          <tr class="border-b hover:bg-gray-50">
            <td class="py-3 px-4">{{ $producto->nombre }}</td>
            <td class="py-3 px-4">{{ $producto->descripcion }}</td>
            <td class="py-3 px-4">${{ number_format($producto->precio, 2) }}</td>
            <td class="py-3 px-4 space-x-2">
                <a href="{{ route('productos.edit', $producto->id) }}" class="text-blue-600 text-sm">✏️ Editar</a>
                <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-600 text-sm">🗑 Eliminar</button>
                </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

  <!-- Botón para añadir producto (visual) -->
  <div class="text-right">
    <a href="{{ route('productos.create') }}" class="inline-block px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 font-medium">
  ➕ Añadir nuevo producto
</a>
  </div>
</section>



    <section x-show="section === 'clientes'" class="mt-10 space-y-6" x-transition>
  <!-- Encabezado -->
  <div class="bg-white p-6 rounded-xl shadow-md">
    <h2 class="text-xl font-semibold text-gray-900">👥 Gestión de Clientes</h2>
    <p class="text-gray-600 mt-2">Listado y detalles de tus clientes frecuentes.</p>
  </div>

 <!-- Tabla de clientes -->
<div class="bg-white p-6 rounded-xl shadow-md">
  <h3 class="text-lg font-semibold text-gray-800 mb-4">📋 Lista de Clientes</h3>
  <div class="overflow-x-auto">
    <table class="w-full text-left border-collapse">
      <thead>
        <tr class="bg-gray-100 text-gray-700 uppercase text-sm">
          <th class="py-3 px-4">Código de Estudiante</th>
          <th class="py-3 px-4">Nombre</th>
          <th class="py-3 px-4">Registrado</th>
        </tr>
      </thead>
      <tbody>
        <tr class="border-b hover:bg-gray-50">
          <td class="py-3 px-4">2025235543</td>
          <td class="py-3 px-4">Carlos Ruiz</td>
          <td class="py-3 px-4">15/08/2025</td>
        </tr>
        <tr class="border-b hover:bg-gray-50">
          <td class="py-3 px-4">2025231127</td>
          <td class="py-3 px-4">María López</td>
          <td class="py-3 px-4">20/09/2025</td>
        </tr>
        <tr class="border-b hover:bg-gray-50">
          <td class="py-3 px-4">2025239981</td>
          <td class="py-3 px-4">Luis Torres</td>
          <td class="py-3 px-4">01/10/2025</td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
</section>


<section x-show="section === 'configuracion'" class="mt-10 space-y-6" x-transition>
  <!-- Panel principal -->
  <div class="bg-white p-6 rounded-xl shadow-md">
    <h2 class="text-xl font-semibold text-gray-900">⚙ Configuración</h2>
    <p class="text-gray-600 mt-2">Preferencias del sistema y ajustes generales.</p>
  </div>

  <!-- Opciones administrativas -->
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <!-- Usuarios -->
    <div class="bg-white p-5 rounded-xl shadow-md hover:shadow-lg transition">
      <h3 class="text-lg font-semibold text-gray-800 mb-2">👥 Gestión de Usuarios</h3>
      <ul class="list-disc list-inside text-gray-600 text-sm space-y-1">
        <li>Crear, editar o eliminar usuarios</li>
        <li>Asignar roles y permisos (admin, editor, usuario, invitado)</li>
        <li>Bloquear / desbloquear cuentas</li>
        <li>Restablecer contraseñas</li>
      </ul>
    </div>

    <!-- Seguridad -->
    <div class="bg-white p-5 rounded-xl shadow-md hover:shadow-lg transition">
      <h3 class="text-lg font-semibold text-gray-800 mb-2">🔐 Seguridad y Actividad</h3>
      <ul class="list-disc list-inside text-gray-600 text-sm space-y-1">
        <li>Ver historial de inicio de sesión</li>
        <li>Monitorear actividad de usuarios</li>
        <li>Alertas de acceso sospechoso</li>
      </ul>
    </div>

    <!-- Marca -->
    <div class="bg-white p-5 rounded-xl shadow-md hover:shadow-lg transition">
      <h3 class="text-lg font-semibold text-gray-800 mb-2">🎨 Personalización</h3>
      <ul class="list-disc list-inside text-gray-600 text-sm space-y-1">
        <li>Nombre de la aplicación</li>
        <li>Logotipo y colores de marca</li>
        <li>Estilo visual del panel</li>
      </ul>
    </div>

    <!-- Sistema -->
    <div class="bg-white p-5 rounded-xl shadow-md hover:shadow-lg transition">
      <h3 class="text-lg font-semibold text-gray-800 mb-2">🔧 Sistema y Plugins</h3>
      <ul class="list-disc list-inside text-gray-600 text-sm space-y-1">
        <li>Actualizaciones del sistema</li>
        <li>Gestión de plugins o extensiones</li>
        <li>Compatibilidad y versiones</li>
      </ul>
    </div>

    <!-- Rendimiento -->
    <div class="bg-white p-5 rounded-xl shadow-md hover:shadow-lg transition">
      <h3 class="text-lg font-semibold text-gray-800 mb-2">🧹 Mantenimiento</h3>
      <ul class="list-disc list-inside text-gray-600 text-sm space-y-1">
        <li>Limpieza de caché</li>
        <li>Archivos temporales</li>
        <li>Optimización de base de datos</li>
      </ul>
    </div>

    <!-- Recursos -->
    <div class="bg-white p-5 rounded-xl shadow-md hover:shadow-lg transition">
      <h3 class="text-lg font-semibold text-gray-800 mb-2">📊 Estado del Servidor</h3>
      <ul class="list-disc list-inside text-gray-600 text-sm space-y-1">
        <li>Uso de CPU y memoria</li>
        <li>Espacio en disco</li>
        <li>Estado de servicios activos</li>
      </ul>
    </div>
  </div>
</section>

  <!-- Chart.js scripts -->
  <script>
    const chartColors = {
      green: '#22c55e',
      yellow: '#facc15',
      red: '#ef4444',
      blue: '#3b82f6',
      purple: '#8b5cf6',
      orange: '#f97316'
    };

    const barCtx = document.getElementById('barChart').getContext('2d');
    new Chart(barCtx, {
      type: 'bar',
      data: {
        labels: ['Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb', 'Dom'],
        datasets: [{
          label: 'Ventas ($)',
          data: [120, 190, 300, 250, 320, 400, 280],
          backgroundColor: chartColors.blue,
          borderRadius: 6
        }]
      },
      options: {
        responsive: true,
        plugins: { legend: { display: false } },
        scales: {
          x: { ticks: { color: '#111827' } },
          y: { ticks: { color: '#111827' }, grid: { color: '#E5E7EB' } }
        }
      }
    });

    const pieCtx = document.getElementById('pieChart').getContext('2d');
    new Chart(pieCtx, {
      type: 'doughnut',
      data: {
        labels: ['Hamburguesas', 'Pizzas', 'Tacos', 'Ensaladas', 'Postres'],
        datasets: [{
          label: 'Pedidos',
          data: [35, 50, 25, 15, 30],
          backgroundColor: [
            chartColors.blue,
            chartColors.green,
            chartColors.yellow,
            chartColors.red,
            chartColors.purple
          ],
          borderWidth: 2
        }]
      },
      options: {
        responsive: true,
        plugins: {
          legend: { position: 'bottom', labels: { color: '#111827' } }
        }
      }
    });
  </script>
</body>
</html>