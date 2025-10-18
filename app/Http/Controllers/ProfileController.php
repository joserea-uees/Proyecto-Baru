<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    // Cambiar nombre del usuario
    public function updateName(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $user = Auth::user();
        $user->name = $request->name;
        $user->save();

        return back()->with('status', 'Nombre actualizado correctamente.');
    }

    // Eliminar cuenta del usuario
    public function deleteAccount(Request $request)
    {
        $user = Auth::user();

        if ($request->has('delete_account')) {
            $user->delete();
            Auth::logout();
            return redirect('/')->with('status', 'Tu cuenta ha sido eliminada.');
        }

        return back()->withErrors(['delete_account' => 'Debes confirmar la eliminación de tu cuenta.']);
    }
}
