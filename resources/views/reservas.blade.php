<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>BARÚ Food Lounge - Reservas</title>
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
        .reservation-card { 
            transition: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94); 
            position: relative;
            overflow: hidden;
        }
        .reservation-card:hover { 
            transform: translateY(-4px) scale(1.01); 
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
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
        .status-badge {
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 500;
        }
        .status-pendiente {
            background: #FEF3C7;
            color: #D97706;
        }
        .status-confirmado {
            background: #D1FAE5;
            color: #059669;
        }
        .status-cancelado {
            background: #FEE2E2;
            color: #DC2626;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-navy-900 via-navy-800 to-navy-700">
    <section class="hero-gradient h-56 flex items-center justify-center relative overflow-hidden">
        <div class="absolute inset-0 bg-black bg-opacity-20"></div>
        <div class="text-center text-white z-10">
            <h1 class="text-5xl md:text-6xl font-bold font-serif mb-2 animate-fade-in-up">BARÚ Food Lounge</h1>
            <p class="text-xl opacity-90">Tus reservas, organizadas y listas</p>
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
        <aside class="w-16 bg-white/90 backdrop-blur-md shadow-lg flex flex-col items-center pt-24 pb-6 z-10">
            <div class="mb-8"></div>
            <nav class="flex flex-col space-y-6">
                <a href="{{ route('home') }}" class="sidebar-icon text-navy-700 hover:text-navy-900"><i class="fas fa-home text-xl"></i></a>
                <a href="{{ route('reservas') }}" class="sidebar-icon text-navy-700 hover:text-navy-900 bg-navy-100"><i class="fas fa-calendar-check text-xl"></i></a>
                <a href="{{ route('password.change') }}" class="sidebar-icon text-navy-700 hover:text-navy-900"><i class="fas fa-cog text-xl"></i></a>
            </nav>
        </aside>

        <div class="flex-1 flex flex-col bg-white/80 backdrop-blur-sm">
            <header class="bg-transparent p-4 flex justify-between items-center sticky top-0 z-20">
                <div class="flex items-center space-x-3">
                    <i class="fas fa-calendar-check text-2xl text-white sidebar-icon"></i>
                    <h1 class="text-xl font-semibold text-white font-serif">Mis Reservas</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-white text-white/90 font-medium hidden md:block">¡Hola, {{ auth()->user()->name }}!</span>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-white/80 hover:text-white transition-colors">
                            <i class="fas fa-sign-out-alt text-white"></i>
                        </button>
                    </form>
                </div>
            </header>

            <main class="flex-1 p-6 overflow-auto fade-in">
                <div class="mb-6">
                    <div class="relative mb-4">
                        <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-navy-400"></i>
                        <input type="text" id="searchInput" placeholder="Busca por código de reserva..." class="search-input w-full pl-10 p-3 rounded-lg focus:outline-none">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="reservationsGrid">
                    @forelse ($reservas as $reserva)
                        <div class="reservation-card bg-white rounded-lg shadow-sm overflow-hidden" data-reservation-code="{{ $reserva->reservation_code }}">
                            <div class="p-4">
                                <div class="flex justify-between items-center mb-2">
                                    <h5 class="text-lg font-medium text-navy-900">Reserva #{{ $reserva->reservation_code }}</h5>
                                    <span class="status-badge status-{{ $reserva->estado }}">{{ ucfirst($reserva->estado) }}</span>
                                </div>
                                <p class="text-sm text-navy-500 mb-2">Fecha de entrega: {{ \Carbon\Carbon::parse($reserva->fecha_reserva)->format('d/m/Y') }}</p>
                                <div class="flex justify-between items-center">
                                    <span class="text-xl font-semibold text-navy-900">Total: ${{ number_format($reserva->total, 2) }}</span>
                                    <div class="flex space-x-2">
                                        @if($reserva->estado === 'pendiente')
                                            <form action="{{ route('pedidos.cancel') }}" method="POST" class="inline cancel-form" data-reservation-code="{{ $reserva->reservation_code }}">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="reservation_code" value="{{ $reserva->reservation_code }}">
                                                <button type="submit" class="text-red-500 hover:text-red-700 p-1 rounded hover:bg-red-50 transition-colors">
                                                    <i class="fas fa-trash text-sm"></i> Cancelar
                                                </button>
                                            </form>
                                        @endif
                                        <a href="{{ route('pedidos.ticket', $reserva->id) }}" class="text-blue-500 hover:text-blue-700 p-1 rounded hover:bg-blue-50">
                                            <i class="fas fa-ticket-alt text-sm"></i> Ver Detalles
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center text-navy-500 py-12">
                            <i class="fas fa-calendar-times fa-3x mb-4 text-navy-200"></i>
                            <p class="text-base mb-2">No tienes reservas registradas</p>
                            <a href="{{ route('home') }}" class="inline-flex items-center px-4 py-2 text-navy-600 hover:text-navy-800 font-medium">
                                <i class="fas fa-arrow-left mr-2"></i>Volver al Menú
                            </a>
                        </div>
                    @endforelse
                </div>
            </main>
        </div>
    </div>

    <!-- Modal de confirmación -->
    <div id="confirmationModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-lg p-6 max-w-sm w-full">
            <h3 class="text-lg font-semibold text-navy-900 mb-4">Confirmar Cancelación</h3>
            <p class="text-navy-500 mb-6">¿Estás seguro de que deseas cancelar la reserva #<span id="modalReservationCode"></span>?</p>
            <div class="flex justify-end space-x-3">
                <button id="cancelModalCancel" class="px-4 py-2 text-navy-600 hover:bg-navy-50 rounded">No</button>
                <button id="confirmModalConfirm" class="px-4 py-2 bg-red-500 text-white hover:bg-red-600 rounded">Sí, Cancelar</button>
            </div>
        </div>
    </div>

    <script>
        console.log("Script de reservas cargado ✅");

        function showConfirmation(reservationCode, callback) {
            const modal = document.getElementById('confirmationModal');
            const modalCode = document.getElementById('modalReservationCode');
            const cancelBtn = document.getElementById('cancelModalCancel');
            const confirmBtn = document.getElementById('confirmModalConfirm');

            modalCode.textContent = reservationCode;
            modal.classList.remove('hidden');

            const closeModal = () => modal.classList.add('hidden');

            cancelBtn.addEventListener('click', () => {
                closeModal();
                callback(false);
            }, { once: true });

            confirmBtn.addEventListener('click', () => {
                closeModal();
                callback(true);
            }, { once: true });
        }

        document.querySelectorAll('.cancel-form').forEach(form => {
            form.addEventListener('submit', function (e) {
                e.preventDefault();
                const reservationCode = this.dataset.reservationCode;

                showConfirmation(reservationCode, (confirmed) => {
                    if (!confirmed) return;

                    const formData = new FormData(this);
                    console.log('FormData:', Object.fromEntries(formData));

                    fetch(this.action, {
                        method: 'PATCH',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json'
                        },
                        body: formData
                    })
                    .then(response => {
                        if (!response.ok) {
                            return response.json().then(data => {
                                throw { status: response.status, data };
                            });
                        }
                        return response.json();
                    })