<div class="w-full items-center justify-center flex">
    <div class="container p-6 bg-slate-200 w-3/4 flex flex-col items-center justify-center">

    <div>
    <input type="text" id="buscador" placeholder="Buscar por nombre, apellido o profesión..." class="form-control mb-3">
    
     <button>
        <x-lucide-funnel class="w-6 h-6 text-gray-500"/>
     </button>
    </div>

    <ul id="resultados" class="list-group"></ul>
</div>

<script>
let timer;

document.getElementById('buscador').addEventListener('keyup', function() {
    clearTimeout(timer);
    const query = this.value.trim();
    console.log(query);
    timer = setTimeout(() => buscar(query), 400);
});

function buscar(query) {
    const resultados = document.getElementById('resultados');

    if (query.length === 0) {
        resultados.innerHTML = '';
        return;
    }

    fetch(`{{ route('professional.search') }}?query=${encodeURIComponent(query)}`)
    .then(res => res.json())
    .then(data => {
        resultados.innerHTML = '';

        if (data.length === 0) {
            resultados.innerHTML = '<li class="list-group-item">No se encontraron resultados</li>';
            return;
        }

        data.forEach(usuario => {
            const li = document.createElement('li');
            li.classList.add('list-group-item');
            li.innerHTML = `<strong>${usuario.name} ${usuario.surname1}</strong> <br>
                            Profesión: ${usuario.profession} <br>
                            <small>${usuario.email}</small>`;
            resultados.appendChild(li);
        });
    })
}
</script>
</div>