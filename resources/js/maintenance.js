document.addEventListener('DOMContentLoaded',()=>{
    document.querySelectorAll('li').forEach(card=>{

        let state = card.querySelector(".canviarStatus");
        state.addEventListener('click', function(event){
            event.stopPropagation();

            const parent = state.closest('li');
            const parentBtn = state.closest('button');
            const cardTitle = card.querySelector(".cardTitle");
            const trackingA = card.querySelector(".ferSeguiment");
            const divBottom = card.querySelector(".bottomDiv");

            console.log(cardTitle);

            const currentState = state;
            const currentStateInner = state.querySelector('span');
            const id = state.querySelector('input').value;
            console.log(currentStateInner.innerHTML);

            let meta = document.querySelector('meta[name="csrf-token"]');
            let token = meta ? meta.getAttribute('content') : '';

            if(currentStateInner.innerText === 'Pendent') {
                divBottom.classList.remove('border-orange-100');
                divBottom.classList.add('border-gray-200');
                cardTitle.classList.remove('text-orange-500');
                cardTitle.classList.add('text-gray-500');
                parentBtn.classList.remove('bg-orange-50','hover:bg-orange-100');
                parentBtn.classList.add('bg-gray-100','hover:bg-gray-200');
                parent.classList.remove('border-orange-300');
                parent.classList.add('border-gray-300');
                currentState.classList.remove('bg-orange-200','text-orange-500','border-orange-400','hover:bg-orange-100');
                currentState.classList.add('bg-gray-200','text-gray-500','border-gray-400','hover:bg-gray-100');
                trackingA.classList.add('hidden');
                trackingA.classList.remove('flex','bg-orange-200','text-orange-500','border-orange-400','hover:bg-orange-100');
            }
            else{
                divBottom.classList.remove('border-gray-200');
                divBottom.classList.add('border-orange-100');
                cardTitle.classList.remove('text-gray-500');
                cardTitle.classList.add('text-orange-500');
                parentBtn.classList.remove('bg-gray-100','hover:bg-gray-200');
                parentBtn.classList.add('bg-orange-50','hover:bg-orange-100');
                parent.classList.remove('border-gray-300');
                parent.classList.add('border-orange-300');
                currentState.classList.remove('bg-gray-200','text-gray-500','border-gray-400','hover:bg-gray-100');
                currentState.classList.add('bg-orange-200','text-orange-500','border-orange-400','hover:bg-orange-100');
                trackingA.classList.remove('hidden');
                trackingA.classList.add('flex','bg-orange-200','text-orange-500','border-orange-400','hover:bg-orange-100');
            }
            
            fetch('/changeStateM',{
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                    body: JSON.stringify({ id: id })
            })
            .then(response => response.json())
            .then(response =>{
                if (response.success==true) {
                    currentStateInner.innerHTML=response.data;
                }
                else{
                    console.log(response.message);
                }
            })
            .catch(error => {
                console.error('Error Gran',error);
            });
        });

    });


    let maintenancBtn=document.querySelector(".crateMaintenanceButton");



    document.querySelectorAll('.ferSeguiment').forEach(tracking => {

        let trackDiv=tracking.querySelector('.fixed');

        tracking.addEventListener('click', function(event){
            event.stopPropagation();

            trackDiv.classList.remove('hidden');
            trackDiv.classList.add('flex');
        });

        
        trackDiv.addEventListener('click', function(event){
            event.stopPropagation();

            trackDiv.classList.add('hidden');
            trackDiv.classList.remove('flex');
        });
        
    });

    document.querySelectorAll('.editar').forEach(tracking => {

        let editDiv=tracking.querySelector('.fixed');

        tracking.addEventListener('click', function(event){
            event.stopPropagation();

            editDiv.classList.remove('hidden');
            editDiv.classList.add('flex');
        });

        //tracking.querySelector('');
    });

    /*
    document.querySelectorAll('.backdrop-blur-sm').forEach(e=>{
        e.addEventListener('click',function(event){
            console.log("Ola")
            e.classList.add('hidden');
        })
    });
    */
});

