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
/*
    function updateEnrollmentMode(id, mode, button) {

    fetch(`/enrolled-in/${id}`, {
        method: 'PATCH',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ mode: mode })
    })
    .then(async res => {
        console.log('Respuesta del servidor:', res);
        const data = await res.json().catch(err => {
            return null;
        });
        return { status: res.status, ok: res.ok, data: data };
    })
    .then(res => {
        console.log('Datos procesados:', res);

        if (!res.ok) {
            showBladeAlert(`Error ${res.status}: No se pudo actualizar`, 'error');
            return;
        }

        if (res.data) {
            showBladeAlert(res.data.message || 'Actualizado correctamente');
            const row = button.closest('tr');
            const modeCell = row.querySelector('td:nth-child(3) span');

            modeCell.textContent = res.data.data.mode;

            if (res.data.data.mode === 'completed') {
                modeCell.className = 'px-2 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700';
                button.textContent = 'Revertir a inscrito';
                button.className = 'text-xs bg-orange-500 hover:bg-orange-600 text-white font-semibold px-3 py-1 rounded-lg transition';
                button.setAttribute('onclick', `updateEnrollmentMode(${id}, 'enrolled', this)`);
            } else {
                modeCell.className = 'px-2 py-1 rounded-full text-xs font-semibold bg-orange-100 text-orange-700';
                button.textContent = 'Marcar como completado';
                button.className = 'text-xs bg-green-500 hover:bg-green-600 text-white font-semibold px-3 py-1 rounded-lg transition';
                button.setAttribute('onclick', `updateEnrollmentMode(${id}, 'completed', this)`);
            }
        }
    })
    .catch(err => {
        console.error('Error en fetch:', err);
        showBladeAlert('Ocurrió un error al actualizar el estado', 'error');
    });
    */
});