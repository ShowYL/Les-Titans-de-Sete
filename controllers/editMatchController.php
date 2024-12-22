<?php
require_once 'MatchController.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['action'] == 'edit') {
    $id = $_POST['id'];
    $date = $_POST['date'];
    $heure = $_POST['heure'];
    $adversaire = $_POST['adversaire'];
    $lieu = $_POST['lieu'];
    $resultat = $_POST['resultat'];

    $controller = new MatchController();
    $error = $controller->updateMatch($date, $heure, $adversaire, $lieu, $resultat, $id);
    $controller->closeConnection();
    
    if (isset($error)) {
        echo $error;
    } else {
        echo "Match modifié avec succès";
    }
}
?>