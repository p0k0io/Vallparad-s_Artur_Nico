@vite('resources/css/app.css')
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Centre</title>
</head>
<body class="bg-slate-50 text-gray-800 font-sans min-h-screen flex items-center justify-center p-6">

    <div class="w-full max-w-md bg-white shadow-lg rounded-2xl p-8">
        <h1 class="text-2xl font-bold text-orange-600 mb-6 text-center">Editar Centre</h1>

        <form action="{{ route('center.update', $center) }}" method="post" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nom</label>
                <input type="text" name="name" id="name" value="{{ $center->name }}" required
                    class="block w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition">
            </div>

            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Telèfon</label>
                <input type="tel" name="phone" id="phone" value="{{ $center->phone }}" required
                    class="block w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition">
            </div>


            <div>
                <label for="location" class="block text-sm font-medium text-gray-700 mb-1">Direcció</label>
                <input type="text" name="location" id="location" value="{{ $center->location }}" required
                    class="block w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition">
            </div>


            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Correu electrònic</label>
                <input type="email" name="email" id="email" value="{{ $center->email }}" required
                    class="block w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition">
            </div>


            <div class="pt-4 text-center">
                <button type="submit"
                    class="px-6 py-2 bg-orange-600 hover:bg-orange-700 text-white font-semibold rounded-lg shadow-md transition focus:ring-2 focus:ring-orange-400 focus:ring-offset-1">
                    Actualitzar
                </button>
            </div>
        </form>
    </div>

</body>
</html>
