<?php 
    session_start();
    if ((!(isset($_SESSION['id']))) || $_SESSION['id'] == null){
        echo('<meta http-equiv="Refresh" content="0;url=index.php">');
    } 
 
    if((isset($_SESSION['consentement'])) && $_SESSION['consentement']=='Je consens'){ 
        if($_SESSION['versionPage']=="scientifique"){
            echo('<meta http-equiv="Refresh" content="0;url=enquete.php">');
        } 
    } 
    else{
        echo('<meta http-equiv="Refresh" content="0;url=index.php">');
    } 

    if($_SESSION['fini']){
        echo('<meta http-equiv="Refresh" content="0;url=merci.php">');
    } 
?>
<!doctype html>
<html lang="fr">
<head>
    <title>Pile ou Face</title>
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
    <?php
        try {
            $db = new PDO('mysql:host=mysql-pile-ou-face.alwaysdata.net;
            dbname=pile-ou-face_bd','272589','9rYYEY44qzy2');
            $db->exec('source script.sql'); 

            if (isset($_POST['truque']) && isset($_POST['pourquoi'])){
                if (isset($_POST['apriori'])){

                    //Affichage Debug
                    /*
                    echo("id : ".$_SESSION['id']."<br/>");
                    echo("age : ".$_POST['age']."<br/>");
                    echo("sexe : ".$_POST['sexe']."<br/>");
                    echo("version page : ".$_SESSION['versionPage']."<br/>");
                    echo("page truque : ".$_SESSION['pagetruque']."<br/>");
                    echo("utilisateur truque : ".$_POST['truque']."<br/>");
                    echo("raison truque : ".$_POST['pourquoi']."<br/>");
                    echo("apriori : ".$_POST['apriori']."<br/>");
                    echo("raison apriori : ".$_POST['Araison']."<br/>");
                    echo("critereXP : ".$_POST['critereXP']."<br/>");
                    echo("criterePersonne : ".$_POST['criterePersonne']."<br/>");
                    echo("critereReputation : ".$_POST['critereReputation']."<br/>");
                    echo("critereAutre : ".$_POST['critereAutre']."<br/>");
                    */

                    $pagetruque = "faux";
                    if($_SESSION['pagetruque']){
                        $pagetruque = "vrai";
                    } 

                    $sql = $db->prepare('SELECT COUNT(*) FROM pileouface WHERE (idutilisateur>=0)');
                    $sql->execute();
                    $id = $sql->fetch(PDO::FETCH_ASSOC);

                    //Dans le cas o?? deux utilisateur valident le formulaire aux m??me moment
                    if($_SESSION['id'] != $id['COUNT(*)']){
                        $_SESSION['id'] = -$_SESSION['id'];
                    } 

                    $sql = $db->prepare('INSERT INTO pileouface VALUES (:idutilisateur,:age,:sexe,:versionpage,:pagetruque,:utilisateurtruque,:raisontruque,:apriori,:raisonapriori,:critereXP,:criterePersonne,:critereReputation,:critereAutre)');
                    $sql->bindValue(':idutilisateur', $_SESSION['id'],PDO::PARAM_STR);
                    $sql->bindValue(':age', $_POST['age'],PDO::PARAM_STR);
                    $sql->bindValue(':sexe', $_POST['sexe'],PDO::PARAM_STR);
                    $sql->bindValue(':versionpage', $_SESSION['versionPage'], PDO::PARAM_STR);
                    $sql->bindValue(':pagetruque', $pagetruque, PDO::PARAM_STR);
                    $sql->bindValue(':utilisateurtruque', $_POST['truque'], PDO::PARAM_STR);
                    $sql->bindValue(':raisontruque', $_POST['pourquoi'], PDO::PARAM_STR);
                    $sql->bindValue(':apriori', $_POST['apriori'], PDO::PARAM_STR);
                    $sql->bindValue(':raisonapriori', $_POST['Araison'], PDO::PARAM_STR);
                    $sql->bindValue(':critereXP', $_POST['critereXP'], PDO::PARAM_STR);
                    $sql->bindValue(':criterePersonne', $_POST['criterePersonne'], PDO::PARAM_STR);
                    $sql->bindValue(':critereReputation', $_POST['critereReputation'], PDO::PARAM_STR);
                    $sql->bindValue(':critereAutre', $_POST['critereAutre'], PDO::PARAM_STR);

                    $sql->execute();

                    //PAGE DE REMERCIMENT
                    $_SESSION['fini'] = true; 
                    echo('<meta http-equiv="Refresh" content="0;url=merci.php">');
                }
            }
        } catch (PDOException $e) {
            echo "ERREUR : ".$e->getMessage()."<br/>";
        }
        $sql = null;
        $db = null; 
    ?>
    <header class="HautDePage">
        Pile ou Face : Lancez la pi??ce !
    </header>
    <div class="row no-gutters full">
        <div class="col-md-2 col-12">
            <div id="col">
                <h5 class="centered">Dernier Lancer</h5>
                <div id="historique">

                </div>
            </div>
        </div>
        <div class="col-md-10 col-12">
            <div class="contenant">
                <div id="jeu">
                    <img src="Pile.png" id="idImg" class="piece">
                </div>
                <p id="nbLance" class="centre">Nombre de lancers : 0/10</p>
                <input class="lancer" type="button" id="lancer" value="Lancer la Pi??ce" onclick="">
            </div>
        </div>
        <div id="qcm" class="col-0">
            
        </div>
    </div>  
    <script>
        <?php
            echo("var truque =0+".(int)$_SESSION['pagetruque'].";");
        ?>
        $('#lancer').attr('onclick',"Tirage("+truque+")");
    </script>  
</body>
</html>