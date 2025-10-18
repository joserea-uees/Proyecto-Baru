<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BARÚ Food Lounge - Menú</title>
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
        .hero-gradient {
            background: linear-gradient(rgba(0,31,63,0.6), rgba(0,51,102,0.6)), url('https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80');
            background-size: cover;
            background-position: center;
        }
        .cart-panel { 
            transform: translateX(100%); 
            transition: transform 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94); 
        }
        .cart-panel.active { 
            transform: translateX(0); 
        }
        .product-card { 
            transition: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94); 
            position: relative;
            overflow: hidden;
        }
        .product-card:hover { 
            transform: translateY(-4px) scale(1.01); 
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        .product-card img {
            transition: transform 0.3s ease;
        }
        .product-card:hover img {
            transform: scale(1.05);
        }
        .category-btn {
            transition: all 0.2s ease;
            border-radius: 8px;
            padding: 8px 16px;
            background: white;
            border: 1px solid #E5E7EB;
            font-weight: 500;
        }
        .category-btn.active { 
            background: #001F3F;
            color: white;
            border-color: #001F3F;
            box-shadow: 0 2px 10px rgba(0,31,63,0.2);
        }
        .category-btn:hover:not(.active) {
            background: #F9FAFB;
            transform: translateY(-1px);
        }
        .reservation-modal { 
            display: none; 
            opacity: 0; 
            transition: all 0.3s ease-in-out; 
        }
        .reservation-modal.active { 
            display: flex; 
            opacity: 1; 
        }
        .add-btn {
            position: absolute;
            bottom: 8px;
            right: 8px;
            background: #001F3F;
            border: none;
            border-radius: 6px;
            padding: 6px 12px;
            color: white;
            font-size: 12px;
            font-weight: 500;
            transition: all 0.3s ease;
            opacity: 0;
            transform: scale(0.8);
        }
        .product-card:hover .add-btn {
            opacity: 1;
            transform: scale(1);
        }
        .add-btn:hover {
            transform: scale(1.02);
            box-shadow: 0 2px 8px rgba(0,31,63,0.3);
            background: #003366;
        }
        .search-input {
            background: rgba(255,255,255,0.95);
            border: 1px solid #D1D5DB;
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }
        .search-input:focus {
            border-color: #001F3F;
            box-shadow: 0 0 0 3px rgba(0,31,63,0.1);
            background: white;
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
            background: rgba(255,255,255,0.1);
            backdrop-filter: blur(10px);
        }
        .sidebar-icon:hover {
            background: rgba(255,255,255,0.2);
            transform: scale(1.05);
        }
        .badge-pulse {
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }
        .quantity-btn {
            width: 28px;
            height: 28px;
            border-radius: 4px;
            background: #001F3F;
            color: white;
            border: none;
            transition: all 0.2s ease;
            font-weight: bold;
        }
        .quantity-btn:hover {
            transform: scale(1.05);
            background: #003366;
        }
        /* Estilo adicional para asegurar visibilidad de la sección de reserva */
        .reservation-section {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-top: 1px solid #E5E7EB;
            transition: all 0.3s ease;
        }
        .reservation-section button {
            background: #001F3F !important;
            color: white !important;
            border: none;
            padding: 0.75rem;
            border-radius: 0.5rem;
            font-weight: 500;
            width: 100%;
            box-shadow: 0 4px 12px rgba(0, 31, 63, 0.15);
            transition: none !important;
        }
    </style>

    {{-- Si usas Laravel con Vite, descomenta esta línea --}}
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
</head>
<body class="bg-gradient-to-br from-navy-900 via-navy-800 to-navy-700">

    <!-- Hero Section for Engagement -->
    <section class="hero-gradient h-56 flex items-center justify-center relative overflow-hidden">
        <div class="absolute inset-0 bg-black bg-opacity-20"></div>
        <div class="text-center text-white z-10">
            <h1 class="text-5xl md:text-6xl font-bold font-serif mb-2 animate-fade-in-up">BARÚ Food Lounge</h1>
            <p class="text-xl opacity-90">Descubre sabores inolvidables en un ambiente vibrante</p>
        </div>
        <style>
            @keyframes fade-in-up {
                from { opacity: 0; transform: translateY(30px); }
                to { opacity: 1; transform: translateY(0); }
            }
            .animate-fade-in-up { animation: fade-in-up 1s ease-out; }
        </style>
    </section>

    <div class="flex h-screen -mt-32 relative">
        <!-- Sidebar -->
        <aside class="w-16 bg-white/90 backdrop-blur-md shadow-lg flex flex-col items-center pt-24 pb-6 z-10">
            <div class="mb-8">
                <i class="fas fa-utensils text-2xl text-navy-900 sidebar-icon"></i>
            </div>
            <nav class="flex flex-col space-y-6">
                <a href="{{ route('home') }}" class="sidebar-icon text-navy-700 hover:text-navy-900"><i class="fas fa-home text-xl"></i></a>
                <a href="#" class="sidebar-icon text-navy-700 hover:text-navy-900"><i class="fas fa-calendar-alt text-xl"></i></a>
                <a href="#" class="sidebar-icon text-navy-700 hover:text-navy-900"><i class="fas fa-cog text-xl"></i></a>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col bg-white/80 backdrop-blur-sm">
            <!-- Header -->
            <header class="bg-transparent p-4 flex justify-between items-center sticky top-0 z-20">
                <div class="flex items-center space-x-3">
                    <i class="fas fa-drumstick-bite text-xl text-white"></i>
                    <h1 class="text-xl font-semibold text-white font-serif">Menú del Día</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-white/90 font-medium hidden md:block">¡Hola, {{ auth()->user()->name }}!</span>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-white/80 hover:text-white transition-colors">
                            <i class="fas fa-sign-out-alt text-lg"></i>
                        </button>
                    </form>
                    <div class="relative cursor-pointer" id="cartToggle">
                        <i class="fas fa-shopping-cart text-lg text-white/80"></i>
                        <span class="cart-badge absolute -top-1 -right-1 bg-navy-600 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center badge-pulse" id="cartBadge" style="display: none;">0</span>
                    </div>
                </div>
            </header>

            <!-- Content -->
            <main class="flex-1 p-6 overflow-auto fade-in">
                <!-- Search and Categories -->
                <div class="mb-6">
                    <div class="relative mb-4">
                        <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-navy-400"></i>
                        <input type="text" id="searchInput" placeholder="Busca tu plato favorito..." class="search-input w-full pl-10 p-3 rounded-lg focus:outline-none">
                    </div>
                    <div class="flex space-x-3 mt-4 overflow-x-auto pb-2">
                        <button class="category-btn active" data-category="all"><i class="fas fa-list mr-2"></i>Todo ({{ \App\Models\Producto::count() }})</button>
                        @foreach ($categorias as $categoria)
                            <button class="category-btn" data-category="{{ $categoria->id }}"><i class="fas fa-{{ $categoria->icono ?? 'tag' }} mr-2"></i>{{ $categoria->nombre }} ({{ $categoria->productos->count() }})</button>
                        @endforeach
                    </div>
                </div>

                <!-- Products Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6" id="productsGrid">
                    @foreach ($categorias as $categoria)
                        @foreach ($categoria->productos as $producto)
                            <div class="product-card bg-white rounded-lg shadow-sm overflow-hidden" data-category="{{ $categoria->id }}">
                                <div class="relative">
                                    <img src="{{ $producto->imagen ? asset($producto->imagen) : asset('img/placeholder.jpg') }}" alt="{{ $producto->nombre }}" class="w-full h-40 object-cover">
                                    @if($producto->especial)
                                        <div class="absolute top-2 right-2 bg-navy-600 text-white px-2 py-1 rounded-md text-xs font-medium">Especial</div>
                                    @endif
                                    <button class="add-btn" data-product='{"id":{{ $producto->id }},"name":"{{ $producto->nombre }}","price":{{ $producto->precio }},"image":"{{ $producto->imagen ? asset($producto->imagen) : asset('img/placeholder.jpg') }}"}'>
                                        <i class="fas fa-plus"></i> Agregar
                                    </button>
                                </div>
                                <div class="p-4">
                                    <h5 class="text-lg font-medium text-navy-900 mb-1">{{ $producto->nombre }}</h5>
                                    <p class="text-sm text-navy-500 mb-2">{{ $categoria->nombre }}</p>
                                    <p class="text-sm text-navy-600 line-clamp-2">{{ $producto->descripcion ?? 'Un plato exquisito que deleitará tu paladar.' }}</p>
                                    <div class="flex justify-between items-center mt-3">
                                        <span class="text-xl font-semibold text-navy-900">${{ number_format($producto->precio, 2) }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                </div>
            </main>
        </div>

        <!-- Cart Panel -->
        <aside class="cart-panel fixed right-0 top-0 h-full w-80 bg-white shadow-xl z-50" id="cartPanel">
            <div class="flex justify-between items-center p-4 border-b border-navy-100">
                <h2 class="text-xl font-semibold text-navy-900">Mi Reserva</h2>
                <button id="closeCart" class="text-navy-400 hover:text-navy-600"><i class="fas fa-times text-xl"></i></button>
            </div>
            <div class="cart-items flex-1 overflow-auto p-4" id="cartItems">
                <div class="empty-cart-message text-center text-navy-500 py-12">
                    <i class="fas fa-utensils fa-3x mb-4 text-navy-200"></i>
                    <p class="text-base mb-2">Tu carrito está vacío</p>
                    <button class="inline-flex items-center px-4 py-2 text-navy-600 hover:text-navy-800 font-medium" onclick="closeCart()">
                        <i class="fas fa-arrow-left mr-2"></i>Volver al Menú
                    </button>
                </div>
            </div>
            <div class="cart-totals p-4 border-t border-navy-100" id="cartTotals" style="display: none;">
                <div class="flex justify-between mb-2 text-navy-700">
                    <span>Subtotal</span>
                    <span id="subtotal" class="font-medium">$0.00</span>
                </div>
                <div class="flex justify-between text-lg font-semibold text-navy-900 mb-4">
                    <span>Total Reserva</span>
                    <span id="total">$0.00</span>
                </div>
            </div>
            <div class="reservation-section p-4 border-t border-navy-100" id="reservationSection" style="display: none;">
                <form action="{{ route('pedidos.store') }}" method="POST" id="confirmForm">
                    @csrf
                    <input type="hidden" name="fecha_reserva" value="{{ now()->addDay()->format('Y-m-d\TH:i') }}">
                    <input type="hidden" name="numero_personas" value="1">
                    <input type="hidden" name="comentarios" value="">
                    <input type="hidden" name="productos" id="cartProductsInput" value="">
                    <input type="hidden" name="reservation_code" id="reservationCodeInput" value="">
                    <button type="submit" class="w-full bg-navy-900 text-white py-3 rounded-lg hover:bg-navy-800 transition-colors font-medium" id="reserveBtn">
                        <i class="fas fa-calendar-check mr-2"></i> Realizar Reserva
                    </button>
                </form>
                <p class="text-sm text-navy-500 mt-2 text-center">Confirma tu reserva para el almuerzo de mañana.</p>
            </div>
        </aside>

        <!-- Reservation Confirmation Modal -->
        <div class="reservation-modal fixed inset-0 bg-navy-900 bg-opacity-50 flex items-center justify-center z-50" id="reservationModal">
            <div class="bg-white rounded-xl p-6 max-w-sm w-full text-center">
                <i class="fas fa-check-circle text-4xl text-green-600 mb-3"></i>
                <h2 class="text-2xl font-semibold text-navy-900 mb-2">¡Reserva Confirmada!</h2>
                <p class="text-navy-600 mb-4">Tu reserva ha sido registrada exitosamente.</p>
                <p class="text-lg font-medium text-navy-700 mb-3">Código de Reserva:</p>
                <p class="text-xl font-mono text-navy-900 font-semibold mb-4 bg-navy-50 p-2 rounded-lg" id="reservationCode"></p>
                <button class="bg-navy-900 text-white px-6 py-2 rounded-lg hover:bg-navy-800 transition-colors font-medium" onclick="closeModal()">
                    Volver al Menú
                </button>
            </div>
        </div>
    </div>

    <script>
        console.log("Script mejorado cargado ✅");

        let cart = [];
        let subtotal = 0;

        function generateReservationCode() {
            return 'RES-' + Math.random().toString(36).substr(2, 8).toUpperCase();
        }

        // Filtrar por categoría con animación
        document.querySelectorAll('.category-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                document.querySelectorAll('.category-btn').forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
                const category = btn.dataset.category;
                document.querySelectorAll('.product-card').forEach((card, index) => {
                    const shouldShow = (category === 'all' || card.dataset.category === category);
                    card.style.opacity = '0';
                    card.style.transform = 'translateY(10px)';
                    setTimeout(() => {
                        card.style.display = shouldShow ? 'block' : 'none';
                        if (shouldShow) {
                            card.style.opacity = '1';
                            card.style.transform = 'translateY(0)';
                        }
                    }, index * 50);
                });
            });
        });

        // Buscar con debounce para mejor UX
        let searchTimeout;
        document.getElementById('searchInput').addEventListener('input', (e) => {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                const query = e.target.value.toLowerCase();
                document.querySelectorAll('.product-card').forEach(card => {
                    const title = card.querySelector('h5').textContent.toLowerCase();
                    const shouldShow = title.includes(query);
                    card.style.opacity = '0';
                    setTimeout(() => {
                        card.style.display = shouldShow ? 'block' : 'none';
                        if (shouldShow) {
                            card.style.opacity = '1';
                        }
                    }, 200);
                });
            }, 300);
        });

        // Agregar al carrito con feedback
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
                btn.style.background = '#10B981';
                setTimeout(() => {
                    btn.innerHTML = '<i class="fas fa-plus"></i> Agregar';
                    btn.style.background = '#001F3F';
                }, 1500);
            });
        });

        // Actualizar carrito con transiciones
        function updateCart() {
            const cartItems = document.getElementById('cartItems');
            const totals = document.getElementById('cartTotals');
            const reservation = document.getElementById('reservationSection');
            const badge = document.getElementById('cartBadge');

            if (cart.length === 0) {
                cartItems.innerHTML = `
                    <div class="empty-cart-message text-center text-navy-500 py-12">
                        <i class="fas fa-utensils fa-3x mb-4 text-navy-200"></i>
                        <p class="text-base mb-2">Tu carrito está vacío</p>
                        <button class="inline-flex items-center px-4 py-2 text-navy-600 hover:text-navy-800 font-medium" onclick="closeCart()">
                            <i class="fas fa-arrow-left mr-2"></i>Volver al Menú
                        </button>
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
                    <div class="flex items-center justify-between mb-4 p-3 bg-navy-50 rounded-lg">
                        <img src="${item.image}" alt="${item.name}" class="w-16 h-16 object-cover rounded-md">
                        <div class="flex-1 ml-3">
                            <h6 class="text-sm font-medium text-navy-900">${item.name}</h6>
                            <p class="text-xs text-navy-500">${item.quantity}x $${item.price.toFixed(2)}</p>
                            <div class="flex items-center mt-1">
                                <button class="quantity-btn mr-1" onclick="updateQuantity(${index}, -1)">-</button>
                                <span class="mx-2 text-sm font-medium">${item.quantity}</span>
                                <button class="quantity-btn ml-1" onclick="updateQuantity(${index}, 1)">+</button>
                            </div>
                        </div>
                        <button class="text-red-500 hover:text-red-700 p-1 rounded hover:bg-red-50" onclick="removeItem(${index})">
                            <i class="fas fa-trash text-sm"></i>
                        </button>
                    </div>
                `;
            });
            cartItems.innerHTML = itemsHtml;
            document.getElementById('subtotal').textContent = `$${subtotal.toFixed(2)}`;
            document.getElementById('total').textContent = `$${subtotal.toFixed(2)}`;
            totals.style.display = 'block';
            reservation.style.display = 'block';
            const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
            badge.textContent = totalItems;
            badge.style.display = 'flex';
            if (totalItems > 0) {
                badge.classList.add('badge-pulse');
            }
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
            const item = cart[index];
            subtotal -= item.price * item.quantity;
            cart.splice(index, 1);
            updateCart();
        }

        function showCart() {
            document.getElementById('cartPanel').classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeCart() {
            document.getElementById('cartPanel').classList.remove('active');
            document.body.style.overflow = 'auto';
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

        // Close modal on outside click
        document.getElementById('reservationModal').addEventListener('click', (e) => {
            if (e.target.id === 'reservationModal') closeModal();
        });

        // Close cart on escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                closeCart();
                closeModal();
            }
        });
    </script>
</body>
</html>