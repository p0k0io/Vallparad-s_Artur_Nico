document.addEventListener('DOMContentLoaded',()=>{
   
    const duration=document.getElementById("durationInput");
    const startDate=document.getElementById("startDate");
    const endDate=document.getElementById("endDate");
    const selectBaixa=document.getElementById("baixaSelect");


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
