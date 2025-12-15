@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-bl from-orange-100 to bg-slate-50 flex flex-row items-start justify-center gap-6 py-12 px-2">

    <div class=" w-5/6 lg:w-2/6 h-auto p-6 rounded-xl bg-gradient-to-r from-gray-100 to-gray-50 border-2 border-orange-400">
        <div class="w-full p-2 flex flex-row justify-between items-center">
            <h1 class="font-bold">Serveis Generals</h1>

            <button onclick="openCreateModal()"
                    class="px-6 py-2 rounded-xl bg-orange-500 text-white font-medium shadow hover:bg-orange-600 transition">
                Afegir nou servei
            </button>
        </div>

        <div class="mt-4">
            @foreach($serveis as $servei)
                <button onclick='openInfoModal(@json($servei))' class="w-full">
                    <div class="p-2 border rounded mb-2 hover:border-2 hover:border-orange-400">
                        <strong>{{ $servei->nom_servei }}</strong> - {{ $servei->center->name }}
                    </div>
                </button>
            @endforeach
        </div>
    </div>
</div>

<div id="info-modal" class="fixed inset-0 flex items-center justify-center bg-black/40 backdrop-blur-sm hidden z-50">
    <div class="bg-white w-2/5 rounded-xl p-6 shadow-lg relative">

        <button onclick="closeInfoModal()" 
                class="absolute top-3 right-3 text-gray-500 hover:text-gray-800 font-bold">✕</button>

        <div id="content-info" class="flex flex-col gap-3"></div>

        <div class="mt-4 flex justify-end">
            <button id="edit-btn"
                    class="px-4 py-2 bg-orange-500 text-white rounded hover:bg-orange-600">
                Editar servei
            </button>
        </div>
    </div>
</div>


<div id="edit-modal" class="fixed inset-0 flex items-center justify-center bg-black/40 backdrop-blur-sm hidden z-50">
    <div class="bg-white w-1/3 max-w-lg h-auto flex flex-col px-8 py-6 rounded-lg shadow-lg">

        <form id="edit-form" method="POST" onsubmit="beforeSubmit()">
            @csrf
            <input type="hidden" id="method-field" name="_method" value="POST">

            <label>Nom del servei:</label>
            <input type="text" id="nom_servei" name="nom_servei"
                   class="border p-1 rounded w-full mb-2" required>

            <label>Responsable:</label>
            <input type="text" id="responsable" name="responsable"
                   class="border p-1 rounded w-full mb-2" required>

            <label>Centre:</label>
            <select name="center_id" id="center_id" class="border p-1 rounded w-full mb-2">
                @foreach($centers as $center)
                    <option value="{{ $center->id }}">{{ $center->name }}</option>
                @endforeach
            </select>

            <!-- PERSONAL INFO -->
            <label>Personal:</label>
            <div id="personal-info-container" class="mb-2"></div>

            <button type="button" onclick="addRow()"
                    class="mb-2 px-4 py-1 bg-green-500 text-white rounded">
                + Afegir persona
            </button>

            <input type="hidden" name="personal_info" id="personal_info">

            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeEditModal()"
                        class="px-4 py-2 bg-gray-300 rounded">Cancelar</button>

                <button type="submit"
                        class="px-4 py-2 bg-orange-500 text-white rounded">Guardar</button>
            </div>
        </form>
    </div>
</div>

<script>
let personalRows = [];
let currentServiceId = null;
function openInfoModal(servei) {
    const modal = document.getElementById("info-modal");
    const content = document.getElementById("content-info");

    content.innerHTML = `
        <h2 class="text-xl font-bold">${servei.nom_servei}</h2>
        <p><strong>Responsable:</strong> ${servei.responsable}</p>

        <div class="bg-gray-50 p-2 rounded">
            <strong>Centre:</strong> ${servei.center.name}<br>
            <strong>Telèfon:</strong> ${servei.center.phone}<br>
            <strong>Email:</strong> ${servei.center.email}<br>
            <strong>Ubicació:</strong> ${servei.center.location}
        </div>
    `;

    let personal = [];
    try { personal = JSON.parse(servei.personal_info ?? "[]"); } catch {}

    let html = "<strong>Personal:</strong><ul class='list-disc ml-5'>";
    personal.forEach(p => {
        html += `<li>${p.nom ?? '-'} — ${p.horari ?? '-'}</li>`;
    });
    html += "</ul>";

    content.innerHTML += html;

    document.getElementById("edit-btn").onclick = () => openEditModal(servei);

    modal.classList.remove("hidden");
}

function closeInfoModal() {
    document.getElementById("info-modal").classList.add("hidden");
}

function openCreateModal() {
    currentServiceId = null;

    document.getElementById("edit-form").action = "{{ route('serveisGenerals.store') }}";
    document.getElementById("method-field").value = "POST";

    document.getElementById("nom_servei").value = "";
    document.getElementById("responsable").value = "";
    document.getElementById("center_id").selectedIndex = 0;

    personalRows = [];
    renderRows();

    document.getElementById("edit-modal").classList.remove("hidden");
}

function openEditModal(servei) {
    currentServiceId = servei.id;

    document.getElementById("edit-form").action = "/serveisGenerals/" + servei.id;
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

function deleteRow(index) {
    personalRows.splice(index, 1);
    renderRows();
}

function updateNom(index, value) {
    personalRows[index].nom = value;
    updateJSON();
}

function updateHorari(index, value) {
    personalRows[index].horari = value;
    updateJSON();
}

function renderRows() {
    const c = document.getElementById("personal-info-container");
    c.innerHTML = "";

    personalRows.forEach((p, index) => {
        c.innerHTML += `
            <div class="flex gap-2 mb-2">
                <input type="text" placeholder="Nom"
                       class="border p-1 rounded flex-1"
                       value="${p.nom}"
                       oninput="updateNom(${index}, this.value)">
                <input type="text" placeholder="Horari"
                       class="border p-1 rounded flex-1"
                       value="${p.horari}"
                       oninput="updateHorari(${index}, this.value)">
                <button class="bg-red-500 text-white px-2 rounded"
                        onclick="deleteRow(${index})">X</button>
            </div>
        `;
    });

    updateJSON();
}

function updateJSON() {
    document.getElementById("personal_info").value = JSON.stringify(personalRows);
}

function beforeSubmit() {
    document.getElementById("personal_info").value = JSON.stringify(personalRows);
}

</script>

@endsection
