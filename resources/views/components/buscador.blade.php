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
        const texto = this.value.toLowerCase().trim();

        // Si el buscador está vacío, no mostrar nada
        if (texto === '') {
            resultados.innerHTML = '';
            return;
        }

        const filtrados = data.filter(item => 
            item.description.toLowerCase().includes(texto)
        );

        resultados.innerHTML = filtrados.map(item => `<li>${item.description}</li>`).join('');

        if(filtrados.length === 0) {
            resultados.innerHTML = '<li>No se encontraron resultados</li>';
        }
    });
</script>
