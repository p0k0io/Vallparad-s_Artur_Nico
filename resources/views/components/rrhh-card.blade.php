<li x-data="{ open: false }" class="border border-orange-300 rounded-xl overflow-hidden m-3">
    <button @click="open = !open" class="bg-orange-50 hover:bg-orange-100 w-full text-left transition py-1 flex px-3">
        <div class="flex flex-col w-3/4">
            <h2 class="text-orange-500 text-2xl">{{$rrhh->context}}</h1>
            <div class="flex">
                <p class="text-gray-400 mr-5">Obert: {{$rrhh->created_at}}</p>
                <p class="text-gray-400 mr-5">Creada Per: {{$rrhh->professional->name}} {{$rrhh->professional->surname1}} {{$rrhh->professional->surname2}}</p>
            </div>
            <div class="flex">
                <p class='text-gray-400 mr-5'>Professional Afectat: {{$rrhh->afectat->name}} {{$rrhh->afectat->surname1}} {{$rrhh->afectat->surname2}}</p>
                <p class='text-gray-400 mr-5'>Professional Derivat: {{$rrhh->derivat->name}} {{$rrhh->derivat->surname1}} {{$rrhh->derivat->surname2}}</p>
            </div>
            
        </div>
        <div class="flex w-1/4 justify-end my-4 gap-1">
            <a class="ferSeguiment font-bold text-orange-500 mr-3 border-2 rounded-full border-orange-400 bg-orange-200 flex w-2/4 justify-center items-center">
                Fer Seguiment
                <x-rrhh-create-tracking :rrhh="$rrhh"/>
            </a>
            <a class="canviarStatus font-bold text-orange-500 border-2 rounded-full border-orange-400 bg-orange-200 flex w-2/4 justify-center items-center">
                <input hidden value="{{$rrhh->id}}">
                <span>{{$rrhh->status}}</span>
            </a>
        </div>
    </button>
    <div x-show="open" x-collapse class="bg-white px-6 py-4 border-t border-orange-100">
        <div class="pb-3 text-gray-500 flex justify-between">
            <p class="w-3/5">{{$rrhh->description}}</p>
            <img src="{{$rrhh->signature}}" alt="firma" class="border border-orange-400 border-dashed rounded-xl">
        </div>
        <div class="rounded-xl border border-spacing-5 border-gray-300 border-dashed">
            <ul>
                @forelse($rrhh->rrhhTrackings as $tracking)
                    <x-rrhh-tracking-card :tracking="$tracking"/>
                @empty
                    <h2 class="text-2xl font-bold text-gray-400 text-center my-5">No s'ha trobat ningun tema pendent</h1>
                @endforelse
            </ul>
        </div>
    </div>
</li>