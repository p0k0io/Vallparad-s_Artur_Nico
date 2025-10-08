<!DOCTYPE html>
<html>
<head>
    <title>Lista de Productos</title>
</head>
<body>
    <h1>Productos</h1>
    <table border="1" cellpadding="5">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Mail</th>
            <th>Phone</th>
        </tr>
        @foreach ($centers as $center)
            <tr>
                <td>{{ $center->id }}</td>
                <td>{{ $center->name}}</td>
                <td>{{ $center->location}}</td>
                <td>{{ $center->email}}</td>
                <td>{{ $center->phone}}</td>
            </tr>
        @endforeach
    </table>
</body>
</html>
