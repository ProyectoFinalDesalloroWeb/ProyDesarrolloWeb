@extends('layout.plantilla')

@section('tituloPagina', 'Inicio')

@section('contenido')
<header class="hero">
    <div class="container text-center">
        <h1 class="hero-title">Bienvenido a Dulcería UMG</h1>
        <p class="hero-subtitle">Donde la calidad se encuentra con la tradición</p>
        <a href="#informacion" class="btn btn-primary btn-lg mt-3">Descubre Más</a>
    </div>
</header>

<div class="container my-5">
    <section id="informacion" class="info-section">
        <h2>Nuestra Historia</h2>
        <p>
            Desde 1990, Dulcería UMG ha traído los auténticos sabores de Guatemala a todos nuestros clientes. Mantenemos una tradición de calidad y excelencia en cada uno de nuestros productos.
        </p>
    </section>

    <section class="info-section">
        <h2>Ubicación</h2>
        <p>
            Situada en la Avenida Reforma, nuestras instalaciones están diseñadas para un ambiente de trabajo colaborativo, garantizando la eficiencia en la producción y distribución.
        </p>
    </section>

    <section class="info-section">
        <h2>Valores de la Empresa</h2>
        <p>
            La calidad, integridad e innovación son los pilares que guían nuestra misión. Estamos comprometidos con el desarrollo de nuestros empleados en un ambiente positivo.
        </p>
    </section>

    <section class="section-background">
        <h2>Galería de Fotos</h2>
        <div class="row photo-gallery">
            <div class="col-md-4">
                <img src="{{ asset('imagenes/empleado1.jpg') }}" class="img-fluid rounded" alt="Empleado 1">
            </div>
            <div class="col-md-4">
                <img src="{{ asset('imagenes/empleado2.jpg') }}" class="img-fluid rounded" alt="Empleado 2">
            </div>
            <div class="col-md-4">
                <img src="{{ asset('imagenes/empleado3.jpg') }}" class="img-fluid rounded" alt="Empleado 3">
            </div>
        </div>
    </section>

    <section class="info-section">
        <h2>Asambleas y Eventos</h2>
        <p>
            Organizamos eventos regulares para mantener a nuestro equipo informado y motivado, donde celebramos logros y compartimos noticias importantes.
        </p>
        <div class="row photo-gallery">
            <div class="col-md-4">
                <img src="{{ asset('imagenes/asamblea1.jpeg') }}" class="img-fluid rounded" alt="Asamblea 1">
            </div>
            <div class="col-md-4">
                <img src="{{ asset('imagenes/asamblea2.jpg') }}" class="img-fluid rounded" alt="Asamblea 2">
            </div>
            <div class="col-md-4">
                <img src="{{ asset('imagenes/asamblea3.jpg') }}" class="img-fluid rounded" alt="Asamblea 3">
            </div>
        </div>
    </section>

    <section class="info-section">
        <h2>Contacto</h2>
        <p>
            Para consultas relacionadas con tu trabajo, contacta a Recursos Humanos. Estamos aquí para ayudarte.
        </p>
        <div class="contact-info">
            <p><strong>Correo Electrónico:</strong> <a href="mailto:contacto@dulceriaumg.com">contacto@dulceriaumg.com</a></p>
            <p><strong>Teléfono:</strong> +502 1234 5678</p>
        </div>
    </section>
</div>
@endsection


