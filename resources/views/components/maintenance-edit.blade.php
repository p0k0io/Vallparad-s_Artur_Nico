<div class="fixed inset-0 backdrop-blur-sm items-center justify-center hidden">
    <div class="bg-white/95 rounded-3xl p-6 w-full max-w-lg shadow-xl border border-orange-200 z-50">
        <h1 class="text-orange-500 font-bold text-2xl text-center mb-6 ">Fer Manteniment</h1>  
            <form action="{{route('maintenance.store')}}" method="POST" class="space-y-4">
                @csrf
                <input type="hidden" name="maintenance_id" value="{{$maintenance->id}}">
                <div>
                    <label class="block text-sm text-orange-600 mb-1 font-medium">Context</label>
                    <input type="text" name="context" value="{{ $maintenance->context }}"
                        class="w-full border border-orange-200 bg-orange-50 focus:border-orange-400 focus:ring-orange-400 px-3 py-2 rounded-xl outline-none transition"
                    >
                </div>
                <div>
                    <label class="block text-sm text-orange-600 mb-1 font-medium">Responsable</label>
                    <input type="text" name="responsible" value="{{ $maintenance->responsible }}"
                        class="w-full border border-orange-200 bg-orange-50 focus:border-orange-400 focus:ring-orange-400 px-3 py-2 rounded-xl outline-none transition"
                    >
                </div>
                <div>
                    <label class="block text-sm text-orange-600 mb-1 font-medium">Descripció</label>
                    <textarea name="description" value="{{ $maintenance->description }}"
                        class="w-full border border-orange-200 bg-orange-50 focus:border-orange-400 focus:ring-orange-400 px-3 py-2 rounded-xl outline-none transition"
                    ></textarea>
                </div>
                <div>
                    <label class="block text-sm text-orange-600 mb-1 font-medium">Path (no creat)</label>
                    <input type="text" name="path" value="{{ $maintenance->path }}" class="w-full border border-orange-200 bg-orange-50 focus:border-orange-400 focus:ring-orange-400 px-3 py-2 rounded-xl outline-none transition">
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
                <input type="submit" value="Crear" class="px-4 py-2 rounded-full bg-orange-500 hover:bg-orange-600 text-white font-medium shadow-md transition w-full">
            </form>
        </div>           
    </div>
</div>
