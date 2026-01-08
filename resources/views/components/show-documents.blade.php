
<div class="w-full bg-white rounded-2xl shadow-md border-2 border-orange-200 p-6 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
    
    <!-- descripcion del documento -->
    <h3 class="text-2xl font-bold text-gray-800 mb-4">
        {{ $document->description }}
    </h3>

    <!-- info  -->
    <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-6 mb-6">
        <div class="flex flex-col md:flex-row gap-6 text-gray-700">
            <p class="text-lg">
                <span class="font-semibold text-orange-600">Centro:</span> 
                {{ $document->center->name ?? 'No asignado' }}
            </p>
            <p class="text-lg">
                <span class="font-semibold text-orange-600">Tipo:</span> 
                {{ $document->type->type ?? 'General' }}
            </p>
        </div>

        <!-- boton descargar  -->
        <a href="{{ route('documents.download', $document->id) }}" 
           class="inline-flex items-center justify-center gap-3 px-8 py-4 bg-gradient-to-r from-orange-500 to-orange-600 text-white font-semibold rounded-xl shadow-md hover:shadow-lg hover:scale-[1.02] transition-all duration-300">
            <svg xmlns="http://www.w3.org/2000/svg" 
                 class="w-6 h-6" 
                 fill="none" 
                 viewBox="0 0 24 24" 
                 stroke="currentColor" 
                 stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5 5m0 0l5-5m-5 5V4" />
            </svg>
            Descargar
        </a>
    </div>

    <!-- fecha de subida  -->
    <div class="text-sm text-gray-500 border-t border-orange-100 pt-4">
        Subido el {{ $document->created_at->format('d/m/Y') }}
    </div>
</div>