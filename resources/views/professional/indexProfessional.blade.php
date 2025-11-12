@extends('../layouts.app')

@section('title','Valoracio Professionals')

@section('content')
        <div class="flex justify-center min-h-screen">
            <div class="hidden w-2/4 bg-white bg-opacity-95 z-50 justify-center rounded-xl mx-5 my-10 shadow-md" id="leftContent">
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


            <div class="flex w-2/4 bg-white bg-opacity-95 z-50 justify-center rounded-xl mx-5 my-10 shadow-md">
                <div class="flex flex-col w-3/4">
                    <form class="flex flex-row w-full justify-between mt-20 mb-10" action="" method="post">
                        <input class="bg-white border-2 w-2/3 border-grey-400 rounded-xl" type="text" name="searchP" id="searchP" placeholder="Buscar Professional">
                        <button class="flex justify-center" type="submit"><x-lucide-search class="size-7 text-gray-500 m-auto"/></button>
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
                                        <el-dropdown class="inline-block">
                                            <button class="inline-flex w-full justify-center gap-x-1.5 rounded-md bg-white px-3 py-1 text-sm font-semibold text-gray-900 shadow-xs inset-ring-1 inset-ring-gray-300 hover:bg-gray-50">
                                                Opcions
                                                <x-lucide-chevron-down class="-mr-1 size-5 text-orange-500"/>
                                            </button>

                                            <el-menu anchor="bottom end" popover class="border-solid border-2 border-gray-50 m-0 w-52 origin-top-right divide-y divide-gray-100 rounded-md bg-white shadow-lg outline-1 outline-black/5 transition transition-discrete [--anchor-gap:--spacing(2)] data-closed:scale-95 data-closed:transform data-closed:opacity-0 data-enter:duration-100 data-enter:ease-out data-leave:duration-75 data-leave:ease-in">
                                                <div class="py-1">
                                                    <a href="{{ route('assessViewProfessional.professional', $professional) }}" class="w-full inline-flex px-4 py-2 text-sm text-gray-700 focus:bg-gray-100 focus:text-gray-900 focus:outline-hidden">
                                                        <x-lucide-file-badge class="mr-2 size-5 text-orange-500"/>
                                                        Veure Valoracions
                                                    </a>
                                                    <a href="{{ route('trackingViewProfessional.professional', $professional) }}" class="w-full inline-flex px-4 py-2 text-sm text-gray-700 focus:bg-gray-100 focus:text-gray-900 focus:outline-hidden">
                                                        <x-lucide-file-text class="mr-2 size-5 text-orange-500"/>
                                                        Veure Seguiments
                                                    </a>
                                                </div>
                                                <div class="py-1">
                                                    <a href="{{ route('trackingView.professional', $professional) }}" class="w-full inline-flex px-4 py-2 text-sm text-gray-700 focus:bg-gray-100 focus:text-gray-900 focus:outline-hidden">
                                                        <x-lucide-file-pen-line class="mr-2 size-5 text-orange-500"/>
                                                        Fer Seguiment
                                                    </a>
                                                    <a href="{{ route('assessView.professional', $professional) }}" class="w-full inline-flex px-4 py-2 text-sm text-gray-700 focus:bg-gray-100 focus:text-gray-900 focus:outline-hidden">
                                                        <x-lucide-user-pen class="mr-2 size-5 text-orange-500"/>
                                                        Avaluar Professional
                                                    </a>
                                                    <a href="{{ route('professional.edit', $professional) }}" class="w-full inline-flex px-4 py-2 text-sm text-gray-700 focus:bg-gray-100 focus:text-gray-900 focus:outline-hidden">
                                                        <x-lucide-square-pen class="mr-2 size-5 text-orange-500"/>
                                                        Editar Professional
                                                    </a>
                                                </div>
                                            </el-menu>
                                        </el-dropdown>
                                        <form action="{{ route('changeStateProfessional', $professional) }}" method="post">
                                            @csrf
                                            @method('PUT')
                                            @if($professional->status==1)
                                                <input type="submit" value="Desactivar" class="px-3 py-1 w-28 text-sm font-semibold text-white bg-red-400 hover:bg-red-500 rounded-lg transition">
                                            @else
                                                <input type="submit" value="Activar" class="px-3 py-1 w-28 text-sm font-semibold text-white bg-green-400 hover:bg-green-500 rounded-lg transition">
                                            @endif
                                        </form>
                                    </td>
                                    
                                </tr>
                            @endforeach
                        </tbody>
                        <div id="result">

                        </div>
                    </table>
                    <div class="mb-5">
                        {{$professionals->links('pagination::tailwind')}}
                    </div>
                    <div class="flex justify-end">
                        <a class="bg-orange-400/90 text-white text-center text-2xl w-20 py-1 rounded-full hover:bg-orange-400 transition" href="<?php echo route('professional.create')?>">+</a>
                    </div>
                </div>
            </div>
        </div>
        @vite(['resources/js/professional.js'])

@endsection