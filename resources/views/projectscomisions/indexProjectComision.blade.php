@extends('../layouts.app')

@section('title','Projectes i comisions')

@section('content')

<div id="toast-container" class="fixed top-5 right-5 space-y-3 z-[9999]"></div>

<div id="test" class="min-h-screen bg-slate-100 py-16 px-6 flex flex-col items-center">
    <div class="w-full max-w-7xl">
        <div class="text-center mb-14">
            <h1 class="text-4xl font-extrabold text-orange-500 mb-3 tracking-tight">
                Gestión de Projectes i Comisions
            </h1>
            <p class="text-lg text-gray-600">
                Asignación de profesionales
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <div class="bg-white rounded-3xl shadow-xl p-8 border-2 border-orange-200">
                <div class="flex justify-between items-center mb-8 pb-6 border-b-2 border-orange-100">
                    <h2 class="w-2/4 text-2xl font-bold text-gray-800">Projectes/Comisions disponibles</h2>
                    <div class="flex gap-4">
                        <x-project-comision-create-modal :centers="$centers" :professionals="$professionals"/>
                        
                        <a href="{{ route('assigned.export') }}" class="flex items-center gap-3 px-6 py-3 rounded-full bg-green-500 hover:bg-green-600 text-white font-semibold shadow-md transition">
                            <x-lucide-file-spreadsheet class="h-4 w-4"/>Exportar
                        </a>
                    </div>
                    
                </div>
                <ul class="space-y-6" id="projectesComisions" class="space-y-4">
            
                    @forelse($projectscomisions as $project_comision)
                        <li
                            id="{{$project_comision->id}}"
                            x-data="{ open: false }"
                            class="rounded-2xl border border-orange-200 shadow hover:shadow-lg transition overflow-hidden"
                        >
                            <input type="number" name="num" id="idPrCo" hidden>
                            <button 
                                @click="open = !open"
                                class="w-full flex justify-between items-center px-6 py-5 bg-orange-50 hover:bg-orange-100 transition"
                            >
                                <div>
                                    <p class="font-bold text-orange-600 text-lg">{{ $project_comision->name }}</p>
                                    <span class="text-xs text-gray-500">
                                        <p>data</p>
                                    </span>
                                </div>
                                <div class="flex items-center gap-4">
                                    
                                    <span class="text-xs font-bold px-4 py-1 rounded-full bg-green-100 text-green-700">
                                        {{ ucfirst($project_comision->type) }}
                                    </span>
                                    <x-lucide-chevron-down x-show="!open" class="h-5 w-5 text-orange-500" />
                                    <x-lucide-chevron-up x-show="open" class="h-5 w-5 text-orange-500" />
                                </div>
                            </button>

                            <div x-show="open" x-collapse class="bg-white px-6 py-6 border-t border-orange-100">
                                <p class="text-gray-600 text-sm mb-4">{{ $project_comision->description }}</p>

                                <ul class="text-sm space-y-2 text-gray-700 mb-6">

                                    <li><b class="text-orange-500">Tipo:</b> {{ ucfirst($project_comision->type ?? 'No especificado') }}</li>
                                    <li><b class="text-orange-500">Centro:</b> {{ $project_comision->center->name ?? 'No asignado' }}</li>
                                    <li><b class="text-orange-500">Profesional:</b> {{ $project_comision->professional->name ?? 'No asignat' }}</li>
                                </ul>

                                
                                @if($project_comision->projectcomisionAssigned->isNotEmpty())
                                    <div class="overflow-x-auto rounded-2xl border border-orange-200">
                                        <table class="min-w-full text-sm text-gray-700">
                                            <thead class="bg-orange-100 text-orange-600 font-bold">
                                                <tr>
                                                    <th class="px-4 py-3">Nom</th>
                                                    <th class="px-4 py-3">Cognom</th>
                                                    <th class="px-4 py-3"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($project_comision->projectcomisionAssigned as $enrollment)
                                                    <tr class="border-t hover:bg-orange-50 transition">
                                                        <td class="px-4 py-3">
                                                            {{ $enrollment->professional->name ?? 'Sin nombre' }}
                                                        </td>
                                                        <td class="px-4 py-3">
                                                            {{ $enrollment->professional->surname1 ?? '' }} {{ $enrollment->professional->surname2 ?? '' }}
                                                        </td>
                                                        <td class=>
                                                            <a class="bg-red-600 text-white py-1 px-4 rounded-lg" href="{{ route('removeAssignation.projectComissionAssignment', ['idPC' => $project_comision->id, 'idProf' => $enrollment->professional->id]) }}">Desassignar</a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <p class="text-gray-500 italic ">No hi han profesionales assignats.</p>
                                @endif
                            </div>
                        </li>
                    @empty
                        <li class="text-center text-gray-500 py-10">
                            No hi han Projectes/Comisions disponibles.
                        </li>
                    @endforelse
                </ul>
                

            </div>

            <div class="bg-white rounded-3xl shadow-xl p-8 border-2 border-orange-200">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Profesionales</h2>

                <div class="h-96 overflow-y-auto rounded-2xl border border-orange-200 bg-orange-50 p-4">
                    <ul id="professionals" class="space-y-4">
                        @forelse($professionals as $professional)
                            <li draggable="true" id="{{$professional->id}}" class="flex items-center gap-4 bg-white px-6 py-4 rounded-2xl shadow hover:shadow-lg hover:bg-orange-100 transition cursor-move font-medium">
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
    
</div>

@vite(['resources/js/project-comisions.js'])
@endsection