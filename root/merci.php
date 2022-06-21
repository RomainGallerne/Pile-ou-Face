<?php 
    session_start();
    if (!(isset($_SESSION['id']) && $_SESSION['fini'])){
        echo('<meta http-equiv="Refresh" content="0;url=index.php">');
    } 
    if(!(isset($_SESSION['consentement']) && $_SESSION['consentement']=='Je consens')){
        echo('<meta http-equiv="Refresh" content="0;url=index.php">');
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
    <link rel="stylesheet" href="style2.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>

<body>
<header class="HautDePage">
        <div class="row">
            <div class="col-md-3 col-12 left">
                <p><a href="https://www.lirmm.fr/"><img src="Logo-LIRMM-long_329x113.png" alt="logo LIRMM"></a></p>
            </div>
            <div class="col-md-9 col-12 right">
                <div class="inline-block">
                    <a href="https://muse.edu.umontpellier.fr/" target="_blank"><img src="logo_muse_50.png" alt="logo Muse, Montpellier Université d’Excellence"></a>
                    <a href="https://www.umontpellier.fr/" target="_blank"><img src="logo_um_50.png" alt="logo Université de Montpellier"></a>
                    <a href="https://www.cnrs.fr/" target="_blank"><img src="logo_CNRS_50.png" alt="logo Centre National de la Recherche Scientifique"></a>
                    <a href="https://www.univ-montp3.fr/" target="_blank"><img src="logo_UPVM_50.png" alt="logo  Montpellier Université Paul Valéry"></a>
                    <a href="https://www.inria.fr/fr" target="_blank"><img src="logo_inria_rouge_50.png" alt="logo inria"></a>
                </div>
            </div>
        </div>
    </header><br/>
    <div class="centre full">
        <h1>Merci d'avoir répondu !</h1><br/>
        <h3>Vous pouvez maintenant fermer cette page</h3>
    </div>
</body>