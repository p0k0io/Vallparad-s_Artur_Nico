document.addEventListener('DOMContentLoaded',()=>{

    document.querySelectorAll('.ferSeguiment').forEach(tracking => {

        let trackDiv=tracking.querySelector('.fixed');

        tracking.addEventListener('click', function(event){
            event.stopPropagation();

            trackDiv.classList.remove('hidden');
            trackDiv.classList.add('flex');
        });
    });
});