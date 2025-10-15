<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BARÚ Food Lounge - Menú</title>
    <link rel="stylesheet" href="{{ asset('assets/homestyle.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@700&family=Pacifico&display=swap" rel="stylesheet">
</head>
<body>
    <div class="dashboard-container">
        <!-- Header -->
        <header class="header">
            <div class="header-left">
                <i class="fas fa-utensils header-icon"></i>
                <h1 class="dashboard-title">BARÚ Food Lounge</h1>
            </div>
            <div class="header-right">
                <span class="user-greeting">Bienvenido, {{ auth()->user()->name }}</span>
            </div>
        </header>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Sidebar -->
            <aside class="sidebar">
                <div class="logo">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <nav class="nav-menu">
                    <a href="{{ route('home') }}" class="nav-item active"><i class="fas fa-home"></i> Inicio</a>
                    <a href="#" class="nav-item"><i class="fas fa-calendar-alt"></i> Calendario</a>
                    <a href="#" class="nav-item"><i class="fas fa-cog"></i> Configuración</a>
                </nav>
            </aside>

            <!-- Content Area -->
            <main class="content-area">
                <!-- Top Bar -->
                <div class="top-bar">
                    <div class="search-section">
                        <i class="fas fa-search"></i>
                        <input type="text" class="form-control" id="searchInput" placeholder="Buscar platos...">
                    </div>
                    <div class="top-right">
                        <div class="notification" id="cartToggle">
                            <i class="fas fa-shopping-cart"></i>
                            <span class="cart-badge" id="cartBadge" style="display: none;">0</span>
                        </div>
                        <div class="user-dropdown">
                            <span>{{ auth()->user()->codigo_estudiante }}</span>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                    </div>
                </div>

                <!-- Menu Categories -->
                <div class="menu-categories">
                    <button class="category-btn active" data-category="all">Todo el Menú <span class="count">{{ \App\Models\Producto::count() }} items</span></button>
                    @foreach ($categorias as $categoria)
                        <button class="category-btn" data-category="{{ $categoria->id }}">{{ $categoria->nombre }} <span class="count">{{ $categoria->productos->count() }} items</span></button>
                    @endforeach
                </div>

                <!-- Products Grid -->
                <div class="products-grid" id="productsGrid">
                    @foreach ($categorias as $categoria)
                        @foreach ($categoria->productos as $producto)
                            <div class="product-card" data-category="{{ $categoria->id }}">
                                <div class="card-front">
                                    <div class="product-image-container">
                                        <img src="{{ $producto->imagen ? asset('storage/' . $producto->imagen) : asset('img/placeholder.jpg') }}" alt="{{ $producto->nombre }}" class="product-image">
                                        <div class="image-overlay">
                                            <i class="fas fa-heart favorite-icon"></i>
                                        </div>
                                    </div>
                                    <div class="product-info">
                                        <div class="product-header">
                                            <h5 class="card-title">{{ $producto->nombre }}</h5>
                                            <span class="category-tag">{{ $categoria->nombre }}</span>
                                        </div>
                                        <div class="price-section">
                                            <span class="price">${{ number_format($producto->precio, 2) }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-back">
                                    <p>{{ $producto->descripcion ?? 'Sin descripción disponible' }}</p>
                                    <button class="add-btn btn" data-product='{"id":{{ $producto->id }},"name":"{{ $producto->nombre }}","price":{{ $producto->precio }},"image":"{{ $producto->imagen ? asset('storage/' . $producto->imagen) : asset('img/placeholder.jpg') }}"}'>
                                        <i class="fas fa-plus"></i> Agregar
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                </div>
            </main>

            <!-- Cart Panel -->
            <aside class="cart-panel" id="cartPanel">
                <div class="cart-header">
                    <h6><i class="fas fa-shopping-cart"></i> Mi Reserva</h6>
                    <button class="close-cart" id="closeCart"><i class="fas fa-times"></i></button>
                </div>
                <div class="cart-items" id="cartItems">
                    <div class="empty-cart-message">
                        <i class="fas fa-utensils fa-3x"></i>
                        <p>Tu carrito está vacío. ¡Agrega platos para reservar!</p>
                        <button class="back-to-menu-btn" onclick="closeCart()">Volver al Menú</button>
                    </div>
                </div>
                <div class="cart-totals" id="cartTotals" style="display: none;">
                    <div class="total-row">
                        <span>Subtotal</span>
                        <span id="subtotal">$0.00</span>
                    </div>
                    <div class="total-row total">
                        <span>Total Reserva</span>
                        <span id="total">$0.00</span>
                    </div>
                </div>
                <div class="reservation-section" id="reservationSection" style="display: none;">
                    <form action="{{ route('pedidos.store') }}" method="POST" id="confirmForm">
                        @csrf
                        <input type="hidden" name="fecha_reserva" value="{{ now()->addDay()->format('Y-m-d\TH:i') }}">
                        <input type="hidden" name="numero_personas" value="1">
                        <input type="hidden" name="comentarios" value="">
                        <input type="hidden" name="productos" id="cartProductsInput" value="">
                        <button type="submit" class="reserve-btn btn" id="reserveBtn">
                            <i class="fas fa-calendar-check"></i> Realizar Reserva
                        </button>
                    </form>
                    <p class="reserve-note">Confirma tu reserva para el almuerzo de mañana.</p>
                </div>
            </aside>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let cart = [];
        let subtotal = 0;

        // Flip card effect
        document.querySelectorAll('.product-card').forEach(card => {
            card.addEventListener('click', (e) => {
                if (!e.target.closest('.add-btn, .favorite-icon')) {
                    card.classList.toggle('flipped');
                }
            });
        });

        // Category filter
        document.querySelectorAll('.category-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                document.querySelectorAll('.category-btn').forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
                const category = btn.dataset.category;
                document.querySelectorAll('.product-card').forEach(card => {
                    if (category === 'all' || card.dataset.category === category) {
                        card.style.display = 'block';
                        card.style.animation = 'fadeIn 0.5s ease-in';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });

        // Search
        document.getElementById('searchInput').addEventListener('input', (e) => {
            const query = e.target.value.toLowerCase();
            document.querySelectorAll('.product-card').forEach(card => {
                const title = card.querySelector('.card-title').textContent.toLowerCase();
                card.style.display = title.includes(query) ? 'block' : 'none';
            });
        });

        // Add to cart
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
                btn.style.backgroundColor = '#3b4044';
                setTimeout(() => {
                    btn.style.backgroundColor = '#4a595a';
                }, 1500);
            });
        });

        // Update cart
        function updateCart() {
            const cartItems = document.getElementById('cartItems');
            const totals = document.getElementById('cartTotals');
            const reservation = document.getElementById('reservationSection');
            const badge = document.getElementById('cartBadge');

            if (cart.length === 0) {
                cartItems.innerHTML = `
                    <div class="empty-cart-message">
                        <i class="fas fa-utensils fa-3x"></i>
                        <p>Tu carrito está vacío. ¡Agrega platos para reservar!</p>
                        <button class="back-to-menu-btn" onclick="closeCart()">Volver al Menú</button>
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
                    <div class="cart-item">
                        <img src="${item.image}" alt="${item.name}" class="cart-item-image">
                        <div class="cart-item-info">
                            <h6>${item.name}</h6>
                            <span class="qty-price">${item.quantity}x $${item.price.toFixed(2)}</span>
                            <div class="quantity-controls">
                                <button class="qty-btn" onclick="updateQuantity(${index}, -1)">-</button>
                                <span>${item.quantity}</span>
                                <button class="qty-btn" onclick="updateQuantity(${index}, 1)">+</button>
                            </div>
                        </div>
                        <button class="remove-item" onclick="removeItem(${index})"><i class="fas fa-trash"></i></button>
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

        // Cart functions
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
            const panel = document.getElementById('cartPanel');
            panel.classList.add('active');
        }

        function closeCart() {
            const panel = document.getElementById('cartPanel');
            panel.classList.remove('active');
        }

        // Clear cart after successful submission
        document.getElementById('confirmForm').addEventListener('submit', function(e) {
            if (cart.length > 0) {
                cart = [];
                subtotal = 0;
                updateCart();
                closeCart();
            }
        });

        document.getElementById('cartToggle').addEventListener('click', showCart);
        document.getElementById('closeCart').addEventListener('click', closeCart);

        // Favorite toggle
        document.querySelectorAll('.favorite-icon').forEach(icon => {
            icon.addEventListener('click', (e) => {
                e.stopPropagation();
                icon.classList.toggle('active');
            });
        });
    </script>
</body>
</html>