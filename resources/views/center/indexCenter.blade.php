<!DOCTYPE html>
<html>
<head>
    <title>Lista de Productos</title>
</head>
<body>
    <h1>Centres</h1>
    <table border="1" cellpadding="5">
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Direccio</th>
            <th>Correu</th>
            <th>Telèfon</th>
            <th>Estat</th>
            <th>Editar</th>
        </tr>
        @foreach ($centers as $center)
            <tr>
                <td>{{ $center->id }}</td>
                <td>{{ $center->name}}</td>
                <td>{{ $center->location}}</td>
                <td>{{ $center->email}}</td>
                <td>{{ $center->phone}}</td>
                @if($center->status==1)
                    <td class="bg-green-300">
                    @elseif($center->status==0)
                    <td class="bg-red-500">
                    @endif
                        <form action="{{route('changeStateCenter', $center)}}" method="post">
                            @csrf
                            @method('PUT')
                            @if($center->status==1)
                                <input type="submit" value="Desactivar" >
                            @elseif($center->status==0)
                                <input type="submit" value="Activar">
                            @endif
                        </form>
                    </td>
                    <td>
                        <a href="<?php echo route('center.edit', $center)?>">Editar</a>
                    </td>
            </tr>
        @endforeach
    </table>
    <a href="<?php echo route('center.create')?>">Introduir nou Centre</a>
</body>
</html>
