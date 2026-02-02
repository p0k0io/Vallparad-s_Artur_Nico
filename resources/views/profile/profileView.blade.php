@extends('../layouts.app')

@section('title','Profile')

@section('content')
    <div class="min-h-screen bg-slate-100 py-16 px-6 flex flex-col items-center">
        <div class="w-full max-w-5xl">
            
            <div class="bg-white rounded-3xl shadow-xl p-10 border-2 border-orange-200 mb-5">
                <div class="flex justify-between items-center mb-8 pb-6 border-b-2 border-orange-100">
                    <h2 class="w-2/4 text-2xl font-bold text-gray-800">{{$user->professional->name}} {{$user->professional->surname1}} {{$user->professional->surname2}} <span class="text-gray-400">- {{$user->professional->profession}}</span> </h2>
                </div>
                <div class="flex gap-6 mb-4 pb-3">
                    <div class="flex w-1/3 items-center space-x-4 p-4 rounded-xl bg-gray-50 hover:bg-orange-50 transition-colors">
                        <div class="p-2 bg-white rounded-lg shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-orange-500"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                        </div>
                        <div>
                            <p class="text-xs font-bold uppercase tracking-wider text-gray-500">Email</p>
                            <p class="text-gray-800 font-medium">{{$user->professional->email}}</p>
                        </div>
                    </div>

                    <div class="flex w-1/3 items-center space-x-4 p-4 rounded-xl bg-gray-50 hover:bg-orange-50 transition-colors">
                        <div class="p-2 bg-white rounded-lg shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-orange-500"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                        </div>
                        <div>
                            <p class="text-xs font-bold uppercase tracking-wider text-gray-500">Adreça</p>
                            <p class="text-gray-800 font-medium">{{$user->professional->address}}</p>
                        </div>
                    </div>

                    <div class="flex w-1/3 items-center space-x-4 p-4 rounded-xl bg-gray-50 hover:bg-orange-50 transition-colors">
                        <div class="p-2 bg-white rounded-lg shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-orange-500"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                        </div>
                        <div>
                            <p class="text-xs font-bold uppercase tracking-wider text-gray-500">Telèfon</p>
                            <p class="text-gray-800 font-medium">{{$user->professional->phone}}</p>
                        </div>
                    </div>
                </div>
                <div class="flex gap-6 mb-8 pb-6 border-b border-gray-100">
                    <div class="flex w-1/3 items-center space-x-4 p-4 rounded-xl bg-gray-50 hover:bg-orange-50 transition-colors">
                        <div class="p-2 bg-white rounded-lg shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-orange-500"><rect width="18" height="18" x="3" y="3" rx="2"/><circle cx="7.5" cy="7.5" r=".5" fill="currentColor"/><path d="m7.9 7.9 2.7 2.7"/><circle cx="16.5" cy="7.5" r=".5" fill="currentColor"/><path d="m13.4 10.6 2.7-2.7"/><circle cx="7.5" cy="16.5" r=".5" fill="currentColor"/><path d="m7.9 16.1 2.7-2.7"/><circle cx="16.5" cy="16.5" r=".5" fill="currentColor"/><path d="m13.4 13.4 2.7 2.7"/><circle cx="12" cy="12" r="2"/></svg>
                        </div>
                        <div>
                            <p class="text-xs font-bold uppercase tracking-wider text-gray-500">Taquilla</p>
                            <p class="text-gray-800 font-medium">{{$user->professional->locker}}</p>
                        </div>
                    </div>

                    <div class="flex w-1/3 items-center space-x-4 p-4 rounded-xl bg-gray-50 hover:bg-orange-50 transition-colors">
                        <div class="p-2 bg-white rounded-lg shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-orange-500"><path d="M2.586 17.414A2 2 0 0 0 2 18.828V21a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1v-1a1 1 0 0 1 1-1h1a1 1 0 0 0 1-1v-1a1 1 0 0 1 1-1h.172a2 2 0 0 0 1.414-.586l.814-.814a6.5 6.5 0 1 0-4-4z"/><circle cx="16.5" cy="7.5" r=".5" fill="currentColor"/></svg>
                        </div>
                        <div>
                            <p class="text-xs font-bold uppercase tracking-wider text-gray-500">Codi Clau</p>
                            <p class="text-gray-800 font-medium">{{$user->professional->keyCode}}</p>
                        </div>
                    </div>

                    <div class="flex w-1/3 items-center space-x-4 p-4 rounded-xl bg-gray-50 hover:bg-orange-50 transition-colors">
                        <div class="p-2 bg-white rounded-lg shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-orange-500"><path d="M2 6h4"/><path d="M2 10h4"/><path d="M2 14h4"/><path d="M2 18h4"/><rect width="16" height="20" x="4" y="2" rx="2"/><path d="M15 2v20"/><path d="M15 7h5"/><path d="M15 12h5"/><path d="M15 17h5"/></svg>
                        </div>
                        <div>
                            <p class="text-xs font-bold uppercase tracking-wider text-gray-500">Nota Mitjana</p>
                            <p class="text-gray-800 font-medium">{{ $median }}</p>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row gap-6 mb-8">
                    <div class="flex-1 flex items-center p-6 bg-white border border-gray-100 rounded-2xl shadow-sm">
                        <div class="flex flex-col">
                            <span class="text-4xl font-extrabold text-gray-900 leading-none">
                                {{$numTrackings}}
                            </span>
                            <span class="mt-2 text-sm font-medium text-gray-500 uppercase tracking-wide">
                                Num. de Seguiments
                            </span>
                        </div>
                        <div class="ml-auto bg-orange-100 p-3 rounded-xl">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-orange-600"><path d="M12 20h9"/><path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4Z"/></svg>
                        </div>
                    </div>

                    <div class="flex-1 flex items-center p-6 bg-white border border-gray-100 rounded-2xl shadow-sm">
                        <div class="flex flex-col">
                            <span class="text-4xl font-extrabold text-gray-900 leading-none">
                                {{$numAvaluacions}}
                            </span>
                            <span class="mt-2 text-sm font-medium text-gray-500 uppercase tracking-wide">
                                Num. de Avaluacions
                            </span>
                        </div>
                        <div class="ml-auto bg-blue-100 p-3 rounded-xl">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-blue-600"><path d="M9 5v4"/><rect width="4" height="6" x="7" y="9" rx="1"/><path d="M9 15v2"/><path d="M17 3v2"/><rect width="4" height="8" x="15" y="5" rx="1"/><path d="M17 13v3"/><path d="M3 3v16a2 2 0 0 0 2 2h16"/></svg>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row gap-6 mb-8">
                    <div class="flex-1 flex items-center p-6 bg-white border border-gray-100 rounded-2xl shadow-sm">
                        <div class="flex flex-col">
                            <span class="text-4xl font-extrabold text-gray-900 leading-none">
                                {{$numProjectes}}
                            </span>
                            <span class="mt-2 text-sm font-medium text-gray-500 uppercase tracking-wide">
                                Num. de Projectes Assignats
                            </span>
                        </div>
                        <div class="ml-auto bg-blue-100 p-3 rounded-xl">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-blue-600"><path d="M4 20h16a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2h-7.93a2 2 0 0 1-1.66-.9l-.82-1.2A2 2 0 0 0 7.93 3H4a2 2 0 0 0-2 2v13c0 1.1.9 2 2 2Z"/><circle cx="12" cy="13" r="2"/><path d="M12 15v5"/></svg>
                        </div>
                    </div>

                    <div class="flex-1 flex items-center p-6 bg-white border border-gray-100 rounded-2xl shadow-sm">
                        <div class="flex flex-col">
                            <span class="text-4xl font-extrabold text-gray-900 leading-none">
                                {{$numCourses}}
                            </span>
                            <span class="mt-2 text-sm font-medium text-gray-500 uppercase tracking-wide">
                                Num. de Cursos Cursant
                            </span>
                        </div>
                        <div class="ml-auto bg-orange-100 p-3 rounded-xl">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-orange-600"><path d="M2 3h20"/><path d="M21 3v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V3"/><path d="m7 21 5-5 5 5"/></svg>
                        </div>
                    </div>
                </div>
                
                
            </div>
            <!--
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
                            <p class="text-xl text-gray-500">No tens seguiments.</p>
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
            -->
            
        </div>
        
    </div>

<!--
{{$user->professional->surname2}}  
-->

@vite(['resources/js/maintenance.js'])
@vite(['resources/js/canvas.js'])
@endsection