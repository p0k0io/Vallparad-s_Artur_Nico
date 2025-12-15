<div class="w-full h-auto bg-green-400 p-4">
    <input type="text" id="buscador" placeholder="Buscar..." class="p-2 border rounded mb-4 w-full">

    <ul id="resultados">
        <ul id="resultados">
    @foreach($objecto as $item)
        
    @endforeach
</ul>

    </ul>
</div>
<!--
ESTO DE MOMENTO SOLO VALE PARA LOS DOCUMENTOS $object puede ser professional
o cualuier cosa q sea un array EXTRAE DESCRIPCION
-->

<script>
    const data = @json($objecto);

    const input = document.getElementById('buscador');
    const resultados = document.getElementById('resultados');

    input.addEventListener('keyup', function() {
        
        


    });
</script>
