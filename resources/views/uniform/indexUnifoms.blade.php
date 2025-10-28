@extends('../layouts.app')

@section('title','Uniformes')

@section('content')
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
@endsection