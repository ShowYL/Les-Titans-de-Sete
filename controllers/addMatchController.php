<?php
require_once 'MatchController.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date = $_POST['date'];
    $heure = $_POST['heure'];
    $adversaire = $_POST['adversaire'];
    $lieu = $_POST['lieu'];
    $resultat = $_POST['resultat'];

    $controller = new MatchController();
    $error = $controller->createMatch($date, $heure, $adversaire, $lieu, $resultat);

    if (isset($error)) {
        echo $error;
    }else{
        echo "Match créé avec succès";
    }
}

?>