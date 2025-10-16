<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Projecte o Comissió</title>
</head>
<body>
    <form action="{{ route('projects_comisions.store') }}" method="post">
        @csrf

        <label for="name">Nom:</label>
        <input type="text" name="name" id="name"><br>

        <label for="description">Descripció:</label>
        <input type="text" name="description" id="description"><br>

        <label for="observations">Observacions:</label>
        <input type="text" name="observations" id="observations"><br>

        <label for="type">Tipus:</label>
        <select name="type" id="type">
            <option value="project">Projecte</option>
            <option value="comision">Comissió</option>
        </select><br>

                    <div>
                <label for="professional_id" class="block text-sm font-medium text-gray-700">Professional responsable:</label>
                <select name="professional_id" id="professional_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500">
                    <option value="">-- Selecciona un professional --</option>
                    @foreach ($professionals as $professional)
                        <option value="{{ $professional->id }}">
                            {{ $professional->name }} {{ $professional->surname1 }} {{ $professional->surname2 }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Centro -->
            <div>
                <label for="center_id" class="block text-sm font-medium text-gray-700">Centre:</label>
                <select name="center_id" id="center_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500">
                    <option value="">-- Selecciona un centre --</option>
                    @foreach ($centers as $center)
                        <option value="{{ $center->id }}">
                            {{ $center->name }}
                        </option>
                    @endforeach
                </select>
            </div><br>

        <button type="submit">Enviar</button>
    </form>
</body>
</html>
