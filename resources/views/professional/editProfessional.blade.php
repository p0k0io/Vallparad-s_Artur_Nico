<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="{{route('professional.update', $professional)}}" method="post">
        @csrf
        @method('PUT')
        Nom: <input type="text" name="name" id="name" value='{{$professional->name}}'><br>
        Cognom 1: <input type="text" name="surname1" id="surname1" value='{{$professional->surname1}}'><br>
        Cognom 2: <input type="text" name="surname2" id="surname2" value='{{$professional->surname2}}'><br>
        Email: <input type="text" name="email" id="email" value='{{$professional->email}}'><br>
        Direccio: <input type="text" name="address" id="address" value='{{$professional->address}}'><br>
        Telefon: <input type="tel" name="phone" id="phone" value='{{$professional->phone}}'><br>
        Taquilla: <input type="text" name="locker" id="locker" value='{{$professional->locker}}'><br>
        Profession: <input type="text" name="profession" id="profession" value='{{$professional->profession}}'><br>
        Estat: <input type="text" name="linkStatus" id="linkStatus" value='{{$professional->linkStatus}}'><br>
        Codi Clau: <input type="text" name="keyCode" id="keyCode" value='{{$professional->keyCode}}'><br>
        Centre: <input type="text" name="center_id" id="center_id" value='{{$professional->center_id}}'><br>
        ID Rol: <input type="number" name="rol_id" id="rol_id" value='{{$professional->rol_id}}'><br>
        ID Cv: <input type="number" name="cv_id" id="cv_id" value='{{$professional->cv_id}}'><br>
        <button type="submit">Enviar</button>
    </form>
</body>
</html>