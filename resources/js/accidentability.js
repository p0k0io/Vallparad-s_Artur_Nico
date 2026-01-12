document.addEventListener('DOMContentLoaded',()=>{
   
    let duration=document.getElementById("durationInput");
    let startDate=document.getElementById("startDate");
    let endDate=document.getElementById("endDate");
    let selectBaixa=document.getElementById("baixaSelect");

    
    document.querySelectorAll('.estatBaixa').forEach(state=> {
        console.log(state);

        state.addEventListener('click', function(event){
            event.stopPropagation();
            let meta = document.querySelector('meta[name="csrf-token"]');
            let token = meta ? meta.getAttribute('content') : '';

            let spanStatus=state.querySelector('span');
            let idAcc=state.querySelector('input');
            let id=idAcc.value;

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

            let accidentDuration=type.querySelector('.accidentDuration');
            let accidentStart=type.querySelector('.accidentStart');
            let accidentEnd=type.querySelector('.accidentEnd');
            let accidentType=type.querySelector('.accidentType');

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
