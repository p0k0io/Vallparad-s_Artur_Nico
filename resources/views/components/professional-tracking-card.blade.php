<div x-data="{ open: false }" class="border border-orange-300 rounded-xl overflow-hidden m-3">
    <button @click="open = !open" class="bg-orange-50 hover:bg-orange-100 w-full text-left transition py-1 flex px-3">
        <div class="flex flex-col w-full">
            <h2 class="text-orange-500 text-2xl">{{$tracking->subject}}</h1>
            <div class="flex justify-between">
                <p class="text-gray-400 mr-5">Tipus: {{$tracking->type}}</p>
                <p class="text-gray-400 text-right">Seguiment fet per:---</p>
            </div>

        </div>
    </button>
    <div x-show="open" x-collapse class="bg-white px-6 py-4 border-t border-orange-100">
        <p class="w-3/5">{{$tracking->description}}</p>
    </div>
</div>