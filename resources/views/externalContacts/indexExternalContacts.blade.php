@extends('layouts.app')

@section('content')
<!-- contenedor principal con alpine para el modal -->
<div x-data="{ openCreate: false }">

    <!-- fondo y estructura general -->
    <div class="min-h-screen bg-slate-100 py-16 px-6 flex flex-col items-center">

        <div class="w-full max-w-5xl">

            <!-- titulo principal -->
            <div class="text-center mb-12">
                <h1 class="text-4xl font-extrabold text-orange-500 mb-3 tracking-tight">
                    Contactos Externos
                </h1>
                <p class="text-lg text-gray-600">
                    Gestion de empresas, proveedores y contactos externos
                </p>
            </div>

            <!-- tarjeta principal con lista -->
            <div class="bg-white rounded-3xl shadow-xl p-10 border-2 border-orange-200">

                <!-- cabecera con titulo y boton crear -->
                <div class="flex justify-between items-center mb-10 pb-6 border-b-2 border-orange-100">
                    <h2 class="text-3xl font-bold text-gray-800">Lista de contactos</h2>

                    <!-- boton abrir modal -->
                    <button 
                        @click="openCreate = true"
                        class="flex items-center gap-3 px-8 py-4 rounded-full bg-orange-500 hover:bg-orange-600 text-white font-semibold shadow-md hover:shadow-lg hover:scale-[1.02] transition-all duration-300"
                    >
                        <x-lucide-plus class="w-6 h-6"/>
                        Nuevo contacto
                    </button>
                </div>

                <!-- lista de contactos -->
                <div class="space-y-6">
                    @forelse ($externalContacts as $contact)
                        <div class="hover:-translate-y-1 transition-all duration-300">
                            <x-contact-card :user="$contact" />
                        </div>
                    @empty
                        <div class="text-center py-12">
                            <p class="text-xl text-gray-500">No hay contactos externos aun.</p>
                            <p class="mt-2 text-gray-400">Empieza añadiendo el primero</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- modal crear contacto con alpine -->
    <div 
        x-show="openCreate" 
        x-transition
        class="fixed inset-0 backdrop-blur-sm bg-black/40 flex items-center justify-center z-50 px-4"
        @keydown.escape.window="openCreate = false"
    >
        <div 
            class="bg-white/95 rounded-3xl p-8 w-full max-w-2xl shadow-2xl border border-orange-200"
            @click.outside="openCreate = false"
        >

            <h2 class="text-3xl font-bold text-orange-600 mb-8 text-center">
                Crear nuevo contacto externo
            </h2>

            <form action="{{ route('externalContact.store') }}" method="post" class="space-y-6">
                @csrf

                <div>
                    <label class="block text-sm text-orange-600 mb-1 font-medium">Nombre de la empresa / contacto</label>
                    <input type="text" name="name" required
                           class="w-full border border-orange-200 bg-orange-50 focus:border-orange-500 focus:ring-4 focus:ring-orange-100 px-5 py-4 rounded-xl outline-none transition"
                           placeholder="Ej: Proveedor XYZ S.L." />
                </div>

                <div>
                    <label class="block text-sm text-orange-600 mb-1 font-medium">Descripcion</label>
                    <textarea name="description" rows="3"
                              class="w-full border border-orange-200 bg-orange-50 focus:border-orange-500 focus:ring-4 focus:ring-orange-100 px-5 py-4 rounded-xl outline-none transition resize-none"
                              placeholder="Ej: Proveedor habitual de material de oficina"></textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm text-orange-600 mb-1 font-medium">Persona de contacto</label>
                        <input type="text" name="manager"
                               class="w-full border border-orange-200 bg-orange-50 focus:border-orange-500 focus:ring-4 focus:ring-orange-100 px-5 py-4 rounded-xl outline-none transition"
                               placeholder="Ej: Maria Garcia" />
                    </div>
                    <div>
                        <label class="block text-sm text-orange-600 mb-1 font-medium">Correo electronico</label>
                        <input type="email" name="email"
                               class="w-full border border-orange-200 bg-orange-50 focus:border-orange-500 focus:ring-4 focus:ring-orange-100 px-5 py-4 rounded-xl outline-none transition"
                               placeholder="contacto@empresa.com" />
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm text-orange-600 mb-1 font-medium">Direccion</label>
                        <input type="text" name="address"
                               class="w-full border border-orange-200 bg-orange-50 focus:border-orange-500 focus:ring-4 focus:ring-orange-100 px-5 py-4 rounded-xl outline-none transition"
                               placeholder="Calle Ejemplo 123, Ciudad" />
                    </div>
                    <div>
                        <label class="block text-sm text-orange-600 mb-1 font-medium">Telefono</label>
                        <input type="tel" name="phone"
                               class="w-full border border-orange-200 bg-orange-50 focus:border-orange-500 focus:ring-4 focus:ring-orange-100 px-5 py-4 rounded-xl outline-none transition"
                               placeholder="93 123 45 67" />
                    </div>
                </div>


                <div class="flex justify-end gap-4 pt-4">
                    <button type="button" 
                            @click="openCreate = false"
                            class="px-8 py-4 rounded-full bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold transition-all">
                        Cancelar
                    </button>
                    <button type="submit"
                            class="px-8 py-4 rounded-full bg-orange-500 hover:bg-orange-600 text-white font-semibold shadow-md hover:shadow-lg transition-all">
                        Guardar contacto
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection