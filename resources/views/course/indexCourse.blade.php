@extends('../layouts.app')

@section('title','Accidentability')

@section('content')
<div id="toast-container" class="fixed top-6 right-6 space-y-4 z-[9999]"></div>

<script>
    function showBladeAlert(message, type = 'success') {
        const toast = document.createElement('div');
        toast.className = `
            flex items-center gap-3 text-white font-semibold
            px-6 py-4 rounded-2xl shadow-2xl backdrop-blur
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
                showBladeAlert(result.data?.message || 'Error al asignar profesional', 'error');
                return;
            }

            showBladeAlert(result.data?.message || 'Profesional asignado correctamente');

            setTimeout(() => window.location.reload(), 500);
        })
        .catch(() => showBladeAlert('Error de red al asignar profesional', 'error'));
    }

    function updateEnrollmentMode(id, mode, button) {
        fetch(`/enrolled-in/${id}`, {
            method: 'PATCH',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ mode })
        })
        .then(async res => {
            const data = await res.json().catch(() => null);
            return { ok: res.ok, status: res.status, data };
        })
        .then(res => {
            if (!res.ok) {
                showBladeAlert(`Error ${res.status}: No se pudo actualizar`, 'error');
                return;
            }

            showBladeAlert(res.data.message || 'Actualizado correctamente');

            const row = button.closest('tr');
            const modeCell = row.querySelector('td:nth-child(3) span');

            modeCell.textContent = res.data.data.mode;

            if (res.data.data.mode === 'completed') {
                modeCell.className = 'px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700';
                button.textContent = 'Revertir a inscrito';
                button.className = 'text-xs bg-orange-500 hover:bg-orange-600 text-white font-semibold px-4 py-2 rounded-full transition';
                button.setAttribute('onclick', `updateEnrollmentMode(${id}, 'enrolled', this)`);
            } else {
                modeCell.className = 'px-3 py-1 rounded-full text-xs font-bold bg-orange-100 text-orange-700';
                button.textContent = 'Marcar como completado';
                button.className = 'text-xs bg-green-500 hover:bg-green-600 text-white font-semibold px-4 py-2 rounded-full transition';
                button.setAttribute('onclick', `updateEnrollmentMode(${id}, 'completed', this)`);
            }
        })
        .catch(() => showBladeAlert('Ocurrió un error al actualizar el estado', 'error'));
    }
</script>

<div class="min-h-screen bg-slate-100 py-16 px-6 flex flex-col items-center">
    <div class="w-full max-w-7xl">
        <div class="text-center mb-14">
            <h1 class="text-4xl font-extrabold text-orange-500 mb-3 tracking-tight">
                Gestión de cursos
            </h1>
            <p class="text-lg text-gray-600">
                Asignación y seguimiento de profesionales
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <div class="bg-white rounded-3xl shadow-xl p-8 border-2 border-orange-200">
                <div class="flex justify-between items-center mb-8 pb-6 border-b-2 border-orange-100">
                    <h2 class="text-2xl font-bold text-gray-800">Cursos disponibles</h2>
                    <div class="flex gap-4">
                        <x-course-create-modal />
                        <a href="{{ route('inscritos.export') }}"
                           class="flex items-center gap-3 px-6 py-3 rounded-full bg-green-500 hover:bg-green-600 text-white font-semibold shadow-md transition">
                            <x-lucide-file-spreadsheet class="h-4 w-4"/>
                            Exportar
                        </a>
                    </div>
                </div>

                <ul class="space-y-6">
                    @forelse($courses as $course)
                        <li
                            x-data="{ open: false }"
                            class="rounded-2xl border border-orange-200 shadow hover:shadow-lg transition overflow-hidden"
                            @dragover.prevent
                            @drop="assignProfessional('{{ $course->id }}', $event)"
                        >
                            <button
                                @click="open = !open"
                                class="w-full flex justify-between items-center px-6 py-5 bg-orange-50 hover:bg-orange-100 transition"
                            >
                                <div>
                                    <p class="font-bold text-orange-600 text-lg">{{ $course->name }}</p>
                                    <span class="text-sm text-gray-500">
                                        {{ \Carbon\Carbon::parse($course->startDate)->format('d/m/Y') }} -
                                        {{ \Carbon\Carbon::parse($course->endDate)->format('d/m/Y') }}
                                    </span>
                                </div>
                                <div class="flex items-center gap-4">
                                    <span class="text-xs font-bold px-4 py-1 rounded-full bg-green-100 text-green-700">
                                        {{ ucfirst($course->mode) }}
                                    </span>
                                    <x-lucide-chevron-down x-show="!open" class="h-5 w-5 text-orange-500"/>
                                    <x-lucide-chevron-up x-show="open" class="h-5 w-5 text-orange-500"/>
                                </div>
                            </button>

                            <div x-show="open" x-collapse class="px-6 py-6 border-t border-orange-100">
                                <p class="text-gray-600 mb-4">{{ $course->description }}</p>

                                <ul class="text-sm space-y-2 text-gray-700 mb-6">
                                    <li><b class="text-orange-500">Inscritos:</b> {{ $course->enrolledIn->count() }}</li>
                                    <li><b class="text-orange-500">Tipo:</b> {{ ucfirst($course->event_type ?? 'No especificado') }}</li>
                                    <li><b class="text-orange-500">Centro:</b> {{ $course->center->name ?? 'No asignado' }}</li>
                                    <li><b class="text-orange-500">Responsable:</b> {{ $course->professional->name ?? 'No asignado' }}</li>
                                </ul>

                                @if($course->enrolledIn->isNotEmpty())
                                    <div class="overflow-x-auto rounded-2xl border border-orange-200">
                                        <table class="min-w-full text-sm text-gray-700">
                                            <thead class="bg-orange-100 text-orange-600 font-bold">
                                                <tr>
                                                    <th class="px-4 py-3">Nombre</th>
                                                    <th class="px-4 py-3">Apellidos</th>
                                                    <th class="px-4 py-3">Modo</th>
                                                    <th class="px-4 py-3"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($course->enrolledIn as $enrollment)
                                                    <tr class="border-t hover:bg-orange-50 transition">
                                                        <td class="px-4 py-3">{{ $enrollment->professional->name }}</td>
                                                        <td class="px-4 py-3">
                                                            {{ $enrollment->professional->surname1 }}
                                                            {{ $enrollment->professional->surname2 }}
                                                        </td>
                                                        <td class="px-4 py-3">
                                                            <span class="px-3 py-1 rounded-full text-xs font-bold
                                                                {{ $enrollment->mode === 'completed' ? 'bg-green-100 text-green-700' : 'bg-orange-100 text-orange-700' }}">
                                                                {{ $enrollment->mode }}
                                                            </span>
                                                        </td>
                                                        <td class="px-4 py-3 text-right">
                                                            @if($enrollment->mode === 'enrolled')
                                                                <button
                                                                    onclick="updateEnrollmentMode({{ $enrollment->id }}, 'completed', this)"
                                                                    class="text-xs bg-green-500 hover:bg-green-600 text-white font-semibold px-4 py-2 rounded-full transition">
                                                                    Marcar como completado
                                                                </button>
                                                            @else
                                                                <button
                                                                    onclick="updateEnrollmentMode({{ $enrollment->id }}, 'enrolled', this)"
                                                                    class="text-xs bg-orange-500 hover:bg-orange-600 text-white font-semibold px-4 py-2 rounded-full transition">
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
                                    <p class="text-gray-500 italic">No hay profesionales inscritos aún.</p>
                                @endif
                            </div>
                        </li>
                    @empty
                        <li class="text-center text-gray-500 py-10">No hay cursos.</li>
                    @endforelse
                </ul>
            </div>

            <div class="bg-white rounded-3xl shadow-xl p-8 border-2 border-orange-200">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Profesionales</h2>
                <div class="h-96 overflow-y-auto rounded-2xl border border-orange-200 bg-orange-50 p-4">
                    <ul class="space-y-4">
                        @forelse($professionals as $professional)
                            <li
                                draggable="true"
                                x-data
                                @dragstart="event.dataTransfer.setData('professional_id', {{ $professional->id }})"
                                class="flex items-center gap-4 bg-white px-6 py-4 rounded-2xl shadow hover:shadow-lg hover:bg-orange-100 transition cursor-move font-medium"
                            >
                                <x-lucide-user class="h-5 text-orange-500"/>
                                {{ $professional->name }} {{ $professional->surname1 }} {{ $professional->surname2 }}
                            </li>
                        @empty
                            <li class="text-center text-gray-500">No hay profesionales.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection