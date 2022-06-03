var pile = 0;
var face = 0;
var nbLance = 0;

function Tirage(){
    nbLance += 1;
    document.getElementById('lancer').disabled = true;
    console.log(document.getElementById('lancer').disabled);

    if((Date.now()) % 2){
      console.log('Pile');
      pile += 1;
      Rotation("https://raw.githubusercontent.com/RomainGallerne/Pile-ou-Face/main/images/Pile.png","https://raw.githubusercontent.com/RomainGallerne/Pile-ou-Face/main/images/Face.png");
      setTimeout(function(){document.getElementById("historique").innerHTML += "<li class='listpoint'>Pile</li>"},4500);
    }
    else {
      console.log('Face');
      face += 1;
      Rotation("https://raw.githubusercontent.com/RomainGallerne/Pile-ou-Face/main/images/Face.png","https://raw.githubusercontent.com/RomainGallerne/Pile-ou-Face/main/images/Pile.png");
      setTimeout(function(){document.getElementById("historique").innerHTML += "<li class='listpoint'>Face</li>"},4500);
    }
    setTimeout(function(){document.getElementById("nbLance").innerHTML = "Nombre de lancés : "+nbLance+"/15"},1000)
}

function Rotation(vraiIm,fausseIm){
    let max = 8;
    let i = 0;
    if(vraiIm != document.getElementById("idImg").src){max+=1;}
    setTimeout(function(){
        let intervalId = setInterval(function(){
            document.getElementById("idImg").setAttribute("class","rotated");
            if(i>=max){
                clearInterval(intervalId);
                document.getElementById("idImg").src = vraiIm;
                document.getElementById("idImg").setAttribute("class","piece");
            }
            else {
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