<div x-data="{ openCreate:false }">
    <button 
        @click="openCreate = true"
        class="bg-orange-400 text-white text-lg px-20 py-2 font-bold rounded-full shadow-md transition-all"
    >
        Fer Incidencia
    </button>

    <div 
        x-show="openCreate" 
        
        class="fixed inset-0 backdrop-blur-sm flex items-center justify-center "
    >
        <div class="bg-white/95 rounded-3xl p-6 w-full max-w-lg shadow-xl border border-orange-200"
            @click.outside="openCreate=false"
        >
            <h1 class="text-orange-500 font-bold text-2xl text-center mb-6 ">Fer Incidencia</h1>
            <div class="flex w-full m-0">
                <button id="btMaintenance" class="w-1/3 border-b-2 hover:border-orange-500 transition">Manteniment</button>
                <button id="btRRHH" class="w-1/3 border-b-2 hover:border-orange-500 transition">RRHH</button>
                <button id="btAccidentability" class="w-1/3 border-b-2 hover:border-orange-500 transition">Accidentabilitat</button>
            </div>

            <div id="maintenanceForm" class="hidden">
                <form action="{{route('maintenance.store')}}" method="POST" class="space-y-4">
                @csrf
                    <div>
                        <label class="block text-sm text-orange-600 mb-1 font-medium">Context</label>
                        <input type="text" name="context" required
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
                    <button type="submit" class="px-4 py-2 rounded-full bg-orange-500 hover:bg-orange-600 text-white font-medium shadow-md transition">
                        Crear
                    </button>
                </form>
            </div>

            <div id="rrhhForm" class="hidden">
                Formulari raro
            </div>

            <div id="accidentabilityForm" class="hidden">
                <form action="" method="POST" class="space-y-4">
                @csrf
                    <label class="block text-sm text-orange-600 mb-1 font-medium">Tipus de Baixa</label>
                    <select name="type" class="w-full border border-orange-200 bg-orange-50 focus:border-orange-400 focus:ring-orange-400 px-3 py-2 rounded-xl outline-none transition">
                        <option value="seminar">Amb Baixa</option>
                        <option value="congress" selected>Sense Baixa</option>
                    </select>
                    <div>
                        <label class="block text-sm text-orange-600 mb-1 font-medium">Context</label>
                        <input type="text" name="name" required
                            class="w-full border border-orange-200 bg-orange-50 focus:border-orange-400 focus:ring-orange-400 px-3 py-2 rounded-xl outline-none transition"
                        >
                    </div>
                    <div>
                        <label class="block text-sm text-orange-600 mb-1 font-medium">Descripció</label>
                        <textarea name="description" required
                            class="w-full border border-orange-200 bg-orange-50 focus:border-orange-400 focus:ring-orange-400 px-3 py-2 rounded-xl outline-none transition"
                        ></textarea>
                    </div>
                    <button type="submit" class="px-4 py-2 rounded-full bg-orange-500 hover:bg-orange-600 text-white font-medium shadow-md transition">
                        Crear
                    </button>
                </form>
            </div>
        </div>
    </div>

</div>
