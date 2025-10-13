<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Profesionales</title>
</head>
<body>
    <h1>Profesionales</h1>

    <table border="1" cellpadding="5">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Primer Apellido</th>
                <th>Email</th>
                <th>Profesión</th>
                <th>Editar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($professionals as $professional)
                <tr>
                    <td>{{ $professional->id }}</td>
                    <td>{{ $professional->name }}</td>
                    <td>{{ $professional->surname1 }}</td>
                    <td>{{ $professional->email }}</td>
                    <td>{{ $professional->profession }}</td>
                    <td>
                        <a href="<?php echo route('professional.edit', $professional)?>">Editar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="<?php echo route('professional.create')?>">Introduir nou Professional</a>
    
</body>
</body>
</html>
