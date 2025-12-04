document.addEventListener('DOMContentLoaded',()=>{

    document.querySelectorAll('.canviarStatus').forEach(state => {
        console.log(state);
        const currentState=document.querySelector('.canviarStatus')
        const maintenanceTracking=document.querySelector('.ferSeguiment')
        const currentStateInner=currentState.innerHTML;

        state.addEventListener('click', function(event){
            event.stopPropagation();
            const meta = document.querySelector('meta[name="csrf-token"]');
            const token = meta ? meta.getAttribute('content') : '';

            const spanStatus=state.querySelector('span');
            const idM=state.querySelector('input');
            const id=idM.value;

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
});

