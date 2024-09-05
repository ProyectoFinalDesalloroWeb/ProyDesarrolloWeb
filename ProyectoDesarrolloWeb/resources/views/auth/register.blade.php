<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registro</title>
    <link rel="icon" href="{{ asset('imagenes/LogoUMGpestaña.png') }}" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/estilos.css') }}">
</head>

<body>
        <div class="container py-3 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-10">
                    <div class="card registro-card text-black">
                        <div class="row g-0">
                            <div class="col-lg-6">
                                <div class="card-body registro-card-body">
                                    <div class="text-center">
                                        <img src="{{ asset('imagenes/logoUMG.png') }}" class="registro-logo" alt="logo">
                                        <p class="registro-eslogan"> Endulza Tu Vida con Sabor</p>
                                        <h4 class="registro-titulo">Registrarse</h4>
                                    </div>

                                    <form action="{{ route('register') }}" method="post">
                                        @csrf
                                        <div class="form-outline registro-input">
                                            <label class="form-label" for="form2Example11">Nombre</label>
                                            <input type="text" name="name" id="form2Example11" class="form-control"
                                                placeholder="Ingresar nombre" value="{{ old('name') }}" required />
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-outline registro-input">
                                            <label class="form-label" for="form2Example12">Correo</label>
                                            <input type="email" name="email" id="form2Example12" class="form-control"
                                                placeholder="Ingresar correo" value="{{ old('email') }}" required />
                                            @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-outline registro-input">
                                            <label class="form-label" for="form2Example22">Contraseña</label>
                                            <input type="password" name="password" id="form2Example22"
                                                class="form-control" required />
                                            @error('password')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-outline registro-input">
                                            <label class="form-label" for="form2Example23">Confirmar Contraseña</label>
                                            <input type="password" name="password_confirmation" id="form2Example23"
                                                class="form-control" required />
                                        </div>

                                        <div class="text-center pt-1 mb-2 pb-1">
                                            <button class="btn btn-primary btn-block mb-2" type="submit">Registrarse</button>
                                        </div>

                                        <div class="d-flex align-items-center justify-content-center pb-4">
                                            <p class="mb-0 me-2">Ya tienes cuenta?</p>
                                            <a href="{{ route('login') }}" class="btn btn-outline-danger">Login</a>
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
