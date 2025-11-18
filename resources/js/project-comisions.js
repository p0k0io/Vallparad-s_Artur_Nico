document.addEventListener('DOMContentLoaded',()=>{

    document.querySelectorAll("#projectesComisions li button").forEach(btn=>{
        btn.addEventListener('dragover', function(e){
            e.preventDefault();
        });
        btn.addEventListener('drop', assignProfessional);
    });

    document.querySelectorAll("#professionals li").forEach(prof=> {
        prof.addEventListener('dragstart', gestionarDragStart);
    });

    function gestionarDragStart(e){
        e.dataTransfer.setData("id",e.target.id);
    }

    function assignProfessional(e){
        e.preventDefault();

        const idProf=e.dataTransfer.getData("id");

        const liProj=e.target.closest("li");
        const idProj=liProj.getAttribute("id");

        console.log(idProj);

        const meta = document.querySelector('meta[name="csrf-token"]');
        const token = meta ? meta.getAttribute('content') : '';
        
        fetch('/storeProj',{
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token
            },
            body:JSON.stringify({
                professional_id:idProf,
                project_comision_id:idProj
            })
        })
        .then(resposta =>{
            if (resposta.trobat) {
                console.log(message);
                console.log(data);
            }
            else{
                console.log("No va")
            }
        })
        
        
    }
});