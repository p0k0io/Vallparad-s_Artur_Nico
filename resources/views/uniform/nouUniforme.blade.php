@vite('resources/css/app.css')

<div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-lg">
        <h1 class="text-3xl font-semibold text-gray-800 mb-6">Crear Nuevo Uniforme</h1>
        <form action="{{ route('uniforms.store') }}" method="POST">
            @csrf
            <div class="space-y-6">
                <div>
                    <label for="shirtSize" class="block text-sm font-medium text-gray-700">Tamaño de Camisa</label>
                    <input type="text" name="shirtSize" id="shirtSize" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500" required maxlength="4">
                </div>
                <div>
                    <label for="pantsSize" class="block text-sm font-medium text-gray-700">Tamaño de Pantalón</label>
                    <input type="text" name="pantsSize" id="pantsSize" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500" required maxlength="4">
                </div>
                <div>
                    <label for="shoeSize" class="block text-sm font-medium text-gray-700">Tamaño de Zapato</label>
                    <input type="number" name="shoeSize" id="shoeSize" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500" required maxlength="2">
                </div>
                <div>
                    <label for="professional_id" class="block text-sm font-medium text-gray-700">Profesional</label>
                    <select name="professional_id" id="professional_id" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500" required>
                        <option value="">--Selecciona--</option>
                        @foreach($professionals as $prof)
                            <option value="{{ $prof->id }}">{{ $prof->name }} {{ $prof->surname1 }} {{ $prof->surname2 }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="lastUniform" class="block text-sm font-medium text-gray-700">Último Uniforme</label>
                    <select name="lastUniform" id="lastUniform" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500">
                        <option value="">Ninguno</option>
                        @foreach($uniforms as $u)
                            <option value="{{ $u->id }}">Uniform #{{ $u->id }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="px-6 py-3 bg-orange-600 text-white font-semibold rounded-lg shadow-md hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-opacity-50">
                        Crear Uniforme
                    </button>
                </div>
            </div>
        </form>
    </div>