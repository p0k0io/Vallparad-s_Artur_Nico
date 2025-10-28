<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

    <div class="flex bg-gray-100">

        <img 
            src="{{ asset('images/asset_login_superpossed.png') }}" 
            alt="Decorative background"
            class="absolute bottom-0 left-0 w-full h-auto object-cover pointer-events-none select-none z-0"
        />

        <div class="min-h-screen flex items-center justify-center bg-white bg-opacity-95 z-10 w-2/4">
        <form action="{{ route('professional.store') }}" method="POST" class="p-10 w-full flex flex-col">
            @csrf

            <h2 class="text-3xl font-semibold text-center text-orange-600 my-10">
                Afegir Professional
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div class="space-y-4">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Nom</label>
                        <input type="text" name="name" id="name" class="mt-1 w-full rounded-xl border-gray-300 focus:border-orange-500 focus:ring-orange-500 h-10 px-3">
                    </div>

                    <div>
                        <label for="surname1" class="block text-sm font-medium text-gray-700">Primer Cognom</label>
                        <input type="text" name="surname1" id="surname1" class="mt-1 w-full rounded-xl border-gray-300 focus:border-orange-500 focus:ring-orange-500 h-10 px-3">
                    </div>

                    <div>
                        <label for="surname2" class="block text-sm font-medium text-gray-700">Segon Cognom</label>
                        <input type="text" name="surname2" id="surname2" class="mt-1 w-full rounded-xl border-gray-300 focus:border-orange-500 focus:ring-orange-500 h-10 px-3">
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Correu electrònic</label>
                        <input type="email" name="email" id="email" class="mt-1 w-full rounded-xl border-gray-300 focus:border-orange-500 focus:ring-orange-500 h-10 px-3">
                    </div>

                    <div>
                        <label for="address" class="block text-sm font-medium text-gray-700">Adreça</label>
                        <input type="text" name="address" id="address" class="mt-1 w-full rounded-xl border-gray-300 focus:border-orange-500 focus:ring-orange-500 h-10 px-3">
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700">Telèfon</label>
                        <input type="tel" name="phone" id="phone" class="mt-1 w-full rounded-xl border-gray-300 focus:border-orange-500 focus:ring-orange-500 h-10 px-3">
                    </div>
                </div>

                <div class="space-y-4">
                    <div>
                        <label for="locker" class="block text-sm font-medium text-gray-700">Taquilla</label>
                        <input type="text" name="locker" id="locker" class="mt-1 w-full rounded-xl border-gray-300 focus:border-orange-500 focus:ring-orange-500 h-10 px-3">
                    </div>

                    <div>
                        <label for="profession" class="block text-sm font-medium text-gray-700">Professió</label>
                        <input type="text" name="profession" id="profession" class="mt-1 w-full rounded-xl border-gray-300 focus:border-orange-500 focus:ring-orange-500 h-10 px-3">
                    </div>

                    <div>
                        <label for="keyCode" class="block text-sm font-medium text-gray-700">Clau</label>
                        <input type="text" name="keyCode" id="keyCode" class="mt-1 w-full rounded-xl border-gray-300 focus:border-orange-500 focus:ring-orange-500 h-10 px-3">
                    </div>

                    <div>
                        <label for="center_id" class="block text-sm font-medium text-gray-700">Centre</label>
                        <input type="number" name="center_id" id="center_id" class="mt-1 w-full rounded-xl border-gray-300 focus:border-orange-500 focus:ring-orange-500 h-10 px-3">
                    </div>

                    <div>
                        <label for="role" class="block text-sm font-medium text-gray-700">Rol</label>
                        <select name="role" id="role" class="mt-1 w-full rounded-xl border-gray-300 focus:border-orange-500 focus:ring-orange-500 h-10 px-3">
                            <option value="admin">Administrador</option>
                            <option value="gestor">Gestor</option>
                            <option value="user">Usuari</option>
                        </select>
                    </div>

                    <div>
                        <label for="cv_id" class="block text-sm font-medium text-gray-700">CV</label>
                        <input type="number" name="cv_id" id="cv_id" class="mt-1 w-full rounded-xl border-gray-300 focus:border-orange-500 focus:ring-orange-500 h-10 px-3">
                    </div>
                </div>
            </div>

            <div class="pt-6">
                <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 text-white font-semibold py-3 rounded-xl shadow transition duration-200"> Enviar </button>
            </div>
        </form>
        </div>
        <div class="flex w-2/4">
            
        </div>
    </div>

</body>
</html>
