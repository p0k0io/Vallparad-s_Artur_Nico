<li x-data="{ open: false }" class="border border-orange-300 rounded-xl overflow-hidden m-3">
    <button @click="open = !open" class="bg-orange-50 hover:bg-orange-100 w-full text-left transition py-1 flex px-3">
        <div class="flex flex-col w-3/4">
            <h2 class="text-orange-500 text-2xl">{{$maintenance->context}}</h1>
            <div class="flex">
                <p class="text-gray-400 mr-5">Obert: {{$maintenance->created_at}}</p> <p class="text-gray-400 mr-5">Responsable: {{$maintenance->responsible}} </p>
            </div>
            <p class="text-gray-400 mr-5">Creada Per: {{$maintenance->professional->name}} {{$maintenance->professional->surname1}} {{$maintenance->professional->surname2}}</p>
        </div>
        <div class="flex w-1/4 justify-end my-4 gap-1">
            <a class="ferSeguiment font-bold text-orange-500 mr-3 border-2 rounded-full border-orange-400 bg-orange-200 flex w-2/4 justify-center items-center">
                Fer Seguiment

                <x-maintenance-create-tracking :maintenance="$maintenance"/>

            </a>
            
            @if($maintenance->status=="Pendent")
                <a class="canviarStatus font-bold text-orange-500 border-2 rounded-full border-orange-400 bg-orange-200 flex w-2/4 justify-center items-center">
            @else
                <a class="canviarStatus font-bold text-green-500 border-2 rounded-full border-green-400 bg-green-200 flex w-2/4 justify-center items-center">
            @endif
                <input hidden value="{{$maintenance->id}}">
                <span>{{$maintenance->status}}</span>
            </a>
            
        </div>
    </button>
    <div x-show="open" x-collapse class="bg-white px-6 py-4 border-t border-orange-100">
        <div class="pb-3 text-gray-500">
            <p>{{$maintenance->description}}</p>
        </div>
        <div class="rounded-xl border border-spacing-5 border-gray-300 border-dashed h-36 overflow-y-scroll">
            <ul>
                @forelse($maintenance->maintenanceTrackings as $tracking)
                    <x-maintenance-tracking-card :tracking="$tracking"/>
                @empty
                    <h2 class="text-2xl font-bold text-gray-400 text-center my-5">No s'ha trobat ningun seguiment</h1>
                @endforelse
            </ul>
        </div>
        
    </div>
</li>
