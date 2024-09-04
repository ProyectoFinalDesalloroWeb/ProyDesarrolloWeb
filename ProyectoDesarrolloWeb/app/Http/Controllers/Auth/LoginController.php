<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/'; // Redirige a la página principal después del inicio de sesión

    /**
     * Muestra el formulario de inicio de sesión.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        // Si el usuario ya está autenticado, redirige a la página de productos
        if (Auth::check()) {
            return redirect()->route('productos.index');
        }

        // Si el usuario no está autenticado, muestra el formulario de inicio de sesión
        return view('auth.login');
    }
}
