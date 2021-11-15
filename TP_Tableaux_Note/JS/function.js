    //fonction javascript qui active la zone de texte en fonction de la check box
    function checkBox(val)
    {
        console.log(val);
        let text =document.getElementById("txt"+val);
                if(text.disabled == true){
                        text.disabled = false;
                }
                else{
                         text.disabled = true;
                }
    }



    function changeColor(){

    const contents = document.getElementbyClassName('moyenne');

            for (var i=0; i<contents.lengt; i++){

                if(x<10){
                        
                        var x = contents[i].style.backgroundColor = red;

                }

                if(x>10){
                        
                        var x = contents[i].style.backgroundColor = orange;

                }

                if(x>14){
                        
                        var x = contents[i].style.backgroundColor = green;

                }
            }

    }