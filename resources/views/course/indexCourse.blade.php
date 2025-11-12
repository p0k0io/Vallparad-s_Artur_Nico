@vite(['resources/css/app.css', 'resources/js/app.js'])

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
        toast.innerHTML = `<span>${message}</span>`;
        document.getElementById('toast-container').appendChild(toast);
        setTimeout(() => {
            toast.classList.add('animate-fade-out');
            setTimeout(() => toast.remove(), 350);
        }, 3000);
    }

    function assignProfessional(course_id, event) {
    event.preventDefault();

    const professional_id = event.dataTransfer.getData('professional_id');
    if (!professional_id) {
        showBladeAlert('No se pudo obtener el profesional.', 'error');
        return;
    }

    fetch('/enrolled-in', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({
            professional_id: professional_id,
            course_id: course_id,
            mode: 'enrolled'
        })
    })
    .then(async res => {
        const data = await res.json().catch(() => null);
        return { ok: res.ok, status: res.status, data };
    })
    .then(result => {
        if (!result.ok) {
            if (result.status === 409) {
                showBladeAlert(result.data?.message || 'Ya está inscrito', 'error');
            } else {
                showBladeAlert(result.data?.message || 'Error al asignar profesional', 'error');
            }
            return;
        }

        showBladeAlert(result.data?.message || 'Profesional asignado correctamente');

      
        setTimeout(() => {
            window.location.reload();
        }, 500);
    })
    .catch(err => {
        console.error('Error en fetch assignProfessional:', err);
        showBladeAlert('Error de red al asignar profesional', 'error');
    });
}


    function updateEnrollmentMode(id, mode, button) {

    fetch(`/enrolled-in/${id}`, {
        method: 'PATCH',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ mode: mode })
    })
    .then(async res => {
        console.log('Respuesta del servidor:', res);
        const data = await res.json().catch(err => {
            return null;
        });
        return { status: res.status, ok: res.ok, data: data };
    })
    .then(res => {
        console.log('Datos procesados:', res);

        if (!res.ok) {
            showBladeAlert(`Error ${res.status}: No se pudo actualizar`, 'error');
            return;
        }

        if (res.data) {
            showBladeAlert(res.data.message || 'Actualizado correctamente');
            const row = button.closest('tr');
            const modeCell = row.querySelector('td:nth-child(3) span');

            modeCell.textContent = res.data.data.mode;

            if (res.data.data.mode === 'completed') {
                modeCell.className = 'px-2 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700';
                button.textContent = 'Revertir a inscrito';
                button.className = 'text-xs bg-orange-500 hover:bg-orange-600 text-white font-semibold px-3 py-1 rounded-lg transition';
                button.setAttribute('onclick', `updateEnrollmentMode(${id}, 'enrolled', this)`);
            } else {
                modeCell.className = 'px-2 py-1 rounded-full text-xs font-semibold bg-orange-100 text-orange-700';
                button.textContent = 'Marcar como completado';
                button.className = 'text-xs bg-green-500 hover:bg-green-600 text-white font-semibold px-3 py-1 rounded-lg transition';
                button.setAttribute('onclick', `updateEnrollmentMode(${id}, 'completed', this)`);
            }
        }
    })
    .catch(err => {
        console.error('Error en fetch:', err);
        showBladeAlert('Ocurrió un error al actualizar el estado', 'error');
    });
}
</script>

