function getData(){
            fetch('/api/professionals')
                .then(res => res.json())
                .then(data => {
                    console.log(data);
                });
}