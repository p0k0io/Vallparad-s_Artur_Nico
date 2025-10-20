<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Projectes i Comisions</h1>

    <table border="1" cellpadding="5">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Descripcio</th>
                <th>Observacio</th>
                <th>Tipus</th>
                <th>Responsable</th>
                <th>Centre</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($projectscomisions as $projectcomision)
                <tr>
                    <td>{{ $projectcomision->id }}</td>
                    <td>{{ $projectcomision->name }}</td>
                    <td>{{ $projectcomision->description }}</td>
                    <td>{{ $projectcomision->observation }}</td>
                    <td>{{ $projectcomision->type }}</td>
                    <td>{{ $projectcomision->responsible}}</td>
                    <td>{{ $projectcomision->center->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="<?php echo route('projects_comisions.nouUniforme')?>">Crea nova commisio</a>
</body>
</html>