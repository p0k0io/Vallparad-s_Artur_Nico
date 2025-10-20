<h1>Uniforms</h1>

<table border="1" cellpadding="5">
    <thead>
        <tr>
            <th>ID</th>
            <th>Shirt Size</th>
            <th>Pants Size</th>
            <th>Shoe Size</th>
            <th>Professional</th>
            <th>Last Uniform</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($uniforms as $uniform)
            <tr>
                <td>{{ $uniform->id }}</td>
                <td>{{ $uniform->shirtSize }}</td>
                <td>{{ $uniform->pantsSize }}</td>
                <td>{{ $uniform->shoeSize }}</td>
                
                <!-- Nombre del profesional -->
                <td>{{ $uniform->professional->name ?? 'N/A' }} {{ $uniform->professional->surname1 ?? '' }} {{ $uniform->professional->surname2 ?? '' }}</td>
                
                <!-- Último uniforme (auto-relación) -->
                <td>
                    @if($uniform->lastUniform)
                        Uniform #{{ $uniform->lastUniform->id }}
                    @else
                        Ninguno
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<a href="<?php echo route('uniforms.create')?>">Entrega nou uniforme</a>
<a href="{{ route('uniforms.export') }}" class="btn btn-success">Exportar a Excel</a>