<div class="min-h-screen bg-slate-50 flex flex-col items-center justify-start py-10 px-6">
    <div class="w-full max-w-7xl flex flex-col lg:flex-row gap-10">
        <div class="bg-white w-full lg:w-1/2 rounded-2xl shadow-lg p-6 border border-orange-200">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-orange-500 mb-6">Cursos disponibles</h2>
                <x-course-create-modal />
                 <a href="{{ route('inscritos.export') }}" class="btn btn-success bg-green-500 text-white  flex-row gap-3 px-4 py-3 rounded-full flex items-center justify-center">
                    <x-lucide-file-spreadsheet class="h-4 w-4"/>Exportar
                </a>
            </div>
            <ul class="space-y-4">
                @forelse($courses as $course)
                    <li
                        x-data="{ open: false }"
                        class="border border-orange-300 rounded-2xl shadow hover:shadow-md transition overflow-hidden bg-white"
                        @dragover.prevent
                        @drop="assignProfessional('{{ $course->id }}', $event)"
                    >
                        <button 
                            @click="open = !open"
                            class="w-full flex justify-between items-center px-5 py-4 bg-orange-50 hover:bg-orange-200 transition"
                        >
                            <div>
                                <p class="font-semibold text-orange-500 text-lg">{{ $course->name }}</p>
                                <span class="text-xs text-gray-500">
                                    {{ \Carbon\Carbon::parse($course->startDate)->format('d/m/Y') }} - 
                                    {{ \Carbon\Carbon::parse($course->endDate)->format('d/m/Y') }}
                                </span>
                            </div>
                            <div class="flex items-center gap-3">
                                <span class="text-xs font-bold px-3 py-1 rounded-full bg-green-100 text-green-700">
                                    {{ ucfirst($course->mode) }}
                                </span>
                                <x-lucide-chevron-down x-show="!open" class="h-5 w-5 text-orange-500" />
                                <x-lucide-chevron-up x-show="open" class="h-5 w-5 text-orange-500" />
                            </div>
                        </button>

                        <div x-show="open" x-collapse class="bg-white px-6 py-4 border-t border-orange-100">
                            <p class="text-gray-600 text-sm mb-3">{{ $course->description }}</p>

                            <ul class="text-sm space-y-1 text-gray-700 mb-4">
                                <li><b 


    public function export()
    {
class="text-orange-500">Inscritos:</b> {{ $course->enrolledIn->count() }}</li>
                                <li><b class="text-orange-500">Tipo:</b> {{ ucfirst($course->event_type ?? 'No especificado') }}</li>
                                <li><b class="text-orange-500">Centro:</b> {{ $course->center->name ?? 'No asignado' }}</li>
                                <li><b class="text-orange-500">Responsable:</b> {{ $course->professional->name ?? 'No asignado' }}</li>
                            </ul>

                            @if($course->enrolledIn->isNotEmpty())
                                <div class="overflow-x-auto rounded-xl border border-orange-200">
                                    <table class="min-w-full text-sm text-left text-gray-700">
                                        <thead class="bg-orange-100 text-orange-500 uppercase font-semibold">
                                            <tr>
                                                <th class="px-4 py-2">Nombre</th>
                                                <th class="px-4 py-2">Apellidos</th>
                                                <th class="px-4 py-2">Modo</th>
                                                <th class="px-4 py-2"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($course->enrolledIn as $enrollment)
                                                <tr class="border-b hover:bg-orange-50 transition">
                                                    <td class="px-4 py-2">
                                                        {{ $enrollment->professional->name ?? 'Sin nombre' }}
                                                    </td>
                                                    <td class="px-4 py-2">
                                                        {{ $enrollment->professional->surname1 ?? '' }} {{ $enrollment->professional->surname2 ?? '' }}
                                                    </td>
                                                    <td class="px-4 py-2 capitalize">
                                                        <span class="px-2 py-1 rounded-full text-xs font-semibold
                                                            @if($enrollment->mode === 'completed') bg-green-100 text-green-700
                                                            @elseif($enrollment->mode === 'cancelled') bg-red-100 text-red-700
                                                            @else bg-orange-100 text-orange-700
                                                            @endif">
                                                            {{ $enrollment->mode }}
                                                        </span>
                                                    </td>
                                                    <td class="px-4 py-2 text-right">
                                                        @if($enrollment->mode === 'enrolled')
                                                            <button 
                                                                onclick="updateEnrollmentMode({{ $enrollment->id }}, 'completed', this)"
                                                                class="text-xs bg-green-500 hover:bg-green-600 text-white font-semibold px-3 py-1 rounded-lg transition">
                                                                Marcar como completado
                                                            </button>
                                                        @elseif($enrollment->mode === 'completed')
                                                            <button 
                                                                onclick="updateEnrollmentMode({{ $enrollment->id }}, 'enrolled', this)"
                                                                class="text-xs bg-orange-500 hover:bg-orange-600 text-white font-semibold px-3 py-1 rounded-lg transition">
                                                                Revertir a inscrito
                                                            </button>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <p class="text-gray-500 text-sm italic mt-2">No hay profesionales inscritos aún.</p>
                            @endif
                        </div>
                    </li>
                @empty
                    <li class="bg-gray-100 p-4 rounded-xl text-gray-500 text-center">
                        No hay cursos.
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
                            class="p-3 bg-white rounded-lg flex justify-center items-center gap-10 border border-orange-200 hover:bg-orange-100 cursor-move font-medium shadow-sm"
                            draggable="true"
                            x-data
                            @dragstart="event.dataTransfer.setData('professional_id', {{ $professional->id }})"
                        >
                            <x-lucide-user class="h-5 text-orange-500"/> 
                            <h1>{{ $professional->name }} {{ $professional->surname1 }} {{ $professional->surname2 }}</h1>
                        </li>
                    @empty
                        <li class="text-gray-500 text-center">No hay profesionales .</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>
