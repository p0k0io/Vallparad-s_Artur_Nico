<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="{{route('center.store')}}" method="post">
        @csrf
        Nom: <input type="text" name="name" id="name"><br>
        Telefon: <input type="tel" name="phone" id="phone"><br>
        Direccio: <input type="text" name="location" id="location"><br>
        Email: <input type="text" name="email" id="email"><br>
        <button type="submit">Enviar</button>
    </form>
</body>
</html>