<?php

// a modifier plus tard pour le serveur en ligne
$servername = "mysql-lestitansdesete.alwaysdata.net";
$username = "385432";
$password = "\$iutinfo";
$dbname = "lestitansdesete_bd";
$port = "3306";

// créer une connexion

$conn = new mysqli($servername, $username, $password, $dbname);

// vérifier la connexion

if ($conn->connect_error) {
    die("La connexion a échoué: " . $conn->connect_error);
}
// echo "Connexion réussie";

?>