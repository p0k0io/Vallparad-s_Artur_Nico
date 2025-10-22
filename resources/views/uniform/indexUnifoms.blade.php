@vite('resources/css/app.css')
<div class="overflow-x-auto bg-gray-50 p-6 rounded-lg shadow-lg">
    <table class="min-w-full table-auto bg-white border-collapse rounded-lg shadow-md">
        <thead>
            <tr class="bg-orange-600 text-white">
                <th class="px-4 py-2 text-left">ID</th>
                <th class="px-4 py-2 text-left">Shirt Size</th>
                <th class="px-4 py-2 text-left">Pants Size</th>
                <th class="px-4 py-2 text-left">Shoe Size</th>
                <th class="px-4 py-2 text-left">Professional</th>
                <th class="px-4 py-2 text-left">Last Uniform</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($uniforms as $uniform)
                <tr class="border-t border-gray-200 hover:bg-orange-50">
                    <td class="px-4 py-2 text-gray-800">{{ $uniform->id }}</td>
                    <td class="px-4 py-2 text-gray-800">{{ $uniform->shirtSize }}</td>
                    <td class="px-4 py-2 text-gray-800">{{ $uniform->pantsSize }}</td>
                    <td class="px-4 py-2 text-gray-800">{{ $uniform->shoeSize }}</td>
                    <td class="px-4 py-2 text-gray-800">
                        {{ $uniform->professional->name ?? 'N/A' }}
                        {{ $uniform->professional->surname1 ?? '' }}
                        {{ $uniform->professional->surname2 ?? '' }}
                    </td>
                    <td class="px-4 py-2 text-gray-800">
                        @if($uniform->lastUniform)
                            Uniform #{{ $uniform->lastUniform->id }}
                        @else
                            None
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="mt-6 flex justify-between">
    <a href="{{ route('uniforms.create') }}" class="inline-block px-6 py-3 bg-orange-600 text-white font-semibold rounded-lg shadow-md hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-opacity-50">
        Add New Uniform
    </a>
    <a href="{{ route('uniforms.export') }}" class="inline-block px-6 py-3 bg-green-600 text-white font-semibold rounded-lg shadow-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50">
        Export to Excel
    </a>
</div>





<div class="w-full flex p-10 bg-slate-100 h-auto items-center justify-center">

    <div class="w-5/6 h-auto bg-white rounded-3xl p-5 flex justify-center">

        <div class="w-10/12 flex flex-col h-auto bg-white">

            <div class="w-full flex">
                <div class="w-1/3 bg-blue-300">
                    <!-- título -->
                </div>

                <div class="w-2/3 bg-red-300 flex flex-row justify-between">
                    <div class="w-8/12 bg-green-500">
                        busqueda
                    </div>
                    <a href="{{ route('uniforms.export') }}"
                        class="w-3/12 inline-block px-6 py-3 bg-green-600 text-white font-semibold rounded-lg shadow-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50">
                        Export to Excel
                    </a>
                </div>
            </div>

            <!-- 🔴 Div rojo debajo del blanco -->
            <div class="w-full h-96 rounded-3xl bg-red-500 mt-2 p-4 ">
                <h1>
                @foreach($uniforms as $uniform)
                    @if($uniform->estat == 0)
                        <div class="w-4/12 h-10 bg-white rounded-full flex flex-row     mt-4">
                            <h1 class ="w-7/12">
                                {{ $uniform->professional->name ?? 'N/A' }}
                        {{ $uniform->professional->surname1 ?? '' }}
                        {{ $uniform->professional->surname2 ?? '' }}                            
                            </h1>

                            <div class="flex flex-row justify-between w-4/12">
                                {{$uniform->created_at->format('d/m/Y')}}
                                <div class ="w-8 h-8 bg-yellow-400 rounded-full"></div>
                            </div>
                        </div>
                    @endif
                @endforeach
                </h1>
            </div>
        </div>

    </div>

</div>

