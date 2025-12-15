document.addEventListener('DOMContentLoaded',()=>{

    document.querySelectorAll('.ferSeguiment').forEach(tracking => {

        let trackDiv=tracking.querySelector('.fixed');

        tracking.addEventListener('click', function(event){
            event.stopPropagation();

            trackDiv.classList.remove('hidden');
            trackDiv.classList.add('flex');
        });
    });


    document.querySelectorAll('.canviarStatus').forEach(state => {
        console.log(state);
        let currentState=document.querySelector('.canviarStatus');
        let maintenanceTracking=document.querySelector('.ferSeguiment');
        let currentStateInner=currentState.innerHTML;

        state.addEventListener('click', function(event){
            event.stopPropagation();
            let meta = document.querySelector('meta[name="csrf-token"]');
            let token = meta ? meta.getAttribute('content') : '';

            let spanStatus=state.querySelector('span');
            let idM=state.querySelector('input');
            let id=idM.value;

            /*
                if(currentStateInner==='Resolt'){
                    currentState.classList.remove('bg-orange-200');
                    currentState.classList.remove('text-orange-500');
                    currentState.classList.remove('border-orange-300');
                    currentState.classList.add('bg-green-200');
                    currentState.classList.add('text-green-500');
                    currentState.classList.add('border-green-300');
                }
                else{
                    currentState.classList.remove('bg-green-200');
                    currentState.classList.remove('text-green-500');
                    currentState.classList.remove('border-green-300');
                    currentState.classList.add('bg-orange-200');
                    currentState.classList.add('text-orange-500');
                    currentState.classList.add('border-orange-300');
                }
            */
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
                    spanStatus.innerHTML=response.data;
                    /*
                    if(response.data==='Resolt'){
                        currentState.classList.remove('bg-orange-200');
                        currentState.classList.remove('text-orange-500');
                        currentState.classList.remove('border-orange-300');
                        currentState.classList.add('bg-green-200');
                        currentState.classList.add('text-green-500');
                        currentState.classList.add('border-green-300');
                    }
                    else{
                        currentState.classList.remove('bg-green-200');
                        currentState.classList.remove('text-green-500');
                        currentState.classList.remove('border-green-300');
                        currentState.classList.add('bg-orange-200');
                        currentState.classList.add('text-orange-500');
                        currentState.classList.add('border-orange-300');
                    }
                    */
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

    /*
    document.querySelectorAll("maintenanceTrackingCard").forEach(trackingList=>{

    });
    */
});

