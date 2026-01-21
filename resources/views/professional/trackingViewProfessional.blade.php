@extends('../layouts.app')

@section('title','Seguiment de Professionals')

@section('content')

<div x-data="{ openCreate: false }">

    <div class="min-h-screen bg-slate-100 py-16 px-6 flex flex-col items-center">

        <div class="w-full max-w-5xl">

            <!-- titulo principal -->
            <div class="text-center mb-12">
                <h1 class="text-4xl font-extrabold text-orange-500 mb-3 tracking-tight">
                    Segiuments de {{ $professional->name }} {{ $professional->surname1 }} {{ $professional->surname2 }}
                </h1>
                <p class="text-lg text-gray-600">
                    Text de exemple
                </p>
            </div>

            <!-- tarjeta principal con lista -->
            <div class="bg-white rounded-3xl shadow-xl p-10 border-2 border-orange-200">

                <!-- cabecera con titulo y boton crear -->
                <div class="flex justify-between items-center mb-10 pb-6 border-b-2 border-orange-100">
                    <h2 class="text-3xl font-bold text-gray-800">Lista de Seguiments</h2>

                    <!-- boton abrir modal -->
                    <button
                        @click="openCreate = true"
                        class="flex items-center gap-3 px-8 py-4 rounded-full bg-orange-500 hover:bg-orange-600 text-white font-semibold shadow-md hover:shadow-lg hover:scale-[1.02] transition-all duration-300"
                    >
                        <x-lucide-plus class="w-6 h-6"/>
                        Nou Seguiment
                    </button>
                </div>

                <!-- lista de seguiments -->
                <div class="space-y-6">
                    @forelse($trackings as $tracking)
                        <div class="hover:-translate-y-1 transition-all duration-300">

                            <x-professional-tracking-card :tracking="$tracking"/>

                        </div>
                    @empty
                        <div class="text-center py-12">
                            <p class="text-xl text-gray-500">No hi han seguiments.</p>
                            <p class="mt-2 text-gray-400">Comença introduint el primer</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    
    <!-- modal crear contacto con alpine -->
    <div 
        x-show="openCreate" 
        x-transition
        class="fixed inset-0 backdrop-blur-sm bg-black/40 flex items-center justify-center z-50 px-4"
        @keydown.escape.window="openCreate = false"
    >
        <div 
            class="bg-white/95 rounded-3xl p-8 w-full max-w-2xl shadow-2xl border border-orange-200"
            @click.outside="openCreate = false"
        >
            <!-- titulo modal -->
            <h2 class="text-3xl font-bold text-orange-600 mb-8 text-center">
                Crear nou seguiment
            </h2>

            <!-- formulario -->
            <form action="{{ route('track.professional',$professional) }}" method="post" class="space-y-6">
                @csrf
                <input type="hidden" name="tracked" value="{{$professional->id}}">
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
</div>

@endsection