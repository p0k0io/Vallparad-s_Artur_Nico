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



<div class="min-h-screen bg-gray-50 flex items-start justify-center py-12 px-6">
    <div class="w-full max-w-4xl bg-white rounded-3xl shadow-lg flex flex-col gap-6 p-8">
        
        <div class="flex justify-between items-center border-b border-gray-200 pb-4">
            <h1 class="text-2xl font-semibold text-gray-800">Documentos</h1>
            <button 
                onclick="createModal()" 
                class="px-6 py-2 rounded-xl bg-orange-500 text-white font-medium shadow hover:bg-orange-600 transition">
                Crear documento
            </button>
        </div>

        
        <div class="flex flex-col gap-4 mt-4">
            @foreach($documents as $document)
                <x-show-documents :document="$document" />
            @endforeach
        </div>
    </div>
</div>










<div id="create-modal" class="fixed inset-0 flex items-center justify-center bg-black/40 backdrop-blur-sm hidden z-50">
    <div class="bg-white rounded-3xl shadow-xl w-full max-w-lg p-8 flex flex-col gap-6 relative">
        <h2 class="text-xl font-semibold text-gray-800">Crear nuevo documento</h2>
        <hr class="border-gray-200">

        <form action="{{ route('documents.store') }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-4">
            @csrf
            <div class="flex flex-col gap-1">
                <label for="description" class="text-gray-700 font-medium">Descripción</label>
                <input type="text" name="description" id="description" class="p-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 transition">
            </div>

            <div class="flex flex-col gap-1">
                <label for="path" class="text-gray-700 font-medium">Ruta del documento</label>
                <input type="file" name="archivo">
            </div>

            <div class="flex flex-col gap-1">
                <label for="center_id" class="text-gray-700 font-medium">Centro</label>
                <select name="center_id" id="center_id" class="p-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 transition">
                    @foreach($centers as $center)
                        <option value="{{ $center->id }}">{{ $center->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex flex-col gap-1">
                <label for="type_id" class="text-gray-700 font-medium">Tipo de documento</label>
                <select name="type_id" id="type_id" class="p-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 transition">
                    @foreach($types as $type)
                        <option value="{{ $type->id }}">{{ $type->type }}</option>
                    @endforeach
                </select>
            </div>

            
            <div class="flex justify-end gap-3 mt-4">
                <button type="button" onclick="closeModal()" class="px-6 py-2 rounded-lg bg-gray-300 text-gray-800 font-medium hover:bg-gray-400 transition">
                    Cancelar
                </button>
                <button type="submit" class="px-6 py-2 rounded-lg bg-orange-500 text-white font-medium hover:bg-orange-600 transition">
                    Guardar
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
