<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="{{route('')}}" method="post">
        @csrf
        Nom: <input type="text" name="name" id="name"><br>
        Descripcio: <input type="text" name="description" id="description"><br>
        Observacions: <input type="text" name="observations" id="observations"><br>
        Tipus: <input type="url" name="type" id="project" value="project"><input type="url" name="type" id="comision" value="comision"><br>
        ID Professional responsable: <input type="number" name="professional_id" id="professional_id"><br>
        ID Centre: <input type="number" name="center_id" id="center_id"><br>
        <button type="submit">Enviar</button>
    </form>
</body>
</html>