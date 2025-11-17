document.addEventListener('DOMContentLoaded',()=>{

    document.querySelectorAll("#projectesComisions li").forEach(pC=> {
        console.log(pC)
        pC.addEventListener('drop',assignProfessional);

    });

    document.querySelectorAll("#professionals li").forEach(prof=> {
        console.log(prof)
        prof.addEventListener('dragstart', gestionarDragStart)

        const idP=this.querySelector('#idP');
    });


    function gestionarDragStart(e){
        e.dataTransfer
    }

    function assignProfessional(id,e){
        const bg=document.getElementById("test");
        e.preventDefault();
        if(e.type=="drop"){
            console.log(id);
            bg.classList.remove("bg-slate-50");
            bg.classList.add("bg-red-500");
            console.log("Adeu");
        }
        else{
            console.log("Adeu");
        }
    }
});