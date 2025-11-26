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



<div class="min-h-screen bg-gray-50 flex flex-col items-center py-12 px-6">
    <div class="w-2/4 h-auto p-6 rounded-xl bg-slate-100">
        <div class="w-full p-2 bg-red-400 flex flex-row justify-between items-center">
            <h1 class="text-white font-bold">Contactos Externos</h1>
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
                    <span>{{ $contact->name }}</span>
                    <span>{{ $contact->email }}</span>
                </div>
            @empty
                <p class="text-gray-500">No hay contactos externos.</p>
            @endforelse
        </div>
    </div>
</div>











<div id="create-modal" class="fixed inset-0 flex items-center justify-center bg-black/40 backdrop-blur-sm hidden z-50">
    <div class="bg-white w-1/3  h-auto flex flex-col px-10 py-4">
        
        <form action="{{route('externalContact.store')}}" method="post" class=" flex flex-col gap-4">
        @csrf
        <input type="text" name="name" id="name">
        <input type="text" name="description" id= "description">
        <input type="text" name="manager" id="manager">
        <input type="email" name="email" id="email">
        <input type="text" name="address" id="address">
        <input type="tel" name="phone" id="phone">

        <select name="center_id" id="center_id">
            @foreach($centers as $center)
            <option value="{{ $center->id }}">{{ $center->name }}</option>
            @endforeach
        </select>
        
        <button type="submit" class="px-6 py-2 rounded-lg bg-orange-500 text-white font-medium hover:bg-orange-600 transition">
                    Guardar
                </button>
        </form>

         
    </div>
</div>
@endsection
