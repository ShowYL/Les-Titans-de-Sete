<?php

session_start(); // Démarrer la session



require 'db_lestitansdesete.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['nomUtilisateur'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM User WHERE Nom_Utilisateur = ?");
    $stmt->bind_param("s", $name);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['Password'])) {
            $_SESSION['loggedin'] = true;
            $_SESSION['user_id'] = $user['ID_User'];
            header('Location: accueil.php');
            exit();
        } else {
            $error = 'Invalid email or password';
        }
    } else {
        $error = 'Invalid email or password';
    }

    $stmt->close();
    $conn->close();
}
?>
