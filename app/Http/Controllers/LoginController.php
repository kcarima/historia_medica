<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // ...

    /**
     * Método que se ejecuta después de autenticarse correctamente.
     */
    protected function authenticated(Request $request, $user)
    {
        if ($user->hasRole('administrador')) {
            // Redirigir a la ruta 'login' para que vea la vista completa con contenido administrador
            return redirect()->route('login');
        }

        // Redirigir a la ruta por defecto para otros usuarios
        return redirect()->intended('/home');
    }
}
