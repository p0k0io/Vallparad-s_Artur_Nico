<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="{{route('professional.store')}}" method="post">
        @csrf
        Nom: <input type="text" name="name" id="name"><br>
        Cognom 1: <input type="text" name="surname1" id="surname1"><br>
        Cognom 2: <input type="text" name="surname2" id="surname2"><br>
        Email: <input type="text" name="email" id="email"><br>
        Direccio: <input type="text" name="address" id="address"><br>
        Telefon: <input type="tel" name="phone" id="phone"><br>
        Taquilla: <input type="text" name="locker" id="locker"><br>
        Profession: <input type="text" name="profession" id="profession"><br>
        Estat: <input type="text" name="linkStatus" id="linkStatus"><br>
        Codi Clau: <input type="text" name="keyCode" id="keyCode"><br>
        ID Centre: <input type="number" name="center_id" id="center_id"><br>
        Rol:
        <Select name="role">
            <option value="admin">Administrador</option>
            <option value="gestor">Gestor</option>
            <option value="user">Usuari</option>
        </Select>
        <br>
        ID Cv: <input type="number" name="cv_id" id="cv_id"><br>
        <button type="submit">Enviar</button>
    </form>
</body>
</html>