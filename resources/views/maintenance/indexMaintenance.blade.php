@extends('../layouts.app')

@section('title','Maintenance')

@section('content')
    <div class="min-h-screen bg-slate-100 py-16 px-6 flex flex-col items-center">
        <div class="w-full max-w-5xl">
            <div class="text-center mb-12">
                <h1 class="text-4xl font-extrabold text-orange-500 mb-3 tracking-tight">
                    Manteniments
                </h1>
                <p class="text-lg text-gray-600">
                    Gestio de manteniments
                </p>
            </div>
            <div class="bg-white rounded-3xl shadow-xl p-10 border-2 border-orange-200">

                <!-- cabecera con titulo y boton crear -->
                <div class="flex justify-between items-center pb-6">
                    <h2 class="text-3xl font-bold text-gray-800">Llista de manteniments</h2>

                    <!-- boto crear manteniment -->
                    <x-create-maintenance/>
                </div>
                <form action="{{ route('searchMaintenances.maintenance') }}" method="POST" class="flex justify-between items-center mb-6 border-b-2">
                    @csrf
                    <input type="text" name="search" id="searchMaintenances" class="w-11/12 border-0 bg-transparent px-3 py-2 outline-none ring-0 focus:ring-0 transition-all" placeholder="Busca manteniments amb el context o el responsable...">
                    <button type="submit" class="w-1/12 flex justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search-icon lucide-search"><path d="m21 21-4.34-4.34"/><circle cx="11" cy="11" r="8"/></svg>
                    </button>
                </form>
                <!-- llista de manteniments -->
                <div id="resultat" class="space-y-6">
                    @forelse($maintenances as $maintenance)
                        <div class="divMaintCard transition-all duration-300">
                                <li x-data="{ open: false }" class="liMaintCard border border-orange-200 rounded-xl overflow-hidden m-3">
                                    <button @click="open = !open" class="bg-orange-50 hover:bg-orange-100 w-full text-left transition py-1 flex px-3">
                                        <div class="flex flex-col w-4/6">
                                            <h2 class="cardTitle text-orange-500 text-2xl">{{$maintenance->context}}</h1>
                                            <div class="flex">
                                                <p class="text-gray-400 mr-5">Obert: {{$maintenance->created_at}}</p> <p class="text-gray-400 mr-5">Responsable: {{$maintenance->responsible}} </p>
                                            </div>
                                            <p class="text-gray-400 mr-5">Creada Per: {{$maintenance->professional->name}} {{$maintenance->professional->surname1}} {{$maintenance->professional->surname2}}</p>
                                        </div>
                                        <div class="flex w-2/6 justify-end my-4 gap-1">
                                            @if($maintenance->status=="Pendent")
                                                <a class="ferSeguiment font-bold text-orange-500 m-0.5 border-2 rounded-full border-orange-300 bg-orange-100 hover:bg-orange-200 transition flex w-2/4 justify-center items-center">
                                                    Fer Seguiment
                                            @else
                                                <a class="ferSeguiment font-bold text-orange-500 m-0.5 border-2 rounded-full border-orange-300 bg-orange-100 hover:bg-orange-200 transition hidden w-2/4 justify-center items-center">
                                                    Fer Seguiment
                                            @endif
                                                
                                                
                                            </a>
                                                <a class="canviarStatus font-bold text-orange-500 m-0.5 border-2 rounded-full border-orange-300 bg-orange-100 hover:bg-orange-200 transition flex w-2/4 justify-center items-center">
                                                <input hidden value="{{$maintenance->id}}">
                                                <span>{{$maintenance->status}}</span>
                                            </a>
                                        </div>
                                    </button>
                                    <div x-show="open" x-collapse class="bottomDiv bg-white px-6 pb-4 border-t border-orange-100">
                                        <div class="flex mb-4 w-full bg-white border-b border-l border-r border-orange-100 rounded-b-lg overflow-hidden">
                                            <a class="openEdit w-full text-gray-500 text-center px-4 py-2 hover:bg-orange-50 transition border-r border-orange-100">
                                                Editar
                                            </a>
                                            <a href="{{ route('maintenance.delete',$maintenance->id)}}" class="w-full text-center px-4 py-2 text-red-600 hover:bg-orange-50 transition ">
                                                Eliminar
                                            </a>
                                        </div>
                                        <div class="pb-3 text-gray-500 flex justify-between">
                                            <p class="w-3/5">{{$maintenance->description}}</p>
                                            <img src="{{$maintenance->signature}}" alt="firma" class="border-b-2 border-gray-300 border-dashed w-2/6">
                                        </div>
                                        <ul class="mt-2 space-y-1 mb-2">
                                            @foreach ($maintenance->documents as $document)
                                                <li class="flex justify-between items-center border-b-2">
                                                    <span class="text-gray-500">
                                                        {{ basename($document->path) }}
                                                    </span>

                                                    <a href="{{ route('maintenanceDocument.download', $document) }}"
                                                    class="text-sm text-orange-600 hover:underline">
                                                        Descarregar
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                        <div class="rounded-xl border border-spacing-5 border-gray-300 border-dashed h-28 overflow-y-scroll">
                                            <ul>
                                                @forelse($maintenance->maintenanceTrackings as $tracking)
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
                                                    <h2 class="text-2xl font-bold text-gray-400 text-center my-5">No s'ha trobat ningun seguiment</h1>
                                                @endforelse
                                            </ul>
                                        </div>
                                        
                                    </div>
                                    
                                </li>


                            <!--Tracking-->
                            <div class="trackingDiv fixed inset-0 backdrop-blur-sm bg-black/40 items-center justify-center z-50 px-4 hidden">
                                <div class="bg-white/95 rounded-3xl p-6 w-full max-w-lg shadow-xl border border-orange-200 z-50">
                                    <button class="closeTrackingDiv w-full text-right text-gray-500">
                                        ✕
                                    </button>
                                    <h1 class="text-orange-500 font-bold text-2xl text-center mb-6 ">
                                        Fer Seguiment
                                    </h1>
                                    <form action="{{route('createMaintenanceTracking.maintenance')}}" method="POST" class="space-y-4">
                                        @csrf
                                        <input type="hidden" name="maintenance_id" value="{{$maintenance->id}}">
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

                            <!--Editar-->
                            <div 
                                class="editForm fixed inset-0 backdrop-blur-sm bg-black/40  items-center justify-center z-50 px-4 hidden"
                            >
                                <div class="bg-white/95 rounded-3xl p-6 w-full max-w-lg shadow-xl border border-orange-200">
                                    <button class="closeEdit w-full text-right text-gray-500">
                                        ✕
                                    </button>
                                    <h1 class="text-orange-500 font-bold text-2xl text-center mb-6 ">Editar Manteniment</h1>
                                    
                                    <div id="maintenanceForm">
                                        <form action="{{route('maintenance.update',$maintenance)}}" method="POST" class="space-y-4" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                            <div>
                                                <label class="block text-sm text-orange-600 mb-1 font-medium">Context</label>
                                                <input type="text" name="context" required value="{{ $maintenance->context }}"
                                                    class="w-full border border-orange-200 bg-orange-50 focus:border-orange-400 focus:ring-orange-400 px-3 py-2 rounded-xl outline-none transition"
                                                >
                                            </div>
                                            <div>
                                                <label class="block text-sm text-orange-600 mb-1 font-medium">Responsable</label>
                                                <input type="text" name="responsible" required value="{{ $maintenance->responsible }}"
                                                    class="w-full border border-orange-200 bg-orange-50 focus:border-orange-400 focus:ring-orange-400 px-3 py-2 rounded-xl outline-none transition"
                                                >
                                            </div>
                                            <div>
                                                <label class="block text-sm text-orange-600 mb-1 font-medium">Descripció</label>
                                                <textarea name="description" required
                                                    class="w-full border border-orange-200 bg-orange-50 focus:border-orange-400 focus:ring-orange-400 px-3 py-2 rounded-xl outline-none transition"
                                                >{{ $maintenance->description }}</textarea>
                                            </div>
                                            
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Documents (s'eliminaran els documents i es ficaran els actuals)</label>
                                                <input type="file" id="files" name="files[]" multiple class="w-full border-gray-300 focus:border-orange-500 focus:ring-orange-500">
                                            </div>
                                            
                                            <button type="submit" class="crateMaintenanceButton px-4 py-2 rounded-full bg-orange-500 hover:bg-orange-600 text-white font-medium shadow-md transition w-full">
                                                Editar
                                            </button>
                                        </form>
                                    </div>           
                                </div>
                            </div>





                        </div>
                    @empty
                        <div class="text-center py-12">
                            <p class="text-xl text-gray-500">No hi han manteniments encara.</p>
                            <p class="mt-2 text-gray-400">Comença afegint-ne un</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
        
    </div>

@vite(['resources/js/maintenance.js'])
@vite(['resources/js/canvas.js'])
@endsection

