<li x-data="{ open: false }" class="border border-orange-300 rounded-xl overflow-hidden m-3">
    <button @click="open = !open" class="bg-orange-50 hover:bg-orange-100 w-full text-left transition py-1 flex px-3">
        <div class="flex flex-col w-3/4">
            <h2 class="text-orange-500 text-2xl">{{$rrhh->context}}</h1>
            <div class="flex">
                <p class="text-gray-400 mr-5">Obert: {{$rrhh->created_at}}</p>
                <p class="text-gray-400 mr-5">Creada Per: {{$rrhh->professional->name}}</p>
            </div>
            <div class="flex">
                <p class='text-gray-400 mr-5'>Professional Afectat: {{$rrhh->afectat->name}}</p>
                <p class='text-gray-400 mr-5'>Professional Derivat: {{$rrhh->derivat->name}}</p>
            </div>
            
        </div>
        <div class="flex w-1/4 justify-end my-4 gap-1">
            <div class="font-bold text-orange-500 mr-3 border-2 rounded-full border-orange-400 bg-orange-200 flex w-2/4 justify-center items-center">
                Fer seguiment
            </div>
            <div class="font-bold text-orange-500 border-2 rounded-full border-orange-400 bg-orange-200 flex w-2/4 justify-center items-center">
                Pendent
            </div>
        </div>
    </button>
    <div x-show="open" x-collapse class="bg-white px-6 py-4 border-t border-orange-100">
        <div>
            <p>{{$rrhh->description}}</p>
        </div>
        <div class="rounded-xl border border-spacing-5 border-gray-300 border-dashed">
            prova de seguiment
        </div>
    </div>
</li>