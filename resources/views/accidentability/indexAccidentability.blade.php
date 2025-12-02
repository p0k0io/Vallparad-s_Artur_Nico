@extends('../layouts.app')

@section('title','Accidentability')

@section('content')
    <div class="min-h-screen flex flex-col py-16 items-center z-10">
        <div class="inline-flex justify-center w-3/4 my-3 gap-2">
            <div class="w-full bg-white shadow-md rounded-full text-center py-1 text-orange-500"></div>
        </div>
        <div class="bg-white rounded-3xl shadow-md flex flex-col w-3/4 my-3 ">
            <div class="flex flex-inline justify-between p-4 mx-1">
                <h1 class="text-4xl font-bold text-orange-500">Ultims Accidents</h1>
                <x-create-accident/>
            </div>
            <ul class="bg-gray-100 bg-opacity-30 m-4 rounded-xl border border-spacing-5 border-gray-300 border-dashed">
                @forelse($accidents as $accident)
                        <x-accidentability-card :accident="$accident"/>
                @empty
                    <h1 class="text-4xl font-bold text-gray-400 text-center my-5">No s'ha trobat ningun accident</h1>
                @endforelse
            </ul>
        </div>
    </div>

@vite(['resources/js/accidentability.js'])
@endsection