var pile = 0;
var face = 0;

function Tirage(){
    //let html = '';

    if((Date.now()) % 2){
      //html += 'Pile';
      pile += 1;
      Rotation("Pile.png","Face.png");
    }
    else {
      //html += 'Face';
      face += 1;
      Rotation("Face.png","Pile.png");
    }
    //document.getElementById("main").innerHTML = "   ";
    //setTimeout("TirageAffiche('"+html+"')", 100);
}

function TirageAffiche(html){
    document.getElementById('main').innerHTML = html;
}

function Rotation(vraiIm,fausseIm){
    let max = 4;
    let i = 0;
    console.log(vraiIm);
    console.log(document.getElementById("idImg").src);
    if(vraiIm != document.getElementById("idImg").src){max+=1;}
    setTimeout(function(){
        let intervalId = setInterval(function(){
            console.log(i);
            document.getElementById("idImg").setAttribute("class","rotated");
            if(i>=max){
                clearInterval(intervalId);
                document.getElementById("idImg").src = vraiIm;
                document.getElementById("idImg").setAttribute("class","piece");
            }
            else {i+=1;}
            if(fausseIm == document.getElementById("idImg").src){
                document.getElementById("idImg").src = vraiIm;
            } else {
                document.getElementById("idImg").src = fausseIm;
            }
            document.getElementById("idImg").clientHeight = document.getElementById("idImg").clientWidth;
            /*setTimeout(function(){
                document.getElementById("idImg").setAttribute("class","piece");
            }, 100);*/ 
        }, 500);
    }, 100);
}