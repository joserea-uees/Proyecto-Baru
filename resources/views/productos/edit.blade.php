<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Editar Producto</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-10 font-sans">
  <div class="max-w-xl mx-auto bg-white p-8 rounded-xl shadow-md">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">✏️ Editar producto</h1>

    <form action="{{ route('productos.update', $producto->id) }}" method="POST">
      @csrf
      @method('PUT')

      <div class="mb-4">
        <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
        <input type="text" name="nombre" id="nombre" value="{{ $producto->nombre }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
      </div>

      <div class="mb-4">
        <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>
        <textarea name="descripcion" id="descripcion" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>{{ $producto->descripcion }}</textarea>
      </div>

      <div class="mb-4">
        <label for="precio" class="block text-sm font-medium text-gray-700">Precio</label>
        <input type="number" step="0.01" name="precio" id="precio" value="{{ $producto->precio }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
      </div>

      <div class="flex justify-between mt-6">
        <a href="{{ route('admin.dashboard') }}" class="text-gray-600 hover:text-gray-800">← Cancelar</a>
        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Actualizar</button>
      </div>
    </form>
  </div>
</body>
</html>
