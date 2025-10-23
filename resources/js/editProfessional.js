document.addEventListener('DOMContentLoaded',()=>{
    const leftContent=document.getElementById('leftContent');
    //const edit = document.querySelectorAll('form a');
    
    document.querySelectorAll('#professionalTable a').forEach(edit => {
        console.log(edit);
        edit.addEventListener('click', function(event){
            console.log('this:', this);
            console.log('event.target:', event.target); 
            
            const nameP=this.querySelector('input');
            const nameP2=nameP.value;

            const meta = document.querySelector('meta[name="csrf-token"]');
            const token = meta ? meta.getAttribute('content') : '';

            
            leftContent.innerHTML ='';

        });
    });
});