<li x-data="{ open: false }" class="border border-orange-200 rounded-xl overflow-hidden m-3">
    <button @click="open = !open" class="bg-orange-50 hover:bg-orange-100 w-full text-left transition py-1 flex px-3">
        <div class="flex flex-col w-3/5">
            <h2 class="text-orange-500 text-2xl">{{$accident->context}}</h1>
            <div class="flex">
                <p class="text-gray-400 mr-5">Obert: {{$accident->created_at}}</p>
                <p class="text-gray-400 mr-5">Creada Per: {{$accident->professional->name}} {{$accident->professional->surname1}} {{$accident->professional->surname2}}</p>
            </div>
            <div class="flex accidentContent">
                <p class="text-gray-400 mr-1">Tipus Accidentabilitat: </p>
                <p class="text-gray-400 mr-5 accidentType">{{$accident->type}}</p>
                <p class='text-gray-400 mr-5 accidentDuration'>Durada: {{$accident->duration}}</p>
                <p class='text-gray-400 mr-5 accidentStart'>Data Inici: {{$accident->startDate}}</p>
                <p class='text-gray-400 accidentEnd'>Data Final: {{$accident->endDate}}</p>
            </div>
            
        </div>
        <div class="flex w-2/5 justify-end my-4 gap-1">
            <a class="font-bold text-orange-500 m-0.5 border-2 rounded-full border-orange-300 bg-orange-100 hover:bg-orange-200 flex w-2/4 justify-center items-center">
                Descarregar Fitxa
            </a>
            <a class="estatBaixa font-bold text-orange-500 m-0.5 border-2 rounded-full border-orange-300 bg-orange-100 hover:bg-orange-200 flex w-2/4 justify-center items-center">
                <input hidden value="{{$accident->id}}">
                <span>En Baixa</span>
            </a>
        </div>
    </button>
    <div x-show="open" x-collapse class="bg-white px-6 py-4 border-t border-orange-100">
        <div class="flex justify-between">
            <p class="w-3/5">{{$accident->description}}</p>
            <img src="{{$accident->signature}}" alt="firma" class="border-b-2 border-gray-300 border-dashed w-2/6">
        </div>
        
    </div>
</li>