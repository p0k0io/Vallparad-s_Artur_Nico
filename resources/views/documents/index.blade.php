@extends('layouts.app')

@section('content')
<!-- script simple para el modal crear documento -->
<script>
    function createModal() {
        document.getElementById("create-modal").classList.remove("hidden");
    }

    function closeModal() {
        document.getElementById("create-modal").classList.add("hidden");
    }
</script>

<!-- fondo general y padding igual que en todas las paginas -->
<div class="min-h-screen bg-slate-100 py-16 px-6 flex flex-col items-center">

    <!-- contenedor principal centrado -->
    <div class="w-full max-w-5xl">

        <!-- titulo grande arriba, estilo consistente -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-extrabold text-orange-500 mb-3 tracking-tight">
                Gestio de Documentos
            </h1>
            <p class="text-lg text-gray-600">
                Documentacion interna del centro, subida y organizacion por tipo y centro
            </p>
        </div>

        <!-- buscador encima de la lista -->
        <div class="mb-8">
            <x-buscador :objecto="$documents" />
        </div>

        <!-- tarjeta principal con la lista y boton crear -->
        <div class="bg-white rounded-3xl shadow-xl p-10 border-2 border-orange-200">

            <!-- cabecera con titulo y boton -->
            <div class="flex justify-between items-center mb-10 pb-6 border-b-2 border-orange-100">
                <h2 class="text-3xl font-bold text-gray-800">Documentos</h2>
                <button onclick="createModal()"
                        class="bg-gradient-to-r from-orange-500 to-orange-600 text-white font-semibold px-8 py-4 rounded-full shadow-md hover:shadow-lg hover:scale-[1.02] transition-all duration-300">
                    Crear documento
                </button>
            </div>

            <!-- lista de documentos -->
            <div class="flex flex-col gap-6">
                @forelse($documents as $document)
                    <x-show-documents :document="$document" />
                @empty
                    <div class="text-center py-12 text-gray-500">
                        <p class="text-xl">No hay documentos aun.</p>
                        <p class="mt-2">Empieza subiendo el primero!</p>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</div>

<!-- modal crear documento -->
<div id="create-modal" class="fixed inset-0 flex items-center justify-center bg-black/50 backdrop-blur-sm hidden z-50 px-4">
    <div class="bg-white rounded-3xl shadow-2xl w-full max-w-2xl p-10 border-2 border-orange-200 relative">

        <!-- titulo del modal -->
        <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">
            Crear nuevo documento
        </h2>

        <!-- formulario -->
        <form action="{{ route('documents.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf

            <!-- descripcion -->
            <div>
                <label for="description" class="block text-lg font-medium text-gray-700 mb-2">
                    Descripcion del documento
                </label>
                <input type="text" 
                       name="description" 
                       id="description" 
                       required
                       class="w-full px-5 py-4 rounded-xl border-2 border-gray-300 focus:border-orange-500 focus:ring-4 focus:ring-orange-100 transition-all"
                       placeholder="Ej: Reglamento interno 2026" />
            </div>

            <!-- archivo -->
            <div>
                <label for="archivo" class="block text-lg font-medium text-gray-700 mb-2">
                    Archivo (PDF, Word, etc.)
                </label>
                <input type="file" 
                       name="archivo" 
                       id="archivo"
                       required
                       accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx"
                       class="w-full px-5 py-4 rounded-xl border-2 border-gray-300 file:mr-4 file:py-3 file:px-6 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-orange-500 file:text-white hover:file:bg-orange-600 transition-all" />
            </div>

            <!-- centro -->
            <div>
                <label for="center_id" class="block text-lg font-medium text-gray-700 mb-2">
                    Centro asociado
                </label>
                <select name="center_id" 
                        id="center_id" 
                        required
                        class="w-full px-5 py-4 rounded-xl border-2 border-gray-300 focus:border-orange-500 focus:ring-4 focus:ring-orange-100 transition-all">
                    <option value="">-- Selecciona un centro --</option>
                    @foreach($centers as $center)
                        <option value="{{ $center->id }}">{{ $center->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- tipo de documento -->
            <div>
                <label for="type_id" class="block text-lg font-medium text-gray-700 mb-2">
                    Tipo de documento
                </label>
                <select name="type_id" 
                        id="type_id" 
                        required
                        class="w-full px-5 py-4 rounded-xl border-2 border-gray-300 focus:border-orange-500 focus:ring-4 focus:ring-orange-100 transition-all">
                    <option value="">-- Selecciona un tipo --</option>
                    @foreach($types as $type)
                        <option value="{{ $type->id }}">{{ $type->type }}</option>
                    @endforeach
                </select>
            </div>

            <!-- botones -->
            <div class="flex justify-end gap-4 pt-6">
                <button type="button" 
                        onclick="closeModal()"
                        class="px-8 py-4 rounded-xl bg-gray-200 text-gray-800 font-semibold hover:bg-gray-300 transition-all">
                    Cancelar
                </button>
                <button type="submit"
                        class="px-8 py-4 rounded-xl bg-gradient-to-r from-orange-500 to-orange-600 text-white font-semibold shadow-md hover:shadow-lg hover:scale-[1.02] transition-all duration-300">
                    Guardar documento
                </button>
            </div>
        </form>

        <!-- boton cerrar X (opcional, por si el usuario quiere cerrar rapido) -->
        <button onclick="closeModal()" 
                class="absolute top-6 right-8 text-3xl text-gray-400 hover:text-gray-600 transition">
            ×
        </button>
    </div>
</div>
@endsection