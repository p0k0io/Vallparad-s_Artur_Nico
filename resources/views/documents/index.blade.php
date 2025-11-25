@extends('layouts.app')

@section('content')
<script>
    function createModal(){
        const modal = document.getElementById("create-modal");
        modal.classList.remove("hidden");
    }

    function closeModal() {
        const modal = document.getElementById("create-modal");
        modal.classList.add("hidden");
    }
</script>

<div class="w-full bg-slate-200 h-auto py-4 px-8 flex items-center justify-center">
    <div class="w-3/5 bg-slate-100 p-6 rounded-2xl flex flex-col gap-5">
        <div class="w-full bg-green-300 flex flex-row justify-between items-center px-10">
            <h1>Documentos</h1>
            <button onClick="createModal()" class="px-6 py-2 rounded-xl bg-black/20">
                Crear nuevo documento
            </button>
        </div>

        <div class="w-2/3 h-auto p-2 flex flex-col gap-4">
            @foreach($documents as $document)
                <x-show-documents :document="$document" />
            @endforeach
        </div>
    </div>


<!-- Modal -->
<div id="create-modal" class="fixed w-full h-full justify-center z-50 bg-blur-xl">
    <div class="flex flex-col p-10 h-auto w-2/6 bg-slate-400 gap-4">
        <h1>Crear nuevo documento de gestión</h1>
        <hr>
        <form action="{{ route('documents.store') }}" method="POST">
            @csrf
            <div class="flex flex-col gap-2">
                <label for="description">Descripción</label>
                <input type="text" name="description" id="description" class="p-2 rounded">
            </div>

            <div class="flex flex-col gap-2">
                <label for="path">Ruta del documento</label>
                <input type="text" name="path" id="path" class="p-2 rounded">
            </div>

            <div class="flex flex-col gap-2">
                <label for="center_id">Centro</label>
                <select name="center-id" id="center_id" class="p-2 rounded">
                    @foreach($centers as $center)
                        <option value="{{ $center->id }}">{{ $center->name }}</option>
                    @endforeach
            </div>

            <div class="flex flex-col gap-2">
                <label for="type_id">Tipo de documento</label>
                <select name="type_id" id="type_id" class="p-2 rounded">
                    @foreach($types as $type)
                        <option value="{{ $type->id }}">{{ $type->type }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex justify-between gap-2 pt-4">
                <button type="submit" class="px-6 py-2 bg-green-500 rounded text-white">Guardar</button>
                <button type="button" onClick="closeModal()" class="px-6 py-2 bg-red-500 rounded text-white">Cancelar</button>
            </div>
        </form>
    </div>
</div>
@endsection
</div>