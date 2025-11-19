document.addEventListener('DOMContentLoaded',()=>{
    const leftContent=document.getElementById('leftContent');
    const leftContentH1=document.getElementById('leftContentH1');
    const leftContentH3=document.getElementById('leftContentH3');
    const leftContentEmail=document.getElementById('leftContentMail');
    const leftContentAddress=document.getElementById('leftContentAddress');
    const leftContentPhone=document.getElementById('leftContentPhone');
    const leftContentButton=document.getElementById('leftContentButton');
    const leftContentEvaluation=document.getElementById('leftContentEvaluation');
    
    const seguiments=document.getElementById('seguiments');
    
    

    document.querySelectorAll('#professionalTable a.perfil').forEach(edit => {
        console.log(edit);
        edit.addEventListener('click', function(event){
            console.log('this:', this);
            console.log('event.target:', event.target); 
            
            const idP=this.querySelector('#idP');
            const nameP=this.querySelector('#nameP');
            const surname1P=this.querySelector('#surname1P');
            const surname2P=this.querySelector('#surname2P');
            const emailP=this.querySelector('#emailP');
            const addressP=this.querySelector('#addressP');
            const phoneP=this.querySelector('#phoneP');
            const professionP=this.querySelector('#professionP');
            const idP2=idP.value;
            const nameP2=nameP.value;
            const surname1P2=surname1P.value;
            const surname2P2=surname2P.value;
            const emailP2=emailP.value;
            const addressP2=addressP.value;
            const phoneP2=phoneP.value;
            const professionP2=professionP.value;

            //Part que apareix a la esquerra "Perfil"

            leftContent.classList.remove("hidden");
            leftContent.classList.add("flex");
            leftContent.classList.add("w-2/4");

            const meta = document.querySelector('meta[name="csrf-token"]');
            const token = meta ? meta.getAttribute('content') : '';

            leftContentH1.innerHTML=nameP2+" "+surname1P2+" "+surname2P2;
            leftContentH3.innerHTML=professionP2;
            leftContentEmail.innerHTML=emailP2;
            leftContentAddress.innerHTML=addressP2;
            leftContentPhone.innerHTML=phoneP2;

            //Valoracions

            fetch(getAssessmentUrl,{
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                    body: JSON.stringify({ idP2: idP2 })
                })
                .then(response => {
                    if (!response.ok) throw new Error('Error del servidor');
                    return response.json();
                })
                .then(resposta =>{
                    if (resposta.trobat) {
                        const mitja=(resposta.median*10)/3;
                        leftContentEvaluation.innerHTML=mitja;
                    } else {
                        leftContentEvaluation.innerHTML = '<p class="">Aquest Usuari no te ninguna valoracio</p>';
                    }
                })
                .catch(error => {
                    console.error('Error fetch:', error);
                    leftContentEvaluation.innerHTML = '<p class="text-red-600">Error en la consulta</p>';
                });
            });
            
    });

    leftContentButton.addEventListener('click',()=>{
        leftContent.classList.remove("flex");
        leftContent.classList.remove("w-2/4");
        leftContent.classList.add("hidden");
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