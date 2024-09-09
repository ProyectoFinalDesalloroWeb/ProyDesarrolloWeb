@extends('layout/plantilla')

@section('tituloPagina', 'Inicio')

@section('contenido')
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/estilos.css') }}">
</head>
<body>
    <br>
    <header class="hero">
        <div class="container">
            <br><br><br>
            <h1>Bienvenido a Dulcería UMG</h1>
            <p>Información para nuestros valiosos empleados</p>
        </div>
    </header>
    <div class="container my-5">
        <section class="info-section">
            <h2>Nuestra Historia</h2>
            <p>
                Dulcería UMG se fundó en 1990 con el objetivo de llevar los auténticos sabores de Guatemala a todos nuestros clientes. A lo largo de los años, hemos mantenido una tradición de calidad y excelencia en la elaboración de nuestros dulces. Desde nuestra modesta tienda en la Ciudad de Guatemala hasta convertirnos en una empresa reconocida a nivel nacional, nuestra historia está llena de pasión y dedicación por los dulces que producimos.
            </p>
        </section>
        <section class="info-section">
            <h2>Ubicación</h2>
            <p>
                Nuestra sede principal está ubicada en el corazón de la Ciudad de Guatemala, en la Avenida Reforma. El lugar está diseñado para facilitar un ambiente de trabajo colaborativo y eficiente, con todas las instalaciones necesarias para la producción y distribución de nuestros productos. Te invitamos a visitar nuestras instalaciones y conocer de cerca el lugar donde creamos magia dulce.
            </p>
        </section>
        <section class="info-section">
            <h2>Valores de la Empresa</h2>
            <p>
                En Dulcería UMG, valoramos la calidad, la integridad y la innovación. Nos comprometemos a ofrecer productos excepcionales que superen las expectativas de nuestros clientes. Creemos en el trabajo en equipo y en el desarrollo profesional de nuestros empleados, fomentando un ambiente donde cada miembro del equipo pueda crecer y prosperar.
            </p>
        </section>
        <section class="section-background">
            <div class="container">
                <h2>Galería de Fotos</h2>
                <div class="row photo-gallery">
                    <!-- Foto de Empleados 1 -->
                    <div class="col-md-4">
                        <img src="{{ asset('imagenes/empleado1.jpg') }}" class="img-fluid" alt="Empleados 1">
                    </div>
                    <!-- Foto de Empleados 2 -->
                    <div class="col-md-4">
                        <img src="{{ asset('imagenes/empleado2.jpg') }}" class="img-fluid" alt="Empleados 2">
                    </div>
                    <!-- Foto de Empleados 3 -->
                    <div class="col-md-4">
                        <img src="{{ asset('imagenes/empleado3.jpg') }}" class="img-fluid" alt="Empleados 3">
                    </div>
                </div>
            </div>
        </section>
        <section class="info-section">
            <h2>Asambleas y Eventos</h2>
            <p>
                En Dulcería UMG, organizamos regularmente asambleas y eventos para mantener a todo el equipo informado y motivado. Estos eventos son una excelente oportunidad para compartir noticias importantes, celebrar logros y fomentar el espíritu de equipo. A continuación, algunas fotos de nuestros eventos recientes.
            </p>
            <div class="row photo-gallery">
                <!-- Foto de Asamblea 1 -->
                <div class="col-md-4">
                    <img src="{{ asset('imagenes/asamblea1.jpeg') }}" class="img-fluid" alt="Asamblea 1">
                </div>
                <!-- Foto de Asamblea 2 -->
                <div class="col-md-4">
                    <img src="{{ asset('imagenes/asamblea2.jpg') }}" class="img-fluid" alt="Asamblea 2">
                </div>
                <!-- Foto de Asamblea 3 -->
                <div class="col-md-4">
                    <img src="{{ asset('imagenes/asamblea3.jpg') }}" class="img-fluid" alt="Asamblea 3">
                </div>
            </div>
        </section>
        <section class="info-section">
            <h2>Contacto</h2>
            <p>
                Para cualquier consulta o necesidad relacionada con tu trabajo, por favor contacta a nuestro departamento de Recursos Humanos. Estamos aquí para ayudarte y asegurarnos de que tengas todo lo necesario para realizar tu trabajo de manera óptima.
            </p>
            <div class="contact-info">
                <p><strong>Correo Electrónico:</strong> <a href="mailto:contacto@dulceriayumg.com">contacto@dulceriayumg.com</a></p>
                <p><strong>Teléfono:</strong> +502 1234 5678</p>
            </div>
        </section>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
@endsection
