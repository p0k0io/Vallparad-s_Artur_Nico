document.addEventListener('DOMContentLoaded',()=>{
    let leftContent=document.getElementById('leftContent');
    let leftContentH1=document.getElementById('leftContentH1');
    let leftContentH3=document.getElementById('leftContentH3');
    let leftContentEmail=document.getElementById('leftContentMail');
    let leftContentAddress=document.getElementById('leftContentAddress');
    let leftContentPhone=document.getElementById('leftContentPhone');
    let leftContentButton=document.getElementById('leftContentButton');
    let leftContentEvaluation=document.getElementById('leftContentEvaluation');
    
    let seguiments=document.getElementById('seguiments');
    
    

    document.querySelectorAll('#professionalTable a.perfil').forEach(edit => {
        console.log(edit);
        edit.addEventListener('click', function(event){
            console.log('this:', this);
            console.log('event.target:', event.target); 
            
            let idP=this.querySelector('#idP');
            let nameP=this.querySelector('#nameP');
            let surname1P=this.querySelector('#surname1P');
            let surname2P=this.querySelector('#surname2P');
            let emailP=this.querySelector('#emailP');
            let addressP=this.querySelector('#addressP');
            let phoneP=this.querySelector('#phoneP');
            let professionP=this.querySelector('#professionP');
            let idP2=idP.value;
            let nameP2=nameP.value;
            let surname1P2=surname1P.value;
            let surname2P2=surname2P.value;
            let emailP2=emailP.value;
            let addressP2=addressP.value;
            let phoneP2=phoneP.value;
            let professionP2=professionP.value;

            //Part que apareix a la esquerra "Perfil"

            leftContent.classList.remove("hidden");
            leftContent.classList.add("flex");
            leftContent.classList.add("w-2/4");

            let meta = document.querySelector('meta[name="csrf-token"]');
            let token = meta ? meta.getAttribute('content') : '';

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
                        let mitja=(resposta.median*10)/3;
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
       
        let name = searchP ? searchP.value : '';
        let meta = document.querySelector('meta[name="csrf-token"]');
        let token = meta ? meta.getAttribute('content') : '';

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