{{-- resources/views/components/professional-modal.blade.php --}}
<div x-data>
    <div x-init="
        professional = $el.closest('[x-data]').__x?.$data?.professional || 
                       window.modalManager ? modalManager().professional : null
    " class="p-8">

        <h1 class="text-4xl font-bold text-orange-600 mb-3">
            <span x-text="professional?.name"></span>
            <span x-text="professional?.surname1"></span>
            <span x-text="professional?.surname2"></span>
        </h1>

        <p class="text-xl text-gray-600 mb-8" x-text="professional?.email"></p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 text-lg">

            <div>
                <h4 class="font-semibold text-gray-700 border-b border-orange-300 pb-2">Email</h4>
                <p x-text="professional?.email" class="mt-2"></p>
            </div>

            <div>
                <h4 class="font-semibold text-gray-700 border-b border-orange-300 pb-2">Telèfon</h4>
                <p x-text="professional?.phone || 'No disponible'" class="mt-2"></p>
            </div>

            <div>
                <h4 class="font-semibold text-gray-700 border-b border-orange-300 pb-2">Adreça</h4>
                <p x-text="professional?.address || 'No especificada'" class="mt-2"></p>
            </div>

            <div>
                <h4 class="font-semibold text-gray-700 border-b border-orange-300 pb-2">Estat</h4>
                <p :class="professional?.status == 1 ? 'text-green-600' : 'text-red-600'" class="font-bold mt-2">
                    <span x-text="professional?.status == 1 ? 'Actiu' : 'Inactiu'"></span>
                </p>
            </div>

            <div class="md:col-span-2">
                <h4 class="font-semibold text-gray-700 border-b border-orange-300 pb-2">Última avaluació</h4>
                <p x-text="professional?.evaluation || 'Sense avaluació'" class="italic mt-2"></p>
            </div>

            <div class="md:col-span-2">
                <h4 class="font-semibold text-gray-700 border-b border-orange-300 pb-2">Seguiment</h4>
                <p x-text="professional?.tracking || 'Sense seguiment'" class="italic mt-2"></p>
            </div>
        </div>
    </div>
</div>