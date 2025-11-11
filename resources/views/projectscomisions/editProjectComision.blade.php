<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Projecte/Comisio</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <img 
        src="{{ asset('images/asset_login_superpossed.png') }}" 
        alt="Decorative background"
        class="absolute bottom-0 left-0 w-full h-auto object-cover pointer-events-none select-none z-0"
    />

    <form action="" method="POST" class="bg-white bg-opacity-95 shadow-xl rounded-2xl p-10 w-full max-w-4xl flex flex-col space-y-8 z-10">
        @csrf
        @method('PUT')
        {{dd($project_comision)}}

        <h2 class="text-3xl font-semibold text-center text-orange-600">
            Editar Projecte/Comisio
        </h2>
            <div class="space-y-4">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Nom</label>
                    <input type="text" name="name" id="name" value="{{$project_comision->name}}" class="mt-1 w-full rounded-xl border-gray-300 focus:border-orange-500 focus:ring-orange-500 h-10 px-3">
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700">Descripció</label>
                    <input type="text" name="description" id="description" value="{{$project_comision->description}}" class="mt-1 w-full rounded-xl border-gray-300 focus:border-orange-500 focus:ring-orange-500 h-10 px-3">
                </div>

                <div>
                    <label for="observations" class="block text-sm font-medium text-gray-700">Observacions</label>
                    <input type="text" name="observations" id="observations" value="{{$project_comision->observations}}" class="mt-1 w-full rounded-xl border-gray-300 focus:border-orange-500 focus:ring-orange-500 h-10 px-3">
                </div>

                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700">Tipus</label>
                    <input type="text" name="type" id="type" value="{{$project_comision->type}}" class="mt-1 w-full rounded-xl border-gray-300 focus:border-orange-500 focus:ring-orange-500 h-10 px-3">
                </div>

                <div>
                    <label for="professional_id" class="block text-sm font-medium text-gray-700">Responsable</label>
                    <input type="text" name="professional_id" id="professional_id" value="{{$project_comision->professional->name}}" class="mt-1 w-full rounded-xl border-gray-300 focus:border-orange-500 focus:ring-orange-500 h-10 px-3">
                </div>
            </div>
        <div class="pt-6">
            <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 text-white font-semibold py-3 rounded-xl shadow transition duration-200"> Actualitzar </button>
        </div>
    </form>

</body>
</html>