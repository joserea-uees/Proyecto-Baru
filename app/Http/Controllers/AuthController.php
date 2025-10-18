<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'codigo_estudiante' => 'required|string|max:50|unique:users,codigo_estudiante',
            'contrasena' => 'required|string|min:8',
        ]);

        User::create([
            'name' => $request->nombre,
            'codigo_estudiante' => $request->codigo_estudiante,
            'password' => Hash::make($request->contrasena),
        ]);

        return redirect()->route('login')->with('success', 'Registro exitoso. Por favor, inicia sesión.');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'codigo_estudiante' => 'required|string',
            'contrasena' => 'required|string',
        ]);

        if (Auth::attempt(['codigo_estudiante' => $request->codigo_estudiante, 'password' => $request->contrasena], $request->has('remember'))) {
            return redirect()->route('home');
        }

        return back()->withErrors(['codigo_estudiante' => 'Credenciales incorrectas']);
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}