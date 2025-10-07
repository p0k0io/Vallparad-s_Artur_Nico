<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="{{route('insertProfessional')}}" method="post">
        @csrf
        Nom: <input type="text" name="name" id="name">
        Cognom 1: <input type="text" name="surname1" id="surname1">
        Cognom 2: <input type="text" name="surname2" id="surname2">
        Email: <input type="text" name="email" id="email">
        Direccio: <input type="text" name="address" id="address">
        Telefon: <input type="tel" name="phone" id="phone">
        Taquilla: <input type="text" name="locker" id="locker">
        Profession: <input type="text" name="profession" id="profession">
        Estat: <input type="text" name="linkStatus" id="linkStatus">
        Codi Clau: <input type="text" name="keyCode" id="keyCode">
        ID Taquilla: <input type="number" name="locker_id" id="locker_id">
        ID Clau: <input type="number" name="key_id" id="key_id">
        ID Centre: <input type="number" name="center_id" id="center_id">
        ID Rol: <input type="number" name="rol_id" id="rol_id">
        ID Cv: <input type="number" name="cv_id" id="cv_id">
        <button type="submit">Enviar</button>
    </form>
</body>
</html>