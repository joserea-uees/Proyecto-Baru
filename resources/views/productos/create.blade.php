<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Crear Producto</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-10 font-sans">
  <div class="max-w-xl mx-auto bg-white p-8 rounded-xl shadow-md">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">➕ Añadir nuevo producto</h1>

    <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <div class="mb-4">
        <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
        <input type="text" name="nombre" id="nombre" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
      </div>

      <div class="mb-4">
        <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>
        <textarea name="descripcion" id="descripcion" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required></textarea>
      </div>

      <div class="mb-4">
        <label for="precio" class="block text-sm font-medium text-gray-700">Precio</label>
        <input type="number" step="0.01" name="precio" id="precio" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
      </div>

      <div class="mb-4">
        <label for="categoria_id" class="block text-sm font-medium text-gray-700">Categoría</label>
        <select name="categoria_id" id="categoria_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
          <option value="" disabled selected>Selecciona una categoría</option>
          @foreach($categorias as $categoria)
            <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
          @endforeach
        </select>
      </div>

      <div class="mb-4">
        <label for="imagen" class="block text-sm font-medium text-gray-700">Imagen del producto</label>
        <input type="file" name="imagen" id="imagen" accept="image/*" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
      </div>

      <div class="flex justify-between mt-6">
        <a href="{{ route('admin.dashboard') }}" class="text-gray-600 hover:text-gray-800">← Cancelar</a>
        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Guardar</button>
      </div>
    </form>
  </div>
</body>
</html>
