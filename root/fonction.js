var pile = 0;
var face = 0;

function Tirage(){
    document.getElementById('lancer').disabled = true;
    console.log(document.getElementById('lancer').disabled);

    if((Date.now()) % 2){
      console.log('Pile');
      pile += 1;
      Rotation("https://raw.githubusercontent.com/RomainGallerne/Pile-ou-Face/main/images/Pile.png","https://raw.githubusercontent.com/RomainGallerne/Pile-ou-Face/main/images/Face.png");
    }
    else {
      console.log('Face');
      face += 1;
      Rotation("https://raw.githubusercontent.com/RomainGallerne/Pile-ou-Face/main/images/Face.png","https://raw.githubusercontent.com/RomainGallerne/Pile-ou-Face/main/images/Pile.png");
    }
}

function Rotation(vraiIm,fausseIm){
    let max = 8;
    let i = 0;
    if(vraiIm != document.getElementById("idImg").src){max+=1;}
    setTimeout(function(){
        document.getElementById("main").setAttribute("class","top");
        let intervalId = setInterval(function(){
            document.getElementById("idImg").setAttribute("class","rotated");
            if(i>=max){
                clearInterval(intervalId);
                document.getElementById("idImg").src = vraiIm;
                document.getElementById("idImg").setAttribute("class","piece");
            }
            else {
                if(i>=max-2){
                    document.getElementById("main").setAttribute("class","bot");
                }
                i+=1;
                document.getElementById("idImg").clientHeight = document.getElementById("idImg").clientWidth;
                setTimeout(function(){
                    document.getElementById("idImg").setAttribute("class","piece");
                    if(fausseIm == document.getElementById("idImg").src){
                        document.getElementById("idImg").src = vraiIm;
                    } else {
                        document.getElementById("idImg").src = fausseIm;
                    }
                }, 200);
            } 
        }, 400);
    }, 100);
    document.getElementById("lancer").disabled = false;
}