<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="{{route('insertCenter')}}" method="post">
        @csrf
        Nom: <input type="text" name="name" id="name">
        Telefon: <input type="tel" name="phone" id="phone">
        Direccio: <input type="text" name="location" id="location">
        Email: <input type="text" name="email" id="email">
        <button type="submit">Enviar</button>
    </form>
</body>
</html>