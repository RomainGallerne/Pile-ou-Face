var pile = 0;
var face = 0;
var nbLance = 0;

function Tirage(truque){
    let div;
    if(truque){div = 3;}
    else{div = 2;}
    
    if(nbLance < 10){
        nbLance += 1;
    }
    document.getElementById("lancer").className = "disabled";
    $('#lancer').attr("onclick","");

    if((Date.now()) % div){ //Date.now() retourne un nombre en 10^-7 secondes => Imprédictible pour un humain
      console.log('Pile'); //Si impair, on choisit pile
      pile += 1;
      Rotation("https://raw.githubusercontent.com/RomainGallerne/Pile-ou-Face/main/images/Pile.png","https://raw.githubusercontent.com/RomainGallerne/Pile-ou-Face/main/images/Face.png");
      setTimeout(function(){document.getElementById("historique").innerHTML += "<li class='listpoint'>Pile</li>"},4000);
    }
    else {
      console.log('Face'); //Si pair, on choisit face
      face += 1;
      Rotation("https://raw.githubusercontent.com/RomainGallerne/Pile-ou-Face/main/images/Face.png","https://raw.githubusercontent.com/RomainGallerne/Pile-ou-Face/main/images/Pile.png");
      setTimeout(function(){document.getElementById("historique").innerHTML += "<li class='listpoint'>Face</li>"},4000);
    }
    setTimeout(function(){
        document.getElementById("nbLance").innerHTML = "Nombre de lancer : "+nbLance+"/10";
        document.getElementById("lancer").className = "lancer";
        $('#lancer').attr("onclick","Tirage()");
        if(nbLance == 10){
            document.getElementById('qcm').setAttribute("class","qcm col-12")
            document.getElementById('qcm').innerHTML = `<form class="centre" method="post">
            <p><h5>D'après vos quelques essais, pensez vous que le jeu soit truqué ?</h5> 
                <div>
                    <input type="radio" id="TOui" name="truque" value="oui" required>
                    <label for="TOui">Oui</label>
                </div>
                <div>
                    <input type="radio" id="TNon" name="truque" value="non" required>
                    <label for="TNon">Non</label>
                </div>
            </p><br>
            <p><h5>Pourquoi cette réponse ? (en quelques mots) :</h5> <input type="text" name="pourquoi" maxlength=500 required/></p><br>
            <p><h5>Aviez-vous un a priori sur le fait que ce programme soit truqué ou non avant de commencer à jouer ? </h5>
                <div>
                    <input type="radio" id="AOui" name="apriori" value="oui" required>
                    <label for="AOui">Oui</label>
                </div>
                <div>
                    <input type="radio" id="ANon" name="apriori" value="non" required>
                    <label for="ANon">Non</label>
                </div>
            </p><br>
            <p> <h5>Sur quelles critères accordez-vous ou non votre confiance à une application ? (plusieurs réponses possibles)</h5>
                <div>
                    <input type="checkbox" id="expU" name="confiance" value="expU">
                    <label for="expU">Votre expérience d'utilisateur</label>
                </div>
                <div>
                    <input type="checkbox" id="personne" name="confiance" value="personne">
                    <label for="personne">La personne/entreprise l'ayant développé</label>
                </div>
                <div>
                    <input type="checkbox" id="reputation" name="confiance" value="reputation">
                    <label for="reputation">La réputation de l'application</label>
                </div>
                <div>
                    <input type="text" id="autre" name="confiance" placeholder="Autres, à préciser" maxlength=500>
                </div>
            </p><br>
            <p><input class="lancer" type="submit" value="OK"></p>
        </form>`;
        }
    },4000)
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
}