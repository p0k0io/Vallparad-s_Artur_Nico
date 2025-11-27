<li x-data="{ open: false }" class="border border-orange-300 rounded-xl overflow-hidden m-3">
    <button @click="open = !open" class="bg-orange-50 hover:bg-orange-100 w-full text-left transition py-1 flex px-3">
        <div class="flex flex-col w-2/4">
            <h2 class="text-orange-500 text-2xl">Tema</h1>
            <div class="flex">
                <p class="text-gray-300 mr-5">Obert: ...</p>
                <p class="text-gray-300 mr-5">Tipus: Accidentabilitat</p>
            </div>
            <div class="flex">
                <p class="text-gray-300 mr-5">Creada Per: ...</p>
                <p class="text-gray-300 mr-5">Tipus Accidentabilitat: Baixa</p>
                <p class="text-gray-300">Durada: 30 dies</p>
            </div>
            
        </div>
        <div class="flex w-2/4 justify-end my-4 gap-1">
            <div class="font-bold text-orange-500 mr-3 border-2 rounded-full border-orange-400 bg-orange-200 flex w-1/4 justify-center items-center">
                Descarregar Fitxa
            </div>
            <div class="font-bold text-orange-500 border-2 rounded-full border-orange-400 bg-orange-200 flex w-1/4 justify-center items-center">
                En Baixa
            </div>
        </div>
    </button>
    <div x-show="open" x-collapse class="bg-white px-6 py-4 border-t border-orange-100">
        <div>
            <p>Descripcio ...</p>
        </div>
        
    </div>
</li>