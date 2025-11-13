@extends('../layouts.app')

@section('title','Valoracio Professionals')

@section('content')

<div class="flex justify-center items-center min-h-screen relative">
    <form action="{{ route('professional.update', $professional) }}" method="POST" class="bg-white bg-opacity-95 shadow-xl rounded-2xl p-10 w-full max-w-4xl flex flex-col space-y-8 z-10">
        @csrf
        @method('PUT')

        <h2 class="text-3xl font-semibold text-center text-orange-600">
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
@endsection