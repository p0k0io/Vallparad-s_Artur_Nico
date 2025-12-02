@extends('../layouts.app')

@section('title','RRHH')

@section('content')
    <div class="min-h-screen flex flex-col py-16 items-center z-10">
        <div class="flex justify-center w-3/4 my-3 bg-white shadow-md rounded-full text-center py-1 text-orange-500 conte">
            <svg class="-mr-1 size-5 text-orange-500">
                <use xlink:href="#search"></use>
            </svg>
        </div>
        <div class="bg-white rounded-3xl shadow-md flex flex-col w-3/4 my-3 ">
            <div class="flex flex-inline justify-between p-4 mx-1">
                <h1 class="text-4xl font-bold text-orange-500">Ultims RRHH</h1>
                <x-create-rrhh :professionals="$professionals"/>
            </div>
            <ul class="bg-gray-100 bg-opacity-30 m-4 rounded-xl border border-spacing-5 border-gray-300 border-dashed">
                @forelse($rrhhs as $rrhh)
                        <x-rrhh-card :rrhh="$rrhh"/>
                @empty
                    <h1 class="text-4xl font-bold text-gray-400 text-center my-5">No s'ha trobat ningun RRHH</h1>
                @endforelse
            </ul>
        </div>
    </div>

@vite(['resources/js/incidents.js'])
@endsection