<?php 
    session_start();
    if ((!(isset($_SESSION['id']))) || $_SESSION['id'] == null){
        try {
            $db = new PDO('mysql:host=mysql-pile-ou-face.alwaysdata.net;
            dbname=pile-ou-face_bd','272589','9rYYEY44qzy2');
            $db->exec('source script.sql'); 

            $sql = $db->prepare('SELECT COUNT(*) FROM pileouface');
            $sql->execute();
            $id = $sql->fetch(PDO::FETCH_ASSOC);
            $_SESSION['id'] = $id['COUNT(*)']; 

            if($_SESSION['id']%2 == 0){
                $_SESSION['page'] = 0; //page non truqué 
            } 
            else{
                $_SESSION['page'] = 1; //page truqué
            } 
        } catch (PDOException $e) {
            echo("ERREUR : ".$e->getMessage()."<br/>");
        }

        $db = null;
        $sql = null;
        $_SESSION['fini'] = false;
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

                    /*echo("id : ".$_SESSION['id']."<br/>");
                    echo("page : ".$_SESSION['page']."<br/>");
                    echo("truque : ".$_POST['truque']."<br/>");
                    echo("raison : ".$_POST['pourquoi']."<br/>");
                    echo("apriori : ".$_POST['apriori']."<br/>");
                    echo("critereXP : ".$_POST['critereXP']."<br/>");
                    echo("criterePersonne : ".$_POST['criterePersonne']."<br/>");
                    echo("critereReputation : ".$_POST['critereReputation']."<br/>");
                    echo("critereAutre : ".$_POST['critereAutre']."<br/>");*/

                    $sql = $db->prepare('INSERT INTO pileouface VALUES (:idutilisateur,:typepage,:truque,:raison,:apriori,:critereXP,:criterePersonne,:critereReputation,:critereAutre)');
                    $sql->bindValue(':idutilisateur', $_SESSION['id'],PDO::PARAM_STR);
                    $sql->bindValue(':typepage', $_SESSION['page'], PDO::PARAM_STR);
                    $sql->bindValue(':truque', $_POST['truque'], PDO::PARAM_STR);
                    $sql->bindValue(':raison', $_POST['pourquoi'], PDO::PARAM_STR);
                    $sql->bindValue(':apriori', $_POST['apriori'], PDO::PARAM_STR);
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
        Pile ou Face : Lancez la pièce !
    </header>
    <div class="row no-gutters full">
        <div class="col-md-2 col-12">
            <div id="col">
                <h5 class="centered">Historique</h5>
                <ul id="historique">

                </ul>
            </div>
        </div>
        <div class="col-md-10 col-12">
            <div class="contenant">
                <div id="jeu">
                    <img src="https://raw.githubusercontent.com/RomainGallerne/Pile-ou-Face/main/images/Pile.png" id="idImg" class="piece">
                </div>
                <p id="nbLance" class="centre">Nombre de lancer : 0/10</p>
                <input class="lancer" type="button" id="lancer" value="Lancer la Pièce" onclick="">
            </div>
        </div>
        <div id="qcm" class="col-0">
            
        </div>
    </div>  
    <script>
        <?php
            echo("var truque =0+".$_SESSION['page'].";");
        ?>
        $('#lancer').attr('onclick',"Tirage("+truque+")");
    </script>  
</body>
</html>