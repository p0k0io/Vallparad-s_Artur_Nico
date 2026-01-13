@extends('../layouts.app')

@section('title','Maintenance')

@section('content')
    <div class="min-h-screen flex flex-col py-16 items-center z-10">
        <div class="flex justify-center w-3/4 my-3 bg-white shadow-md rounded-full text-center py-1 text-orange-500 conte">
            <svg class="-mr-1 size-5 text-orange-500">
                <use xlink:href="#search"></use>
            </svg>
        </div>
        <div class="bg-white rounded-3xl shadow-md flex flex-col w-3/4 my-3">
            <div class="flex flex-inline justify-between p-4 mx-1">
                <h1 class="text-4xl font-bold text-orange-500">Manteniments</h1>
                <x-create-maintenance/>
            </div>
        @forelse($maintenances as $maintenance)
            <ul class="bg-gray-100 bg-opacity-30 m-4 rounded-xl border border-spacing-5 border-gray-300 border-dashed h-[32rem] overflow-y-scroll">
                    <x-maintenance-card :maintenance="$maintenance"/>
        @empty
            <ul class="bg-gray-100 bg-opacity-30 m-4 rounded-xl flex justify-center items-center border border-spacing-5 border-gray-300 border-dashed h-[32rem] overflow-y-scroll">
                    <h1 class="text-4xl font-bold text-gray-400 text-center my-5">No s'ha trobat ningun manteniment</h1>
        @endforelse
            </ul>
        </div>
    </div>

@vite(['resources/js/maintenance.js'])
@vite(['resources/js/canvas.js'])
@endsection