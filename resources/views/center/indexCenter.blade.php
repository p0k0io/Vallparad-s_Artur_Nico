@vite('resources/css/app.css')
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Centros</title>
    {{-- Cargar Alpine.js correctamente --}}
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="bg-slate-50 text-gray-800 font-sans">
    <div class="max-w-6xl mx-auto px-6 py-10" x-data="{ selectedCenter:null}">

        <h1 class="text-3xl font-bold text-orange-600 mb-8 text-center">Lista de Centros</h1>


        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">


            <div x-show="!selectedCenter" class="md:col-span-3 flex justify-center">
                <div class="bg-white rounded-2xl shadow-md p-6 w-full max-w-lg">
                    <h2 class="text-xl font-semibold mb-4 text-center">Todos los centros</h2>
                    <ul class="space-y-2 flex justify-center flex-col items-center ">
                        @foreach ($centers as $center)
                            <li class= "w-4/6 h-auto px-10>">
                                <button
                                    type="button"
                                    @click="selectedCenter = {{ Js::from($center) }}"
                                    class="w-full border-2 border-orange-400  px-4 py-2 rounded-full hover:bg-orange-50  text-gray-700"
                                >
                                    {{ $center->name }}
                                </button>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            
            <div x-show="selectedCenter" class="bg-white rounded-2xl shadow-md p-4" >
                <h2 class="text-xl font-semibold mb-4">Todos los centros</h2>
                <ul class="space-y-2">
                    @foreach ($centers as $center)
                        <li>
                            <button
                                type="button"
                                @click="selectedCenter = {{ Js::from($center) }}"
                                :class="selectedCenter && selectedCenter.id === {{ $center->id }}
                                    ? 'border-2 border-orange-500 text-orange-600 font-semibold rounded-full px-4 py-2 w-full text-left'
                                    : 'text-gray-700 hover:text-orange-600 px-4 py-2 w-full text-left rounded-full transition'"
                            >
                                {{ $center->name }}
                            </button>
                        </li>
                    @endforeach
                </ul>

                <div class="mt-4 text-center">
                    <button @click="selectedCenter = null"
                            class="text-sm text-orange-600 hover:underline">
                        Volver a la vista centrada
                    </button>
                </div>
            </div>


            <div class="md:col-span-2" x-show="selectedCenter">
                <div class="bg-white rounded-2xl shadow-md p-6 relative">
                    <div class="flex justify-between items-start">
                        <h2 class="text-2xl font-bold text-orange-600" x-text="selectedCenter.name"></h2>
                        <span
                            class="'bg-green-100 text-green-700 inline-flex items-center gap-2 text-sm font-semibold px-3 py-1 rounded-full"
                            :class="selectedCenter.status == 1 
                                ? 'bg-green-100 text-green-700' 
                                : 'bg-red-100 text-red-700'">
                            <span class="w-2 h-2 rounded-full"
                                :class="selectedCenter.status == 1 ? 'bg-green-500' : 'bg-red-500'"></span>
                            <span x-text="selectedCenter.status == 1 ? 'Activo' : 'Inactivo'"></span>
                        </span>
                    </div>

                    <div class="mt-4 space-y-2 text-sm">
                        <p><strong>Nombre del centro:</strong> <span x-text="selectedCenter.name"></span></p>
                        <p><strong>Dirección:</strong> <span x-text="selectedCenter.location"></span></p>
                        <p><strong>Correo electrónico:</strong> <span x-text="selectedCenter.email"></span></p>
                        <p><strong>Teléfono:</strong> <span x-text="selectedCenter.phone"></span></p>
                    </div>

                    <div class="mt-6">
                        <a :href="`/center/${selectedCenter.id}/edit`"
                           class="inline-block bg-orange-600 hover:bg-orange-700 text-white font-semibold px-6 py-2 rounded-lg shadow">
                           Editar Centro
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- BOTÓN PARA CREAR NUEVO CENTRO --}}
        <div class="text-center mt-10">
            <a href="{{ route('center.create') }}"
               class="inline-block bg-orange-600 hover:bg-orange-700 text-white font-semibold px-6 py-2 rounded-lg shadow transition">
               Introducir nuevo Centro
            </a>
        </div>
    </div>
</body>
</html>
