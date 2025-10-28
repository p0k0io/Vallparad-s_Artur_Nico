<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <form action="{{route('professional.update', $professional)}}" method="post">
        @csrf
        @method('PUT')
        Nom: <input type="text" name="name" id="name" value='{{$professional->name}}'><br>
        Descripcio: <input type="text" name="description" id="description" value='{{$professional->description}}'><br>
        Observacions: <input type="text" name="observations" id="observations" value='{{$professional->observations}}'><br>
        Tipus: <input type="text" name="type" id="type" value='{{$professional->type}}'><br>
        Responsable: <input type="number" name="responsible" id="responsible" value='{{$professional->name}}'><br>
        Centre: <input type="number" name="center" id="center" value='{{$professional->center->name}}'><br>
        <button type="submit">Enviar</button>
    </form>
</body>
</html>