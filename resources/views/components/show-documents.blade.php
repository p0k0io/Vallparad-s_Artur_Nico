<div class="w-full max-w-md mx-auto p-4 bg-white/20 backdrop-blur-lg border border-orange-500 rounded-2xl shadow-lg transition-transform hover:scale-[1.02] hover:shadow-xl">
    <h3 class="text-lg font-semibold text-orange-500 mb-2 truncate">{{ $document->description }}</h3>
    
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-2">
        <div class="flex flex-col sm:flex-row sm:gap-4 text-gray-800 text-sm">
            <p class="truncate"><span class="font-medium">Centro:</span> {{ $document->center->name }}</p>
            <p class="truncate"><span class="font-medium">Tipo:</span> {{ $document->type->type }}</p>
        </div>

        <a href="{{ route('documents.download', $document->id) }}" 
           class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-orange-500/70 backdrop-blur-md border border-orange-500 text-white rounded-lg font-medium hover:bg-orange-500/50 hover:shadow-md transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-download">
                <path d="M12 15V3"/>
                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                <path d="m7 10 5 5 5-5"/>
            </svg>
            Descargar
        </a>
    </div>
</div>
