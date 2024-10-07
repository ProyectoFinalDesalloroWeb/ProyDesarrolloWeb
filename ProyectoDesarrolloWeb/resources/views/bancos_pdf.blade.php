<!DOCTYPE html>
<html>
<head>
    <title>Movimientos Bancarios</title>
    <style>
        /* Añadir estilos para el PDF */
        body {
            font-family: Arial, sans-serif;
        }
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #333;
            padding: 10px 0;
        }
        .logo {
            width: 100px;
        }
        .company-info {
            text-align: right;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th {
            background-color: #f2f2f2;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        footer {
            text-align: center;
            margin-top: 30px;
            font-size: 0.9em;
            color: #666;
            border-top: 1px solid #333;
            padding-top: 10px;
        }
        .signature {
            margin-top: 30px;
            text-align: center;
        }
        .signature img {
            width: 150px;
        }
        .signature-name {
            margin-top: 10px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <header>
        <div>
            <img class="logo" src="{{ public_path('imagenes/LogosinFondo.png') }}" alt="Logo Empresa">
        </div>
        <div class="company-info">
            <h2>Dulceria UMG</h2>
            <p>Dirección: Ciudad de Guatemala, Avenida Reforma</p>
            <p>Teléfono: +502 1234 5678</p>
            <p>Email: contacto@dulceriaumg.com</p>
        </div>
    </header>

    <h1>Movimientos Bancarios</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Fecha</th>
                <th>Descripción</th>
                <th>Tipo</th>
                <th>Monto</th>
                <th>Saldo</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($movimientos as $movimiento)
                <tr>
                    <td>{{ $movimiento->id }}</td>
                    <td>{{ $movimiento->fecha }}</td>
                    <td>{{ $movimiento->descripcion }}</td>
                    <td>{{ $movimiento->tipo }}</td>
                    <td>Q{{ $movimiento->monto }}</td>
                    <td>Q{{ $movimiento->saldo }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <footer>
        <p>Este documento es generado automáticamente por el sistema de gestión bancaria. Para cualquier consulta, comuníquese con nosotros.</p>
    </footer>

    <div class="signature">
        <img src="{{ public_path('imagenes/firma.jpg') }}" alt="Firma">
        <div class="signature-name">Alexander Ortiz<br>Gerente Financiero</div>
    </div>
</body>
</html>
