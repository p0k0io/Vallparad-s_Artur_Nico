@extends('../layouts.app')

@section('title', 'Valoracio Professionals')

@section('content')
<div class="min-h-screen bg-slate-100 py-10 px-6">

    <div id="mainContainer" class="max-w-7xl mx-auto flex  gap-6 transition-all duration-500 ease-in-out">

        {{-- LISTA DE PROFESIONALES --}}
        <div id="professionalsList" class="flex-1 flex flex-col items-center transition-all duration-500 ease-in-out">
            <div class="bg-white rounded-2xl shadow-xl p-8 border border-orange-200/60 w-full max-w-3xl">
                
                <div class="flex justify-between items-center mb-8">
                    <h1 class="text-3xl font-bold text-orange-600">Professionals</h1>
                    <a class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-3 font-bold rounded-full shadow-lg transition-all duration-300"
                       href="{{ route('professional.create') }}">
                        Nou Professional
                    </a>
                    
                </div>

                <form action="{{ route('searchProfessional.professional') }}" method="POST" class="flex justify-between items-center mb-6 border-b-2">
                    @csrf
                    <input type="text" name="search" id="searchMaintenances" class="w-11/12 border-0 bg-transparent px-3 py-2 outline-none ring-0 focus:ring-0 transition-all" placeholder="Busca professionals...">
                    <button type="submit" class="w-1/12 flex justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search-icon lucide-search"><path d="m21 21-4.34-4.34"/><circle cx="11" cy="11" r="8"/></svg>
                    </button>
                </form>
                <div class="flex flex-col gap-6">
                    @foreach ($professionals as $professional)
                        <div 
                            
                            onclick="openRightModal({{ json_encode($professional) }})"
                        >
                            <x-professional-card :professional="$professional" />
                        </div>
                    @endforeach
                </div>
                
            </div>
        </div>

        {{-- MODAL LATERAL AL MISMO NIVEL --}}
        <div id="rightModal" class="w-0 overflow-hidden transition-all duration-500 ease-in-out">
            <div class="bg-white rounded-2xl shadow-2xl h-full p-8 flex flex-col">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-orange-600">Detalls del Professional</h2>
                    <button onclick="closeRightModal()" 
                            class="text-orange-500 hover:text-orange-700 text-3xl font-bold">
                        ×
                    </button>
                </div>
                <div id="rightModalContent" class="flex-1 overflow-y-auto">
                    {{-- Contenido inyectado --}}
                </div>
            </div>
        </div>

    </div>
    
</div>

{{-- SCRIPT --}}
<script>
document.addEventListener('DOMContentLoaded', function () {

    const mainContainer = document.getElementById('mainContainer');
    const professionalsList = document.getElementById('professionalsList');
    const rightModal = document.getElementById('rightModal');
    const rightModalContent = document.getElementById('rightModalContent');

    window.openRightModal = function(professional) {

        // Inyectar contenido
        rightModalContent.innerHTML = `
            <div class="space-y-6 rounded-lg">
                <h1 class="text-3xl font-bold text-gray-900">
                    ${professional.name} ${professional.surname1} ${professional.surname2 || ''}
                </h1>
                <p class="text-gray-600">${professional.email}</p>

                <div class="bg-white shadow-sm rounded-xl p-6 border border-orange-200">
                    <h3 class="font-semibold text-orange-600 mb-4">Informació bàsica</h3>
                    <p><strong>Telèfon:</strong> ${professional.phone || 'No disponible'}</p>
                    <p><strong>Adreça:</strong> ${professional.address || 'No especificada'}</p>
                </div>

                <div class="bg-white shadow-sm rounded-xl p-6 border border-orange-200">
                    <h3 class="font-semibold text-orange-600 mb-4">Estat</h3>
                    <div class="text-center">
                        <span class="px-6 py-3 text-xl font-bold rounded-full ${
                            professional.status == 1 
                            ? 'bg-green-100 text-green-700 border border-green-300' 
                            : 'bg-red-100 text-red-700 border border-red-300'
                        }">
                            ${professional.status == 1 ? 'Actiu' : 'Inactiu'}
                        </span>
                    </div>
                </div>

                <div class="bg-white shadow-sm rounded-xl p-6 border border-orange-200">
                    <h3 class="font-semibold text-orange-600 mb-4">Notes</h3>
                    <p><strong>Última avaluació:</strong></p>
                    <p class="p-4 bg-orange-50 border-l-4 border-orange-500 rounded">${professional.evaluation || 'Sense avaluació'}</p>

                    <p class="mt-4"><strong>Seguiment:</strong></p>
                    <p class="p-4 bg-orange-50 border-l-4 border-orange-500 rounded">${professional.tracking || 'Sense seguiment'}</p>
                </div>
            </div>
        `;

        // Animar ancho del modal y mover lista a la izquierda
        rightModal.style.width = '55%';
        professionalsList.classList.remove('items-center');
        professionalsList.classList.add('items-start');
    };

    window.closeRightModal = function() {
        rightModal.style.width = '0';
        professionalsList.classList.remove('items-start');
        professionalsList.classList.add('items-center');
    };
});
</script>
@endsection
