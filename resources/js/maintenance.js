document.addEventListener('DOMContentLoaded', () => {
    /*Search bar
    const searchInput = document.getElementById('searchMaintenances');
    const resultat = document.getElementById('resultat');

    searchInput.addEventListener('keyup', () => {
        const search = searchInput ? searchInput.value : '';
        const meta = document.querySelector('meta[name="csrf-token"]');
        const token = meta ? meta.getAttribute('content') : '';


        fetch('/searchMaintenances', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token
            },
            body: JSON.stringify({ search: search })
        })
            .then(response => response.json())
            .then(response => {
                console.log(response.maintenances);
                if (response.trobat) {
                    for(let i in response.maintenances){
                        resultat.innerHTML = `
                        
                            `;
                    }
                } else {
                    resultat.innerHTML = '<p class="text-red-600">Ta buit: </p>';
                }
            })
            .catch(error => {
                console.error('Error fetch:', error);
                resultat.innerHTML = '<p class="text-red-600">Error en la consulta</p>';
            });

    });
    Search bar*/



    document.querySelectorAll('.divMaintCard').forEach(card => {

        let state = card.querySelector(".canviarStatus");
        let trackingA = card.querySelector(".ferSeguiment");
        let closerTrackingDiv = card.querySelector(".closeTrackingDiv");
        let trackDiv = card.querySelector('.trackingDiv');

        let openEdit = card.querySelector('.openEdit');
        let closeEdit = card.querySelector('.closeEdit');
        let editForm = card.querySelector('.editForm');

        state.addEventListener('click', function (event) {
            event.stopPropagation();

            let cardTitle = card.querySelector(".cardTitle");
            

            console.log(cardTitle);

            let currentStateInner = state.querySelector('span');
            let id = state.querySelector('input').value;
            console.log(currentStateInner.innerHTML);

            let meta = document.querySelector('meta[name="csrf-token"]');
            let token = meta ? meta.getAttribute('content') : '';

            if (currentStateInner.innerText === 'Pendent') {
                trackingA.classList.add('hidden');
                trackingA.classList.remove('flex');
            }
            else {
                trackingA.classList.remove('hidden');
                trackingA.classList.add('flex');
            }

            fetch('/changeStateM', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token
                },
                body: JSON.stringify({ id: id })
            })
                .then(response => response.json())
                .then(response => {
                    if (response.success == true) {
                        currentStateInner.innerHTML = response.data;
                    }
                    else {
                        console.log(response.message);
                    }
                })
                .catch(error => {
                    console.error('Error Gran', error);
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


    let maintenancBtn = document.querySelector(".crateMaintenanceButton");


});

