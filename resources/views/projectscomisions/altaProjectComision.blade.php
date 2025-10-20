<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Projecte o Comissió</title>
</head>
<body>
<form action="{{ route('projects_comisions.store') }}" method="POST">
    @csrf

    <!-- Nombre -->
    <div>
        <label for="name" class="block text-sm font-medium text-gray-700">Nom:</label>
        <input type="text" name="name" id="name"
               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500"
               required>
    </div>

    <!-- Descripción -->
    <div class="mt-3">
        <label for="description" class="block text-sm font-medium text-gray-700">Descripció:</label>
        <textarea name="description" id="description" rows="2"
                  class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500"></textarea>
    </div>

    <!-- Observaciones -->
    <div class="mt-3">
        <label for="observations" class="block text-sm font-medium text-gray-700">Observacions:</label>
        <textarea name="observations" id="observations" rows="2"
                  class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500"></textarea>
    </div>

    <!-- Archivo relacionado -->
    <div class="mt-3">
        <label for="path" class="block text-sm font-medium text-gray-700">Arxiu relacionat:</label>
        <input type="text" name="path" id="path"
               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500">
    </div>

    <!-- Tipo -->
    <div class="mt-3">
        <label for="type" class="block text-sm font-medium text-gray-700">Tipus:</label>
        <select name="type" id="type"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500"
                required>
            <option value="">-- Selecciona un tipus --</option>
            <option value="project">Projecte</option>
            <option value="comision">Comissió</option>
        </select>
    </div>

    <!-- Responsable -->
    <div class="mt-3">
        <label for="responsible" class="block text-sm font-medium text-gray-700">Professional responsable:</label>
        <select name="responsible" id="responsible"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500">
            <option value="">-- Selecciona un professional --</option>
            @foreach ($professionals as $professional)
                <option value="{{ $professional->id }}">
                    {{ $professional->name }} {{ $professional->surname1 }} {{ $professional->surname2 }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Centro -->
    <div class="mt-3">
        <label for="center_id" class="block text-sm font-medium text-gray-700">Centre:</label>
        <select name="center_id" id="center_id"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500">
            <option value="">-- Selecciona un centre --</option>
            @foreach ($centers as $center)
                <option value="{{ $center->id }}">{{ $center->name }}</option>
            @endforeach
        </select>
    </div>

    <!-- Botón enviar -->
    <div class="mt-5">
        <button type="submit"
                class="px-4 py-2 bg-orange-600 text-white font-semibold rounded-md shadow hover:bg-orange-700">
            Enviar
        </button>
    </div>
</form>


</body>
</html>
