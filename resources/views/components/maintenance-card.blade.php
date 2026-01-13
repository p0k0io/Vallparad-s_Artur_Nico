@if ($maintenance->status=="Pendent")
    <li x-data="{ open: false }" class="liMaintCard border border-orange-300 rounded-xl overflow-hidden m-3">
@else
    <li x-data="{ open: false }" class="liMaintCard border border-gray-300 rounded-xl overflow-hidden m-3">
@endif
    @if($maintenance->status=="Pendent")
        <button @click="open = !open" class="bg-orange-50 hover:bg-orange-100 w-full text-left transition py-1 flex px-3">
    @else
        <button @click="open = !open" class="bg-gray-100 hover:bg-gray-200 w-full text-left transition py-1 flex px-3">  
    @endif
            <div class="flex flex-col w-4/6">
            @if($maintenance->status=="Pendent")
                <h2 class="cardTitle text-orange-500 text-2xl">{{$maintenance->context}}</h1>
            @else
                <h2 class="cardTitle text-gray-500 text-2xl">{{$maintenance->context}}</h1>
            @endif
                <div class="flex">
                    <p class="text-gray-400 mr-5">Obert: {{$maintenance->created_at}}</p> <p class="text-gray-400 mr-5">Responsable: {{$maintenance->responsible}} </p>
                </div>
                <p class="text-gray-400 mr-5">Creada Per: {{$maintenance->professional->name}} {{$maintenance->professional->surname1}} {{$maintenance->professional->surname2}}</p>
            </div>
            <div class="flex w-2/6 justify-end my-4 gap-1">
                
                @if($maintenance->status=="Pendent")
                    <a class="ferSeguiment font-bold text-orange-500 m-0.5 border-2 rounded-full border-orange-400 bg-orange-200 hover:bg-orange-100 transition flex w-2/6 justify-center items-center">
                @else
                    <a class="hidden ferSeguiment font-bold m-0.5 border-2 rounded-full bg-gray-200 text-gray-500 border-gray-400 hover:bg-gray-100 transition w-2/6 justify-center items-center">
                @endif
                    Fer Seguiment

                    <x-maintenance-create-tracking :maintenance="$maintenance"/>

                </a>
                
                @if($maintenance->status=="Pendent")
                    <a class="canviarStatus font-bold text-orange-500 m-0.5 border-2 rounded-full border-orange-400 bg-orange-200 hover:bg-orange-100 transition flex w-2/6 justify-center items-center">
                @else
                    <a class="canviarStatus font-bold m-0.5 border-2 rounded-full bg-gray-200 text-gray-500 border-gray-400 hover:bg-gray-100 transition flex w-2/6 justify-center items-center">
                @endif
                    <input hidden value="{{$maintenance->id}}">
                    <span>{{$maintenance->status}}</span>
                </a>
            </div>
        </button>
    @if($maintenance->status=="Pendent")
        <div x-show="open" x-collapse class="bottomDiv bg-white px-6 py-4 border-t border-orange-100">
    @else
        <div x-show="open" x-collapse class="bottomDiv bg-white px-6 py-4 border-t border-gray-200">
    @endif
            <div class="pb-3 text-gray-500 flex justify-between">
                <p class="w-3/5">{{$maintenance->description}}</p>
                <img src="{{$maintenance->signature}}" alt="firma" class="border-b-2 border-gray-300 border-dashed w-2/6">
            </div>
            <div class="rounded-xl border border-spacing-5 border-gray-300 border-dashed h-28 overflow-y-scroll">
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
