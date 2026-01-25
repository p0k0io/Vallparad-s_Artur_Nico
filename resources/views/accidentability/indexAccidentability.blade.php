@extends('../layouts.app')

@section('title','Accidentability')

@section('content')

    <div class="min-h-screen bg-slate-100 py-16 px-6 flex flex-col items-center">
        <div class="w-full max-w-5xl">
            <div class="text-center mb-12">
                <h1 class="text-4xl font-extrabold text-orange-500 mb-3 tracking-tight">
                    Accidents
                </h1>
                <p class="text-lg text-gray-600">
                    Gestio d'accidents
                </p>
            </div>
            <div class="bg-white rounded-3xl shadow-xl p-10 border-2 border-orange-200">

                <!-- cabecera con titulo y boton crear -->
                <div class="flex justify-between items-center mb-10 pb-6 border-b-2 border-orange-100">
                    <h2 class="text-3xl font-bold text-gray-800">Llista d'accidents</h2>

                    <!-- boto crear manteniment -->
                    <x-create-accident/>
                </div>

                <!-- llista de manteniments -->
                <div class="space-y-6">
                    @forelse($accidents as $accident)
                        <div class="hover:-translate-y-1 transition-all duration-300">
                            <li x-data="{ open: false }" class="border border-orange-200 rounded-xl overflow-hidden m-3">
                                <button @click="open = !open" class="bg-orange-50 hover:bg-orange-100 w-full text-left transition py-1 flex px-3">
                                    <div class="flex flex-col w-3/5">
                                        <h2 class="text-orange-500 text-2xl">{{$accident->context}}</h1>
                                        <div class="flex">
                                            <p class="text-gray-400 mr-5">Obert: {{$accident->created_at}}</p>
                                            <p class="text-gray-400 mr-5">Creada Per: {{$accident->professional->name}} {{$accident->professional->surname1}} {{$accident->professional->surname2}}</p>
                                        </div>
                                        <div class="flex accidentContent">
                                            <p class="text-gray-400 mr-1">Tipus: </p>
                                            <p class="text-gray-400 mr-5 accidentType">{{$accident->type}}</p>
                                            <p class='text-gray-400 mr-5 accidentDuration'>Durada: {{$accident->duration}}</p>
                                            <p class='text-gray-400 mr-5 accidentStart'>Data Inici: {{$accident->startDate}}</p>
                                            <p class='text-gray-400 accidentEnd'>Data Final: {{$accident->endDate}}</p>
                                        </div>
                                        
                                    </div>
                                    <div class="flex w-2/5 justify-end my-4 gap-1">
                                        <a href="{{route('accidentability.downloadAccident',$accident)}}" class="font-bold text-orange-500 m-0.5 border-2 rounded-full border-orange-300 bg-orange-100 hover:bg-orange-200 flex w-2/4 justify-center items-center">
                                            Descarregar Fitxa
                                        </a>
                                        <a class="estatBaixa font-bold text-orange-500 m-0.5 border-2 rounded-full border-orange-300 bg-orange-100 hover:bg-orange-200 flex w-2/4 justify-center items-center">
                                            <input hidden value="{{$accident->id}}">
                                            <span>En Baixa</span>
                                        </a>
                                    </div>
                                </button>
                                <div x-show="open" x-collapse class="bg-white px-6 py-4 border-t border-orange-100">
                                    <div class="flex justify-between">
                                        <p class="w-3/5">{{$accident->description}}</p>
                                        <img src="{{$accident->signature}}" alt="firma" class="border-b-2 border-gray-300 border-dashed w-2/6">
                                    </div>
                                    
                                </div>
                            </li>
                        </div>
                    @empty
                        <div class="text-center py-12">
                            <p class="text-xl text-gray-500">No hi han accidents encara.</p>
                            <p class="mt-2 text-gray-400">Comença afegint-ne un</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
        
    </div>


@vite(['resources/js/accidentability.js'])
@vite(['resources/js/canvas.js'])
@endsection