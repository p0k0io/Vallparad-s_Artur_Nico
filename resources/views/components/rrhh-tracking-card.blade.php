<li x-data="{ open: false }" class="border border-orange-300 rounded-xl m-2 overflow-hidden">
    <button
        @click="open=!open"
        class="bg-orange-50 hover:bg-orange-100 w-full text-left transition py-1"
    >
    <div class="flex justify-between">
        <p class="text-orange-500 pl-5 text-xl">
            {{$tracking->context}}
        </p>
        <p class="text-lg pr-5 text-orange-400">
            Qui fa el seguiment {{$tracking->created_at}}
        </p>
    </div>
    </button>
    <div x-show="open" class="bg-white px-6 py-4 border-t border-orange-100 rounded-b-xl">
        <p>
            {{$tracking->description}}
        </p>
    </div>
</li>