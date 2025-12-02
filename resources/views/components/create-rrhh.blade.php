<div x-data="{ openCreate:false }">
    <button 
        @click="openCreate = true"
        class="bg-orange-400 text-white text-lg px-20 py-2 font-bold rounded-full shadow-md transition-all"
    >
        Fer RRHH
    </button>

    <div 
        x-show="openCreate" 
        
        class="fixed inset-0 backdrop-blur-sm flex items-center justify-center "
    >
        <div class="bg-white/95 rounded-3xl p-6 w-full max-w-lg shadow-xl border border-orange-200"
            @click.outside="openCreate=false"
        >
            <h1 class="text-orange-500 font-bold text-2xl text-center mb-6 ">Fer RRHH</h1>
            
            <div id="rrhhForm">
                <form action="{{route('rrhh.store')}}" method="POST" class="space-y-4">
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
                        <label class="block text-sm text-orange-600 mb-1 font-medium">Profesional afectat</label>
                        <select name="professional_afectat" required
                            class="w-full border border-orange-200 bg-orange-50 focus:border-orange-400 focus:ring-orange-400 px-3 py-2 rounded-xl outline-none transition"
                        >
                            @foreach($professionals as $professional)
                                <option value="{{ $professional->id }}">{{ $professional->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm text-orange-600 mb-1 font-medium">Profesional derivat</label>
                        <select name="professional_derivat" required
                            class="w-full border border-orange-200 bg-orange-50 focus:border-orange-400 focus:ring-orange-400 px-3 py-2 rounded-xl outline-none transition"
                        >
                            @foreach($professionals as $professional)
                                <option value="{{ $professional->id }}">{{ $professional->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="px-4 py-2 rounded-full bg-orange-500 hover:bg-orange-600 text-white font-medium shadow-md transition">
                        Crear
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
