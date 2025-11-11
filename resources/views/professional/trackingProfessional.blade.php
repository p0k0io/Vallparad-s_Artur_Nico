<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seguiment Professional</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <img 
        src="{{ asset('images/asset_login_superpossed.png') }}" 
        alt="Decorative background"
        class="absolute bottom-0 left-0 w-full h-auto object-cover pointer-events-none select-none z-0"
    />

    <form action="{{ route('track.professional',$professional) }}" method="POST" class="bg-white bg-opacity-95 shadow-xl rounded-2xl p-10 w-full max-w-4xl flex flex-col space-y-4 z-10">
        @csrf
        @method('POST')

        <h2 class="text-3xl font-semibold text-center text-orange-600">
            Segiument a {{ $professional->name }} {{ $professional->surname1 }} {{ $professional->surname2 }}
        </h2>

        <div>
            <label for="type" class="block text-sm font-medium text-gray-700">Tipus</label>
            <select name="type" id="" class="mt-1 w-full rounded-xl border-gray-300 focus:border-orange-500 focus:ring-orange-500 h-10 px-3">
                <option value="obert">Obert</option>
                <option value="restringit">Restringit</option>
                <option value="fi de la vinculacio">Fi de la vinculacio</option>
            </select>
        </div>

        <div>
            <label for="role" class="block text-sm font-medium text-gray-700">Subjecte</label>
            <input type="text" name="subject" id="" class="mt-1 w-full rounded-xl border-gray-300 focus:border-orange-500 focus:ring-orange-500 h-10 px-3" maxlength="75">
        </div>

        <div>
            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Descripció</label>
            <textarea name="description" id="" rows="5" class="block w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition"></textarea>
        </div>

        <div class="pt-6">
            <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 text-white font-semibold py-3 rounded-xl shadow transition duration-200"> Fer Seguiment </button>
        </div>
    </form>

</body>
</html>