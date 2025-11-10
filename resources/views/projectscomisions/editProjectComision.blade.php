<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <form action="" method="post">
        @csrf
        @method('PUT')
        Nom: <input type="text" name="name" id="name" value='{{$project_comision->name}}'><br>
        Descripcio: <input type="text" name="description" id="description" value='{{$project_comision->description}}'><br>
        Observacions: <input type="text" name="observations" id="observations" value='{{$project_comision->observations}}'><br>
        Tipus: <input type="text" name="type" id="type" value='{{$project_comision->type}}'><br>
        Responsable: <input type="number" name="responsible" id="responsible" value='{{$project_comision->professional->name}}'><br>
        Centre: <input type="number" name="center" id="center" value='{{$project_comision->center->name}}'><br>
        <button type="submit">Enviar</button>
    </form>
</body>
</html>