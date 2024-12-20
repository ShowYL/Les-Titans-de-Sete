<?php
require_once __DIR__ . '/../db_lestitansdesete.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nomUtilisateur = $_POST['nomUtilisateur'];
    $password = $_POST['password'];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO User (Password, Nom_Utilisateur) VALUES (?, ?)");
    $stmt->bind_param("ss", $hashed_password, $nomUtilisateur);

    
    if ($stmt->execute()) {
        echo "New account created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>