<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Document</title>

</head>
<body>
    <div class="w-full h-10 bg-red-200">asdas</div>
    <form action="{{route('insertCv')}}" method ="POST">
        @csrf
        <input type="text" name="path" id="">
        <button type="submit">insertar</button>
    </form>
</body>
</html>