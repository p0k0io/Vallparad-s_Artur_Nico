<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Seguiment Professional</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <img 
        src="{{ asset('images/asset_login_superpossed.png') }}" 
        alt="Decorative background"
        class="absolute bottom-0 left-0 w-full h-auto object-cover pointer-events-none select-none z-0"
    />

    <div class="bg-white bg-opacity-95 shadow-xl rounded-2xl p-10 w-3/4 flex flex-col space-y-4 z-10">
        <h2 class="text-3xl font-semibold text-center text-orange-600">
            Segiuments de {{ $professional->name }} {{ $professional->surname1 }} {{ $professional->surname2 }}
        </h2>
        <div id="seguiments">
            @foreach($trackings as $tracking)
                <div 
                    x-data="{ open: false }"
                    class="bg-orange-300 my-3 rounded-xl flex"

                    @click="open= !open"
                >
                    <p class="text-white pl-5 text-xl font-bold">
                        {{$tracking->subject}} 
                    </p>
                    <p x-show="open" class="text-white text-xl font-bold">
                        {{$tracking->tracker}}
                    </p>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>