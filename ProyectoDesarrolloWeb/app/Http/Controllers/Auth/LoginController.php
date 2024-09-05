<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
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

    /**
     * Maneja una solicitud de inicio de sesión.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        // Valida los datos del formulario
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Autenticación pasada
            return redirect()->intended('home');
        }

        // Si la autenticación falla, redirige de nuevo con un mensaje de error
        return redirect()->back()->withErrors([
            'email' => 'El correo electrónico o la contraseña son incorrectos.'
        ]);
    }

    /**
     * Cierra la sesión del usuario.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
