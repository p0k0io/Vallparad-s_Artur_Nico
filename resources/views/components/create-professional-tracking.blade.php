<button x-data="{ {{$professional->id}}: false }" class="flex items-center py-2 text-sm text-gray-700 hover:bg-orange-50">
    <x-lucide-file-pen-line class="mr-3 text-orange-600 size-5"/>
    Fer Seguiment
    <div 
        x-show="{{$professional->id}}"
        x-transition
        class="fixed inset-0 backdrop-blur-sm bg-black/40 flex items-center justify-center z-50 px-4"
        @keydown.escape.window="{{$professional->id}} = false"
    >
        <div

            class="bg-white/95 rounded-3xl p-8 w-full max-w-2xl shadow-2xl border border-orange-200"
            @click.outside="{{$professional->id}} = false"
        >
            <!-- titulo modal -->
            <h2 class="text-3xl font-bold text-orange-600 mb-8 text-center">
                Crear nuevo contacto externo
            </h2>

            <!-- formulario -->
            <form action="{{ route('track.professional',$professional) }}" method="post" class="space-y-6">
                @csrf
                <input type="hidden" name="tracked" value="{{$professional->id}}">
                <input type="hidden" name="tracker" value="{{(Auth::user()->email)}}">
                <!-- Tipus -->
                <div>
                    <label class="block text-sm text-orange-600 mb-1 font-medium">Tipus de Seguiment</label>
                    <select name="type" id="" class="w-full border border-orange-200 bg-orange-50 focus:border-orange-500 focus:ring-4 focus:ring-orange-100 px-5 py-4 rounded-xl outline-none transition resize-none" required>
                        <option value="obert">Obert</option>
                        <option value="restringit">Restringit</option>
                        <option value="fi de la vinculacio">Fi de la vinculacio</option>
                    </select>
                </div>

                <!-- Subjecte -->

                <div>
                    <label class="block text-sm text-orange-600 mb-1 font-medium">Subjecte</label>
                    <textarea name="subject" rows="1"
                              class="w-full border border-orange-200 bg-orange-50 focus:border-orange-500 focus:ring-4 focus:ring-orange-100 px-5 py-4 rounded-xl outline-none transition resize-none"
                              placeholder="Ex: Juan ha faltat 3 dies seguits sense avisar"></textarea>
                </div>

                <!-- descripcion -->

                <div>
                    <label class="block text-sm text-orange-600 mb-1 font-medium">Descripció</label>
                    <textarea name="description" rows="3"
                              class="w-full border border-orange-200 bg-orange-50 focus:border-orange-500 focus:ring-4 focus:ring-orange-100 px-5 py-4 rounded-xl outline-none transition resize-none"
                              placeholder="Ex: Juan ha faltat 3 dies seguits sense avisar"></textarea>
                </div>

                
                <!-- botones -->
                <div class="flex justify-end gap-4 pt-4">
                    <button type="button" 
                            @click="openCreate = false"
                            class="px-8 py-4 rounded-full bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold transition-all">
                        Cancelar
                    </button>
                    <button type="submit"
                            class="px-8 py-4 rounded-full bg-orange-500 hover:bg-orange-600 text-white font-semibold shadow-md hover:shadow-lg transition-all">
                        Guardar Seguiment
                    </button>
                </div>
            </form>
        </div>
    </div>
</button>