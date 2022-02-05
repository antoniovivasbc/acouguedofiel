var validator = 0;
function sidebar(){
    var largura = screen.width;
    var sidebar = document.getElementById("sidebar");
    if(largura <= 400){
        if(validator == 0){
            validator = 1;
            sidebar.style.width = "100vw";
        }else{
            validator = 0;
            sidebar.style.width = "0px";
        }
    }else if(largura <= 600){
        if(validator == 0){
            validator = 1;
            sidebar.style.width = "50vw";
        }else{
            validator = 0;
            sidebar.style.width = "0px";
        } 
    }else if(largura > 600 && largura <= 800){
        if(validator == 0){
            validator = 1;
            sidebar.style.width = "30vw";
        }else{
            validator = 0;
            sidebar.style.width = "0px";
        } 
    }else if(largura > 800 && largura <= 1000){
        if(validator == 0){
            validator = 1;
            sidebar.style.width = "25vw";
        }else{
            validator = 0;
            sidebar.style.width = "0px";
        } 
    }else if(largura > 1000 && largura <= 1400){
        if(validator == 0){
            validator = 1;
            sidebar.style.width = "20vw";
        }else{
            validator = 0;
            sidebar.style.width = "0px";
        } 
    }else if(largura > 1400){
        if(validator == 0){
            validator = 1;
            sidebar.style.width = "15vw";
        }else{
            validator = 0;
            sidebar.style.width = "0px";
        } 
    }    
}