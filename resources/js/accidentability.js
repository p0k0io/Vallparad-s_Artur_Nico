document.addEventListener('DOMContentLoaded',()=>{
   
    const duration=document.getElementById("durationInput");
    const startDate=document.getElementById("startDate");
    const endDate=document.getElementById("endDate");
    const selectBaixa=document.getElementById("baixaSelect");

    
    document.querySelectorAll('.estatBaixa').forEach(state=> {
        console.log(state);

        state.addEventListener('click', function(event){
            event.stopPropagation();
            const meta = document.querySelector('meta[name="csrf-token"]');
            const token = meta ? meta.getAttribute('content') : '';

            const spanStatus=state.querySelector('span');
            const idAcc=state.querySelector('input');
            const id=idAcc.value;

            fetch('/changeStateBaixa',{
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

        document.querySelectorAll('.accidentContent').forEach(type => {

            const accidentDuration=type.querySelector('.accidentDuration');
            const accidentStart=type.querySelector('.accidentStart');
            const accidentEnd=type.querySelector('.accidentEnd');
            const accidentType=type.querySelector('.accidentType');

            console.log(accidentType);

            if(accidentType.innerHTML === "Amb Baixa"){
                accidentDuration.classList.remove('hidden');
                accidentStart.classList.add('hidden');
                accidentEnd.classList.add('hidden');
            }
            else if(accidentType.innerHTML === "Baixa Llarga"){
                accidentDuration.classList.add('hidden');
                accidentStart.classList.remove('hidden');
                accidentEnd.classList.remove('hidden');
            }
            else{
                accidentDuration.classList.add('hidden');
                accidentStart.classList.add('hidden');
                accidentEnd.classList.add('hidden');
            }
        });

    selectBaixa.addEventListener('change',changeBaixaState);


    function changeBaixaState(){
        if(selectBaixa.value === "Amb Baixa"){
            duration.classList.remove("hidden");
            startDate.classList.add("hidden");
            endDate.classList.add("hidden");
        }
        else if (selectBaixa.value === "Baixa Llarga") {
            duration.classList.add("hidden");
            startDate.classList.remove("hidden");
            endDate.classList.remove("hidden");
        }
        else{
            duration.classList.add("hidden");
            startDate.classList.add("hidden");
            endDate.classList.add("hidden");
        }
    }
});
