@extends('../layouts.app')

@section('title','Centres')

@section('content')

    <div class="max-w-6xl mx-auto px-6 py-10">
        <h1 class="text-3xl font-bold text-orange-600 mb-8 text-center">Llista de Centres</h1>

        <div class="overflow-x-auto shadow-lg rounded-2xl bg-white">
            <table class="w-full border-collapse text-sm text-left">
                <thead class="bg-orange-500 text-white uppercase text-xs tracking-wider">
                    <tr>
                        <th class="px-6 py-3 rounded-tl-2xl">ID</th>
                        <th class="px-6 py-3">Nom</th>
                        <th class="px-6 py-3">Direcció</th>
                        <th class="px-6 py-3">Correu</th>
                        <th class="px-6 py-3">Telèfon</th>
                        <th class="px-6 py-3">Estat</th>
                        <th class="px-6 py-3 rounded-tr-2xl">Editar</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($centers as $center)
                        <tr class="hover:bg-orange-50 transition-colors">
                            <td class="px-6 py-3">{{ $center->id }}</td>
                            <td class="px-6 py-3 font-medium text-gray-900">{{ $center->name }}</td>
                            <td class="px-6 py-3 text-gray-700">{{ $center->location }}</td>
                            <td class="px-6 py-3 text-gray-700">{{ $center->email }}</td>
                            <td class="px-6 py-3">{{ $center->phone }}</td>
                            <td class="px-6 py-3">
                                <form action="{{ route('changeStateCenter', $center) }}" method="post" class="inline">
                                    @csrf
                                    @method('PUT')

                                    @if($center->status == 1)
                                        <span class="inline-flex items-center gap-1 bg-green-100 text-green-700 text-xs font-semibold px-2.5 py-1 rounded-full mb-1">
                                            <span class="w-2 h-2 bg-green-500 rounded-full"></span> Actiu
                                        </span>
                                        <button type="submit"
                                            class="ml-2 text-xs text-orange-600 hover:text-orange-800 underline">
                                            Desactivar
                                        </button>
                                    @else
                                        <span class="inline-flex items-center gap-1 bg-red-100 text-red-700 text-xs font-semibold px-2.5 py-1 rounded-full mb-1">
                                            <span class="w-2 h-2 bg-red-500 rounded-full"></span> Inactiu
                                        </span>
                                        <button type="submit"
                                            class="ml-2 text-xs text-orange-600 hover:text-orange-800 underline">
                                            Activar
                                        </button>
                                    @endif
                                </form>
                            </td>
                            <td class="px-6 py-3">
                                <a href="{{ route('center.edit', $center) }}"
                                   class="text-orange-600 hover:text-orange-800 font-semibold text-sm underline">
                                   Editar
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="text-center mt-8">
            <a href="{{ route('center.create') }}"
               class="inline-block bg-orange-600 hover:bg-orange-700 text-white font-semibold px-6 py-2 rounded-lg shadow transition">
               Introduir nou Centre
            </a>
        </div>
    </div>
@endsection