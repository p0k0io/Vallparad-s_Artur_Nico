@extends('../layouts.app')

@section('title','Incidencies')

@section('content')
    <div class="min-h-screen flex flex-col py-16 items-center">
        <div class="inline-flex justify-center w-3/4 my-3 gap-2">
            <div class="w-1/6 bg-white shadow-md rounded-full text-center py-1 text-orange-500">Manteniment</div>
            <div class="w-1/6 bg-white shadow-md rounded-full text-center py-1 text-orange-500">Accidentabilitat</div>
            <div class="w-1/6 bg-white shadow-md rounded-full text-center py-1 text-orange-500">RRHH</div>
            <div class="w-3/6 bg-white shadow-md rounded-full text-center py-1 text-orange-500"></div>
        </div>
        <div class="bg-white rounded-3xl shadow-md flex flex-col w-3/4 my-3">
            <div class="flex flex-inline justify-center p-4">
                <h1 class="text-4xl font-bold text-orange-500">Ultimes Incidencies</h1>
            </div>
            <div class="bg-gray-100 bg-opacity-50 m-4 rounded-3xl border border-spacing-5 border-gray-300 border-dashed">
                <x-maintenance-card/>
            </div>
        </div>
    </div>
@endsection