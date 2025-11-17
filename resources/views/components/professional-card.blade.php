
<div class="bg-green-400 rounded-xl py-4 w-full flex justify-center shadow-lg border-orange-400">
    <div class=" w-full lg:w-3/4 items-center flex bg-red-200 md:flex-row justify-around flex-col">
        <h1 class="font-semibold text-lg">{{$professional->name}} {{$professional->surname1}} {{$professional->surname2}}</h1>
        <div class="bg-yellow-500 flex gap-2">
        <el-dropdown class="inline-block">
                                            <button class="inline-flex w-full justify-center gap-x-1.5 rounded-md bg-white px-3 py-1 text-sm font-semibold text-gray-900 shadow-xs inset-ring-1 inset-ring-gray-300 hover:bg-gray-50">
                                                Opcions
                                                <x-lucide-chevron-down class="-mr-1 size-5 text-orange-500"/>
                                            </button>

                                            <el-menu anchor="bottom end" popover class="border-solid border-2 border-gray-50 m-0 w-52 origin-top-right divide-y divide-gray-100 rounded-md bg-white shadow-lg outline-1 outline-black/5 transition transition-discrete [--anchor-gap:--spacing(2)] data-closed:scale-95 data-closed:transform data-closed:opacity-0 data-enter:duration-100 data-enter:ease-out data-leave:duration-75 data-leave:ease-in">
                                                <div class="py-1">
                                                    <a href="{{ route('assessViewProfessional.professional', $professional) }}" class="w-full inline-flex px-4 py-2 text-sm text-gray-700 focus:bg-gray-100 focus:text-gray-900 focus:outline-hidden">
                                                        <x-lucide-file-badge class="mr-2 size-5 text-orange-500"/>
                                                        Veure Valoracions
                                                    </a>
                                                    <a href="{{ route('trackingViewProfessional.professional', $professional) }}" class="w-full inline-flex px-4 py-2 text-sm text-gray-700 focus:bg-gray-100 focus:text-gray-900 focus:outline-hidden">
                                                        <x-lucide-file-text class="mr-2 size-5 text-orange-500"/>
                                                        Veure Seguiments
                                                    </a>
                                                </div>
                                                <div class="py-1">
                                                    <a href="{{ route('trackingView.professional', $professional) }}" class="w-full inline-flex px-4 py-2 text-sm text-gray-700 focus:bg-gray-100 focus:text-gray-900 focus:outline-hidden">
                                                        <x-lucide-file-pen-line class="mr-2 size-5 text-orange-500"/>
                                                        Fer Seguiment
                                                    </a>
                                                    <a href="{{ route('assessView.professional', $professional) }}" class="w-full inline-flex px-4 py-2 text-sm text-gray-700 focus:bg-gray-100 focus:text-gray-900 focus:outline-hidden">
                                                        <x-lucide-user-pen class="mr-2 size-5 text-orange-500"/>
                                                        Avaluar Professional
                                                    </a>
                                                    <a href="{{ route('professional.edit', $professional) }}" class="w-full inline-flex px-4 py-2 text-sm text-gray-700 focus:bg-gray-100 focus:text-gray-900 focus:outline-hidden">
                                                        <x-lucide-square-pen class="mr-2 size-5 text-orange-500"/>
                                                        Editar Professional
                                                    </a>
                                                </div>
                                            </el-menu>
        </el-dropdown>

        <form action="{{ route('changeStateProfessional', $professional) }}" method="post">
            @csrf
            @method('PUT')
            @if($professional->status==1)
               <input type="submit" value="Desactivar" class="px-3 py-1 w-28 text-sm font-semibold text-white bg-red-400 hover:bg-red-500 rounded-lg transition">
            @else
                <input type="submit" value="Activar" class="px-3 py-1 w-28 text-sm font-semibold text-white bg-green-400 hover:bg-green-500 rounded-lg transition">
            @endif
        </form>
    </div>
</div>


<!--
Modal
-->



