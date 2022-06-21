var pile = 0;
var face = 0;
var nbLance = 0;
var precedent = null;
var scrolled = false;

function Tirage(truque){
    let div;
    if(truque){div = 4;}
    else{div = 2;}
    
    if(nbLance < 10){
        nbLance += 1;
    }
    document.getElementById("lancer").className = "disabled";
    var onclick = $('#lancer').attr("onclick");
    $('#lancer').attr("onclick","");

    if(precedent != null){
        let oldprecedent = precedent;
        document.getElementById("historique").innerHTML = "";
        setTimeout(function(){document.getElementById("historique").innerHTML = "<img src='"+oldprecedent+"' class='imgPrec'>"},100);
    } 

    if((Date.now()) % div){ //Date.now() retourne un nombre en 10^-7 secondes => Imprédictible pour un humain
        console.log('Pile'); //Si impair, on choisit pile
        pile += 1;
        Rotation("Pile.png","Face.png");
        precedent = "Pile.png";
    }
    else {
        console.log('Face'); //Si pair, on choisit face
        face += 1;
        Rotation("Face.png","Pile.png");
        precedent = "Face.png";
      
    }
    setTimeout(function(){
        document.getElementById("nbLance").innerHTML = "Nombre de lancers : "+nbLance+"/10";
        document.getElementById("lancer").className = "lancer";
        $('#lancer').attr("onclick",onclick);
        if(nbLance == 1){
            document.getElementById('qcm').setAttribute("class","qcm col-12")
            document.getElementById('qcm').innerHTML = `<form class="centre" method="post">
            <h1>Encore une petite minute !</h1><br/>
            <p><h5> Veuillez indiquer votre tranche d'âge, ainsi que votre sexe</h5>
                <p><select name="age" id="age">
                    <option value="-18">moins de 18 ans</option>
                    <option value="18-25">18 à 25 ans</option>
                    <option value="26-40">26 à 40 ans</option>
                    <option value="41-60">41 à 60 ans</option>
                    <option value="60+">plus de 60ans</option>
                </select></p><p>
                <select name="sexe" id="sexe">
                    <option value="Homme">Homme</option>
                    <option value="Femme">Femme</option>
                </select></p>
            </p><br/>
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
                    <input type="radio" id="AOui" name="apriori" value="oui" onclick="ouiApriori()" required>
                    <label for="AOui">Oui</label>
                </div>
                <div>
                    <input type="radio" id="ANon" name="apriori" value="non" onclick="ouiApriori()" required>
                    <label for="ANon">Non</label>
                </div>     
            </p><br>
            <div id="AraisonDisplay">
                <p> <h5> Quelles sont les raisons qui ont engendré cet apriori ? </h5>
                    <div>
                        <input type="text" id="Araison" name="Araison" maxlength=500>
                    </div>
                </p><br/>
            </div>
            <p> <h5>Sur quelles critères accordez-vous ou non votre confiance à une application ? (plusieurs réponses possibles)</h5>
                <div>
                    <input type="checkbox" id="expU" name="critereXP" value="oui">
                    <label for="expU">Votre expérience d'utilisateur</label>
                </div>
                <div>
                    <input type="checkbox" id="personne" name="criterePersonne" value="oui">
                    <label for="personne">La personne/entreprise l'ayant développé</label>
                </div>
                <div>
                    <input type="checkbox" id="reputation" name="critereReputation" value="oui">
                    <label for="reputation">La réputation de l'application</label>
                </div>
                <div>
                    <input type="text" id="autre" name="critereAutre" placeholder="Autres, à préciser" maxlength=500>
                </div>
            </p><br>
            <p><input class="lancer" type="submit" value="OK"></p>
            </form>`;
            ouiApriori();
            if (!scrolled){
                window.scrollTo({top: 800, behavior: 'smooth'});
                scrolled = true;
            } 
        }
    },4000)
}

function ouiApriori() {
    var divARaison = document.getElementById("AraisonDisplay");
    if(!!document.getElementById("AOui")){
        if (document.getElementById("AOui").checked == true) {
            divARaison.style.display = "block";
        } 
        else {
            divARaison.style.display = "none";
            document.getElementById("Araison").value = null;
        } 
    } 
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