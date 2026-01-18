@extends('../layouts.app')

@section('title','Projectes i comisions')

@section('content')

<div id="toast-container" class="fixed top-5 right-5 space-y-3 z-[9999]"></div>

<div id="test" class="min-h-screen bg-slate-50 flex flex-col items-center justify-start py-10 px-6">
    <div class="w-full max-w-7xl flex flex-col lg:flex-row gap-10">
        
        <div class="bg-white w-full lg:w-1/2 rounded-2xl shadow-lg p-6 border border-orange-200">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-orange-500 mb-6 ">Projectes/Comisions disponibles</h2>
                <x-project-comision-create-modal :centers="$centers" :professionals="$professionals"/> <!--esta igual que cursos i no funciona, Chat GPT m'ha dit que fiqui aixo, ni idea pero funciona,-->
                <a href="{{ route('assigned.export') }}" class="btn btn-success bg-green-500 text-white  flex-row gap-3 px-4 py-3 rounded-full flex items-center justify-center">
                    <x-lucide-file-spreadsheet class="h-4 w-4"/>Exportar
                </a>
            </div>
            <ul id="projectesComisions" class="space-y-4">
           
                @forelse($projectscomisions as $project_comision)
                    <li
                        id="{{$project_comision->id}}"
                        x-data="{ open: false }"
                        class="border border-orange-300 rounded-2xl shadow hover:shadow-md transition overflow-hidden bg-white"
                    >
                        <input type="number" name="num" id="idPrCo" hidden>
                        <button 
                            @click="open = !open"
                            class="w-full flex justify-between items-center px-5 py-4 bg-orange-50 hover:bg-orange-200 transition"
                        >
                            <div>
                                <p class="font-semibold text-orange-500 text-lg">{{ $project_comision->name }}</p>
                                <span class="text-xs text-gray-500">
                                    <p>data</p>
                                </span>
                            </div>
                            <div class="flex items-center gap-3">
                                <x-project-comision-edit-modal :centers="$centers" :project_comision="$project_comision"/>
                                <span class="text-xs font-bold px-3 py-1 rounded-full bg-green-100 text-green-700">
                                    {{ ucfirst($project_comision->type) }}
                                </span>
                                <x-lucide-chevron-down x-show="!open" class="h-5 w-5 text-orange-500" />
                                <x-lucide-chevron-up x-show="open" class="h-5 w-5 text-orange-500" />
                            </div>
                        </button>

                        <div x-show="open" x-collapse class="bg-white px-6 py-4 border-t border-orange-100">
                            <p class="text-gray-600 text-sm mb-3">{{ $project_comision->description }}</p>

                            <ul class="text-sm space-y-1 text-gray-700">

                                <li><b class="text-orange-500">Tipo:</b> {{ ucfirst($project_comision->type ?? 'No especificado') }}</li>
                                <li><b class="text-orange-500">Centro:</b> {{ $project_comision->center->name ?? 'No asignado' }}</li>
                                <li><b class="text-orange-500">Profesional:</b> {{ $project_comision->professional->name ?? 'No asignat' }}</li>
                            </ul>

                            
                            @if($project_comision->projectcomisionAssigned->isNotEmpty())
                                <div class="overflow-x-auto rounded-xl border border-orange-200 mt-2">
                                    <table class="min-w-full text-sm text-left text-gray-700">
                                        <thead class="bg-orange-100 text-orange-500 uppercase font-semibold">
                                            <tr>
                                                <th class="px-4 py-2">Nom</th>
                                                <th class="px-4 py-2">Cognom</th>
                                                <th class="px-4 py-2"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($project_comision->projectcomisionAssigned as $enrollment)
                                                <tr class="border-b hover:bg-orange-50 transition">
                                                    <td class="px-4 py-2">
                                                        {{ $enrollment->professional->name ?? 'Sin nombre' }}
                                                    </td>
                                                    <td class="px-4 py-2">
                                                        {{ $enrollment->professional->surname1 ?? '' }} {{ $enrollment->professional->surname2 ?? '' }}
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('removeAssignation.projectComissionAssignment', ['idPC' => $project_comision->id, 'idProf' => $enrollment->professional->id]) }}">Desassignar</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <p class="text-gray-500 text-sm italic mt-2">No hi han profesionales assignats.</p>
                            @endif
                        </div>
                    </li>
                @empty
                    <li class="bg-gray-100 p-4 rounded-xl text-gray-500 text-center">
                        No hi han Projectes/Comisions disponibles.
                    </li>
                @endforelse
            </ul>
            

        </div>

        <div class="bg-white w-full lg:w-1/2 rounded-2xl shadow-lg p-6 border border-orange-200">
            <h2 class="text-2xl font-bold text-orange-500 mb-3">Profesionales</h2>

            <div class="h-80 overflow-y-auto rounded-xl border border-orange-300 p-4 bg-slate-50">
                <ul id="professionals" class="space-y-3 text-gray-800">
                    @forelse($professionals as $professional)
                        <li draggable="true" id="{{$professional->id}}" class="p-3 bg-white rounded-lg  flex justify-center items-center gap-10 border border-orange-200 hover:bg-orange-100 cursor-move font-medium shadow-sm">
                            <x-lucide-user class="h-5 text-orange-500"/> 
                            <h1>
                                {{ $professional->name }} {{ $professional->surname1 }} {{ $professional->surname2 }}
                            </h1>
                            <input type="number" name="num" id="idP" hidden>
                        </li>
                    @empty
                        <li class="text-gray-500 text-center">No hay profesionales registrados.</li>
                    @endforelse
                </ul>
            </div>
        </div>

    </div>
    
</div>

@vite(['resources/js/project-comisions.js'])
@endsection