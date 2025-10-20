<h1>Crear Uniforme</h1>

<form action="{{ route('uniforms.store') }}" method="POST">
    @csrf

    <label for="shirtSize">Shirt Size:</label>
    <input type="text" name="shirtSize" id="shirtSize"><br>

    <label for="pantsSize">Pants Size:</label>
    <input type="text" name="pantsSize" id="pantsSize"><br>

    <label for="shoeSize">Shoe Size:</label>
    <input type="number" name="shoeSize" id="shoeSize"><br>

    <label for="professional_id">Professional:</label>
    <select name="professional_id" id="professional_id">
        <option value="">--Selecciona--</option>
        @foreach($professionals as $prof)
            <option value="{{ $prof->id }}">{{ $prof->name }} {{ $prof->surname1 }} {{ $prof->surname2 }}</option>
        @endforeach
    </select><br>

    <label for="lastUniform">Último Uniforme:</label>
    <select name="lastUniform" id="lastUniform">
        <option value="">Ninguno</option>
        @foreach($uniforms as $u)
            <option value="{{ $u->id }}">Uniform #{{ $u->id }}</option>
        @endforeach
    </select><br>

    <button type="submit">Crear Uniforme</button>
</form>
