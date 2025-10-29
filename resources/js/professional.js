document.addEventListener('DOMContentLoaded',()=>{
    const leftContent=document.getElementById('leftContent');
    const leftContentDiv=document.getElementById('innerDiv');
    const leftContentH1=document.getElementById('leftContentH1');
    const leftContentH3=document.getElementById('leftContentH3');
    const leftContentP=document.getElementById('leftContentP');
    const leftContentButton=document.getElementById('leftContentButton');
    //const edit = document.querySelectorAll('form a');
    
    

    document.querySelectorAll('#professionalTable a.perfil').forEach(edit => {
        console.log(edit);
        edit.addEventListener('click', function(event){
            console.log('this:', this);
            console.log('event.target:', event.target); 
            
            const nameP=this.querySelector('#nameP');
            const surname1P=this.querySelector('#surname1P');
            const surname2P=this.querySelector('#surname2P');
            const emailP=this.querySelector('#emailP');
            const addressP=this.querySelector('#addressP');
            const phoneP=this.querySelector('#phoneP');
            const professionP=this.querySelector('#professionP');
            const nameP2=nameP.value;
            const surname1P2=surname1P.value;
            const surname2P2=surname2P.value;
            const emailP2=emailP.value;
            const addressP2=addressP.value;
            const phoneP2=phoneP.value;
            const professionP2=professionP.value;


            leftContent.classList.add("w-2/4");
            leftContentDiv.classList.remove("hidden");

            const meta = document.querySelector('meta[name="csrf-token"]');
            const token = meta ? meta.getAttribute('content') : '';

            leftContentH1.innerHTML=nameP2+" "+surname1P2+" "+surname2P2;
            
            leftContentH3.innerHTML=professionP2;
            
            leftContentP.innerHTML=emailP2+"<br>"+addressP2+"<br>"+phoneP2;
        });
    });

    leftContentButton.addEventListener('click',()=>{
        leftContent.classList.remove("w-2/4");
        leftContentDiv.classList.add("hidden");
    });

    //Search
    searchP.addEventListener('keyup', () => {
        console.log("ola");
       
        const name = searchP ? searchP.value : '';
        const meta = document.querySelector('meta[name="csrf-token"]');
        const token = meta ? meta.getAttribute('content') : '';

        console.log(name);

        fetch('search', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token
            },
                body: JSON.stringify({ name: name })
            })
            .then(response => {
                if (!response.ok) throw new Error('Error del servidor');
                console.log(response.name);
                return response.json();
            })
            .then(response => {
                if (response.trobat) {
                result.innerHTML = `
                <p><strong>Nom:</strong> ${response.name}</p>
                `;
            } else {
                result.innerHTML = '<p class="text-red-600">Usuari no trobat</p>';
            }
            })
                .catch(error => {
                console.error('Error fetch:', error);
                result.innerHTML = '<p class="text-red-600">Error en la consulta</p>';
            });
            
    });

});