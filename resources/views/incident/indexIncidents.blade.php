@extends('../layouts.app')

@section('title','Incidencies')

@section('content')
    <div class="min-h-screen flex flex-col py-16 items-center z-10">
        <div class="inline-flex justify-center w-3/4 my-3 gap-2">
            <button id="showMaintenance" class="w-1/6 bg-white shadow-md rounded-full text-center py-1 text-orange-500">Manteniment</button>
            <button id="showAccidentability" class="w-1/6 bg-white shadow-md rounded-full text-center py-1 text-orange-500">Accidentabilitat</button>
            <button id="showRRHH" class="w-1/6 bg-white shadow-md rounded-full text-center py-1 text-orange-500">RRHH</button>
            <div class="w-3/6 bg-white shadow-md rounded-full text-center py-1 text-orange-500"></div>
        </div>
        <div class="bg-white rounded-3xl shadow-md flex flex-col w-3/4 my-3 ">
            <div class="flex flex-inline justify-between p-4 mx-1">
                <h1 class="text-4xl font-bold text-orange-500">Ultimes Incidencies</h1>
                <x-create-incident/>
            </div>
            <ul class="bg-gray-100 bg-opacity-30 m-4 rounded-xl border border-spacing-5 border-gray-300 border-dashed">
                @forelse($incidents as $incident)
                    @if($incident->type=='maintenance')
                        <x-maintenance-card/>
                    @elseif($incident->type=='rrhh')
                        <p>de moment res</p>
                    @elseif($incident->type=='accidentability')
                        <x-accidentability-card :incident="$incident"/>
                    @endif
                @empty
                    <h1 class="text-4xl font-bold text-gray-400 text-center my-5">No s'ha trobat ningun incident</h1>
                @endforelse
            </ul>
        </div>
    </div>

@vite(['resources/js/incidents.js'])
@endsection