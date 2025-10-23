@extends('../layouts.app')

@section('title','Professionals')

@section('content')
<div class="flex">

    <img 
        src="{{ asset('images/asset_login_superpossed.png') }}" 
        alt="Decorative background"
        class="absolute bottom-0 left-0 w-full h-auto object-cover pointer-events-none select-none z-0"
    />


    <div class="w-2/4" id="leftContent">
        <form action="{{ route('professional.update', $professional) }}" method="POST" class="bg-white bg-opacity-95 shadow-xl rounded-2xl p-10 w-full max-w-4xl flex flex-col space-y-8 z-10">
        @csrf
        @method('PUT')

            <h2 class="text-3xl font-semibold text-center text-orange-600 hidden">
                Editar Professional
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-4">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Nom</label>
                        <input type="text" name="name" id="name" value="{{ $professional->name }}" class="mt-1 w-full rounded-xl border-gray-300 focus:border-orange-500 focus:ring-orange-500 h-10 px-3">
                    </div>

                    <div>
                        <label for="surname1" class="block text-sm font-medium text-gray-700">Primer Cognom</label>
                        <input type="text" name="surname1" id="surname1" value="{{ $professional->surname1 }}" class="mt-1 w-full rounded-xl border-gray-300 focus:border-orange-500 focus:ring-orange-500 h-10 px-3">
                    </div>

                    <div>
                        <label for="surname2" class="block text-sm font-medium text-gray-700">Segon Cognom</label>
                        <input type="text" name="surname2" id="surname2" value="{{ $professional->surname2 }}" class="mt-1 w-full rounded-xl border-gray-300 focus:border-orange-500 focus:ring-orange-500 h-10 px-3">
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Correu electrònic</label>
                        <input type="email" name="email" id="email" value="{{ $professional->email }}" class="mt-1 w-full rounded-xl border-gray-300 focus:border-orange-500 focus:ring-orange-500 h-10 px-3">
                    </div>

                    <div>
                        <label for="address" class="block text-sm font-medium text-gray-700">Adreça</label>
                        <input type="text" name="address" id="address" value="{{ $professional->address }}" class="mt-1 w-full rounded-xl border-gray-300 focus:border-orange-500 focus:ring-orange-500 h-10 px-3">
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700">Telèfon</label>
                        <input type="tel" name="phone" id="phone" value="{{ $professional->phone }}" class="mt-1 w-full rounded-xl border-gray-300 focus:border-orange-500 focus:ring-orange-500 h-10 px-3">
                    </div>
                </div>

                <div class="space-y-4">
                    <div>
                        <label for="locker" class="block text-sm font-medium text-gray-700">Taquilla</label>
                        <input type="text" name="locker" id="locker" value="{{ $professional->locker }}" class="mt-1 w-full rounded-xl border-gray-300 focus:border-orange-500 focus:ring-orange-500 h-10 px-3">
                    </div>
                    
                    <div>
                        <label for="profession" class="block text-sm font-medium text-gray-700">Professió</label>
                        <input type="text" name="profession" id="profession" value="{{ $professional->profession }}" class="mt-1 w-full rounded-xl border-gray-300 focus:border-orange-500 focus:ring-orange-500 h-10 px-3">
                    </div>

                    <div>
                        <label for="keyCode" class="block text-sm font-medium text-gray-700">Codi Clau</label>
                        <input type="text" name="keyCode" id="keyCode" value="{{ $professional->keyCode }}" class="mt-1 w-full rounded-xl border-gray-300 focus:border-orange-500 focus:ring-orange-500 h-10 px-3">
                    </div>

                    <div>
                        <label for="center_id" class="block text-sm font-medium text-gray-700">Centre</label>
                        <input type="text" name="center_id" id="center_id" value="{{ $professional->center_id }}" class="mt-1 w-full rounded-xl border-gray-300 focus:border-orange-500 focus:ring-orange-500 h-10 px-3">
                    </div>

                    <div>
                        <label for="role" class="block text-sm font-medium text-gray-700">Rol</label>
                        <select name="role" id="role" class="mt-1 w-full rounded-xl border-gray-300 focus:border-orange-500 focus:ring-orange-500 h-10 px-3">
                            <option value="admin" @if($professional->role == 'admin') selected @endif>Administrador</option>
                            <option value="gestor" @if($professional->role == 'gestor') selected @endif>Gestor</option>
                            <option value="user" @if($professional->role == 'user') selected @endif>Usuari</option>
                        </select>
                    </div>

                    <div>
                        <label for="cv_id" class="block text-sm font-medium text-gray-700">ID CV</label>
                        <input type="number" name="cv_id" id="cv_id" value="{{ $professional->cv_id }}" class="mt-1 w-full rounded-xl border-gray-300 focus:border-orange-500 focus:ring-orange-500 h-10 px-3">
                    </div>
                </div>
            </div>

            <div class="pt-6">
                <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 text-white font-semibold py-3 rounded-xl shadow transition duration-200"> Actualitzar </button>
            </div>
        </form>
    </div>


    <div class="flex w-2/4 bg-white bg-opacity-95 z-50 min-h-screen justify-center rounded-xl mx-5 my-10">
        <div class="flex flex-col w-3/4">
            <form class="flex flex-row w-full justify-between mt-32 mb-10" action="" method="post">
                <input class="bg-white border-2 w-2/3 border-grey-400 rounded-xl" type="text" name="" id="" placeholder="Buscar Professional">
                <button class="bg-white border-2 w-16 border-gray-400 rounded-3xl" type="submit">Lupa</button>
                <input class="bg-white border-2 w-16 border-orange-400 rounded-3xl" type="button" value="">
                <input class="bg-white border-2 w-16 border-orange-700 rounded-3xl" type="button" value="">
            </form>
            <table id="professionalTable" class="w-full border-separate border-spacing-y-2">
                <tbody>
                    @foreach ($professionals as $professional)
                        @if($professional->status==1)
                            <tr class="bg-white border border-yellow-400 rounded-xl shadow-sm hover:border-orange-600 transition flex items-center justify-between px-4 py-2 my-5">
                        @else
                            <tr class="bg-gray-300 border border-gray-400 rounded-xl flex items-center justify-between px-4 py-2 my-5">
                        @endif
                            <td id="" class="text-lg font-medium text-gray-800">
                                {{ $professional->name }} {{ $professional->surname1 }} {{ $professional->surname2 }}
                            </td>

                            <td class="flex items-center gap-3">
                                <form action="{{ route('changeStateProfessional', $professional) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    @if($professional->status==1)
                                        <input type="submit" value="Desactivar" class="px-3 py-1 w-28 text-sm font-semibold text-white bg-red-500 hover:bg-red-600 rounded-lg transition">
                                    @else
                                        <input type="submit" value="Activar" class="px-3 py-1 w-28 text-sm font-semibold text-white bg-green-500 hover:bg-green-600 rounded-lg transition">
                                    @endif
                                </form>
                                
                                <a class="px-3 py-1 text-sm font-semibold text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-100 transition">
                                    Editar
                                    <input type="hidden" name="nameP" value="{{$professional->name}}">
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="flex justify-end">
                <a class="bg-orange-500 text-white text-center text-2xl w-20 py-1 rounded-full hover:bg-orange-400 transition" href="<?php echo route('professional.create')?>">+</a>
            </div>
        </div>
    </div>
</div>
@vite(['resources/js/editProfessional.js'])
@endsection
