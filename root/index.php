<?php 
    session_start();

    //DEBUG
    /*
    echo("session id : ".$_SESSION['id']."<br/>");
    echo("session truque : ".$_SESSION['pagetruque']."<br/>");
    echo("session  version page : ".$_SESSION['versionPage']."<br/>");
    echo("get consentement : ".$_GET['consentement']."<br/>");
    echo("session consentement : ".$_SESSION['consentement']."<br/>");
    */

    if($_SESSION['fini']){
        echo('<meta http-equiv="Refresh" content="0;url=merci.php">');
    }

    if ((!(isset($_SESSION['id']))) || $_SESSION['id'] == null){
        try {
            $db = new PDO('mysql:host=mysql-pile-ou-face.alwaysdata.net;
            dbname=pile-ou-face_bd','272589','9rYYEY44qzy2');
            $db->exec('source script.sql'); 

            $sql = $db->prepare('SELECT COUNT(*) FROM pileouface WHERE (idutilisateur>=0)');
            $sql->execute();
            $id = $sql->fetch(PDO::FETCH_ASSOC);
            $_SESSION['id'] = $id['COUNT(*)']; 

            if($_SESSION['id']%2 == 0){
                $_SESSION['pagetruque'] = false; //page non truqué 
            } 
            else{
                $_SESSION['pagetruque'] = true; //page truqué
            } 

            if($_SESSION['id']%4 == 2 || $_SESSION['id']%4 == 3){
                $_SESSION['versionPage'] = "normal"; //page normal
            } 
            else{
                $_SESSION['versionPage'] = "scientifique"; //page scientifique
            } 

        } catch (PDOException $e) {
            echo("ERREUR : ".$e->getMessage()."<br/>");
        }

        $db = null;
        $sql = null;
        $_SESSION['fini'] = false;
    } 
    else{
        if($_GET['consentement']=="Je consens"){ 
            $_SESSION['consentement'] = $_GET['consentement']; 
        } 
        if($_SESSION['consentement']=='Je consens'){ 
            if($_SESSION['versionPage']=="scientifique"){
                echo('<meta http-equiv="Refresh" content="0;url=enquete.php">');
            } 
            else{
                echo('<meta http-equiv="Refresh" content="0;url=jeu.php">');
            } 
        } 
    }  
?>
<!doctype html>
<html lang="fr">
<head>
    <title>Pile ou Face : Accueil</title>
    <meta charset="utf-8"/>
    <link rel="icon" href="piece.png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="fonction.js"></script>
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>

<body>
    <div class="legal">
        <form>
            <h3>Bienvenue !</h3>
            <p>
                Bienvenue et merci à vous de bien vouloir prendre le temps de répondre à cette courte enquête ! (~2 minutes)<br/>
                Il vous sera demander d'interagir 10 fois avec le jeu de pile ou face qui va suivre. Après ces 10 lancers, vous pourrez passer à la suite.<br/><br/>
                Nous collectons vos données de manière totalement anonyme et à usage scientifique uniquement, aucune autres données que celles vous étant explicitement demandées ne seront collectées.<br/>
                Les données collectées seront conservées dans une base de données sécurisée pour une durée maximale de 1 an. <br/>
                Passé ce délai, elles seront supprimées.<br/><br/>
                Si vous souhaitez faire supprimer vos données avant ce délai, merci de contacter l'adresse mail suivante : <a href="mailto:pileouface.lirmm@gmail.com">pileouface.lirmm@gmail.com</a> 
            </p><br/>
            <input class="lancer" type="submit" value="Je consens" name="consentement"></input><br/> 
            <div class="container fluid">
                <img src="logo_CNRS_50.png" class="logoAUTRE">
                <img src="Logo-LIRMM-long_329x113.png" class="logoLIRMM">
                <img src="logo_um_50.png" class="logoAUTRE">
            </div>
        </form>
    </div>
</body>
</html>