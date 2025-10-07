<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="{{route('insertCv')}}" method ="POST">
        @csrf
        <input type="text" name="path" id="">
        <button type="submit">insertar</button>
    </form>
</body>
</html>