<!DOCTYPE html>
<html>
<head>
    <title>Movimientos Bancarios</title>
    <style>
        /* Añadir estilos para el PDF */
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
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
                    <td>{{ $movimiento->monto }}</td>
                    <td>{{ $movimiento->saldo }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
