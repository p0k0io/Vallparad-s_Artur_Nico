let canvas = document.getElementById("canvas");
let clear = document.getElementById('clear');
let context = canvas.getContext("2d");


context.strokeStyle="black";
context.lineCap = "round";
let isPainting = false;
let lineWidth = 5;

clear.addEventListener('click', e=>{
    context.clearRect(0,0,canvas.width, canvas.height);
});

canvas.addEventListener('mousedown', e => {
    isPainting = true;
    let rect = canvas.getBoundingClientRect();
    console.log(rect);
    let x = e.clientX - rect.left;
    let y = e.clientY - rect.top;

    context.beginPath();
    context.moveTo(x, y);
});

canvas.addEventListener('mouseup', e => {
    isPainting = false;
    context.beginPath();
});

canvas.addEventListener('mousemove', e=>{
    if(isPainting) {
        let rect = canvas.getBoundingClientRect();
        let x = e.clientX - rect.left;
        let y = e.clientY - rect.top;
        
        context.lineTo(x, y);
        context.stroke();
    }
});

let data=canvas.toDataURL();
console.log(data);