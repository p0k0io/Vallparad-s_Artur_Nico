@extends('../layouts.app')

@section('title','Accidentability')

@section('content')
<div class="w-full flex flex-col justify-center items-center py-16 px-6">
    <div class="w-full max-w-7xl bg-white rounded-3xl shadow-xl p-10">

        <div class="mb-10">
            <h1 class="text-4xl font-extrabold text-orange-500 mb-3 tracking-tight">
                Gestion de Usuarios
            </h1>
            <p class="text-lg text-gray-600">
                Administracion completa de las cuentas del sistema
            </p>
        </div>

        @if (session('success'))
            <div class="mb-8 rounded-xl bg-green-100 border border-green-200 p-4 text-green-800 font-medium">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

            <div class="lg:col-span-2 bg-white rounded-2xl shadow-md border-2 border-orange-200 overflow-hidden">
                <div class="px-8 py-6 border-b border-orange-100 bg-orange-50">
                    <h2 class="text-2xl font-bold text-gray-800">Usuarios registrados</h2>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-orange-50">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">ID</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nombre</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Email</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Rol</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Registro</th>
                                <th class="px-6 py-4 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($users as $user)
                                <tr class="hover:bg-orange-50 transition-all duration-200">
                                    <td class="px-6 py-4 text-sm text-gray-700">{{ $user->id }}</td>
                                    <td class="px-6 py-4 text-sm font-semibold text-gray-800">{{ $user->name }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">{{ $user->email }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">{{ $user->role }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-500">{{ $user->created_at->format('d/m/Y') }}</td>
                                    <td class="px-6 py-4 text-right">
                                        <form method="POST" action="{{ route('admin.destroy', $user) }}" onsubmit="return confirm('Seguro que quieres eliminar este usuario?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-sm font-semibold text-red-600 hover:text-red-700 transition">
                                                Eliminar
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                        No hay usuarios registrados aun
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-md border-2 border-orange-200 overflow-hidden">
                <div class="px-8 py-6 border-b border-orange-100 bg-orange-50">
                    <h2 class="text-2xl font-bold text-gray-800">Nuevo usuario y profesional</h2>
                    <p class="text-sm text-gray-600 mt-1">Informacion general y especifica</p>
                </div>

                <form method="POST" action="{{ route('admin.store') }}" class="p-8 space-y-10">
                    @csrf

                    <div>
                        <h3 class="text-lg font-bold text-orange-500 mb-6">Informacion general</h3>

                        <div class="space-y-5">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Nombre completo</label>
                                <input type="text" name="name" value="{{ old('name') }}"
                                       class="w-full rounded-xl border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 transition-all" />
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                <input type="email" name="email" value="{{ old('email') }}"
                                       class="w-full rounded-xl border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 transition-all" />
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Rol</label>
                                <select name="role"
                                        class="w-full rounded-xl border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 transition-all">
                                    <option value="Equip Directiu">Equip Directiu</option>
                                    <option value="Administracio">Administracio</option>
                                    <option selected value="Responsable i Equip Tecnic">Responsable i Equip Tecnic</option>
                                </select>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Contrasenya</label>
                                    <input type="password" name="password"
                                           class="w-full rounded-xl border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 transition-all" />
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Confirmar</label>
                                    <input type="password" name="password_confirmation"
                                           class="w-full rounded-xl border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 transition-all" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-lg font-bold text-orange-500 mb-6">Informacion profesional</h3>

                        <div class="space-y-5">
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Primer apellido</label>
                                    <input type="text" name="surname1" value="{{ old('surname1') }}"
                                           class="w-full rounded-xl border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 transition-all" />
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Segundo apellido</label>
                                    <input type="text" name="surname2" value="{{ old('surname2') }}"
                                           class="w-full rounded-xl border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 transition-all" />
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Direccion</label>
                                <input type="text" name="address" value="{{ old('address') }}"
                                       class="w-full rounded-xl border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 transition-all" />
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Telefono</label>
                                    <input type="text" name="phone" value="{{ old('phone') }}"
                                           class="w-full rounded-xl border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 transition-all" />
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Taquilla</label>
                                    <input type="text" name="locker" value="{{ old('locker') }}"
                                           class="w-full rounded-xl border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 transition-all" />
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Profesion</label>
                                <input type="text" name="profession" value="{{ old('profession') }}"
                                       class="w-full rounded-xl border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 transition-all" />
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Codigo de vinculacion</label>
                                <input type="text" name="keyCode" value="{{ old('keyCode') }}"
                                       class="w-full rounded-xl border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 transition-all" />
                            </div>
                        </div>
                    </div>

                    <button type="submit"
                            class="w-full py-4 bg-gradient-to-r from-orange-500 to-orange-600 text-white font-semibold rounded-xl shadow-md hover:shadow-lg hover:scale-[1.02] transition-all duration-300">
                        Crear usuario
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection