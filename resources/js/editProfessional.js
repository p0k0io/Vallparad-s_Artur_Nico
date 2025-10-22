document.addEventListener('DOMContentLoaded',()=>{
    const leftContent=document.getElementById('leftContent');
    const edit=document.getElementById('edit');

    edit.addEventListener('click',()=>{
        const professional=document.getElementById('objectProfessional');
        const meta = document.querySelector('meta[name="csrf-token"]');
        const token = meta ? meta.getAttribute('content') : '';

        fetch('')
    });
});