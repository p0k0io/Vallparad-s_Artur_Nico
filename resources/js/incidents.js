document.addEventListener('DOMContentLoaded',()=>{

    const maintForm=document.getElementById('maintenanceForm');
    const rrhhForm=document.getElementById('rrhhForm');
    const accForm=document.getElementById('accidentabilityForm');


    const btMaintenance=document.querySelector('#btMaintenance');
    btMaintenance.addEventListener('click',btMaintenanceClick);

    const btRRHH=document.querySelector('#btRRHH');
    btRRHH.addEventListener('click',btRRHHClick);

    const btAccidentability=document.querySelector('#btAccidentability');
    btAccidentability.addEventListener('click',btAccidentabilityClick);

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
