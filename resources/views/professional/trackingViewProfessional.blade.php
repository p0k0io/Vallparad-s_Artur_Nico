@extends('../layouts.app')

@section('title','Seguiment de Professionals')

@section('content')

<div class="flex justify-center items-center min-h-screen relative">

    <div class="bg-white bg-opacity-95 shadow-xl rounded-2xl p-10 w-2/4 flex flex-col space-y-4 z-10">
        <h2 class="text-3xl font-semibold text-center text-orange-600">
            Segiuments de {{ $professional->name }} {{ $professional->surname1 }} {{ $professional->surname2 }}
        </h2>
        <ul id="seguiments">
            @foreach($trackings as $tracking)
                <li x-data="{ open: false }" class="border border-orange-300 rounded-xl my-2 overflow-hidden">
                    <button
                        @click="open=!open"
                        class="bg-orange-50 hover:bg-orange-200 w-full text-left transition py-1"
                    >
                        <div class="flex justify-between">
                            <p class="text-orange-500 pl-5 text-xl">
                                {{$tracking->subject}} 
                            </p>
                            <p class="text-lg pr-5 text-orange-400 bg-orange-100">
                                {{$tracking->tracker}} ({{$tracking->created_at}})
                            </p>
                        </div>
                    </button>
                    <div x-show="open" class="bg-white px-6 py-4 border-t border-orange-100 rounded-b-xl">
                        <p>
                            {{ $tracking->description }}
                        </p>
                    </div>
                </li>
            @endforeach
        </ul>
        <div class="mb-5">
                {{$trackings->links('pagination::tailwind')}}
        </div>
        <div class="flex justify-center">
            <a href="{{ route('professional.index')}}" class="text-center font-semibold text-white bg-orange-400 mr-2 w-44 rounded-lg py-1">Tornar</a>
            <a href="{{ route('trackingView.professional', $professional)}}" class="text-center font-semibold text-white bg-orange-400 ml-2 w-44 rounded-lg py-1">Nou Seguiment</a>
            <a href="{{ route('assessViewProfessional.professional', $professional)}}" class="text-center font-semibold text-white bg-orange-400 ml-2 w-44 rounded-lg py-1">Veure Valoracions</a>
        </div>
    </div>
</div>
@endsection