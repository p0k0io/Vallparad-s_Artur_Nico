<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administracion - Usuarios</title>
    

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-100 min-h-screen">

<!-- contenedor principal -->
<div class="w-full flex flex-col justify-center items-center py-16 px-6">
    
   
    <div class="w-full max-w-7xl bg-white rounded-3xl shadow-xl p-10">

        <!-- cabecera -->
        <div class="mb-10">
            <h1 class="text-4xl font-extrabold text-orange-500 mb-3 tracking-tight">
                Gestion de Usuarios
            </h1>
            <p class="text-lg text-gray-600">
                Administracion completa de las cuentas del sistema
            </p>
        </div>

        <!-- mensaje de exito -->
        @if (session('success'))
            <div class="mb-8 rounded-xl bg-green-100 border border-green-200 p-4 text-green-800 font-medium">
                {{ session('success') }}
            </div>
        @endif

        <!-- layout principal: tabla a la izquierda, formulario a la derecha -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

            <!-- tabla de usuarios - ocupa 2/3 en pantallas grandes -->
            <div class="lg:col-span-2 bg-white rounded-2xl shadow-md border-2 border-orange-200 overflow-hidden">
                
               
                <div class="px-8 py-6 border-b border-orange-100 bg-orange-50">
                    <h2 class="text-2xl font-bold text-gray-800">Usuarios registrados</h2>
                </div>

                <!-- tabla con scroll horizontal -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-orange-50">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">ID</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nombre</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Email</th>
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
                                    <td class="px-6 py-4 text-sm text-gray-500">{{ $user->created_at->format('d/m/Y') }}</td>
                                    <td class="px-6 py-4 text-right">
                                        <!-- boton eliminar  -->
                                        <form method="POST" action="{{ route('admin.destroy', $user) }}" 
                                              onsubmit="return confirm('Seguro que quieres eliminar este usuario?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="text-sm font-semibold text-red-600 hover:text-red-700 transition">
                                                Eliminar
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                        No hay usuarios registrados aun
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- formulario crear nuevo usuario -->
            <div class="bg-white rounded-2xl shadow-md border-2 border-orange-200">
                
                <!-- titulo del formulario -->
                <div class="px-8 py-6 border-b border-orange-100 bg-orange-50">
                    <h2 class="text-2xl font-bold text-gray-800">Crear nuevo usuario</h2>
                    <p class="text-sm text-gray-600 mt-1">Rellena los datos para añadir una cuenta</p>
                </div>

                <!-- el formulario-->
                <form method="POST" action="{{ route('admin.store') }}" class="p-8 space-y-6">
                    @csrf

                    <!-- campo nombre -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nombre completo</label>
                        <input type="text" name="name" value="{{ old('name') }}"
                               class="w-full rounded-xl border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 transition-all" 
                               placeholder="Ej: Juan Perez" />
                        @error('name')
                            <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- campo email -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}"
                               class="w-full rounded-xl border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 transition-all" 
                               placeholder="usuario@ejemplo.com" />
                        @error('email')
                            <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- campo password -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Contrasena</label>
                        <input type="password" name="password"
                               class="w-full rounded-xl border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 transition-all" />
                        @error('password')
                            <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- campo confirmar password -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Confirmar contrasena</label>
                        <input type="password" name="password_confirmation"
                               class="w-full rounded-xl border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 transition-all" />
                    </div>

                    <!-- boton creare -->
                    <button type="submit"
                            class="w-full py-4 bg-gradient-to-r from-orange-500 to-orange-600 text-white font-semibold rounded-xl shadow-md hover:shadow-lg hover:scale-[1.02] transition-all duration-300">
                        Crear usuario
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>

</body>
</html>