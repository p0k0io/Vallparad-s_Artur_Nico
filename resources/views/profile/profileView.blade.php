@extends('../layouts.app')

@section('title','Profile')

@section('content')
    <div class="min-h-screen bg-slate-100 py-16 px-6 flex flex-col items-center">
        <div class="w-full max-w-5xl">
            
            <div class="bg-white rounded-3xl shadow-xl p-10 border-2 border-orange-200 mb-5">
                <div class="flex justify-between items-center mb-8 pb-6 border-b-2 border-orange-100">
                    <h2 class="w-2/4 text-2xl font-bold text-gray-800">{{$user->professional->name}} {{$user->professional->surname1}} {{$user->professional->surname2}} <span class="text-gray-400">- {{$user->professional->profession}}</span> </h2>
                    <div class="flex gap-4">
                        Editar
                    </div>     
                </div>
                <div class="flex justify-between items-center mb-8 pb-6 ">
                    <p class="text-lg"> <span class="text-orange-500 bold">Email:</span>  {{$user->professional->email}}  </p>
                    <p class="text-lg"> <span class="text-orange-500 bold">Adreça:</span>  {{$user->professional->address}}  </p>
                    <p class="text-lg"> <span class="text-orange-500 bold">Telèfon:</span>  {{$user->professional->phone}}  </p>
                </div>
                
            </div>
            <div class="flex w-full gap-5">
                <div class="bg-white rounded-3xl shadow-xl p-10 border-2 border-orange-200 w-2/4">
                    <div class="flex justify-between items-center mb-8 pb-6 border-b-2 border-orange-100">
                        <h2 class="w-2/4 text-2xl font-bold text-gray-800">Seguiments</h2>
                    </div> 
                    @forelse($trackings as $tracking)
                    <div x-data="{ open: false }" class="border border-orange-300 rounded-xl overflow-hidden m-3">
                        <button @click="open = !open" class="bg-orange-50 hover:bg-orange-100 w-full text-left transition py-1 flex px-3">
                            <div class="flex flex-col w-full">
                                <h2 class="text-orange-500 text-2xl">{{$tracking->subject}}</h1>
                                <div class="flex justify-between">
                                    <p class="text-gray-400 text-right">Seguiment fet per: no va de moment</p>
                                </div>

                            </div>
                        </button>
                        <div x-show="open" x-collapse class="bg-white px-6 py-4 border-t border-orange-100">
                            <p class="w-3/5">{{$tracking->description}}</p>
                        </div>
                    </div>
                    @empty
                        <div class="text-center py-12">
                            <p class="text-xl text-gray-500">No tens seguiments</p>
                            <p class="mt-2 text-gray-400">Comença afegint-ne un</p>
                        </div>
                    @endforelse
                </div>
                <div class="bg-white rounded-3xl shadow-xl p-10 border-2 border-orange-200 w-2/4">
                    <div class="flex justify-between items-center mb-8 pb-6 border-b-2 border-orange-100">
                        <h2 class="w-2/4 text-2xl font-bold text-gray-800">Avaluacions</h2>
                    </div> 
                    @forelse($evaluations as $evaluation)
                        <div>Algo</div>
                    @empty
                        <div class="text-center py-12">
                            <p class="text-xl text-gray-500">No tens avaluacions.</p>
                        </div>
                    @endforelse
                </div>
                    
            </div>
            
        </div>
        
    </div>

<!--
{{$user->professional->surname2}}  
-->

@vite(['resources/js/maintenance.js'])
@vite(['resources/js/canvas.js'])
@endsection