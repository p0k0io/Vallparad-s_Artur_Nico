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

    function showBladeAlert(message,success) {
        let toast = document.createElement('div');
        if(success==true){
            toast.className = `
            flex gap-2 items-center text-white font-medium
            px-4 py-3 rounded-xl shadow-xl backdrop-blur
            animate-fade-in-up border border-white/20
            bg-green-500
            `;
        }
        else{
            toast.className = `
            flex gap-2 items-center text-white font-medium
            px-4 py-3 rounded-xl shadow-xl backdrop-blur
            animate-fade-in-up border border-white/20
            bg-red-500
        `;
        }
        
        toast.innerHTML = `<span>${message}</span>`;
        document.getElementById('toast-container').appendChild(toast);
        setTimeout(() => {
            toast.classList.add('animate-fade-out');
            setTimeout(() => toast.remove(), 350);
        }, 3000);
    }

    function gestionarDragStart(e){
        e.dataTransfer.setData("id",e.target.id);
    }

    function assignProfessional(e){
        e.preventDefault();

        let idProf=e.dataTransfer.getData("id");

        let liProj=e.target.closest("li");
        let idProj=liProj.getAttribute("id");

        console.log(idProf);
        console.log(idProj);

        let meta = document.querySelector('meta[name="csrf-token"]');
        let token = meta ? meta.getAttribute('content') : '';
        
        
        fetch('storeProj',{
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
        .then(response => response.json())
        .then(response =>{
            if (response.success==true) {
                console.log(response.message);
            }
            else{
                console.log(response.message);
            }
            showBladeAlert(response.message,response.success);
        })
        .catch(error => {
            console.error('Error Gran',error);
        });
        
        
    }



    document.querySelectorAll('.pjli').forEach(card => {


        let openEdit = card.querySelector('.openEdit');
        let closeEdit = card.querySelector('.closeEdit');
        let editForm = card.querySelector('.editForm');


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



    
});