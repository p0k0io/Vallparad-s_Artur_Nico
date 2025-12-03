document.addEventListener('DOMContentLoaded',()=>{
   
    const duration=document.getElementById("durationInput");
    const startDate=document.getElementById("startDate");
    const endDate=document.getElementById("endDate");
    const selectBaixa=document.getElementById("baixaSelect");

    

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
