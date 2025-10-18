<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PedidoController;
Route::get('/', function () {
    return view('login');
});

Route::get('/login', function () { return view('login'); })->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::get('/register', function () { return view('register'); })->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout'); // Asegúrate de que esta línea esté presente

Route::get('/home', function () {
    $categorias = \App\Models\Categoria::with('productos')->get();
    return view('home', compact('categorias'));
})->name('home')->middleware('auth');
Route::post('/pedidos', [PedidoController::class, 'store'])->name('pedidos.store')->middleware('auth');
Route::get('/pedidos/{pedido}/ticket', [PedidoController::class, 'ticket'])->name('pedidos.ticket')->middleware('auth');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::put('/password/update', [App\Http\Controllers\Auth\PasswordController::class, 'update'])->middleware('auth')->name('password.update');
Route::get('/password/change', function () {
    return view('change-password');
})->middleware('auth')->name('password.change');