<script>
    function toggleInfo() {
        const info = document.getElementById("info");
        info.classList.toggle("hidden");
    }
</script>

<div class="w-full max-w-lg mx-auto bg-white border border-gray-200 rounded-xl p-5 shadow-sm">

    <div class="space-y-1">
        <h1 class="text-xl font-semibold text-gray-900">{{ $user->name }}</h1>

        <h3 class="text-gray-600">
            Manager: <span class="font-medium">{{ $user->manager }}</span>
        </h3>

        <button 
            onclick="toggleInfo()" 
            class="mt-3 px-4 py-2 rounded-lg bg-orange-600 text-white text-sm 
                   hover:bg-orange-700 active:scale-95 transition duration-200">
            More info
        </button>
    </div>

    <div id="info" class="hidden mt-4 border-t border-gray-200 pt-4 space-y-2 text-gray-700">
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Descripción:</strong> {{ $user->description }}</p>
        <p><strong>Teléfono:</strong> {{ $user->phone }}</p>
        <p><strong>Dirección:</strong> {{ $user->address }}</p>
    </div>

</div>
