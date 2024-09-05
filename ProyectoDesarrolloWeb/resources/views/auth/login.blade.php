<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inicio</title>
    <link rel="icon" href="{{ asset('imagenes/LogoUMGpestaña.png') }}" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/estilos.css') }}">
</head>
<body>
    <section class="h-100 gradient-form login-view">
        <div class="container py-4 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-10">
                    <div class="card rounded-3 text-black">
                        <div class="row g-0">
                            <div class="col-lg-6">
                                <div class="card-body p-md-1 mx-md-1">
                                    <div class="text-center">
                                        <img src="{{ asset('imagenes/logoUMG.png') }}" style="width: 350px;" alt="logo">
                                        <p class="eslogan"> Endulza Tu Vida con Sabor</p>
                                        <h4 class="titulo">Inicio de Sesión</h4>
                                    </div>

                                    @if ($errors->any())
                                        <div class="alert alert-danger alert-small" role="alert">
                                            {{ $errors->first() }}
                                        </div>
                                    @endif

                                    <form action="{{ route('login') }}" method="post">
                                        @csrf

                                        <div class="form-outline mb-3">
                                            <label class="form-label" for="email">Correo:</label>
                                            <input type="email" name="email" id="email" class="form-control" placeholder="Ingresar correo" required />
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="password">Contraseña:</label>
                                            <input type="password" name="password" id="password" class="form-control" required />
                                        </div>

                                        <div class="text-center pt-1 mb-4 pb-1">
                                            <div class="d-flex justify-content-center">
                                                <button class="btn btn-primary mb-3" type="submit">Ingresar</button>
                                            </div>
                                        </div>
                                        
                                        <div class="d-flex align-items-center justify-content-center pb-4">
                                            <p class="mb-0 me-2">No tienes cuenta?</p>
                                            <a href="{{ route('register') }}" class="btn btn-outline-danger">Crear cuenta</a>
                                        </div>
                                    </form>

                                </div>
                            </div>
                            <div class="col-lg-6 d-flex align-items-center background-gradient">
                            </div>                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

