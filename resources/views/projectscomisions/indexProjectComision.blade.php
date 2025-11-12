@extends('../layouts.app')

@section('title','Projectes i comisions')

@section('content')

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>


<div id="toast-container" class="fixed top-5 right-5 space-y-3 z-[9999]"></div>

<script>

    function showBladeAlert(message, type = 'success') {
        const toast = document.createElement('div');


        toast.className = `
            flex gap-2 items-center text-white font-medium
            px-4 py-3 rounded-xl shadow-xl backdrop-blur
            animate-fade-in-up border border-white/20
            bg-green-500
        `;

        toast.innerHTML = `
           
            <span>${message}</span>
        `;

        document.getElementById('toast-container').appendChild(toast);

        setTimeout(() => {
            toast.classList.add('animate-fade-out');
            setTimeout(() => toast.remove(), 350);
        }, 3000);
    }

 
    function assignProfessional(project_comision_id, event) {
        const professional_id = event.dataTransfer.getData('professional_id');

        if (!professional_id) {
            showBladeAlert('No se pudo obtener el profesional.', 'error');
            return;
        }

        fetch('/assigned-in', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                professional_id: professional_id,
                project_comision_id: project_comision_id
            })
        })
        .then(res => res.json())
        .then(data => {
            showBladeAlert('Profesional asignado correctamente');

            const projectComision = event.currentTarget;
            const list = projectComision.querySelector('.assigned-professionals');

            if (list) {
                const li = document.createElement('li');
                li.textContent = `Profesional ${professional_id}`;
                li.className = "px-2 py-1 bg-orange-100 rounded-md text-orange-700 text-xs";
                list.appendChild(li);
            }
        })
        .catch(err => {
            console.error(err);
        });
    }
</script>

<div class="min-h-screen bg-slate-50 flex flex-col items-center justify-start py-10 px-6">
    <div class="w-full max-w-7xl flex flex-col lg:flex-row gap-10">

        
        <div class="bg-white w-full lg:w-1/2 rounded-2xl shadow-lg p-6 border border-orange-200">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-orange-500 mb-6 ">Projectes/Comisions disponibles</h2>
                <x-project-comision-create-modal :centers="$centers" :professionals="$professionals"/> <!--esta igual que cursos i no funciona, Chat GPT m'ha dit que fiqui aixo, ni idea pero funciona,-->
            </div>
            <ul class="space-y-4">
                @forelse($projectscomisions as $project_comision)
                    <li
                        x-data="{ open: false }"
                        class="border border-orange-300 rounded-2xl shadow hover:shadow-md transition overflow-hidden bg-white"
                        @dragover.prevent
                        @drop="assignProfessional('{{ $project_comision->id }}', $event)"
                    >
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
                                <li><a href="{{ route('projects_comisions.edit', $project_comision) }}">Editar</a></li>
                            </ul>

                            <ul class="assigned-professionals text-xs font-medium text-gray-700 mt-3 space-y-1"></ul>
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
                <ul class="space-y-3 text-gray-800">
                    @forelse($professionals as $professional)
                        <li 
                            class="p-3 bg-white rounded-lg  flex justify-center items-center gap-10 border border-orange-200 hover:bg-orange-100 cursor-move font-medium shadow-sm"
                            draggable="true"
                            x-data
                            @dragstart="event.dataTransfer.setData('professional_id', {{ $professional->id }})"
                        >
                         <x-lucide-user class="h-5 text-orange-500"/> 
                         <h1>
                             {{ $professional->name }} {{ $professional->surname1 }} {{ $professional->surname2 }}
                        </h1>
                         
                            </li>
                    @empty
                        <li class="text-gray-500 text-center">No hay profesionales registrados.</li>
                    @endforelse
                </ul>
            </div>
        </div>

    </div>
</div>

@endsection