<head>
    <title>Factura de Venta</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 20px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .header {
            display: flex;
            align-items: center;
            margin-bottom: 30px;
            justify-content: space-between;
        }
        .header img {
            width: 150px;
            height: auto;
        }
        .header-content {
            text-align: center;
            flex-grow: 1;
            margin-left: 20px;
            position: relative;
            top: -20px; /* Ajuste para mover el contenido más arriba */
        }
        h1 {
            color: #2c3e50;
            margin-bottom: 5px; /* Reduce el margen debajo del título */
        }
        .header-content h2 {
            margin: 0;
            font-size: 24px;
            color: #2980b9;
        }
        .header-content p {
            margin: 5px 0;
            color: #7f8c8d;
        }
        .info {
            margin-bottom: 20px;
            border: 1px solid #2980b9;
            padding: 10px;
            border-radius: 5px;
        }
        .info p {
            margin: 5px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: center;
            vertical-align: middle;
        }
        th {
            background-color: #2980b9;
            color: #ffffff;
        }
        h3 {
            text-align: right;
            color: #2c3e50;
            margin-top: 20px;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 12px;
            color: #95a5a6;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ public_path('imagenes/Logosinfondo.jpg') }}" alt="Logo de Dulceria UMG">
        <div class="header-content">
            <h1>Factura de Venta</h1>
            <h2>Dulceria UMG</h2>
            <p>Morales, Izabal, Guatemala</p>
            <p>Teléfono: (502) 1235-4567</p>
            <p>Email: contactodulceriaumg@gmail.com</p>
        </div>
    </div>
    
    <div class="info">
        <p><strong>Cliente:</strong> {{ $venta->cliente->Empresa_Cliente ?? 'No disponible' }}</p>
        <p>
            <strong>Dirección:</strong> {{ $venta->cliente->Departamento }}, 
            {{ $venta->cliente->Municipio }}, 
            {{ $venta->cliente->Completar_Direccion }}
        </p>
        <p><strong>Fecha de Venta:</strong> {{ \Carbon\Carbon::parse($venta->fecha_venta)->format('d/m/Y') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($detalles as $detalle)
                <tr>
                    <td>{{ $detalle->producto->nombre }}</td>
                    <td>{{ $detalle->cantidad }}</td>
                    <td>Q{{ number_format($detalle->precio_unitario, 2) }}</td>
                    <td>Q{{ number_format($detalle->subtotal, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    <h3>Total: Q{{ number_format($detalles->sum('subtotal'), 2) }}</h3>
    
    <div class="footer">
        <p>Gracias por su compra!</p>
        <p>Este documento es generado automáticamente y no requiere firma.</p>
    </div>
</body>
</html>
