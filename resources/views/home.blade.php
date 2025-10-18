<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BARÚ Food Lounge - Menú</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .cart-panel { transform: translateX(100%); transition: transform 0.3s ease-in-out; }
        .cart-panel.active { transform: translateX(0); }
        .product-card { transition: transform 0.2s; }
        .product-card:hover { transform: scale(1.02); }
        .category-btn.active { border-bottom: 2px solid #1a202c; }
        .reservation-modal { display: none; opacity: 0; transition: opacity 0.3s ease-in-out; }
        .reservation-modal.active { display: flex; opacity: 1; }
    </style>

    {{-- Si usas Laravel con Vite, descomenta esta línea --}}
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
</head>
<body class="bg-gray-100">

    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-16 bg-white shadow-md flex flex-col items-center py-4">
            <div class="mb-8">
                <i class="fas fa-utensils text-2xl text-gray-800"></i>
            </div>
            <nav class="flex flex-col space-y-4">
                <a href="{{ route('home') }}" class="text-gray-600 hover:text-gray-800"><i class="fas fa-home text-xl"></i></a>
                <a href="#" class="text-gray-600 hover:text-gray-800"><i class="fas fa-calendar-alt text-xl"></i></a>
                <a href="#" class="text-gray-600 hover:text-gray-800"><i class="fas fa-cog text-xl"></i></a>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Header -->
            <header class="bg-white shadow-sm p-4 flex justify-between items-center">
                <h1 class="text-xl font-semibold text-gray-800">BARÚ Food Lounge</h1>
                <div class="flex items-center space-x-4">
                    <span class="text-gray-600">Bienvenido, {{ auth()->user()->name }}</span>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="text-gray-600 hover:text-gray-800">
                            <i class="fas fa-sign-out-alt text-xl"></i>
                        </button>
                    </form>
                    <div class="relative cursor-pointer" id="cartToggle">
                        <i class="fas fa-shopping-cart text-gray-600"></i>
                        <span class="cart-badge absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full px-2 py-1" id="cartBadge" style="display: none;">0</span>
                    </div>
                </div>
            </header>

            <!-- Content -->
            <main class="flex-1 p-6 overflow-auto">
                <!-- Search and Categories -->
                <div class="mb-6">
                    <input type="text" id="searchInput" placeholder="Buscar platos..." class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-gray-300">
                    <div class="flex space-x-4 mt-4 overflow-x-auto">
                        <button class="category-btn active px-4 py-2 text-gray-800 font-medium" data-category="all">Todo el Menú ({{ \App\Models\Producto::count() }})</button>
                        @foreach ($categorias as $categoria)
                            <button class="category-btn px-4 py-2 text-gray-600 hover:text-gray-800" data-category="{{ $categoria->id }}">{{ $categoria->nombre }} ({{ $categoria->productos->count() }})</button>
                        @endforeach
                    </div>
                </div>

                <!-- Products Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6" id="productsGrid">
                    @foreach ($categorias as $categoria)
                        @foreach ($categoria->productos as $producto)
                            <div class="product-card bg-white rounded-lg shadow-md p-4" data-category="{{ $categoria->id }}">
                                <img src="{{ $producto->imagen ? asset($producto->imagen) : asset('img/placeholder.jpg') }}" alt="{{ $producto->nombre }}" class="w-full h-40 object-cover rounded-md">
                                <div class="mt-2">
                                    <h5 class="text-lg font-medium text-gray-800">{{ $producto->nombre }}</h5>
                                    <p class="text-sm text-gray-500">{{ $categoria->nombre }}</p>
                                    <p class="text-sm text-gray-600 mt-1">{{ $producto->descripcion ?? 'Sin descripción' }}</p>
                                    <div class="flex justify-between items-center mt-2">
                                        <span class="text-lg font-semibold text-gray-800">${{ number_format($producto->precio, 2) }}</span>
                                        <button class="add-btn text-white bg-gray-800 hover:bg-gray-700 px-3 py-1 rounded-md" data-product='{"id":{{ $producto->id }},"name":"{{ $producto->nombre }}","price":{{ $producto->precio }},"image":"{{ $producto->imagen ? asset($producto->imagen) : asset('imgplaceholder.jpg') }}"}'>
                                            <i class="fas fa-plus"></i> Agregar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                </div>
            </main>
        </div>

        <!-- Cart Panel -->
        <aside class="cart-panel fixed right-0 top-0 h-full w-80 bg-white shadow-lg p-6" id="cartPanel">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold text-gray-800">Mi Reserva</h2>
                <button id="closeCart" class="text-gray-600 hover:text-gray-800"><i class="fas fa-times"></i></button>
            </div>
            <div class="cart-items flex-1 overflow-auto" id="cartItems">
                <div class="empty-cart-message text-center text-gray-500">
                    <i class="fas fa-utensils fa-3x mb-2"></i>
                    <p>Tu carrito está vacío.</p>
                    <button class="back-to-menu-btn mt-2 text-gray-800 hover:underline" onclick="closeCart()">Volver al Menú</button>
                </div>
            </div>
            <div class="cart-totals mt-4" id="cartTotals" style="display: none;">
                <div class="flex justify-between mb-2">
                    <span>Subtotal</span>
                    <span id="subtotal">$0.00</span>
                </div>
                <div class="flex justify-between font-semibold">
                    <span>Total Reserva</span>
                    <span id="total">$0.00</span>
                </div>
            </div>
            <div class="reservation-section mt-4" id="reservationSection" style="display: none;">
                <form action="{{ route('pedidos.store') }}" method="POST" id="confirmForm">
                    @csrf
                    <input type="hidden" name="fecha_reserva" value="{{ now()->addDay()->format('Y-m-d\TH:i') }}">
                    <input type="hidden" name="numero_personas" value="1">
                    <input type="hidden" name="comentarios" value="">
                    <input type="hidden" name="productos" id="cartProductsInput" value="">
                    <input type="hidden" name="reservation_code" id="reservationCodeInput" value="">
                    <button type="submit" class="w-full bg-gray-800 text-white py-2 rounded-md hover:bg-gray-700" id="reserveBtn">
                        <i class="fas fa-calendar-check"></i> Realizar Reserva
                    </button>
                </form>
                <p class="text-sm text-gray-500 mt-2 text-center">Confirma tu reserva para el almuerzo de mañana.</p>
            </div>
        </aside>

        <!-- Reservation Confirmation Modal -->
        <div class="reservation-modal fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center" id="reservationModal">
            <div class="bg-white rounded-lg p-8 max-w-md w-full text-center">
                <i class="fas fa-check-circle text-5xl text-green-500 mb-4"></i>
                <h2 class="text-2xl font-semibold text-gray-800 mb-2">¡Reserva Confirmada!</h2>
                <p class="text-gray-600 mb-4">Tu reserva ha sido registrada exitosamente.</p>
                <p class="text-lg font-bold text-gray-800">Código de Reserva:</p>
                <p class="text-2xl font-mono text-gray-800 mb-6" id="reservationCode"></p>
                <button class="bg-gray-800 text-white px-6 py-2 rounded-md hover:bg-gray-700" onclick="closeModal()">Volver al Menú</button>
            </div>
        </div>
    </div>

    <script>
        console.log("Script de carrito cargado correctamente ✅");

        let cart = [];
        let subtotal = 0;

        function generateReservationCode() {
            return 'RES-' + Math.random().toString(36).substr(2, 8).toUpperCase();
        }

        // Filtrar por categoría
        document.querySelectorAll('.category-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                document.querySelectorAll('.category-btn').forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
                const category = btn.dataset.category;
                document.querySelectorAll('.product-card').forEach(card => {
                    card.style.display = (category === 'all' || card.dataset.category === category) ? 'block' : 'none';
                });
            });
        });

        // Buscar productos
        document.getElementById('searchInput').addEventListener('input', (e) => {
            const query = e.target.value.toLowerCase();
            document.querySelectorAll('.product-card').forEach(card => {
                const title = card.querySelector('h5').textContent.toLowerCase();
                card.style.display = title.includes(query) ? 'block' : 'none';
            });
        });

        // Agregar al carrito
        document.querySelectorAll('.add-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                const product = JSON.parse(btn.dataset.product);
                const existing = cart.find(item => item.id === product.id);
                if (existing) {
                    existing.quantity += 1;
                    subtotal += product.price;
                } else {
                    cart.push({ ...product, quantity: 1 });
                    subtotal += product.price;
                }
                updateCart();
                showCart();
                btn.innerHTML = '<i class="fas fa-check"></i> Agregado';
                setTimeout(() => {
                    btn.innerHTML = '<i class="fas fa-plus"></i> Agregar';
                }, 1500);
            });
        });

        // Actualizar carrito
        function updateCart() {
            const cartItems = document.getElementById('cartItems');
            const totals = document.getElementById('cartTotals');
            const reservation = document.getElementById('reservationSection');
            const badge = document.getElementById('cartBadge');

            if (cart.length === 0) {
                cartItems.innerHTML = `
                    <div class="empty-cart-message text-center text-gray-500">
                        <i class="fas fa-utensils fa-3x mb-2"></i>
                        <p>Tu carrito está vacío.</p>
                        <button class="back-to-menu-btn mt-2 text-gray-800 hover:underline" onclick="closeCart()">Volver al Menú</button>
                    </div>
                `;
                totals.style.display = 'none';
                reservation.style.display = 'none';
                badge.style.display = 'none';
                document.getElementById('cartProductsInput').value = '';
                return;
            }

            let itemsHtml = '';
            cart.forEach((item, index) => {
                itemsHtml += `
                    <div class="flex items-center justify-between mb-4">
                        <img src="${item.image}" alt="${item.name}" class="w-16 h-16 object-cover rounded-md">
                        <div class="flex-1 ml-4">
                            <h6 class="text-sm font-medium">${item.name}</h6>
                            <p class="text-xs text-gray-500">${item.quantity}x $${item.price.toFixed(2)}</p>
                            <div class="flex items-center mt-1">
                                <button class="text-gray-600" onclick="updateQuantity(${index}, -1)">-</button>
                                <span class="mx-2">${item.quantity}</span>
                                <button class="text-gray-600" onclick="updateQuantity(${index}, 1)">+</button>
                            </div>
                        </div>
                        <button class="text-red-500" onclick="removeItem(${index})"><i class="fas fa-trash"></i></button>
                    </div>
                `;
            });
            cartItems.innerHTML = itemsHtml;
            document.getElementById('subtotal').textContent = `$${subtotal.toFixed(2)}`;
            document.getElementById('total').textContent = `$${subtotal.toFixed(2)}`;
            totals.style.display = 'block';
            reservation.style.display = 'block';
            badge.textContent = cart.reduce((sum, item) => sum + item.quantity, 0);
            badge.style.display = 'inline';
            document.getElementById('cartProductsInput').value = JSON.stringify(cart.map(item => ({ id: item.id, cantidad: item.quantity })));
        }

        function updateQuantity(index, delta) {
            if (cart[index].quantity + delta > 0) {
                subtotal += delta * cart[index].price;
                cart[index].quantity += delta;
                updateCart();
            } else {
                removeItem(index);
            }
        }

        function removeItem(index) {
            subtotal -= cart[index].price * cart[index].quantity;
            cart.splice(index, 1);
            updateCart();
        }

        function showCart() {
            document.getElementById('cartPanel').classList.add('active');
        }

        function closeCart() {
            document.getElementById('cartPanel').classList.remove('active');
        }

        function showModal(reservationCode) {
            document.getElementById('reservationCode').textContent = reservationCode;
            document.getElementById('reservationModal').classList.add('active');
        }

        function closeModal() {
            document.getElementById('reservationModal').classList.remove('active');
            cart = [];
            subtotal = 0;
            updateCart();
            closeCart();
        }

        document.getElementById('cartToggle').addEventListener('click', showCart);
        document.getElementById('closeCart').addEventListener('click', closeCart);

        document.getElementById('confirmForm').addEventListener('submit', function(e) {
            e.preventDefault();
            if (cart.length > 0) {
                const reservationCode = generateReservationCode();
                document.getElementById('reservationCodeInput').value = reservationCode;
                showModal(reservationCode);
            }
        });
    </script>
</body>
</html>
