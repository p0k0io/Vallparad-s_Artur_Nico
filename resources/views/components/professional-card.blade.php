<div class="bg-gradient-to-r from-white to-orange-50 rounded-2xl w-full shadow-md border border-orange-300/50 hover:border-orange-400 transition-all duration-300 relative">
    <div class="p-3 flex flex-col md:flex-row items-center justify-between gap-3">

        <!-- Nombre del profesional -->
        <h1 class="font-semibold text-lg md:text-xl text-gray-900 text-center md:text-left leading-snug">
            {{ $professional->name }} {{ $professional->surname1 }} {{ $professional->surname2 }}
        </h1>

        <div class="flex flex-col sm:flex-row items-center gap-2 md:gap-3">

            <!-- Menú Opciones con teleport -->
            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open"
                        class="inline-flex items-center gap-1 md:gap-2 rounded-lg px-3 py-2 text-xs md:text-sm font-semibold text-slate-800 bg-gray-100 hover:bg-gray-200 transition">
                    Opcions
                    <x-lucide-chevron-down class="text-orange-600 size-4 md:size-5"/>
                </button>

                <!-- Dropdown teleported al body -->
                <div x-show="open" x-cloak x-teleport="body"
                     @click.outside="open = false"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 transform scale-95"
                     x-transition:enter-end="opacity-100 transform scale-100"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 transform scale-100"
                     x-transition:leave-end="opacity-0 transform scale-95"
                     class="absolute mt-2 w-64 bg-white rounded-xl shadow-lg border border-gray-200 z-[9999]">
                    <div class="py-1 md:py-2">
                        <a href="{{ route('assessViewProfessional.professional', $professional) }}"
                           class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-orange-50">
                            <x-lucide-file-badge class="mr-3 text-orange-600 size-5"/>
                            Veure Valoracions
                        </a>
                        <a href="{{ route('trackingViewProfessional.professional', $professional) }}"
                           class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-orange-50">
                            <x-lucide-file-text class="mr-3 text-orange-600 size-5"/>
                            Veure Seguiments
                        </a>
                    </div>

                    <div class="border-t border-gray-200 py-1 md:py-2">
                        <a href="{{ route('trackingView.professional', $professional) }}"
                           class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-orange-50">
                            <x-lucide-file-pen-line class="mr-3 text-orange-600 size-5"/>
                            Fer Seguiment
                        </a>
                        <a href="{{ route('assessView.professional', $professional) }}"
                           class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-orange-50">
                            <x-lucide-user-pen class="mr-3 text-orange-600 size-5"/>
                            Avaluar Professional
                        </a>
                        <a href="{{ route('professional.edit', $professional) }}"
                           class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-orange-50">
                            <x-lucide-square-pen class="mr-3 text-orange-600 size-5"/>
                            Editar Professional
                        </a>
                    </div>
                </div>
            </div>

            <!-- Botón Activar/Desactivar -->
            <form @click.stop action="{{ route('changeStateProfessional', $professional) }}" method="post">
                @csrf
                @method('PUT')
                @if($professional->status == 1)
                    <button type="submit"
                            class="px-3 py-2 text-xs md:text-sm font-bold text-white bg-red-600 hover:bg-red-700 rounded-lg transition transform hover:scale-105 shadow-sm">
                        Desactivar
                    </button>
                @else
                    <button type="submit"
                            class="px-3 py-2 text-xs md:text-sm font-bold text-white bg-green-600 hover:bg-green-700 rounded-lg transition transform hover:scale-105 shadow-sm">
                        Activar
                    </button>
                @endif
            </form>

        </div>
    </div>
</div>
