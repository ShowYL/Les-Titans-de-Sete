<? php

// a modifier plus tard pour le serveur en ligne
$servername = "localhost"; 
$username = "root";
$password = "";
$dbname = "db_lestitansdesete";

// créer une connexion

$conn = new mysqli($servername, $username, $password, $dbname);

// vérifier la connexion

if ($conn->connect_error) {
    die("La connexion a échoué: " . $conn->connect_error);
}
echo "Connexion réussie";

?>