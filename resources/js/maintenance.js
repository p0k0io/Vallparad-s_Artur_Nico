document.addEventListener('DOMContentLoaded',()=>{
    document.querySelectorAll('.liMaintCard').forEach(card=>{

        let state = card.querySelector(".canviarStatus");
        state.addEventListener('click', function(event){
            event.stopPropagation();

            const cardTitle = card.querySelector(".cardTitle");
            const trackingA = card.querySelector(".ferSeguiment");

            console.log(cardTitle);

            const currentStateInner = state.querySelector('span');
            const id = state.querySelector('input').value;
            console.log(currentStateInner.innerHTML);

            let meta = document.querySelector('meta[name="csrf-token"]');
            let token = meta ? meta.getAttribute('content') : '';

            if(currentStateInner.innerText === 'Pendent') {
                trackingA.classList.add('hidden');
                trackingA.classList.remove('flex');
            }
            else{
                trackingA.classList.remove('hidden');
                trackingA.classList.add('flex');
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

        tracking.addEventListener('click', function(e){
            trackDiv.classList.remove('hidden');
            trackDiv.classList.add('flex');
        });
        
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

