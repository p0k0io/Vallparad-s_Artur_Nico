@extends('../layouts.app')

@section('title','Accidentability')

@section('content')
    <div class="min-h-screen bg-slate-100 py-16 px-6 flex flex-col items-center">
        <div class="w-full max-w-5xl">
            <div class="text-center mb-12">
                <h1 class="text-4xl font-extrabold text-orange-500 mb-3 tracking-tight">
                    Accidents de {{ $professional->name }} {{ $professional->surname1 }} {{ $professional->surname2 }}
                </h1>
                <p class="text-lg text-gray-600">
                    Gestio d'accidents
                </p>
            </div>
            <div class="bg-white rounded-3xl shadow-xl p-10 border-2 border-orange-200">

                <!-- cabecera con titulo y boton crear -->
                <div class="flex justify-between items-center pb-6">
                    <h2 class="text-3xl font-bold text-gray-800">Llista d'accidents</h2>

                    <!-- boto crear manteniment -->
                    <div x-data="{ openCreate:false }">
                        <button 
                            @click="openCreate = true"
                            class="flex items-center gap-3 px-8 py-4 rounded-full bg-orange-500 hover:bg-orange-600 text-white font-semibold shadow-md hover:shadow-lg hover:scale-[1.02] transition-all duration-300"
                        >
                            <x-lucide-plus class="w-6 h-6"/>
                            Fer Incidencia
                        </button>

                        <div 
                            x-show="openCreate" 
                            class="fixed inset-0 backdrop-blur-sm bg-black/40 flex items-center justify-center z-50 px-4"
                        >
                            <div class="bg-white/95 rounded-3xl p-6 w-full max-w-lg shadow-xl border border-orange-200"
                                @click.outside="openCreate=false"
                            >
                                <h1 class="text-orange-500 font-bold text-2xl text-center mb-6 ">Fer Accidentabilitat</h1>

                                <div id="accidentabilityForm">
                                    <form action="{{route('accidentability.store')}}" method="POST" class="space-y-4">
                                    @csrf
                                        <label class="block text-sm text-orange-600 mb-1 font-medium">Tipus de Baixa</label>
                                        <input type="hidden" name="professional_id" value="{{ $professional->id }}">
                                        <select id="baixaSelect" name="type" class="w-full border border-orange-200 bg-orange-50 focus:border-orange-400 focus:ring-orange-400 px-3 py-2 rounded-xl outline-none transition">
                                            <option value="Sense Baixa" selected>Sense Baixa</option>
                                            <option value="Amb Baixa">Amb Baixa</option>
                                            @if (Auth::user()->role === 'Equip Directiu' || Auth::user()->role === 'Administracio')
                                            <option value="Baixa Llarga">Baixa Llarga</option>
                                            @endif
                                        </select>
                                        <div>
                                            <label class="block text-sm text-orange-600 mb-1 font-medium">Context</label>
                                            <input type="text" name="context" required
                                                class="w-full border border-orange-200 bg-orange-50 focus:border-orange-400 focus:ring-orange-400 px-3 py-2 rounded-xl outline-none transition"
                                            >
                                        </div>
                                        <div>
                                            <label class="block text-sm text-orange-600 mb-1 font-medium">Descripció</label>
                                            <textarea name="description" required
                                                class="w-full border border-orange-200 bg-orange-50 focus:border-orange-400 focus:ring-orange-400 px-3 py-2 rounded-xl outline-none transition"
                                            ></textarea>
                                        </div>
                                        <div id="durationInput" class="hidden">
                                            <label class="block text-sm text-orange-600 mb-1 font-medium">Durada</label>
                                            <input type="text" name="duration"
                                                class="w-full border border-orange-200 bg-orange-50 focus:border-orange-400 focus:ring-orange-400 px-3 py-2 rounded-xl outline-none transition"
                                            >
                                        </div>
                                        <div id="startDate" class="hidden">
                                            <label class="block text-sm text-orange-600 mb-1 font-medium">Data Inici</label>
                                            <input type="date" name="startDate"
                                                class="w-full border border-orange-200 bg-orange-50 focus:border-orange-400 focus:ring-orange-400 px-3 py-2 rounded-xl outline-none transition"
                                            >
                                        </div>
                                        <div id="endDate" class="hidden">
                                            <label class="block text-sm text-orange-600 mb-1 font-medium">Data Final</label>
                                            <input type="date" name="endDate"
                                                class="w-full border border-orange-200 bg-orange-50 focus:border-orange-400 focus:ring-orange-400 px-3 py-2 rounded-xl outline-none transition"
                                            >
                                        </div>
                                        <div>
                                            <label class="block text-sm text-orange-600 mb-1 font-medium">Firma</label>
                                            <div class="border border-orange-200 rounded-xl overflow-hidden">
                                                <div class="bg-orange-50 border-b-2 border-orange-200 p-2 flex justify-between">
                                                    <a id="clear" class="border-b-2 border-orange-300 text-orange-600">Netejar</a>
                                                    <a id="guardar" class="border-b-2 border-orange-300 text-orange-600">Guardar</a>
                                                </div>
                                                <div class="h-36">
                                                    <canvas width="460" height="144" id="canvas" class="border-orange-200 bg-white"></canvas>
                                                </div>
                                            </div>
                                            <input type="hidden" id="signature" name="signature">
                                        </div>
                                        <button type="submit" class="px-4 py-2 rounded-full bg-orange-500 hover:bg-orange-600 text-white font-medium shadow-md transition">
                                            Crear
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <form action="{{ route('searchAccidents.accidents',$professional) }}" method="POST" class="flex justify-between items-center mb-6 border-b-2">
                @csrf
                    <input type="text" name="search" class="w-11/12 border-0 bg-transparent px-3 py-2 outline-none ring-0 focus:ring-0 transition-all" placeholder="Busca accidents...">
                    <button type="submit" class="w-1/12 flex justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search-icon lucide-search"><path d="m21 21-4.34-4.34"/><circle cx="11" cy="11" r="8"/></svg>
                    </button>
                </form>

                <!-- llista de manteniments -->
                <div class="space-y-6">
                    @forelse($accidents as $accident)
                        <div class="divMaintCard transition-all duration-300">
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
                                        @if ($accident->status != "Sense Baixa")
                                            <a class="estatBaixa font-bold text-orange-500 m-0.5 border-2 rounded-full border-orange-300 bg-orange-100 hover:bg-orange-200 flex w-2/4 justify-center items-center">
                                                <input hidden value="{{$accident->id}}">
                                                <span>En Baixa</span>
                                            </a>
                                        @endif
                                        
                                    </div>
                                </button>
                                <div x-show="open" x-collapse class="bg-white px-6 pb-4 border-t border-orange-100">
                                    <div class="flex mb-4 w-full bg-white border-b border-l border-r border-orange-100 rounded-b-lg overflow-hidden">
                                        <a class="openEdit w-full text-gray-500 text-center px-4 py-2 hover:bg-orange-50 transition border-r border-orange-100">
                                            Editar
                                        </a>
                                        <a href="{{ route('accident.delete',['id'=>$accident->id, 'professional'=>$professional] )}}" class="w-full text-center px-4 py-2 text-red-600 hover:bg-orange-50 transition ">
                                            Eliminar
                                        </a>
                                    </div>
                                    <div class="flex justify-between">
                                        <p class="w-3/5">{{$accident->description}}</p>
                                        <img src="{{$accident->signature}}" alt="firma" class="border-b-2 border-gray-300 border-dashed w-2/6">
                                    </div>
                                    
                                </div>
                            </li>

                            <!--Edit-->
                            <div class="editForm fixed inset-0 backdrop-blur-sm bg-black/40  items-center justify-center z-50 px-4 hidden">
                                <div class="bg-white/95 rounded-3xl p-6 w-full max-w-lg shadow-xl border border-orange-200">
                                    <button class="closeEdit w-full text-right text-gray-500">
                                        ✕
                                    </button>
                                    <h1 class="text-orange-500 font-bold text-2xl text-center mb-6 ">Fer Accidentabilitat</h1>

                                    <div id="accidentabilityForm">
                                        <form action="{{route('accidentability.update', $accident)}}" method="POST" class="space-y-4">
                                        @csrf
                                        @method('PUT')
                                            <input type="hidden" name="professional_id" value="{{ $accident->professional_id }}">
                                            <div>
                                                <label class="block text-sm text-orange-600 mb-1 font-medium">Context</label>
                                                <input type="text" name="context" value="{{ $accident->context }}"
                                                    class="w-full border border-orange-200 bg-orange-50 focus:border-orange-400 focus:ring-orange-400 px-3 py-2 rounded-xl outline-none transition"
                                                >
                                            </div>
                                            <div>
                                                <label class="block text-sm text-orange-600 mb-1 font-medium">Descripció</label>
                                                <textarea name="description"
                                                    class="w-full border border-orange-200 bg-orange-50 focus:border-orange-400 focus:ring-orange-400 px-3 py-2 rounded-xl outline-none transition"
                                                >{{ $accident->description }}</textarea>
                                            </div>

                                            @if($accident->type=="Amb Baixa")
                                                <div id="durationInput">
                                                    <label class="block text-sm text-orange-600 mb-1 font-medium">Durada</label>
                                                    <input type="text" name="duration" value="{{ $accident->duration }}"
                                                        class="w-full border border-orange-200 bg-orange-50 focus:border-orange-400 focus:ring-orange-400 px-3 py-2 rounded-xl outline-none transition"
                                                    >
                                                </div>
                                            @endif

                                            @if($accident->type=="Baixa Llarga")
                                                <div id="startDate">
                                                    <label class="block text-sm text-orange-600 mb-1 font-medium">Data Inici</label>
                                                    <input type="date" name="startDate" value="{{ $accident->startDate }}"
                                                        class="w-full border border-orange-200 bg-orange-50 focus:border-orange-400 focus:ring-orange-400 px-3 py-2 rounded-xl outline-none transition"
                                                    >
                                                </div>
                                            @endif

                                            @if($accident->type=="Baixa Llarga")
                                                <div id="endDate">
                                                    <label class="block text-sm text-orange-600 mb-1 font-medium">Data Final</label>
                                                    <input type="date" name="endDate" value="{{ $accident->endDate }}"
                                                        class="w-full border border-orange-200 bg-orange-50 focus:border-orange-400 focus:ring-orange-400 px-3 py-2 rounded-xl outline-none transition"
                                                    >
                                                </div>
                                            @endif

                                            <button type="submit" class="px-4 py-2 rounded-full bg-orange-500 hover:bg-orange-600 text-white font-medium shadow-md transition">
                                                Guardar
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
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