<div x-data="{ openCreate:false }">


    <button 
        @click="openCreate = true"
        class="flex items-center gap-2 px-4 h-11 rounded-full bg-orange-400/90 hover:bg-orange-500 text-white font-medium shadow-sm transition-all"
    >
        <x-lucide-plus class="w-5 h-5"/>
        Nou Projecte/Comisio
    </button>



    <div 
        x-show="openCreate" 
        x-transition
        class="fixed inset-0 backdrop-blur-sm flex items-center justify-center "
    >
        <div class="bg-white/95 rounded-3xl p-6 w-full max-w-lg shadow-xl border border-orange-200"
             @click.outside="openCreate=false"
        >
            <h2 class="text-xl font-semibold text-orange-600 mb-6">
                Crear un nou Projecte/Comisio
            </h2>

            <form action="{{ route('projects_comisions.store') }}" method="POST" class="space-y-4">
                @csrf


                <div>
                    <label class="block text-sm text-orange-600 mb-1 font-medium">Nom del Projecte/Comisio</label>
                    <input type="text" name="name" required
                        class="w-full border border-orange-200 bg-orange-50 focus:border-orange-400 focus:ring-orange-400 px-3 py-2 rounded-xl outline-none transition"
                    >
                </div>

                <div>
                    <label class="block text-sm text-orange-600 mb-1 font-medium">Descripció</label>
                    <textarea name="description"
                        class="w-full border border-orange-200 bg-orange-50 focus:border-orange-400 focus:ring-orange-400 px-3 py-2 rounded-xl outline-none transition"
                    ></textarea>
                </div>

                <div>
                    <label class="block text-sm text-orange-600 mb-1 font-medium">Observacions</label>
                    <textarea name="observations"
                        class="w-full border border-orange-200 bg-orange-50 focus:border-orange-400 focus:ring-orange-400 px-3 py-2 rounded-xl outline-none transition"
                    ></textarea>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-sm text-orange-600 mb-1 font-medium">Tipus</label>
                        <select name="type" required
                            class="w-full border border-orange-200 bg-orange-50 focus:border-orange-400 focus:ring-orange-400 px-3 py-2 rounded-xl outline-none transition"
                        >
                            <option value="project">Projecte</option>
                            <option value="comision">Comisio</option>
                        </select>
                    </div>

                    
                </div>

                <!--
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-sm text-orange-600 mb-1 font-medium">Fecha inicio</label>
                        <input type="date" name="startDate"
                               class="w-full border border-orange-200 bg-orange-50 focus:border-orange-400 focus:ring-orange-400 px-3 py-2 rounded-xl outline-none transition">
                    </div>

                    <div>
                        <label class="block text-sm text-orange-600 mb-1 font-medium">Fecha fin</label>
                        <input type="date" name="endDate"
                               class="w-full border border-orange-200 bg-orange-50 focus:border-orange-400 focus:ring-orange-400 px-3 py-2 rounded-xl outline-none transition">
                    </div>
                </div>


                <input type="hidden" name="attendee" value="0">
                -->
                <div class="grid grid-cols-2 gap-3">
                    
                    <div>
                        <label class="block text-sm text-orange-600 mb-1 font-medium">Centro</label>
                        <select name="center_id" required
                            class="w-full border border-orange-200 bg-orange-50 focus:border-orange-400 focus:ring-orange-400 px-3 py-2 rounded-xl outline-none transition"
                        >
                        
                            @foreach($centers as $center)
                                <option value="{{ $center->id }}">{{ $center->name }}</option>
                            @endforeach
                        
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-sm text-orange-600 mb-1 font-medium">Profesional</label>
                        <select name="professional_id" required
                            class="w-full border border-orange-200 bg-orange-50 focus:border-orange-400 focus:ring-orange-400 px-3 py-2 rounded-xl outline-none transition"
                        >
                        
                            @foreach($professionals as $professional)
                                <option value="{{ $professional->id }}">{{ $professional->name }} {{ $professional->surname1 }} {{ $professional->surname2 }}</option>
                            @endforeach
                        
                        </select>
                    </div>
                </div>


                <div class="flex justify-end gap-3 pt-2">
                    <button type="button" 
                        @click="openCreate = false"
                        class="px-4 py-2 rounded-full bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium transition"
                    >
                        Cancelar
                    </button>

                    <button type="submit"
                        class="px-4 py-2 rounded-full bg-orange-500 hover:bg-orange-600 text-white font-medium shadow-md transition"
                    >
                        Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
