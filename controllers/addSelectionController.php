<?php
require_once 'selectionController.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idJoueur = $_POST['ID_Joueur'];
    $idMatch = $_POST['ID_Match'];
    $titulaire = $_POST['Titulaire'];
    $poste = $_POST['Poste'];


    $controller = new selectionController();
    $error = $controller->createSelection($idJoueur, $idMatch, $titulaire, $poste);
    $controller->closeConnection();
    if (isset($error)) {
        echo $error;
    }else{
        echo "Joueur créeee avec succès";
    }
}


?>