@vite('resources/css/app.css')
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Projecte o Comissió</title>
</head>
<body class="bg-slate-50 text-gray-800 font-sans min-h-screen flex items-center justify-center p-6">

    <div class="w-full max-w-2xl bg-white shadow-lg rounded-2xl p-8">
        <h1 class="text-2xl font-bold text-orange-600 mb-6 text-center">Crear Projecte o Comissió</h1>

        <form action="{{ route('projects_comisions.store') }}" method="POST" class="space-y-5">
            @csrf

            <!-- Nom -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nom</label>
                <input type="text" name="name" id="name"
                    class="block w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition"
                    required>
            </div>

            <!-- Descripció -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Descripció</label>
                <textarea name="description" id="description" rows="2"
                    class="block w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition"></textarea>
            </div>

            <!-- Observacions -->
            <div>
                <label for="observations" class="block text-sm font-medium text-gray-700 mb-1">Observacions</label>
                <textarea name="observations" id="observations" rows="2"
                    class="block w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition"></textarea>
            </div>

            <!-- Arxiu relacionat -->
            <div>
                <label for="path" class="block text-sm font-medium text-gray-700 mb-1">Arxiu relacionat</label>
                <input type="text" name="path" id="path"
                    class="block w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition">
            </div>

            <!-- Tipus -->
            <div>
                <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Tipus</label>
                <select name="type" id="type"
                    class="block w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition"
                    required>
                    <option value="">-- Selecciona un tipus --</option>
                    <option value="project">Projecte</option>
                    <option value="comision">Comissió</option>
                </select>
            </div>

            <!-- Professional responsable -->
            <div>
                <label for="responsible" class="block text-sm font-medium text-gray-700 mb-1">Professional responsable</label>
                <select name="responsible" id="responsible"
                    class="block w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition">
                    <option value="">-- Selecciona un professional --</option>
                    @foreach ($professionals as $professional)
                        <option value="{{ $professional->id }}">
                            {{ $professional->name }} {{ $professional->surname1 }} {{ $professional->surname2 }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Centre -->
            <div>
                <label for="center_id" class="block text-sm font-medium text-gray-700 mb-1">Centre</label>
                <select name="center_id" id="center_id"
                    class="block w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition">
                    <option value="">-- Selecciona un centre --</option>
                    @foreach ($centers as $center)
                        <option value="{{ $center->id }}">{{ $center->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Botón enviar -->
            <div class="pt-4 text-center">
                <button type="submit"
                    class="px-6 py-2 bg-orange-600 hover:bg-orange-700 text-white font-semibold rounded-lg shadow-md transition focus:ring-2 focus:ring-orange-400 focus:ring-offset-1">
                    Enviar
