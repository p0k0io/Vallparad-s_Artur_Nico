@extends('layouts.app')

@section('content')
<div class="bg-slate-100 min-h-screen py-16 px-6">

    <!-- CONTENEDOR PRINCIPAL -->
    <div class="w-full max-w-6xl mx-auto bg-white rounded-3xl shadow-xl p-10">

        <!-- CABECERA -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-10">
            <div>
                <h1 class="text-4xl font-extrabold text-orange-500 tracking-tight">
                    Serveis Complementaris
                </h1>
                <p class="text-lg text-gray-600 mt-2">
                    Gestió i administració dels serveis generals
                </p>
            </div>

            <button id="addNewCService" onclick="openCreateModal()"
                class="mt-6 md:mt-0 px-6 py-3 bg-gradient-to-r from-orange-500 to-orange-600
                       text-white font-semibold rounded-xl shadow-md hover:shadow-lg
                       hover:scale-[1.02] transition-all duration-300">
                + Afegir nou servei
            </button>
        </div>

        <!-- LLISTAT -->
        <div class="bg-white rounded-2xl shadow-md border-2 border-orange-200 overflow-hidden">
            <div class="px-8 py-6 border-b border-orange-100 bg-orange-50">
                <h2 class="text-2xl font-bold text-gray-800">Llista de serveis</h2>
            </div>

            <div class="p-6 space-y-3">
                @forelse($complementaryServices as $servei)
                    <button onclick='openInfoModal(@json($servei))'
                        class="w-full text-left p-4 rounded-xl border border-gray-200
                               hover:border-orange-400 hover:bg-orange-50 transition-all">
                        <p class="text-lg font-semibold text-gray-800">
                            {{ $servei->name }}
                        </p>
                    </button>
                @empty
                    <p class="text-center text-gray-500 py-10">
                        No hi ha serveis registrats
                    </p>
                @endforelse
            </div>
        </div>
    </div>
</div>

<!-- MODAL INFO -->
<div id="info-modal" class="fixed inset-0 bg-black/40 backdrop-blur-sm hidden z-50 flex items-center justify-center">
    <div class="bg-white w-full max-w-lg rounded-2xl shadow-xl p-8 relative">

        <button onclick="closeInfoModal()"
            class="absolute top-4 right-4 text-gray-400 hover:text-gray-700 text-xl font-bold">
            ✕
        </button>

        <div id="content-info" class="space-y-4"></div>

        <div class="pt-6 flex justify-between">
            <button id="delete-btn"
                class="px-5 py-2 bg-red-500 text-white rounded-xl
                       hover:bg-red-600 transition">
                Eliminar servei
            </button>
            
            <button id="edit-btn"
                class="px-5 py-2 bg-orange-500 text-white rounded-xl
                       hover:bg-orange-600 transition">
                Editar servei
            </button>
        </div>
    </div>
</div>

