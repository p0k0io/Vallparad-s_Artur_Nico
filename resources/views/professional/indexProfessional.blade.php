@extends('../layouts.app')

@section('title', 'Valoracio Professionals')

@section('content')
<div class="min-h-screen bg-slate-100 py-10 px-6 justify-center items-center w-full">
    <div class="w-full flex items-center justify-center pb-10 flex-">
        <div class=" w-full flex flex-col items-center justify-center">
                <input oninput="searchUser()" type="text" id ="search" class="rounded-2xl w-1/3" >
                <ul id="results"></ul>
        </div>
    </div>
    <div id="mainContainer" class="max-w-7xl mx-auto flex  gap-6 transition-all duration-500 ease-in-out">
    
        
        {{-- LISTA DE PROFESIONALES --}}
        <div id="professionalsList" class="flex-1 flex flex-col items-center transition-all duration-500 ease-in-out">
            <div class="bg-white rounded-2xl shadow-xl p-8 border border-orange-200/60 w-full max-w-3xl">
                
                <div class="flex justify-between items-center mb-8">
                    <h1 class="text-3xl font-bold text-orange-600">Professionals</h1>
                                       
                    <a class="bg-orange-500 hover:bg-orange-600 text-white p-3 font-bold rounded-full shadow-lg transition-all duration-300"
                       href="{{ route('professional.create') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user-plus-icon lucide-user-plus"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><line x1="19" x2="19" y1="8" y2="14"/><line x1="22" x2="16" y1="11" y2="11"/></svg>
                    </a>
                   
 
                </div>

                

                <div class="flex flex-col gap-6">
                    @foreach ($professionals as $professional)
                        <div 
                            
                            onclick="openRightModal({{ json_encode($professional) }})"
                        >
                            <x-professional-card :professional="$professional" />
                        </div>
                    @endforeach
                </div>

                <div class="mt-12 flex justify-center">
                    {{ $professionals->links('pagination::tailwind') }}
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

function searchUser() {
    const search = document.getElementById("search").value.toLowerCase();
    const resultsContainer = document.getElementById("results");
    resultsContainer.innerHTML = ''; // Limpiar resultados previos

    if (search.length === 0) {
        return;
    }

    fetch('/api/professionals')
        .then(res => res.json())
        .then(data => {
            // Filtrar por nombre, apellidos o profesión
            const filtered = data.filter(professional =>
                professional.name.toLowerCase().includes(search) ||
                professional.surname1.toLowerCase().includes(search) ||
                professional.surname2.toLowerCase().includes(search) ||
                professional.profession.toLowerCase().includes(search)
            );

            if (filtered.length === 0) {
                resultsContainer.innerHTML = `
                    <li class="p-4 text-center text-gray-500 italic">No se encontraron resultados</li>
                `;
            } else {
                filtered.forEach(professional => {
                    const li = document.createElement('li');
                    li.innerHTML = `
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="font-semibold text-gray-800">${professional.name} ${professional.surname1} ${professional.surname2}</p>
                                <p class="text-sm text-gray-500">${professional.profession}</p>
                            </div>
                            <div class="text-orange-500 font-bold cursor-pointer">Ver</div>
                        </div>
                    `;
                    li.classList.add(
                        'cursor-pointer',
                        'hover:bg-orange-50',
                        'transition',
                        'duration-200',
                        'p-3',
                        'rounded-lg',
                        'shadow-sm',
                        'mb-2'
                    );

                    li.addEventListener('click', () => {
                        openRightModal(professional);
                    });

                    resultsContainer.appendChild(li);
                });
            }
        })
        .catch(err => console.error('Error al cargar profesionales:', err));
}


document.addEventListener('DOMContentLoaded', function () {

    const mainContainer = document.getElementById('mainContainer');
    const professionalsList = document.getElementById('professionalsList');
    const rightModal = document.getElementById('rightModal');
    const rightModalContent = document.getElementById('rightModalContent');

    window.openRightModal = function(professional) {

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
