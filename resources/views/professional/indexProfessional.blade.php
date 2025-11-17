@extends('../layouts.app')

@section('title','Valoracio Professionals')

@section('content')
<div class="flex justify-center min-h-screen relative" x-data="{ selectedProfessional: null, openModal: false }">

    <!-- MODAL IZQUIERDO COMO COMPONENTE -->
    <x-professional-modal 
        :professional="selectedProfessional" 
        x-show="openModal" 
        @click.outside="openModal = false" 
    />

    <!-- CONTENEDOR DE PROFESIONAL GRID -->
    <div class="flex flex-col w-full lg:w-2/3 bg-white bg-opacity-95 z-50 rounded-xl mx-5 my-10 shadow-md p-5">

        <!-- BUSCADOR Y BOTONES -->
        <form class="flex flex-row w-full justify-between mb-10" action="" method="post">
            <input class="bg-white border-2 w-2/3 border-grey-400 rounded-xl px-3 py-2" type="text" name="searchP" id="searchP" placeholder="Buscar Professional">
            <button class="flex justify-center px-4" type="submit">
                <x-lucide-search class="size-7 text-gray-500 m-auto"/>
            </button>
            <input class="bg-white border-2 w-16 border-orange-400 rounded-3xl" type="button" value="">
            <input class="bg-white border-2 w-16 border-orange-700 rounded-3xl" type="button" value="">
        </form>

        <!-- GRID DE CARDS -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach ($professionals as $professional)
                <div 
                    class="cursor-pointer"
                    @click="selectedProfessional = @js($professional); openModal = true"
                >
                    <x-professional-card :professional="$professional" />
                </div>
            @endforeach
        </div>

        <!-- PAGINACION -->
        <div class="mt-5">
            {{$professionals->links('pagination::tailwind')}}
        </div>

        <!-- BOTON CREAR NUEVO -->
        <div class="flex justify-end mt-5">
            <a class="bg-orange-400/90 text-white text-center text-2xl w-20 py-1 rounded-full hover:bg-orange-400 transition" href="{{ route('professional.create') }}">+</a>
        </div>
    </div>
</div>

@vite(['resources/js/professional.js'])
@endsection
