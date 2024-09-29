<!DOCTYPE html>
<html>
<head>
    <title>Listado de Ventas</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; }
        th { background-color: #f2f2f2; }
        .btn { display: inline-block; padding: 10px 15px; color: white; background-color: #007bff; border: none; border-radius: 5px; text-decoration: none; }
        .btn:hover { background-color: #0056b3; }
    </style>
</head>
<body>

<h1>Listado de Ventas</h1>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Cliente</th>
            <th>Fecha de Venta</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($ventas as $venta)
            <tr>
                <td>{{ $venta->id }}</td>
                <td>{{ $venta->cliente->Empresa_Cliente}}</td>
                <td>{{ $venta->fecha_venta }}</td>
                <td>
                    <a class="btn" href="{{ route('pdf', $venta->id) }}">Descargar PDF</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
