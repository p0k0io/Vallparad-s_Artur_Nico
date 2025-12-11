document.addEventListener('DOMContentLoaded',()=>{

    let maintForm=document.getElementById('maintenanceForm');
    let rrhhForm=document.getElementById('rrhhForm');
    let accForm=document.getElementById('accidentabilityForm');
    
    // Accidentabilitat
    let duration=document.getElementById("durationInput");
    let startDate=document.getElementById("startDate");
    let endDate=document.getElementById("endDate");
    let selectBaixa=document.getElementById("baixaSelect");
    /////////////////////////////////////////////////////////////

    let btMaintenance=document.querySelector('#btMaintenance');
    btMaintenance.addEventListener('click',btMaintenanceClick);

    let btRRHH=document.querySelector('#btRRHH');
    btRRHH.addEventListener('click',btRRHHClick);

    let btAccidentability=document.querySelector('#btAccidentability');
    btAccidentability.addEventListener('click',btAccidentabilityClick);

    // Accidentabilitat
    selectBaixa.addEventListener('change',changeBaixaState);

    function changeBaixaState(){
        if(selectBaixa.value === "baixa"){
            duration.classList.remove("hidden");
            startDate.classList.add("hidden");
            endDate.classList.add("hidden");
        }
        else if (selectBaixa.value === "baixa_llarga") {
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
    //////////////////////////////////////////////////////////////////

    //border-orange-500

    function btMaintenanceClick(){
        maintForm.classList.remove('hidden');//////////////
        btMaintenance.classList.add('border-orange-500');//////
        btRRHH.classList.remove('border-orange-500');
        rrhhForm.classList.add('hidden');
        btAccidentability.classList.remove('border-orange-500');
        accForm.classList.add('hidden');
    }

    function btRRHHClick(){
        btMaintenance.classList.remove('border-orange-500');
        maintForm.classList.add('hidden');
        rrhhForm.classList.remove('hidden');////////////////
        btRRHH.classList.add('border-orange-500');////////
        btAccidentability.classList.remove('border-orange-500');
        accForm.classList.add('hidden');
    }

    function btAccidentabilityClick(){
        btMaintenance.classList.remove('border-orange-500');
        maintForm.classList.add('hidden');
        btRRHH.classList.remove('border-orange-500');
        rrhhForm.classList.add('hidden');
        accForm.classList.remove('hidden');/////////////////
        btAccidentability.classList.add('border-orange-500');/////////
    }
});
