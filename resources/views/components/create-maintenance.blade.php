<div x-data="{ openCreate:false }">
    <button 
        @click="openCreate = true"
        class="bg-orange-400 text-white text-lg px-20 py-2 font-bold rounded-full shadow-md transition-all"
    >
        Fer Manteniment
    </button>

    <div 
        x-show="openCreate" 
        class="fixed inset-0 backdrop-blur-sm flex items-center justify-center "
    >
        <div class="bg-white/95 rounded-3xl p-6 w-full max-w-lg shadow-xl border border-orange-200"
            @click.outside="openCreate=false"
        >
            <h1 class="text-orange-500 font-bold text-2xl text-center mb-6 ">Fer Manteniment</h1>
            
            <div id="maintenanceForm">
                <form action="{{route('maintenance.store')}}" method="POST" class="space-y-4">
                @csrf
                    <div>
                        <label class="block text-sm text-orange-600 mb-1 font-medium">Context</label>
                        <input type="text" name="context" required
                            class="w-full border border-orange-200 bg-orange-50 focus:border-orange-400 focus:ring-orange-400 px-3 py-2 rounded-xl outline-none transition"
                        >
                    </div>
                    <div>
                        <label class="block text-sm text-orange-600 mb-1 font-medium">Responsable</label>
                        <input type="text" name="responsible" required
                            class="w-full border border-orange-200 bg-orange-50 focus:border-orange-400 focus:ring-orange-400 px-3 py-2 rounded-xl outline-none transition"
                        >
                    </div>
                    <div>
                        <label class="block text-sm text-orange-600 mb-1 font-medium">Descripció</label>
                        <textarea name="description" required
                            class="w-full border border-orange-200 bg-orange-50 focus:border-orange-400 focus:ring-orange-400 px-3 py-2 rounded-xl outline-none transition"
                        ></textarea>
                    </div>
                    <div>
                        <label class="block text-sm text-orange-600 mb-1 font-medium">Path (no creat)</label>
                        <input type="text" name="path"
                            class="w-full border border-orange-200 bg-orange-50 focus:border-orange-400 focus:ring-orange-400 px-3 py-2 rounded-xl outline-none transition"
                        >
                    </div>
                    <div>
                        <label class="block text-sm text-orange-600 mb-1 font-medium">Firma</label>
                        <div class="border border-orange-200 rounded-xl overflow-hidden">
                            <div class="bg-orange-50 border-b-2 border-orange-200 p-2 flex justify-between">
                                <a id="clear" class="border-b-2 border-orange-300 text-orange-600">Netejar</a>
                                <a id="guardar" class="border-b-2 border-orange-300 text-orange-600">Guardar</a>
                            </div>
                            <div class="h-36">
                                <canvas width="460" height="144" id="canvas" class="border-orange-200 bg-white"></canvas>
                            </div>
                        </div>
                        <input type="hidden" id="signature" name="signature">
                    </div>
                    <button type="submit" class="crateMaintenanceButton px-4 py-2 rounded-full bg-orange-500 hover:bg-orange-600 text-white font-medium shadow-md transition w-full">
                        Crear
                    </button>
                </form>
            </div>           
        </div>
    </div>
</div>
