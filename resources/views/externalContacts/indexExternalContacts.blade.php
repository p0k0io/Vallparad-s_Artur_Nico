@extends('layouts.app')

@section('content')
<script>
    function createModal() {
        document.getElementById("create-modal").classList.remove("hidden");
    }

    function closeModal() {
        document.getElementById("create-modal").classList.add("hidden");
    }
</script>



<div class="min-h-screen bg-gray-50 flex flex-col items-center py-12 px-2">
    <div class="w-3/4 h-auto p-6 rounded-xl bg-gradient-to-r from-orange-100 to-orange-300">
        <div class="w-full p-2 flex flex-row justify-between items-center">
            <h1 class=" font-bold">Contactos Externos</h1>
            <div class="px-2 h-auto">
                <button 
                    onclick="createModal()" 
                    class="px-6 py-2 rounded-xl bg-orange-500 text-white font-medium shadow hover:bg-orange-600 transition">
                    Crear nuevo contacto
                </button>
            </div>
        </div>

        <div class="mt-4">
            @forelse ($externalContacts as $contact)
                <div class="p-2 border-b border-gray-300 flex justify-between items-center">
                    <x-contact-card :user=$contact/>
                </div>
            @empty
                <p class="text-gray-500">No hay contactos externos.</p>
            @endforelse
        </div>
    </div>
</div>











<div id="create-modal" class="fixed inset-0 flex items-center justify-center bg-black/40 backdrop-blur-sm hidden z-50">
    <div class="bg-white w-1/3 max-w-lg h-auto flex flex-col px-8 py-6 rounded-lg shadow-lg">
        
        <h2 class="text-2xl font-semibold mb-4 text-gray-800">Nuevo Contacto</h2>
        
        <form action="{{ route('externalContact.store') }}" method="post" class="flex flex-col gap-4">
            @csrf

            <div class="flex flex-col">
                <label for="name" class="mb-1 text-gray-700 font-medium">Nombre</label>
                <input type="text" name="name" id="name" placeholder="Ingrese el nombre" class="border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400">
            </div>

            <div class="flex flex-col">
                <label for="description" class="mb-1 text-gray-700 font-medium">Descripción</label>
                <input type="text" name="description" id="description" placeholder="Ingrese una descripción" class="border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400">
            </div>

            <div class="flex flex-col">
                <label for="manager" class="mb-1 text-gray-700 font-medium">Encargado</label>
                <input type="text" name="manager" id="manager" placeholder="Nombre del encargado" class="border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400">
            </div>

            <div class="flex flex-col">
                <label for="email" class="mb-1 text-gray-700 font-medium">Correo Electrónico</label>
                <input type="email" name="email" id="email" placeholder="correo@ejemplo.com" class="border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400">
            </div>

            <div class="flex flex-col">
                <label for="address" class="mb-1 text-gray-700 font-medium">Dirección</label>
                <input type="text" name="address" id="address" placeholder="Ingrese la dirección" class="border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400">
            </div>

            <div class="flex flex-col">
                <label for="phone" class="mb-1 text-gray-700 font-medium">Teléfono</label>
                <input type="tel" name="phone" id="phone" placeholder="123-456-7890" class="border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400">
            </div>

            <div class="flex flex-col">
                <label for="center_id" class="mb-1 text-gray-700 font-medium">Centro</label>
                <select name="center_id" id="center_id" class="border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400">
                    @foreach($centers as $center)
                        <option value="{{ $center->id }}">{{ $center->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="mt-4 px-6 py-2 rounded-lg bg-orange-500 text-white font-medium hover:bg-orange-600 transition">
                Guardar
            </button>
        </form>
    </div>
</div>

@endsection
