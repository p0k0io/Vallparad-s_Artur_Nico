<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="{{route('center.update', $center)}}" method="post">
        @csrf
        @method('PUT')
        Nom: <input type="text" name="name" id="name" value='{{$center->name}}'><br>
        Telefon: <input type="tel" name="phone" id="phone" value='{{$center->phone}}'><br>
        Direccio: <input type="text" name="location" id="location" value='{{$center->location}}'><br>
        Email: <input type="text" name="email" id="email" value='{{$center->email}}'><br>
        <button type="submit">Enviar</button>
    </form>
</body>
</html>