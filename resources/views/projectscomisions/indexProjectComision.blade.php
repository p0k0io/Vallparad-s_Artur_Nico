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
                <div class="flex justify-between items-center pb-6 ">
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
                            class="pjli rounded-2xl border border-orange-200 shadow hover:shadow-lg transition overflow-hidden"
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

                            <div x-show="open" x-collapse class="bg-white px-6 pb-6 border-t border-orange-100">
                                <div class="flex mb-4 w-full bg-white border-b border-l border-r border-orange-100 rounded-b-lg overflow-hidden">
                                            <a class="openEdit w-full text-gray-500 text-center px-4 py-2 hover:bg-orange-50 transition border-r border-orange-100">
                                                Editar
                                            </a>
                                            <a href="{{ route("projectComision.delete", $project_comision) }}" class="w-full text-center px-4 py-2 text-red-600 hover:bg-orange-50 transition ">
                                                Eliminar
                                            </a>
                                        </div>
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
                        
                            <!-- Edit -->
                            <div 
                                class="editForm  fixed inset-0 backdrop-blur-sm bg-black/40 items-center justify-center z-50 px-4 hidden"
                            >
                                <div class="bg-white/95 rounded-3xl p-6 w-full max-w-lg shadow-xl border border-orange-200"
                                >
                                    <h2 class="text-xl font-semibold text-orange-600 mb-6">
                                        Editar Projecte/Comisio
                                    </h2>

                                    <form action="{{ route('projects_comisions.update',$project_comision) }}" method="POST" class="space-y-4">
                                        @csrf
                                        @method('PUT')

                                        <div>
                                            <label class="block text-sm text-orange-600 mb-1 font-medium">Nom del Projecte/Comisio</label>
                                            <input type="text" name="name" required value="{{ $project_comision->name }}"
                                                class="w-full border border-orange-200 bg-orange-50 focus:border-orange-400 focus:ring-orange-400 px-3 py-2 rounded-xl outline-none transition"
                                            >
                                        </div>

                                        <div>
                                            <label class="block text-sm text-orange-600 mb-1 font-medium">Descripció</label>
                                            <textarea name="description"
                                                class="w-full border border-orange-200 bg-orange-50 focus:border-orange-400 focus:ring-orange-400 px-3 py-2 rounded-xl outline-none transition"
                                            >{{ $project_comision->description }}</textarea>
                                        </div>

                                        <div>
                                            <label class="block text-sm text-orange-600 mb-1 font-medium">Observacions</label>
                                            <textarea name="observations"
                                                class="w-full border border-orange-200 bg-orange-50 focus:border-orange-400 focus:ring-orange-400 px-3 py-2 rounded-xl outline-none transition"
                                            >{{ $project_comision->observations }}</textarea>
                                        </div>

                                        <div>
                                            <label class="block text-sm text-orange-600 mb-1 font-medium">Data inici</label>
                                            <input type="date" name="startDate" value="{{ $project_comision->startDate }}" class="w-full border border-orange-200 bg-orange-50 focus:border-orange-400 focus:ring-orange-400 px-3 py-2 rounded-xl outline-none transition">
                                        </div>
                                        <div>
                                            <label class="block text-sm text-orange-600 mb-1 font-medium">Data final</label>
                                            <input type="date" name="startDate" value="{{ $project_comision->startDate }}" class="w-full border border-orange-200 bg-orange-50 focus:border-orange-400 focus:ring-orange-400 px-3 py-2 rounded-xl outline-none transition">
                                        </div>

                                        <div class="grid grid-cols-2 gap-3">
                                            <div>
                                                <label class="block text-sm text-orange-600 mb-1 font-medium">Tipus</label>
                                                <select name="type" required 
                                                    class="w-full border border-orange-200 bg-orange-50 focus:border-orange-400 focus:ring-orange-400 px-3 py-2 rounded-xl outline-none transition"
                                                >
                                                    <option value="project">Projecte</option>
                                                    <option value="comision">Comisio</option>
                                                </select>
                                            </div>
                                            <div>
                                                <label class="block text-sm text-orange-600 mb-1 font-medium">Profesional</label>
                                                <select name="professional_id" required 
                                                    class="w-full border border-orange-200 bg-orange-50 focus:border-orange-400 focus:ring-orange-400 px-3 py-2 rounded-xl outline-none transition"
                                                >
                                                
                                                    @foreach($professionals as $professional)
                                                        <option value="{{ $professional->id }}">{{ $professional->name }} {{ $professional->surname1 }} {{ $professional->surname2 }}</option>
                                                    @endforeach
                                                
                                                </select>
                                            </div>
                                        <input type="hidden" name="attendee" value="0">
                                        
                                        <div class="flex justify-end gap-3 pt-2">
                                            <button class="closeEdit px-4 py-2 rounded-full bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium transition">
                                                Cancelar
                                            </button>

                                            <button type="submit"
                                                class="px-4 py-2 rounded-full bg-orange-500 hover:bg-orange-600 text-white font-medium shadow-md transition"
                                            >
                                                Guardar
                                            </button>
                                        </div>
                                    </form>
                                </div>
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