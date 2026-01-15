@extends('layouts.app')

@section('content')
<div class="bg-slate-100 min-h-screen py-16 px-6">

    <!-- CONTENEDOR PRINCIPAL -->
    <div class="w-full max-w-6xl mx-auto bg-white rounded-3xl shadow-xl p-10">

        <!-- CABECERA -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-10">
            <div>
                <h1 class="text-4xl font-extrabold text-orange-500 tracking-tight">
                    Serveis Generals
                </h1>
                <p class="text-lg text-gray-600 mt-2">
                    Gestió i administració dels serveis generals
                </p>
            </div>

            <button onclick="openCreateModal()"
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
                @forelse($serveis as $servei)
                    <button onclick='openInfoModal(@json($servei))'
                        class="w-full text-left p-4 rounded-xl border border-gray-200
                               hover:border-orange-400 hover:bg-orange-50 transition-all">
                        <p class="text-lg font-semibold text-gray-800">
                            {{ $servei->nom_servei }}
                        </p>
                        <p class="text-sm text-gray-500">
                            {{ $servei->center->name }}
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

        <div class="pt-6 flex justify-end">
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

        <form id="edit-form" method="POST" onsubmit="beforeSubmit()" class="space-y-4">
            @csrf
            <input type="hidden" id="method-field" name="_method" value="POST">

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nom del servei</label>
                <input type="text" id="nom_servei" name="nom_servei" required
                    class="w-full rounded-xl border-gray-300 focus:border-orange-500 focus:ring-orange-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Responsable</label>
                <input type="text" id="responsable" name="responsable" required
                    class="w-full rounded-xl border-gray-300 focus:border-orange-500 focus:ring-orange-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Centre</label>
                <select id="center_id" name="center_id"
                    class="w-full rounded-xl border-gray-300 focus:border-orange-500 focus:ring-orange-500">
                    @foreach($centers as $center)
                        <option value="{{ $center->id }}">{{ $center->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- PERSONAL -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Personal</label>
                <div id="personal-info-container" class="space-y-2"></div>

                <button type="button" onclick="addRow()"
                    class="mt-2 px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600">
                    + Afegir persona
                </button>
            </div>

            <input type="hidden" name="personal_info" id="personal_info">

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
let personalRows = [];

function openInfoModal(servei) {
    const modal = document.getElementById("info-modal");
    const content = document.getElementById("content-info");

    content.innerHTML = `
        <h2 class="text-2xl font-bold text-gray-800">${servei.nom_servei}</h2>
        <p><strong>Responsable:</strong> ${servei.responsable}</p>

        <div class="bg-orange-50 p-3 rounded-xl space-y-1">
            <p><strong>Centre:</strong> ${servei.center.name}</p>
            <p><strong>Telèfon:</strong> ${servei.center.phone}</p>
            <p><strong>Email:</strong> ${servei.center.email}</p>
            <p><strong>Ubicació:</strong> ${servei.center.location}</p>
        </div>
    `;

    let personal = [];
    try { personal = JSON.parse(servei.personal_info ?? "[]"); } catch {}

    if (personal.length) {
        content.innerHTML += `
           <div class="bg-orange-50 border-l-4 border-orange-500 p-4 rounded-md shadow-sm">
                <strong class="text-orange-600 block mb-2 text-sm uppercase tracking-wide">
                    Personal
                </strong>

                <ul class="list-disc ml-6 space-y-1 text-gray-700">
                    ${personal.map(p => `
                        <li class="marker:text-orange-500">
                            <span class="font-medium">${p.nom}</span>
                            <span class="text-sm text-gray-500"> — ${p.horari}</span>
                        </li>
                    `).join('')}
                </ul>
            </div>`;
    }

    document.getElementById("edit-btn").onclick = () => openEditModal(servei);
    modal.classList.remove("hidden");
}

function closeInfoModal() {
    document.getElementById("info-modal").classList.add("hidden");
}

function openCreateModal() {
    document.getElementById("edit-form").action = "{{ route('serveisGenerals.store') }}";
    document.getElementById("method-field").value = "POST";
    document.getElementById("edit-form").reset();
    personalRows = [];
    renderRows();
    document.getElementById("edit-modal").classList.remove("hidden");
}

function openEditModal(servei) {
    document.getElementById("edit-form").action = `/serveisGenerals/${servei.id}`;
    document.getElementById("method-field").value = "PUT";

    document.getElementById("nom_servei").value = servei.nom_servei;
    document.getElementById("responsable").value = servei.responsable;
    document.getElementById("center_id").value = servei.center_id;

    try { personalRows = JSON.parse(servei.personal_info ?? "[]"); }
    catch { personalRows = []; }

    renderRows();
    closeInfoModal();
    document.getElementById("edit-modal").classList.remove("hidden");
}

function closeEditModal() {
    document.getElementById("edit-modal").classList.add("hidden");
}

function addRow() {
    personalRows.push({ nom: "", horari: "" });
    renderRows();
}

function deleteRow(i) {
    personalRows.splice(i, 1);
    renderRows();
}

function renderRows() {
    const c = document.getElementById("personal-info-container");
    c.innerHTML = "";

    personalRows.forEach((p, i) => {
        c.innerHTML += `
            <div class="flex gap-2">
                <input class="flex-1 rounded-lg border-gray-300"
                       placeholder="Nom"
                       value="${p.nom}"
                       oninput="personalRows[${i}].nom=this.value">
                <input class="flex-1 rounded-lg border-gray-300"
                       placeholder="Horari"
                       value="${p.horari}"
                       oninput="personalRows[${i}].horari=this.value">
                <button onclick="deleteRow(${i})"
                        class="px-4 border-2  border-red-500 text-red-500 rounded-lg font-bold">✕</button>
            </div>`;
    });

    document.getElementById("personal_info").value = JSON.stringify(personalRows);
}

function beforeSubmit() {
    document.getElementById("personal_info").value = JSON.stringify(personalRows);
}
</script>
@endsection
