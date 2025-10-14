<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Profesionales</title>
</head>
<body>
    <h1>Profesionales</h1>
    @vite('resources/css/app.css')
    <table border="1" cellpadding="5">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Primer Cognom</th>
                <th>Email</th>
                <th>Professio</th>
                <th>Centro</th>
                <th>Estat</th>
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
                    <td>{{ $professional->center->name }}</td>
                    @if($professional->status==1)
                    <td class="bg-green-300">
                    @elseif($professional->status==0)
                    <td class="bg-red-500">
                    @endif
                        <form action="{{route('changeStateProfessional', $professional)}}" method="post">
                            @csrf
                            @method('PUT')
                            @if($professional->status==1)
                                <input type="submit" value="Desactivar" >
                            @elseif($professional->status==0)
                                <input type="submit" value="Activar">
                            @endif
                        </form>
                        
                    </td>
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
