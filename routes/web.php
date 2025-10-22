<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});

Route::get('/login', function () { return view('login'); })->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::get('/register', function () { return view('register'); })->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/home', function () {
    $categorias = \App\Models\Categoria::with('productos')->get();
    return view('home', compact('categorias'));
})->name('home')->middleware('auth');

Route::get('/reservas', [PedidoController::class, 'index'])->name('reservas')->middleware('auth');

Route::patch('reservas', [App\Http\Controllers\PedidoController::class, 'cancel'])
    ->name('pedidos.cancel')
    ->middleware(['auth', 'throttle:10,1']);

Route::post('/pedidos', [PedidoController::class, 'store'])->name('pedidos.store')->middleware('auth');
Route::get('/pedidos/{id}/ticket', [PedidoController::class, 'ticket'])->name('pedidos.ticket')->middleware('auth');

Route::put('/password/update', [App\Http\Controllers\Auth\PasswordController::class, 'update'])->middleware('auth')->name('password.update');
Route::get('/password/change', function () {
    return view('change-password');
})->middleware('auth')->name('password.change');

Route::middleware(['auth'])->group(function () {
    Route::put('/user/update-name', [ProfileController::class, 'updateName'])->name('user.update.name');
    Route::delete('/user/delete', [ProfileController::class, 'deleteAccount'])->name('user.delete');
});

Route::get('/admin/dashboard', function () {
    return view('admin');
})->name('admin.dashboard')->middleware('auth');

Route::get('/admin/login', function () { return view('adminLogin'); })->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'adminLogin'])->name('admin.login.submit');