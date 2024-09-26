<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/estilos.css') }}">
    <link rel="icon" href="{{ asset('imagenes/LogoUMGpestaña.png') }}" type="image/png">
    <title>@yield('tituloPagina')</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="navbar-brand ms-3">
            <img src="{{ asset('imagenes/LogosinFondo.png') }}" alt="Dulcería" style="height: 40px;">
        </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <!-- Opción de Inicio -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">Inicio</a>
                </li>
                <!-- Opción de Materia Prima -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('productos.index') }}">Materia Prima</a>
                </li>
                <li>
                    <a class="nav-link" href="{{ route('productot') }}">Producto terminado</a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto">
                @guest
                    <li class="nav-item me-3">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item me-3">
                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                    </li>
                    <li>
                        <a class="nav-link" href="{{ route('ventacliente') }}">Realizar Ventas</a>
                    </li>
                @else
                    <li class="nav-item me-3">
                        <span class="nav-link">{{ Auth::user()->name }}</span>
                    </li>
                    <li class="nav-item me-3">
                        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar Sesión</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                @endguest
            </ul>
        </div>
    </nav>

    <div class="container">
        @yield('contenido')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
