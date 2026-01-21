@extends('../layouts.app')

@section('title','Accidentability')

@section('content')

    <div class="min-h-screen bg-slate-100 py-16 px-6 flex flex-col items-center">
        <div class="w-full max-w-5xl">
            <div class="text-center mb-12">
                <h1 class="text-4xl font-extrabold text-orange-500 mb-3 tracking-tight">
                    Accidents
                </h1>
                <p class="text-lg text-gray-600">
                    Gestio d'accidents
                </p>
            </div>
            <div class="bg-white rounded-3xl shadow-xl p-10 border-2 border-orange-200">

                <!-- cabecera con titulo y boton crear -->
                <div class="flex justify-between items-center mb-10 pb-6 border-b-2 border-orange-100">
                    <h2 class="text-3xl font-bold text-gray-800">Llista d'accidents</h2>

                    <!-- boto crear manteniment -->
                    <x-create-accident/>
                </div>

                <!-- llista de manteniments -->
                <div class="space-y-6">
                    @forelse($accidents as $accident)
                        <div class="hover:-translate-y-1 transition-all duration-300">
                            <x-accidentability-card :accident="$accident"/>
                        </div>
                    @empty
                        <div class="text-center py-12">
                            <p class="text-xl text-gray-500">No hi han accidents encara.</p>
                            <p class="mt-2 text-gray-400">Comença afegint-ne un</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
        
    </div>


@vite(['resources/js/accidentability.js'])
@vite(['resources/js/canvas.js'])
@endsection