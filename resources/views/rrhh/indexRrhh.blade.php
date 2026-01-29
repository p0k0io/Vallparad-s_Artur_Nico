@extends('../layouts.app')

@section('title','RRHH')

@section('content')

    <div class="min-h-screen bg-slate-100 py-16 px-6 flex flex-col items-center">
        <div class="w-full max-w-5xl">
            <div class="text-center mb-12">
                <h1 class="text-4xl font-extrabold text-orange-500 mb-3 tracking-tight">
                    Temas Pendents de RH
                </h1>
                <p class="text-lg text-gray-600">
                    Gestio de Temas Pendents de RH
                </p>
            </div>
            <div class="bg-white rounded-3xl shadow-xl p-10 border-2 border-orange-200">

                <!-- cabecera con titulo y boton crear -->
                <div class="flex justify-between items-center mb-10 pb-6 border-b-2 border-orange-100">
                    <h2 class="text-3xl font-bold text-gray-800">Llista de Temas Pendents de RH</h2>

                    <!-- boto crear manteniment -->
                    <div x-data="{ openCreate:false }">
                        <button 
                            @click="openCreate = true"
                            class="flex items-center gap-3 px-8 py-4 rounded-full bg-orange-500 hover:bg-orange-600 text-white font-semibold shadow-md hover:shadow-lg hover:scale-[1.02] transition-all duration-300"
                        >
                            <x-lucide-plus class="w-6 h-6"/>
                            Fer RRHH
                        </button>

                        <div 
                            x-show="openCreate" 
                            
                            class="fixed inset-0 backdrop-blur-sm bg-black/40 flex items-center justify-center z-50 px-4"
                        >
                            <div class="bg-white/95 rounded-3xl p-6 w-full max-w-lg shadow-xl border border-orange-200"
                                @click.outside="openCreate=false"
                            >
                                <h1 class="text-orange-500 font-bold text-2xl text-center mb-6 ">Fer RRHH</h1>
                                
                                <div id="rrhhForm">
                                    <form action="{{route('rrhh.store')}}" method="POST" class="space-y-4" enctype="multipart/form-data">
                                    @csrf
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
                                        <div>
                                            <label class="block text-sm text-orange-600 mb-1 font-medium">Profesional afectat</label>
                                            <select name="professional_afectat" required
                                                class="w-full border border-orange-200 bg-orange-50 focus:border-orange-400 focus:ring-orange-400 px-3 py-2 rounded-xl outline-none transition"
                                            >
                                                @foreach($professionals as $professional)
                                                    <option value="{{ $professional->id }}">{{ $professional->name }} {{ $professional->surname1 }} {{ $professional->surname2 }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div>
                                            <label class="block text-sm text-orange-600 mb-1 font-medium">Profesional derivat</label>
                                            <select name="professional_derivat" required
                                                class="w-full border border-orange-200 bg-orange-50 focus:border-orange-400 focus:ring-orange-400 px-3 py-2 rounded-xl outline-none transition"
                                            >
                                                @foreach($professionals as $professional)
                                                    <option value="{{ $professional->id }}">{{ $professional->name }} {{ $professional->surname1 }} {{ $professional->surname2 }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Documents</label>
                                            <input type="file" id="files" name="files[]" multiple class="w-full border-gray-300 focus:border-orange-500 focus:ring-orange-500">
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
                                        <button type="submit" class="px-4 py-2 rounded-full bg-orange-500 hover:bg-orange-600 text-white font-medium shadow-md transition w-full">
                                            Crear
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- llista de manteniments -->
                <div class="space-y-6">
                    @forelse($rrhhs as $rrhh)
                        <div class="hover:-translate-y-1 transition-all duration-300">
                                <li x-data="{ open: false }" class="liMaintCard border border-orange-200 rounded-xl overflow-hidden m-3">
                                    <button @click="open = !open" class="bg-orange-50 hover:bg-orange-100 w-full text-left transition py-1 flex px-3">       
                                        <div class="flex flex-col w-3/5">
                                            <h2 class="cardTitle text-orange-500 text-2xl">{{$rrhh->context}}</h1>
                                            <div class="flex">
                                                <p class="text-gray-400 mr-5">Obert: {{$rrhh->created_at}}</p>
                                                <p class="text-gray-400 mr-5">Creada Per: {{$rrhh->professional->name}} {{$rrhh->professional->surname1}} {{$rrhh->professional->surname2}}</p>
                                            </div>
                                            <div class="flex">
                                                <p class='text-gray-400 mr-5'>Afectat: {{$rrhh->afectat->name}} {{$rrhh->afectat->surname1}} {{$rrhh->afectat->surname2}}</p>
                                                <p class='text-gray-400 mr-5'>Derivat: {{$rrhh->derivat->name}} {{$rrhh->derivat->surname1}} {{$rrhh->derivat->surname2}}</p>
                                            </div>
                                            
                                        </div>

                                        <div class="flex w-2/5 justify-end my-4 gap-1">

                                            @if($rrhh->status=="Pendent")
                                                <a class="ferSeguiment font-bold text-orange-500 m-0.5 border-2 rounded-full border-orange-300 bg-orange-100 hover:bg-orange-200 transition flex w-2/4 justify-center items-center">
                                            @else
                                                <a class="ferSeguiment font-bold text-orange-500 m-0.5 border-2 rounded-full border-orange-300 bg-orange-100 hover:bg-orange-200 transition hidden w-2/4 justify-center items-center">
                                            @endif
                                                Fer Seguiment

                                                <div class="fixed inset-0 backdrop-blur-sm items-center justify-center hidden">
                                                    <div class="bg-white/95 rounded-3xl p-6 w-full max-w-lg shadow-xl border border-orange-200">
                                                        <h1 class="text-orange-500 font-bold text-2xl text-center mb-6 ">
                                                            Fer Seguiment
                                                        </h1>
                                                        <form action="{{route('createRrhhTracking.rrhh')}}" method="POST" class="space-y-4">
                                                            @csrf
                                                            <input type="hidden" name="rrhh_id" value="{{$rrhh->id}}">
                                                            <div>
                                                                <label class="block text-sm text-orange-600 mb-1 font-medium">Context</label>
                                                                <input type="text" name="context" required
                                                                    class="w-full border border-orange-200 bg-orange-50 focus:border-orange-400 focus:ring-orange-400 px-3 py-2 rounded-xl outline-none transition"
                                                                >
                                                            </div>
                                                            <div>
                                                                <label class="block text-sm text-orange-600 mb-1 font-medium">Descripcio</label>
                                                                <input type="text" name="description" required
                                                                    class="w-full border border-orange-200 bg-orange-50 focus:border-orange-400 focus:ring-orange-400 px-3 py-2 rounded-xl outline-none transition"
                                                                >
                                                            </div>
                                                            <input type="submit" value="Crear" class="px-4 py-2 rounded-full bg-orange-500 hover:bg-orange-600 text-white font-medium shadow-md transition w-full">
                                                        </form>
                                                    </div>
                                                </div>

                                            </a>

                                                <a class="canviarStatus font-bold text-orange-500 m-0.5 border-2 rounded-full border-orange-300 bg-orange-100 hover:bg-orange-200 transition flex w-2/4 justify-center items-center">

                                                <input hidden value="{{$rrhh->id}}">
                                                <span>{{$rrhh->status}}</span>
                                            </a>
                                        </div>
                                    </button>

                                    <div x-show="open" x-collapse class="bottomDiv bg-white px-6 py-4 border-t border-orange-100">
                                        <div class="pb-3 text-gray-500 flex justify-between">
                                            <p class="w-3/5">{{$rrhh->description}}</p>
                                            <img src="{{$rrhh->signature}}" alt="firma" class="border-b-2 border-gray-300 border-dashed w-2/6">
                                        </div>
                                        <ul class="mt-2 space-y-1 mb-2">
                                            @foreach ($rrhh->documents as $document)
                                                <li class="flex justify-between items-center border-b-2">
                                                    <span class="text-gray-500">
                                                        {{ basename($document->path) }}
                                                    </span>

                                                    <a href="{{ route('rrhhDocument.download', $document) }}"
                                                    class="text-sm text-orange-600 hover:underline">
                                                        Descarregar
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                        <div class="rounded-xl border border-spacing-5 border-gray-300 border-dashed">
                                            <ul>
                                                @forelse($rrhh->rrhhTrackings as $tracking)
                                                    <li x-data="{ open: false }" class="border border-orange-300 rounded-xl m-2 overflow-hidden">
                                                        <button
                                                            @click="open=!open"
                                                            class="bg-orange-50 hover:bg-orange-100 w-full text-left transition py-1"
                                                        >
                                                        <div class="flex justify-between">
                                                            <p class="text-orange-500 pl-5 text-xl">
                                                                {{$tracking->context}}
                                                            </p>
                                                            <p class="text-lg pr-5 text-orange-400">
                                                                Qui fa el seguiment {{$tracking->created_at}}
                                                            </p>
                                                        </div>
                                                        </button>
                                                        <div x-show="open" class="bg-white px-6 py-4 border-t border-orange-100 rounded-b-xl">
                                                            <p>
                                                                {{$tracking->description}}
                                                            </p>
                                                        </div>
                                                    </li>
                                                @empty
                                                    <h2 class="text-2xl font-bold text-gray-400 text-center my-5">No s'ha trobat ningun tema pendent</h1>
                                                @endforelse
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                        </div>
                    @empty
                        <div class="text-center py-12">
                            <p class="text-xl text-gray-500">No hi han manteniments tema pendent.</p>
                            <p class="mt-2 text-gray-400">Comença afegint-ne un</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
        
    </div>

@vite(['resources/js/rrhh.js'])
@vite(['resources/js/canvas.js'])
@endsection