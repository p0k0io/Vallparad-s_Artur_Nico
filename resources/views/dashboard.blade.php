@extends('../layouts.app')

@section('title','Accidentability')

@section('content')

<div class="w-full flex flex-col justify-center items-center py-16 px-6">
    
    <!-- Contenedor principal -->
    <div class="w-full max-w-7xl bg-white rounded-3xl shadow-xl p-10">
        <div class="font-medium text-sm text-gray-500">{{ Auth::user()->role }}</div>

        <!-- Cabecera -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-extrabold text-orange-500 mb-3 tracking-tight">
                Panell de Control
            </h1>
            <p class="text-lg text-gray-600">
                Acces rapid i organitzat a tots els moduls del sistema
            </p>
        </div>

        <!-- Grid de tarjetas -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">

           @if (Auth::user()->role === 'Equip Directiu')

            <a href="{{ route('admin.index') }}" 
               class="group bg-white border-2 border-orange-200 rounded-2xl shadow-md hover:shadow-2xl hover:border-orange-400 hover:-translate-y-2 transition-all duration-300 overflow-hidden">
                <div class="p-8 text-center">
                    <div class="mx-auto mb-6 w-20 h-20 bg-orange-100 rounded-2xl flex items-center justify-center group-hover:bg-orange-200 transition-colors">
                        <svg class="w-10 h-10 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">Usuaris</h3>
                    <p class="text-gray-600">Gestio completa d'usuaris del sistema</p>
                </div>
            </a>

            @endif
            
            <a href="{{ route('professional.index') }}" 
               class="group bg-white border-2 border-orange-200 rounded-2xl shadow-md hover:shadow-2xl hover:border-orange-400 hover:-translate-y-2 transition-all duration-300 overflow-hidden">
                <div class="p-8 text-center">
                    <div class="mx-auto mb-6 w-20 h-20 bg-orange-100 rounded-2xl flex items-center justify-center group-hover:bg-orange-200 transition-colors">
                        <svg class="w-10 h-10 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">Profesionals</h3>
                    <p class="text-gray-600">Listat i seguiment de profesionals</p>
                </div>
            </a>

         
            <a href="{{ route('center.index') }}" 
               class="group bg-white border-2 border-orange-200 rounded-2xl shadow-md hover:shadow-2xl hover:border-orange-400 hover:-translate-y-2 transition-all duration-300 overflow-hidden">
                <div class="p-8 text-center">
                    <div class="mx-auto mb-6 w-20 h-20 bg-orange-100 rounded-2xl flex items-center justify-center group-hover:bg-orange-200 transition-colors">
                        <svg class="w-10 h-10 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H2m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">Centres</h3>
                    <p class="text-gray-600">Gestio integral de centres</p>
                </div>
            </a>

          
            <a href="{{ route('course.index') }}" 
               class="group bg-white border-2 border-orange-200 rounded-2xl shadow-md hover:shadow-2xl hover:border-orange-400 hover:-translate-y-2 transition-all duration-300 overflow-hidden">
                <div class="p-8 text-center">
                    <div class="mx-auto mb-6 w-20 h-20 bg-orange-100 rounded-2xl flex items-center justify-center group-hover:bg-orange-200 transition-colors">
                        <svg class="w-10 h-10 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M12 14l9-5-9-5-9 5 9 5z"/>
                            <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">Cursos</h3>
                    <p class="text-gray-600">Administració de cursos i formacions</p>
                </div>
            </a>

       
            @if (Auth::user()->role === 'Equip Directiu')
    
            <a href="{{ route('documents.index') }}" 
               class="group bg-white border-2 border-orange-200 rounded-2xl shadow-md hover:shadow-2xl hover:border-orange-400 hover:-translate-y-2 transition-all duration-300 overflow-hidden">
                <div class="p-8 text-center">
                    <div class="mx-auto mb-6 w-20 h-20 bg-orange-100 rounded-2xl flex items-center justify-center group-hover:bg-orange-200 transition-colors">
                        <svg class="w-10 h-10 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">Documents</h3>
                    <p class="text-gray-600">Documentacio interna del centre</p>
                </div>
            </a>
            @endif

    
            <a href="{{ route('externalContact.indexExternalContacts') }}" 
               class="group bg-white border-2 border-orange-200 rounded-2xl shadow-md hover:shadow-2xl hover:border-orange-400 hover:-translate-y-2 transition-all duration-300 overflow-hidden">
                <div class="p-8 text-center">
                    <div class="mx-auto mb-6 w-20 h-20 bg-orange-100 rounded-2xl flex items-center justify-center group-hover:bg-orange-200 transition-colors">
                        <svg class="w-10 h-10 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">Contactes Externs</h3>
                    <p class="text-gray-600">Empresas i contactes externs</p>
                </div>
            </a>

            @if (Auth::user()->role === 'Equip Directiu' || Auth::user()->role === 'Administracio')
            <a href="{{ route('serveisGenerals.index') }}" 
               class="group bg-white border-2 border-orange-200 rounded-2xl shadow-md hover:shadow-2xl hover:border-orange-400 hover:-translate-y-2 transition-all duration-300 overflow-hidden">
                <div class="p-8 text-center">
                    <div class="mx-auto mb-6 w-20 h-20 bg-orange-100 rounded-2xl flex items-center justify-center group-hover:bg-orange-200 transition-colors">
                        <svg class="w-10 h-10 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">Serveis Generals</h3>
                    <p class="text-gray-600">Gestio de serveis generals</p>
                </div>
            </a>
            @endif

            <a href="{{ route('complementaryService.index') }}" 
               class="group bg-white border-2 border-orange-200 rounded-2xl shadow-md hover:shadow-2xl hover:border-orange-400 hover:-translate-y-2 transition-all duration-300 overflow-hidden">
                <div class="p-8 text-center">
                    <div class="mx-auto mb-6 w-20 h-20 bg-orange-100 rounded-2xl flex items-center justify-center group-hover:bg-orange-200 transition-colors">
                        <svg class="w-10 h-10 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">Serveis Complementaris</h3>
                    <p class="text-gray-600">Gestio de Serveis Complementaris</p>
                </div>
            </a>

            <a href="{{ route('uniforms.index') }}" 
               class="group bg-white border-2 border-orange-200 rounded-2xl shadow-md hover:shadow-2xl hover:border-orange-400 hover:-translate-y-2 transition-all duration-300 overflow-hidden">
                <div class="p-8 text-center">
                    <div class="mx-auto mb-6 w-20 h-20 bg-orange-100 rounded-2xl flex items-center justify-center group-hover:bg-orange-200 transition-colors">
                        <x-lucide-shirt class="w-12 h-12 text-orange-600" />
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">Uniformes</h3>
                    <p class="text-gray-600">Control d'estats d'uniformes</p>
                </div>
            </a>

            <a href="{{ route('projects_comisions.index') }}" 
               class="group bg-white border-2 border-orange-200 rounded-2xl shadow-md hover:shadow-2xl hover:border-orange-400 hover:-translate-y-2 transition-all duration-300 overflow-hidden">
                <div class="p-8 text-center">
                    <div class="mx-auto mb-6 w-20 h-20 bg-orange-100 rounded-2xl flex items-center justify-center group-hover:bg-orange-200 transition-colors">
                        <svg class="w-10 h-10 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">Projectes / Comisions</h3>
                    <p class="text-gray-600">Gestio de projectes i comisions</p>
                </div>
            </a>

            @if (Auth::user()->role === 'Equip Directiu' || Auth::user()->role === 'Administracio')

            <a href="{{ route('maintenance.index') }}" 
               class="group bg-white border-2 border-orange-200 rounded-2xl shadow-md hover:shadow-2xl hover:border-orange-400 hover:-translate-y-2 transition-all duration-300 overflow-hidden">
                <div class="p-8 text-center">
                    <div class="mx-auto mb-6 w-20 h-20 bg-orange-100 rounded-2xl flex items-center justify-center group-hover:bg-orange-200 transition-colors">
                        <svg class="w-10 h-10 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">Manteniments</h3>
                    <p class="text-gray-600">Gestio de manteniments</p>
                </div>
            </a>
            @endif

            @if (Auth::user()->role === 'Equip Directiu')
            <a href="{{ route('rrhh.index') }}" 
               class="group bg-white border-2 border-orange-200 rounded-2xl shadow-md hover:shadow-2xl hover:border-orange-400 hover:-translate-y-2 transition-all duration-300 overflow-hidden">
                <div class="p-8 text-center">
                    <div class="mx-auto mb-6 w-20 h-20 bg-orange-100 rounded-2xl flex items-center justify-center group-hover:bg-orange-200 transition-colors">
                        <svg class="w-10 h-10 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">Temes pendents RRHH</h3>
                    <p class="text-gray-600">Gestio de temes pendents de recursos humans</p>
                </div>
            </a>
            @endif

        </div>
    </div>
</div>
@endsection