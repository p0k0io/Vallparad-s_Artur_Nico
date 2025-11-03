@extends('../layouts.app')

@section('title','Projectes i Comisions')

@section('content')
    <div class="max-w-7xl mx-auto px-6 py-10">
        <h1 class="text-3xl font-bold text-orange-600 mb-8 text-center">Projectes i Comisions</h1>

        <div class="overflow-x-auto shadow-lg rounded-2xl bg-white">
            <table class="w-full border-collapse text-sm text-left">
                <thead class="bg-orange-500 text-white uppercase text-xs tracking-wider">
                    <tr>
                        <th class="px-6 py-3 rounded-tl-2xl">ID</th>
                        <th class="px-6 py-3">Nom</th>
                        <th class="px-6 py-3">Descripció</th>
                        <th class="px-6 py-3">Observació</th>
                        <th class="px-6 py-3">Tipus</th>
                        <th class="px-6 py-3">Responsable</th>
                        <th class="px-6 py-3 rounded-tr-2xl">Centre</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($projectscomisions as $projectcomision)
                        <tr class="hover:bg-orange-50 transition-colors">
                            <td class="px-6 py-3">{{ $projectcomision->id }}</td>
                            <td class="px-6 py-3 font-medium text-gray-900">{{ $projectcomision->name }}</td>
                            <td class="px-6 py-3 text-gray-700">{{ $projectcomision->description }}</td>
                            <td class="px-6 py-3 text-gray-700">{{ $projectcomision->observation }}</td>
                            <td class="px-6 py-3">{{ $projectcomision->type }}</td>
                            <td class="px-6 py-3">
                                {{ optional($professionals->firstWhere('id', $projectcomision->responsible))->name ?? '—' }}
                            </td>
                            <td class="px-6 py-3">{{ $projectcomision->center->name }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="text-center mt-8">
            <a href="{{ route('projects_comisions.create') }}"
               class="inline-block bg-orange-500 hover:bg-orange-600 text-white font-semibold px-6 py-2 rounded-lg shadow transition">
               Crea nova comissió
            </a>
        </div>
        <div class="text-center mt-8">
            <a href="{{ route('projects_comisions.create') }}"
               class="inline-block bg-orange-500 hover:bg-orange-600 text-white font-semibold px-6 py-2 rounded-lg shadow transition">
               Assignar Professionals
            </a>
        </div>
    </div>
@endsection