<!-- MODAL CREATE / EDIT -->
<div id="edit-modal" class="fixed inset-0 bg-black/40 backdrop-blur-sm hidden z-50 flex items-center justify-center">
    <div class="bg-white w-full max-w-xl rounded-2xl shadow-xl p-8">

        <h2 class="text-2xl font-bold text-gray-800 mb-6">
            Gestió del servei
        </h2>

        <form id="edit-form" method="POST" onsubmit="beforeSubmit()" class="space-y-4" enctype="multipart/form-data">
            @csrf
            <input type="hidden" id="method-field" name="_method" value="POST">

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nom del servei</label>
                <input type="text" id="name" name="name" required
                    class="w-full rounded-xl border-gray-300 focus:border-orange-500 focus:ring-orange-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Descripció</label>
                <textarea name="description" id="description" rows="3" required class="w-full rounded-xl border-gray-300 focus:border-orange-500 focus:ring-orange-500"></textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Responsable</label>
                <input type="text" id="manager" name="manager" required
                    class="w-full rounded-xl border-gray-300 focus:border-orange-500 focus:ring-orange-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Contacte</label>
                <input type="text" id="contact" name="contact" required
                    class="w-full rounded-xl border-gray-300 focus:border-orange-500 focus:ring-orange-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Data d'inici</label>
                <input type="date" id="startDate" name="startDate" required
                    class="w-full rounded-xl border-gray-300 focus:border-orange-500 focus:ring-orange-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Observacions</label>
                <textarea name="observations" id="observations" rows="3" required class="w-full rounded-xl border-gray-300 focus:border-orange-500 focus:ring-orange-500"></textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Documents</label>
                <input type="file" id="files" name="files[]" multiple 
                    class="w-full border-gray-300 focus:border-orange-500 focus:ring-orange-500">
            </div>

            <div class="flex justify-end gap-3 pt-4">
                <button type="button" onclick="closeEditModal()"
                    class="px-5 py-2 bg-gray-200 rounded-xl hover:bg-gray-300">
                    Cancel·lar
                </button>

                <button type="submit"
                    class="px-6 py-2 bg-orange-500 text-white rounded-xl hover:bg-orange-600">
                    Guardar
                </button>
            </div>
        </form>
    </div>
</div>

<!-- SCRIPT -->
<script>

function openInfoModal(servei) {
    const modal = document.getElementById("info-modal");
    const content = document.getElementById("content-info");

    document.getElementById("edit-btn").onclick = () => openEditModal(servei);

    let documentsHtml = '';

    console.log(servei.documents);

    if (servei.documents && servei.documents.length > 0) {
        documentsHtml = `
            <h3 class="mt-4 font-semibold">Documents</h3>
            <ul class="mt-2 space-y-1">
                ${servei.documents.map(doc => `
                    <li class="flex justify-between items-center">
                        <span>${doc.path.split('/').pop()}</span>
                        <a href="/complementary-service-documents/${doc.id}/download"
                           class="text-sm text-orange-600 hover:underline">
                            Descarregar
                        </a>
                    </li>
                `).join('')}
            </ul>
        `;
    } else {
        documentsHtml = `<p class="mt-4 text-gray-400">Aquest servei no té documents</p>`;
    }

    
    content.innerHTML = `
        <h2 class="text-2xl font-bold text-gray-800">${servei.name}</h2>
        <p><strong>Descripció:</strong> ${servei.description}</p>
        <p><strong>Responsable:</strong> ${servei.manager}</p>
        <p><strong>Contacte:</strong> ${servei.contact}</p>
        <p><strong>Data d'inici:</strong> ${servei.startDate}</p>
        <p><strong>Observacions:</strong> ${servei.observations}</p>
        ${documentsHtml}
    `;
    
    
    modal.classList.remove("hidden");
}

function closeInfoModal() {
    document.getElementById("info-modal").classList.add("hidden");
}

function openCreateModal() {
    document.getElementById("edit-form").action = "{{ route('complementaryService.store') }}";
    document.getElementById("method-field").value = "POST";
    document.getElementById("edit-form").reset();
    document.getElementById("edit-modal").classList.remove("hidden");
}

function openEditModal(servei) {
    document.getElementById("edit-form").action = `/complementaryService/${servei.id}`;
    document.getElementById("method-field").value = "PUT";
    document.getElementById("name").value = servei.name;
    document.getElementById("description").value = servei.description;
    document.getElementById("manager").value = servei.manager;
    document.getElementById("contact").value = servei.contact;
    document.getElementById("startDate").value = servei.startDate;
    document.getElementById("observations").value = servei.observations;
    //document.getElementById("docs").value = servei.docs;

    closeInfoModal();
    document.getElementById("edit-modal").classList.remove("hidden");
}

function closeEditModal() {
    document.getElementById("edit-modal").classList.add("hidden");
}

function beforeSubmit() {
    document.getElementById("personal_info").value = JSON.stringify(personalRows);
}
</script>
@endsection
