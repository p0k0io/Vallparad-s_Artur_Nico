document.addEventListener('DOMContentLoaded',()=>{
    document.querySelectorAll('.divMaintCard').forEach(card=>{
        
        let trackingA = card.querySelector(".ferSeguiment");
        let trackDiv=card.querySelector('.trackingDiv');
        let closerTrackingDiv = card.querySelector(".closeTrackingDiv");

        let openEdit = card.querySelector('.openEdit');
        let closeEdit = card.querySelector('.closeEdit');
        let editForm = card.querySelector('.editForm');

        let state = card.querySelector(".canviarStatus");
        state.addEventListener('click', function(event){
            event.stopPropagation();

            let cardTitle = card.querySelector(".cardTitle");
            

            console.log(cardTitle);

            let currentStateInner = state.querySelector('span');
            let id = state.querySelector('input').value;
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
            
            fetch('/changeStateRrhh',{
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


        trackingA.addEventListener('click', function (e) {
            e.stopPropagation();

            trackDiv.classList.remove('hidden');
            trackDiv.classList.add('flex');
        });

        closerTrackingDiv.addEventListener('click', function (e) {
            e.stopPropagation();

            trackDiv.classList.remove('flex');
            trackDiv.classList.add('hidden');
        });

        openEdit.addEventListener('click', function (e) {
            e.stopPropagation();

            editForm.classList.remove('hidden');
            editForm.classList.add('flex');
        });

        closeEdit.addEventListener('click', function (e) {
            e.stopPropagation();

            editForm.classList.remove('flex');
            editForm.classList.add('hidden');
        });

    });
});