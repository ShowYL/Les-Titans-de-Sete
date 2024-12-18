<?php
session_start(); // Démarrer la session

require 'db_lestitansdesete.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['nomUtilisateur'];
    $passwordSend = $_POST['password'];

    $stmt = $conn->prepare("SELECT user FROM User WHERE Nom_Utilisateur = ?");
    $stmt->bind_param("s", $name);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($passwordSend, $user['password'])) {
            $_SESSION['loggedin'] = true;
            $_SESSION['user_id'] = $user['ID_User'];
            header('Location: acceuil.php');
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
