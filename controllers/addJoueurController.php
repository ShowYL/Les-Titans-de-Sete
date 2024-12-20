<?php
require_once 'JoueurController.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $licence = $_POST['licence'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $taille = $_POST['taille'];
    $poids = $_POST['poids'];
    $date_naissance = $_POST['date_naissance'];
    $statut = $_POST['statut'];
    $commentaire = $_POST['commentaire'];

    $controller = new JoueurController();
    $error = $controller->createJoueur($licence, $nom, $prenom, $taille, $poids, $date_naissance, $statut, $commentaire);

    if (isset($error)) {
        echo $error;
    }else{
        echo "Joueur créeee avec succès";
    }
}


?>