<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title','Vallparadis')</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <!-- Scripts -->
        <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <script>
        const getAssessmentUrl = "{{ route('getAssessment.professional') }}";
        const csrfToken = "{{ csrf_token() }}";
    </script>
    <script src="{{ asset('js/professional.js') }}"></script>
    
    <body class="font-sans antialiased bg-slate-50"> 
        <img 
                src="{{ asset('images/asset_login_superpossed.png') }}" 
                alt="Decorative background"
                class="absolute bottom-0 left-0 w-full h-auto object-cover pointer-events-none select-none z-0"
        />
        <div class="flex justify-center min-h-screen">
            <div class="hidden w-2/4 bg-white bg-opacity-95 z-50 justify-center rounded-xl mx-5 my-10 " id="leftContent">
                <div class="w-full m-10">
                    <div id="topLeftContent" class="text-right mb-10">
                        <button id ="leftContentButton"><x-lucide-x class="w-8 h-8 text-orange-500"/></button>
                    </div>
                    <div id="leftContentTitle" class="flex">
                        <h1 id="leftContentH1" class="text-6xl text-orange-500 "></h1>
                    </div>
                    <div id="leftContentSecondTitle" class="mb-10">
                        <h3 id="leftContentH3" class="text-4xl text-gray-400"></h3>
                    </div>
                    <div>
                        <h3 class="text-2xl text-gray-400 border-b-2">Email</h3>
                        <p id="leftContentMail"></p>
                    </div>
                    <div>
                        <h3 class="text-2xl text-gray-400 border-b-2">Adreça</h3>
                        <p id="leftContentAddress"></p>
                    </div>
                    <div>
                        <h3 class="text-2xl text-gray-400 border-b-2">Telèfon</h3>
                        <p id="leftContentPhone"></p>
                    </div>
                    <div>
                        <h3 class="text-2xl text-gray-400 border-b-2">Avaluació</h3>
                        <p id="leftContentEvaluation"></p>
                    </div>
                    <div>
                        <h3 class="text-2xl text-gray-400 border-b-2">Seguiment</h3>
                        <p id="leftContentTracking"></p>
                    </div>
                </div>
            </div>



            <div class="flex w-2/4 bg-white bg-opacity-95 z-50 justify-center rounded-xl mx-5 my-10">
                <div class="flex flex-col w-3/4">
                    <form class="flex flex-row w-full justify-between mt-32 mb-10" action="" method="post">
                        <input class="bg-white border-2 w-2/3 border-grey-400 rounded-xl" type="text" name="searchP" id="searchP" placeholder="Buscar Professional">
                        <button class="bg-white border-2 w-16 border-gray-400 rounded-3xl" type="submit">Lupa</button>
                        <input class="bg-white border-2 w-16 border-orange-400 rounded-3xl" type="button" value="">
                        <input class="bg-white border-2 w-16 border-orange-700 rounded-3xl" type="button" value="">
                    </form>
                    <table id="professionalTable" class="w-full border-separate border-spacing-y-2">
                        <tbody>
                            @foreach ($professionals as $professional)
                                @if($professional->status==1)
                                    <tr class="bg-white border border-yellow-400 rounded-xl shadow-sm hover:border-orange-600 transition flex items-center justify-between px-4 py-2 my-5">
                                @else
                                    <tr class="bg-gray-300 border border-gray-400 rounded-xl flex items-center justify-between px-4 py-2 my-5">
                                @endif
                                    <td id="" class="text-lg font-medium text-gray-800">
                                        <a class="perfil">
                                            {{ $professional->name }} {{ $professional->surname1 }} {{ $professional->surname2 }}
                                            <input id="idP" type="hidden" name="idP" value="{{$professional->id}}">
                                            <input id="nameP" type="hidden" name="nameP" value="{{$professional->name}}">
                                            <input id="surname1P" type="hidden" name="surname1P" value="{{$professional->surname1}}">
                                            <input id="surname2P" type="hidden" name="surname2P" value="{{$professional->surname2}}">
                                            <input id="emailP" type="hidden" name="emailP" value="{{$professional->email}}">
                                            <input id="addressP" type="hidden" name="addressP" value="{{$professional->address}}">
                                            <input id="phoneP" type="hidden" name="phoneP" value="{{$professional->phone}}">
                                            <input id="professionP" type="hidden" name="professionP" value="{{$professional->profession}}">
                                        </a>
                                    </td>

                                    <td class="flex items-center gap-3">
                                        <a id="seguiments" class="px-3 py-1 text-sm font-semibold text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-100 transition">
                                            Seguiments
                                        </a>
                                        <a href="{{ route('trackingView.professional', $professional) }}" class="px-3 py-1 text-sm font-semibold text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-100 transition">
                                            Seguiment
                                        </a>
                                        <a href="{{ route('assessView.professional', $professional) }}" class="px-3 py-1 text-sm font-semibold text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-100 transition">
                                            Avaluar
                                        </a>
                                        <a href="{{ route('professional.edit', $professional) }}" class="px-3 py-1 text-sm font-semibold text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-100 transition">
                                            Editar
                                        </a>
                                        <form action="{{ route('changeStateProfessional', $professional) }}" method="post">
                                            @csrf
                                            @method('PUT')
                                            @if($professional->status==1)
                                                <input type="submit" value="Desactivar" class="px-3 py-1 w-28 text-sm font-semibold text-white bg-red-500 hover:bg-red-600 rounded-lg transition">
                                            @else
                                                <input type="submit" value="Activar" class="px-3 py-1 w-28 text-sm font-semibold text-white bg-green-500 hover:bg-green-600 rounded-lg transition">
                                            @endif
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <div id="result">

                        </div>
                    </table>
                    <div class="flex justify-end">
                        <a class="bg-orange-500 text-white text-center text-2xl w-20 py-1 rounded-full hover:bg-orange-400 transition" href="<?php echo route('professional.create')?>">+</a>
                    </div>
                </div>
            </div>
        </div>
        @vite(['resources/js/professional.js'])
    </body>
</html>
