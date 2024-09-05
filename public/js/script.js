if(document.URL.slice('product')[1]){
    let inputs = document.querySelectorAll('form .simulated');
    for(let input of inputs){
        input.onkeyup=function (){
            let input_name =event.target.getAttribute('name');
            let written_el = document.querySelector('.simulation .info span[related_to="'+input_name+'"]');
            written_el.innerHTML = event.target.value;
        }
    }

    let simulation_images = document.querySelector('.simulation .images');
    document.querySelector('form input[type="file"]').onchange = function (){
        simulation_images.innerHTML='';
        for(let file of event.target.files){
            let img = document.createElement('img');
            img.src= URL.createObjectURL(file);
            img.className= 'card-img-top'
            simulation_images.append(img)
        }
    }
}


